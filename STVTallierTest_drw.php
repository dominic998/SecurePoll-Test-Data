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

		// Tallier constructor requires getOptions to return iterable
		$options = array_map( function ( $id ) {
			$option = $this->createMock( Option::class );
			$option->method( 'getId' )
				->willReturn( $id );
			return $option;
		}, [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20 ] );
		$question = $this->createMock( Question::class );
		$question->method( 'getOptions' )->willReturn( $options );

		$this->tallier = Tallier::factory(
			$this->createMock( RequestContext::class ),
			'droop-quota',
			$this->createMock( ElectionTallier::class ),
			$question
		);
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

            // Remove the first and last element, which are not part of the vote, but
            // part of the syntax of OpenSTV.
            array_shift($vote);
            array_pop($vote);

            $blah = [];
            foreach ( $vote as $index => $candidate ) {
                $blah[$index + 1] = $candidate;
            }
            $vote = $blah;

            if ( isset( $votes[implode("_", $vote)] ) ) {
                $votes[implode("_", $vote)]['count'] = $votes[implode("_", $vote)]['count'] + 1;
            } else {
                $votes[implode("_", $vote)] = [
                    'count' => 1,
                    'rank' => $vote
                ];
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

        $this->tallier->seats = (int)$numSeats;
        $this->tallier->candidates = $candidatesNames;
        $this->tallier->rankedVotes = $votes;

		$this->tallier->finishTally();
        sort( $this->tallier->resultsLog['elected'] );
        var_dump( $this->tallier->resultsLog['elected'] );
        // $this->assertEquals( $expectedElected, $this->tallier->resultsLog['elected'] );
	}
}
