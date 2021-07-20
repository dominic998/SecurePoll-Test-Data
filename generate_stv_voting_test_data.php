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

function createBallots( $candidates, $voteDistribution, $totalVotes ) {
    $votes = [];
    foreach ( range(1, $totalVotes) as $i ) {
        $vote = [];
        foreach ( range(0, count($candidates) - 1) as $j ) {
            $potentialCandidates = [];
            foreach ( $candidates as $index => $candidateName ) {
                // Can only rank a candidate if they have not already been
                // ranked by this vote and if we have not already reached the
                // maximum votes for that candidate for this ranking.
                if ( !in_array($candidateName, $vote) && $voteDistribution[$j][$index] > 0 ) {
                    $potentialCandidates[] = $index;
                }
            }
            if (count($potentialCandidates) > 1) {
                // If more than one potential candidate, choose one at random.
                $index = $potentialCandidates[array_rand($potentialCandidates)];
            } else if (count($potentialCandidates) < 1) {
                break;
            } else {
                $index = $potentialCandidates[0];
            }
            $vote[] = $candidates[$index];
            // Update the vote distribution reflecting that one candidate has
            // been ranked.
            $voteDistribution[$j][$index] = $voteDistribution[$j][$index] - 1;
        }
        $votes[] = $vote;
    }
    return $votes;
}

// Names of the candidates (or some kind of identifier).
$candidates = [1, 2, 3];

// Total number of votes for the election.
$totalVotes = 99;

// Number of votes for each candidate for each "rank". In the same order in
// which the candidates are listed above.
// 
// createBallots is not guaranteed to produce these exact distribution in the
// final ballots. Some distributions might be impossible. There is also an
// element of randomness so the distribution might vary each time you run it.
//
// Currently, we assume preferences are evenly distributed: if two voters put
// candidates x and y resp. for their first choice they are equally likely to
// put candidate z as their second. In practice, this is less likely.
$voteDistribution = [
    [33, 33, 33], // First preference
    [33, 33, 33], // Second preference
    [33, 33, 33], // Third preference
];

// The number of seats is not used in the above function, but it is something to
// consider when testing...
$numSeats = 2;

// The output is an array of arrays. Each vote is an array representing the
// preferences/ranking:
// [
//   [3, 2, 1], first vote
//   [2, 3, 1], second vote
//   ...
// ]
$ballots = createBallots($candidates, $voteDistribution, $totalVotes);

$random = rand();

// file_put_contents(sprintf("%d_%d_%d_%d.php", count($candidates), $numSeats, $totalVotes, $random), var_export($ballots, true));

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
