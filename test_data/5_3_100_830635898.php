<?php

/**
 * $candidates = [1, 2, 3, 4, 5];
 * $totalVotes = 100;
 * $voteDistribution = [
 *     [20, 20, 20, 20, 20],
 *     [2, 1, 1, 1, 1],
 *     [1, 1, 1, 1, 0],
 *     [1, 1, 1, 0, 0],
 *     [1, 1, 0, 0, 0],
 * ];
 *
 * Results from openstv for number of seats = 3:
 *
 * Counting votes for ElectionTitle using Meek STV.
 * 5 candidates running for 3 seats.
 * 
 *  R|1                 |2                 |3                 |4                 
 *   |------------------+------------------+------------------+------------------
 *   |5                 |Exhausted         |Surplus           |Threshold         
 * ==============================================================================
 *  1|         20.000000|         20.000000|         20.000000|         20.000000
 *   |         20.000000|          0.000000|          0.000000|         25.000001
 *   |---------------------------------------------------------------------------
 *   | Count of first choices.
 * ==============================================================================
 *  2|         21.000000|         20.000000|                  |         21.000000
 *   |         20.000000|         18.000000|          0.999998|         20.500001
 *   |---------------------------------------------------------------------------
 *   | Count after eliminating 3 and transferring votes. All losing candidates
 *   | are eliminated. Candidates 1, 2, 3, 4, and 5 were tied when choosing
 *   | candidates to eliminate. Candidate 3 was chosen by breaking the tie
 *   | randomly. Candidates 1 and 4 have reached the threshold and are elected.
 * ==============================================================================
 *  3|         20.523253|         20.047618|                  |         20.523253
 *   |         20.023809|         18.882067|          0.487538|         20.279484
 *   |---------------------------------------------------------------------------
 *   | Count after transferring surplus votes. Keep factors of candidates who
 *   | have exceeded the threshold: 1, 0.976191 and 4, 0.976191.
 * ==============================================================================
 *  4|         20.290686|         20.070806|                  |         20.290686
 *   |         20.035403|         19.312419|          0.237580|         20.171896
 *   |---------------------------------------------------------------------------
 *   | Count after transferring surplus votes. Keep factors of candidates who
 *   | have exceeded the threshold: 1, 0.964597 and 4, 0.964597.
 * ==============================================================================
 *  5|         20.177314|         20.082100|                  |         20.177314
 *   |         20.041050|         19.522222|          0.115738|         20.119445
 *   |---------------------------------------------------------------------------
 *   | Count after transferring surplus votes. Keep factors of candidates who
 *   | have exceeded the threshold: 1, 0.958950 and 4, 0.958950.
 * ==============================================================================
 *  6|         20.122081|         20.087600|                  |         20.122081
 *   |         20.043800|         19.624438|          0.056380|         20.093891
 *   |---------------------------------------------------------------------------
 *   | Count after transferring surplus votes. Keep factors of candidates who
 *   | have exceeded the threshold: 1, 0.956200 and 4, 0.956200.
 * ==============================================================================
 *  7|         20.095182|         20.090278|                  |         20.095182
 *   |         20.045139|         19.674219|          0.036304|         20.081446
 *   |---------------------------------------------------------------------------
 *   | Count after transferring surplus votes. Keep factors of candidates who
 *   | have exceeded the threshold: 1, 0.954861 and 4, 0.954861. Candidate 2 has
 *   | reached the threshold and is elected.
 * 
 * Winners are 1, 2, and 4.
 */

Array
(
    [0] => Array
        (
            [0] => 3
            [1] => 4
            [2] => 2
            [3] => 1
        )

    [1] => Array
        (
            [0] => 4
            [1] => 2
            [2] => 3
        )

    [2] => Array
        (
            [0] => 4
            [1] => 1
        )

    [3] => Array
        (
            [0] => 5
            [1] => 3
            [2] => 1
            [3] => 2
        )

    [4] => Array
        (
            [0] => 3
            [1] => 1
            [2] => 4
        )

    [5] => Array
        (
            [0] => 4
            [1] => 5
        )

    [6] => Array
        (
            [0] => 5
        )

    [7] => Array
        (
            [0] => 2
        )

    [8] => Array
        (
            [0] => 5
        )

    [9] => Array
        (
            [0] => 5
        )

    [10] => Array
        (
            [0] => 2
        )

    [11] => Array
        (
            [0] => 2
        )

    [12] => Array
        (
            [0] => 2
        )

    [13] => Array
        (
            [0] => 1
        )

    [14] => Array
        (
            [0] => 3
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
            [0] => 4
        )

    [18] => Array
        (
            [0] => 3
        )

    [19] => Array
        (
            [0] => 3
        )

    [20] => Array
        (
            [0] => 2
        )

    [21] => Array
        (
            [0] => 3
        )

    [22] => Array
        (
            [0] => 2
        )

    [23] => Array
        (
            [0] => 3
        )

    [24] => Array
        (
            [0] => 3
        )

    [25] => Array
        (
            [0] => 5
        )

    [26] => Array
        (
            [0] => 4
        )

    [27] => Array
        (
            [0] => 2
        )

    [28] => Array
        (
            [0] => 4
        )

    [29] => Array
        (
            [0] => 4
        )

    [30] => Array
        (
            [0] => 4
        )

    [31] => Array
        (
            [0] => 3
        )

    [32] => Array
        (
            [0] => 3
        )

    [33] => Array
        (
            [0] => 2
        )

    [34] => Array
        (
            [0] => 5
        )

    [35] => Array
        (
            [0] => 4
        )

    [36] => Array
        (
            [0] => 4
        )

    [37] => Array
        (
            [0] => 4
        )

    [38] => Array
        (
            [0] => 1
        )

    [39] => Array
        (
            [0] => 3
        )

    [40] => Array
        (
            [0] => 3
        )

    [41] => Array
        (
            [0] => 2
        )

    [42] => Array
        (
            [0] => 4
        )

    [43] => Array
        (
            [0] => 4
        )

    [44] => Array
        (
            [0] => 4
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
            [0] => 2
        )

    [48] => Array
        (
            [0] => 3
        )

    [49] => Array
        (
            [0] => 5
        )

    [50] => Array
        (
            [0] => 3
        )

    [51] => Array
        (
            [0] => 2
        )

    [52] => Array
        (
            [0] => 4
        )

    [53] => Array
        (
            [0] => 5
        )

    [54] => Array
        (
            [0] => 5
        )

    [55] => Array
        (
            [0] => 5
        )

    [56] => Array
        (
            [0] => 5
        )

    [57] => Array
        (
            [0] => 3
        )

    [58] => Array
        (
            [0] => 3
        )

    [59] => Array
        (
            [0] => 5
        )

    [60] => Array
        (
            [0] => 4
        )

    [61] => Array
        (
            [0] => 5
        )

    [62] => Array
        (
            [0] => 1
        )

    [63] => Array
        (
            [0] => 5
        )

    [64] => Array
        (
            [0] => 5
        )

    [65] => Array
        (
            [0] => 1
        )

    [66] => Array
        (
            [0] => 5
        )

    [67] => Array
        (
            [0] => 1
        )

    [68] => Array
        (
            [0] => 3
        )

    [69] => Array
        (
            [0] => 3
        )

    [70] => Array
        (
            [0] => 4
        )

    [71] => Array
        (
            [0] => 4
        )

    [72] => Array
        (
            [0] => 5
        )

    [73] => Array
        (
            [0] => 1
        )

    [74] => Array
        (
            [0] => 2
        )

    [75] => Array
        (
            [0] => 5
        )

    [76] => Array
        (
            [0] => 3
        )

    [77] => Array
        (
            [0] => 2
        )

    [78] => Array
        (
            [0] => 3
        )

    [79] => Array
        (
            [0] => 1
        )

    [80] => Array
        (
            [0] => 1
        )

    [81] => Array
        (
            [0] => 5
        )

    [82] => Array
        (
            [0] => 5
        )

    [83] => Array
        (
            [0] => 2
        )

    [84] => Array
        (
            [0] => 4
        )

    [85] => Array
        (
            [0] => 2
        )

    [86] => Array
        (
            [0] => 1
        )

    [87] => Array
        (
            [0] => 4
        )

    [88] => Array
        (
            [0] => 1
        )

    [89] => Array
        (
            [0] => 2
        )

    [90] => Array
        (
            [0] => 1
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
            [0] => 1
        )

    [94] => Array
        (
            [0] => 2
        )

    [95] => Array
        (
            [0] => 1
        )

    [96] => Array
        (
            [0] => 1
        )

    [97] => Array
        (
            [0] => 1
        )

    [98] => Array
        (
            [0] => 1
        )

    [99] => Array
        (
            [0] => 1
        )

)
