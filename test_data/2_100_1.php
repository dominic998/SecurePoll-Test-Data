<?php

/**
 * $candidates = [1, 2];
 * $totalVotes = 100;
 * $voteDistribution = [
 *     [50, 50],
 *     [0, 0],
 * ];
 *
 * Results from openstv for number of seats = 1:
 *
 * Counting votes for ElectionTitle using Meek STV.
 * 2 candidates running for 1 seat.
 * 
 *  R|1             |2             |Exhausted     |Surplus       |Threshold     
 * =============================================================================
 *  1|     50.000000|     50.000000|      0.000000|      0.000000|     50.000001
 *   |--------------------------------------------------------------------------
 *   | Count of first choices.
 * =============================================================================
 *  2|     50.000000|              |     50.000000|     24.999999|     25.000001
 *   |--------------------------------------------------------------------------
 *   | Count after eliminating 2 and transferring votes. All losing candidates
 *   | are eliminated. Candidates 1 and 2 were tied when choosing candidates to
 *   | eliminate. Candidate 2 was chosen by breaking the tie randomly. Candidate
 *   | 1 has reached the threshold and is elected.
 * 
 * Winner is 1.
 */

Array
(
    [0] => Array
        (
            [0] => 2
        )

    [1] => Array
        (
            [0] => 1
        )

    [2] => Array
        (
            [0] => 1
        )

    [3] => Array
        (
            [0] => 1
        )

    [4] => Array
        (
            [0] => 2
        )

    [5] => Array
        (
            [0] => 1
        )

    [6] => Array
        (
            [0] => 1
        )

    [7] => Array
        (
            [0] => 2
        )

    [8] => Array
        (
            [0] => 1
        )

    [9] => Array
        (
            [0] => 1
        )

    [10] => Array
        (
            [0] => 1
        )

    [11] => Array
        (
            [0] => 2
        )

    [12] => Array
        (
            [0] => 1
        )

    [13] => Array
        (
            [0] => 1
        )

    [14] => Array
        (
            [0] => 1
        )

    [15] => Array
        (
            [0] => 1
        )

    [16] => Array
        (
            [0] => 1
        )

    [17] => Array
        (
            [0] => 2
        )

    [18] => Array
        (
            [0] => 1
        )

    [19] => Array
        (
            [0] => 2
        )

    [20] => Array
        (
            [0] => 2
        )

    [21] => Array
        (
            [0] => 2
        )

    [22] => Array
        (
            [0] => 1
        )

    [23] => Array
        (
            [0] => 1
        )

    [24] => Array
        (
            [0] => 1
        )

    [25] => Array
        (
            [0] => 1
        )

    [26] => Array
        (
            [0] => 1
        )

    [27] => Array
        (
            [0] => 1
        )

    [28] => Array
        (
            [0] => 1
        )

    [29] => Array
        (
            [0] => 1
        )

    [30] => Array
        (
            [0] => 1
        )

    [31] => Array
        (
            [0] => 2
        )

    [32] => Array
        (
            [0] => 1
        )

    [33] => Array
        (
            [0] => 2
        )

    [34] => Array
        (
            [0] => 2
        )

    [35] => Array
        (
            [0] => 1
        )

    [36] => Array
        (
            [0] => 2
        )

    [37] => Array
        (
            [0] => 2
        )

    [38] => Array
        (
            [0] => 1
        )

    [39] => Array
        (
            [0] => 2
        )

    [40] => Array
        (
            [0] => 1
        )

    [41] => Array
        (
            [0] => 2
        )

    [42] => Array
        (
            [0] => 1
        )

    [43] => Array
        (
            [0] => 2
        )

    [44] => Array
        (
            [0] => 1
        )

    [45] => Array
        (
            [0] => 2
        )

    [46] => Array
        (
            [0] => 1
        )

    [47] => Array
        (
            [0] => 1
        )

    [48] => Array
        (
            [0] => 2
        )

    [49] => Array
        (
            [0] => 2
        )

    [50] => Array
        (
            [0] => 2
        )

    [51] => Array
        (
            [0] => 1
        )

    [52] => Array
        (
            [0] => 1
        )

    [53] => Array
        (
            [0] => 2
        )

    [54] => Array
        (
            [0] => 1
        )

    [55] => Array
        (
            [0] => 2
        )

    [56] => Array
        (
            [0] => 1
        )

    [57] => Array
        (
            [0] => 2
        )

    [58] => Array
        (
            [0] => 1
        )

    [59] => Array
        (
            [0] => 1
        )

    [60] => Array
        (
            [0] => 1
        )

    [61] => Array
        (
            [0] => 1
        )

    [62] => Array
        (
            [0] => 1
        )

    [63] => Array
        (
            [0] => 2
        )

    [64] => Array
        (
            [0] => 2
        )

    [65] => Array
        (
            [0] => 1
        )

    [66] => Array
        (
            [0] => 2
        )

    [67] => Array
        (
            [0] => 1
        )

    [68] => Array
        (
            [0] => 2
        )

    [69] => Array
        (
            [0] => 1
        )

    [70] => Array
        (
            [0] => 2
        )

    [71] => Array
        (
            [0] => 1
        )

    [72] => Array
        (
            [0] => 2
        )

    [73] => Array
        (
            [0] => 2
        )

    [74] => Array
        (
            [0] => 1
        )

    [75] => Array
        (
            [0] => 1
        )

    [76] => Array
        (
            [0] => 2
        )

    [77] => Array
        (
            [0] => 1
        )

    [78] => Array
        (
            [0] => 1
        )

    [79] => Array
        (
            [0] => 1
        )

    [80] => Array
        (
            [0] => 2
        )

    [81] => Array
        (
            [0] => 1
        )

    [82] => Array
        (
            [0] => 2
        )

    [83] => Array
        (
            [0] => 2
        )

    [84] => Array
        (
            [0] => 2
        )

    [85] => Array
        (
            [0] => 2
        )

    [86] => Array
        (
            [0] => 2
        )

    [87] => Array
        (
            [0] => 2
        )

    [88] => Array
        (
            [0] => 2
        )

    [89] => Array
        (
            [0] => 2
        )

    [90] => Array
        (
            [0] => 2
        )

    [91] => Array
        (
            [0] => 2
        )

    [92] => Array
        (
            [0] => 2
        )

    [93] => Array
        (
            [0] => 2
        )

    [94] => Array
        (
            [0] => 2
        )

    [95] => Array
        (
            [0] => 2
        )

    [96] => Array
        (
            [0] => 2
        )

    [97] => Array
        (
            [0] => 2
        )

    [98] => Array
        (
            [0] => 2
        )

    [99] => Array
        (
            [0] => 2
        )

)
