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

function chooseCandidateFromArray( $candidates, $voteDistribution, $vote = [] ) {
    $potentialCandidates = [];
    foreach ( $candidates as $candidateName ) {
        // Can only rank a candidate if they have not already been
        // ranked by this vote and if we have not already reached the
        // maximum votes for that candidate for this ranking.
        if ( isset($voteDistribution[$candidateName]) && !in_array($candidateName, $vote) && $voteDistribution[$candidateName] > 0 ) {
            $potentialCandidates[] = $candidateName;
        }
    }
    if (count($potentialCandidates) > 1) {
        // If more than one potential candidate, choose one at random.
        return $potentialCandidates[array_rand($potentialCandidates)];
    } else if (count($potentialCandidates) < 1) {
        // If no potential candidates, return false
        return false;
    } else {
        return $potentialCandidates[0];
    }
}

function createBallots( $candidates, $voteDistribution, $totalVotes ) {
    $votes = [];

    foreach ( range(1, $totalVotes) as $i ) {
        $vote = [];

        // Voters first preference
        $cand = chooseCandidateFromArray( $candidates, $voteDistribution[1]);
        if ( $cand !== false ) {
            $vote[] = $cand;
            $voteDistribution[1][$cand] = $voteDistribution[1][$cand] - 1;
        } else {
            break;
        }

        // Voters 2nd to nth preference
        foreach ( range(2, count($voteDistribution)) as $round ) {
            if ( isset($voteDistribution[$round][$vote[0]]) ) {
                $cand = chooseCandidateFromArray( $candidates, $voteDistribution[$round][$vote[0]], $vote );
                if ( $cand !== false ) {
                    $vote[] = $cand;
                    // Update the vote distribution reflecting that one candidate has
                    // been ranked.
                    $voteDistribution[$round][$vote[0]][$cand] = $voteDistribution[$round][$vote[0]][$cand] - 1;
                } else {
                    break;
                }
            }
        }

        $votes[] = $vote;
    }

    return $votes;
}

// Names of the candidates (or some kind of identifier).
$candidates = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

// Total number of votes for the election.
$totalVotes = 4838;

// Number of votes for each candidate for each rank/preference.
// 
// createBallots is not guaranteed to produce these exact distribution in the
// final ballots. Some distributions might be impossible. There is also an
// element of randomness so the distribution might vary each time you run it.
$voteDistribution = [
    1 => [   // First preferences
        1 => 501,
        2 => 501,
        3 => 501,
        4 => 501,
        5 => 501,
        6 => 501,
        7 => 501,
        8 => 501,
        9 => 82,
        10 => 82,
        11 => 82,
        12 => 82,
		13 => 83,
		14 => 83,
		15 => 2,
		16 => 2,
		17 => 83,
		18 => 83,
		19 => 83,
		20 => 83,
    ],
];

// The number of seats is not used in the above function, but it is something to
// consider when testing...
$numSeats = 3;

// The output is an array of arrays. Each vote is an array representing the
// preferences/ranking:
// [
//   [3, 2, 1], first vote
//   [2, 3, 1], second vote
//   ...
// ]
$ballots = createBallots($candidates, $voteDistribution, $totalVotes);

$random = rand();

file_put_contents(sprintf("%d_%d_%d_%d.php", count($candidates), $numSeats, $totalVotes, $random), var_export($ballots, true));

$filename = sprintf("%d_%d_%d_%d.blt", count($candidates), $numSeats, $totalVotes, $random);

file_put_contents($filename, sprintf("%d %d\n", count($candidates), $numSeats));

foreach ( $ballots as $ballot ) {
    file_put_contents($filename, sprintf("1 %s 0\n", implode(" ", $ballot)), FILE_APPEND);
}

file_put_contents($filename, "0\n", FILE_APPEND);

foreach ( $candidates as $candidate ) {
    file_put_contents($filename, sprintf("\"%s\"\n", $candidate), FILE_APPEND);
}

file_put_contents($filename, "\"ElectionTitle\"\n", FILE_APPEND);
