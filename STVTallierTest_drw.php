<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 */

namespace MediaWiki\Extensions\SecurePoll\Test\Unit;

use MediaWiki\Extensions\SecurePoll\Entities\Option;
use MediaWiki\Extensions\SecurePoll\Entities\Question;
use MediaWiki\Extensions\SecurePoll\Talliers\ElectionTallier;
use MediaWiki\Extensions\SecurePoll\Talliers\STVTallier;
use MediaWiki\Extensions\SecurePoll\Talliers\Tallier;
use MediaWikiUnitTestCase;
use RequestContext;

/**
 * @group SecurePoll
 * @covers MediaWiki\Extensions\SecurePoll\Talliers\STVTallier
 */
class STVTallierTest extends MediaWikiUnitTestCase {
	protected function setUp(): void {
		parent::setUp();
	}

    /**
	 * @covers \MediaWiki\Extensions\SecurePoll\Talliers\STVTallier::finishTally
	 */
	public function testFinishTally() {
        $ballots = file_get_contents(getenv('FILE'));
        $lines = explode("\n", $ballots);

        // First line gives us number of candidates and seats
        [$numCandidates, $numSeats] = explode(" ", array_shift($lines));

        // The next lines are the actual votes
        $votes = [];
        foreach ( $lines as $index => $line ) {
            // The list of votes end with a "0"
            if ($line == 0) {
                $finalIndex = $index;
                break;
            }

            $vote = explode(" ", $line);

            // First element is number of votes.
            $num = array_shift($vote);
            // Remove the last element, which are not part of the vote, but part
            // of the syntax of OpenSTV.
            array_pop($vote);

            if ( $vote && $vote[0] != "" ) {
                foreach ( range( 1, (int)$num ) as $i ) {
                    $votes[] = $vote;
                }
            }
        }

        // Next lines are candidate names
        $candidatesNames = array_slice($lines, $finalIndex + 1, $numCandidates);
        $cand = [];
        foreach ( $candidatesNames as $index => $name ) {
            $cand[$index + 1] = $name;
        }
        $candidatesNames = $cand;

        // Final line is the name of the election
        $electionName = array_slice($lines, -1)[0];
        $electionName = str_replace("\"", "", $electionName);

        // Tallier constructor requires getOptions to return iterable
        // This allows us to set the candidates
		$options = array_map( function ( $id ) {
			$option = $this->createMock( Option::class );
			$option->method( 'getId' )
				->willReturn( $id );
			return $option;
		}, array_keys( $candidatesNames ) );
		$question = $this->createMock( Question::class );
		$question->method( 'getOptions' )->willReturn( $options );

        // Set the number of seats
        $question->method( 'getProperty' )->willReturn( (int)$numSeats );

		$this->tallier = Tallier::factory(
			$this->createMock( RequestContext::class ),
			'droop-quota',
			$this->createMock( ElectionTallier::class ),
			$question
		);

        foreach ( $votes as $vote ) {
            $this->tallier->addVote( $vote );
        }

		$this->tallier->finishTally();
        // sort( $this->tallier->resultsLog['elected'] );
        // var_dump( $this->tallier->resultsLog );
        // foreach ( $this->tallier->resultsLog['elected'] as $candidateId ) {
        //     var_dump( "Elected: " . $candidatesNames[$candidateId] );
        // }

        // $blt_file = explode( "/", getenv('FILE') );
        // $php_file = array_pop( $blt_file );
        // $php_file = str_replace( ".blt", ".php", $php_file );
        // $php_file = sprintf("%s_%s.php", getenv('FILE'), date("YmdHis"));
        $php_file = sprintf( "%s.php", getenv('FILE') );

        file_put_contents( $php_file, '<?php return '.var_export( $this->tallier->resultsLog, true ).";\n" );

        // $this->assertEquals( $expectedElected, $this->tallier->resultsLog['elected'] );
	}
}
