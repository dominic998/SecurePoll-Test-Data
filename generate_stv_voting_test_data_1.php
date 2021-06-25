<?php

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
$candidates = [1, 2, 3, 4, 5];

// Total number of votes for the election.
$totalVotes = 100;

// Number of votes for each candidate for each "rank". In the same order in
// which the candidates are listed above.
// 
// createBallots is not guaranteed to produce these exact distribution in the
// final ballots. Some distributions might be impossible. There is also an
// element of randomness so the distribution might vary each time you run it.
$voteDistribution = [
    1 => [   // First preferences
        1 => 20,
        2 => 20,
        3 => 20,
        4 => 20,
        5 => 20
    ],
    2 => [   // Second preferences
        1 => [   // Candidate 1
            1 => 0,
            2 => 5,
            3 => 5,
            4 => 5,
            5 => 5
        ],
        2 => [   // Candidate 2
            1 => 5,
            2 => 0,
            3 => 5,
            4 => 5,
            5 => 5
        ],
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
