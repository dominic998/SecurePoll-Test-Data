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

    public $possibleVotes = [
        [ 1, 2, 3, 4 ],
        [ 1, 2, 4, 3 ],
        [ 1, 4, 2, 3 ],
        [ 4, 1, 2, 3 ],
        [ 4, 1, 3, 2 ],
        [ 1, 4, 3, 2 ],
        [ 1, 3, 4, 2 ],
        [ 1, 3, 2, 4 ],
        [ 3, 1, 2, 4 ],
        [ 3, 1, 4, 2 ],
        [ 3, 4, 1, 2 ],
        [ 4, 3, 1, 2 ],
        [ 4, 3, 2, 1 ],
        [ 3, 4, 2, 1 ],
        [ 3, 2, 4, 1 ],
        [ 3, 2, 1, 4 ],
        [ 2, 3, 1, 4 ],
        [ 2, 3, 4, 1 ],
        [ 2, 4, 3, 1 ],
        [ 4, 2, 3, 1 ],
        [ 4, 2, 1, 3 ],
        [ 2, 4, 1, 3 ],
        [ 2, 1, 4, 3 ],
        [ 2, 1, 3, 4 ],
        [ 1, 2, 3 ],
        [ 1, 2, 4 ],
        [ 1, 4, 2 ],
        [ 4, 1, 2 ],
        [ 4, 1, 3 ],
        [ 1, 4, 3 ],
        [ 1, 3, 4 ],
        [ 1, 3, 2 ],
        [ 3, 1, 2 ],
        [ 3, 1, 4 ],
        [ 3, 4, 1 ],
        [ 4, 3, 1 ],
        [ 4, 3, 2 ],
        [ 3, 4, 2 ],
        [ 3, 2, 4 ],
        [ 3, 2, 1 ],
        [ 2, 3, 1 ],
        [ 2, 3, 4 ],
        [ 2, 4, 3 ],
        [ 4, 2, 3 ],
        [ 4, 2, 1 ],
        [ 2, 4, 1 ],
        [ 2, 1, 4 ],
        [ 2, 1, 3 ],
        [ 1, 2 ],
        [ 1, 4 ],
        [ 4, 1 ],
        [ 1, 3 ],
        [ 3, 1 ],
        [ 4, 3 ],
        [ 3, 4 ],
        [ 3, 2 ],
        [ 2, 3 ],
        [ 2, 4 ],
        [ 4, 2 ],
        [ 2, 1 ],
        [ 1 ],
        [ 2 ],
        [ 3 ],
        [ 4 ],
    ];

    function writeBltFile( $ballots, $filename, $numSeats, $candidates ) {
        file_put_contents($filename, sprintf("%d %d\n", count($candidates), $numSeats));

        foreach ( $ballots as $ballot ) {
            file_put_contents($filename, sprintf("1 %s 0\n", implode(" ", $ballot)), FILE_APPEND);
        }

        file_put_contents($filename, "0\n", FILE_APPEND);

        foreach ( $candidates as $candidate ) {
            file_put_contents($filename, sprintf("\"%s\"\n", $candidate), FILE_APPEND);
        }

        file_put_contents($filename, "\"ElectionTitle\"\n", FILE_APPEND);
    }

    /**
	 * @covers \MediaWiki\Extensions\SecurePoll\Talliers\STVTallier::finishTally
	 */
	public function testFinishTally() {
        // Candidates
        $candidatesNames = [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
        ];

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
        $question->method( 'getProperty' )->willReturn( 2 );

        $votesFinal = [
            [ 1, 2, 3, 4 ],
            [ 1, 4, 3 ],
            [ 2, 3 ],
            [ 2 ],
        ];
        foreach ( range( 1, 100 ) as $i ) {
            $chosenVote = FALSE;
            $totalMaxDiff = 0;

            foreach ( $this->possibleVotes as $possVote ) {
                $tempVotes = $votesFinal;
                $tempVotes[] = $possVote;

                $this->tallier = Tallier::factory(
                    $this->createMock( RequestContext::class ),
                    'droop-quota',
                    $this->createMock( ElectionTallier::class ),
                    $question
                );

                foreach ( $tempVotes as $vote ) {
                    $this->tallier->addVote( $vote );
                }

                // Actual
                $this->tallier->finishTally();

                // Expected
                $random = rand();
                $filename = sprintf("descent4/%d_%d_%d_%d.blt", 4, 2, count( $tempVotes ), $random);
                $this->writeBltFile( $tempVotes, $filename, 2, $candidatesNames );
                $yaml = shell_exec( sprintf( "openstv-run-election -r YamlReport MeekSTV %s", $filename ) );
                $expected = yaml_parse( $yaml );
                $expectedElected = [];
                foreach( $expected['Winners'] as $elected ) {
                    $expectedElected[] = $elected + 1;
                }

                // Compare
                // Will exit if they are not equal
                sort( $this->tallier->resultsLog['elected'] );
                // $this->assertEquals( $expectedElected, $this->tallier->resultsLog['elected'], $filename );

                $expected_candidate_votes = [];
                $actual_candidate_votes = [];
                foreach( $expected['Round'] as $i => $round ) {
                    foreach( $round['Tally'] as $candidate => $votes ) {
                        $expected_candidate_votes[$candidate + 1][] = $votes;
                    }
                    if ( isset( $this->tallier->resultsLog['rounds'][$i] ) ) {
                        foreach( $this->tallier->resultsLog['rounds'][$i]['rankings'] as $candidate => $votes ) {
                            $actual_candidate_votes[$candidate][] = $votes['total'];
                        }
                    }
                }

                $results = [];
                foreach( $actual_candidate_votes as $candidate => $votes ) {
                    foreach( $votes as $i => $vote ) {
                        $match = FALSE;
                        foreach( $expected_candidate_votes[$candidate] as $key => $value ) {
                            if ( !$match || abs( $vote - $value ) < $match ) {
                                $match = abs( $vote - $value );
                                $expected_candidate_votes[$candidate] = array_slice( $expected_candidate_votes[$candidate], 1 );
                            }
                        }
                        $results["candidates"][$candidate][] = $match;
                    }
                }

                $maxDiff = 0;
                foreach( $results['candidates'] as $candidateId => $candidate ) {
                    $foo = array_slice( $candidate, 2 );
                    foreach( $foo as $diff ) {
                        if ( $diff > $maxDiff ) {
                            $maxDiff = $diff;
                        }
                    }
                }

                if ( $maxDiff > $totalMaxDiff ) {
                    $chosenVote = $possVote;
                    $totalMaxDiff = $maxDiff;
                }

            }

            if ( $chosenVote ) {
                $votesFinal[] = $chosenVote;
            } else {
                $votesFinal[] = $this->possibleVotes[ array_rand( $this->possibleVotes ) ];
            }

        }

        // Final ballot file
        $random = rand();
        $filename = sprintf("descent4/final_%d_%d_%d_%d.blt", 4, 2, count( $votesFinal ), $random);
        $this->writeBltFile( $votesFinal, $filename, 2, $candidatesNames );
	}
}
