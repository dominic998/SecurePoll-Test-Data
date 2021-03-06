<?php

/**
 * $candidates = [1, 2, 3];
 * $totalVotes = 99;
 * $voteDistribution = [
 *   [33, 33, 33], // First preference
 *   [33, 33, 33], // Second preference
 *   [33, 33, 33], // Third preference
 * ];
 * 
 * Results from openstv for number of seats = 2 and 1:
 * 
 * Counting votes for ElectionTitle using Meek STV.
 * 3 candidates running for 2 seats.
 * 
 *  R|1          |2          |3          |Exhausted  |Surplus    |Threshold  
 * ==========================================================================
 *  1|  33.000000|  33.000000|  33.000000|   0.000000|   0.000000|  33.000001
 *   |-----------------------------------------------------------------------
 *   | Count of first choices.
 * ==========================================================================
 *  2|  54.000000|           |  45.000000|   0.000000|  32.999998|  33.000001
 *   |-----------------------------------------------------------------------
 *   | Count after eliminating 2 and transferring votes. All losing
 *   | candidates are eliminated. Candidates 1, 2, and 3 were tied when
 *   | choosing candidates to eliminate. Candidate 2 was chosen by breaking
 *   | the tie randomly. Candidates 1 and 3 have reached the threshold and
 *   | are elected.
 * 
 * Winners are 1 and 3.
 * 
 * Counting votes for ElectionTitle using Meek STV.
 * 3 candidates running for 1 seat.
 * 
 *  R|1          |2          |3          |Exhausted  |Surplus    |Threshold  
 * ==========================================================================
 *  1|  33.000000|  33.000000|  33.000000|   0.000000|   0.000000|  49.500001
 *   |-----------------------------------------------------------------------
 *   | Count of first choices.
 * ==========================================================================
 *  2|  45.000000|  51.000000|           |   3.000000|   2.999999|  48.000001
 *   |-----------------------------------------------------------------------
 *   | Count after eliminating 3 and transferring votes. All losing
 *   | candidates are eliminated. Candidates 1, 2, and 3 were tied when
 *   | choosing candidates to eliminate. Candidate 3 was chosen by breaking
 *   | the tie randomly. Candidate 2 has reached the threshold and is
 *   | elected.
 * 
 * Winner is 2.
 */

return array (
  0 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  1 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  2 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  3 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  4 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  5 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  6 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  7 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  8 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  9 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  10 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  11 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  12 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  13 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  14 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  15 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  16 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  17 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  18 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  19 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  20 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  21 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  22 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  23 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  24 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  25 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  26 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  27 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
  28 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  29 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
  30 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  31 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  32 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  33 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  34 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  35 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  36 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  37 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  38 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  39 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  40 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  41 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
  42 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  43 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
  44 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
  45 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  46 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
  47 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  48 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
  49 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  50 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  51 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  52 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  53 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  54 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  55 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  56 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  57 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  58 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  59 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  60 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  61 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  62 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
  63 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  64 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  65 => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  66 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  67 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  68 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  69 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  70 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  71 => 
  array (
    0 => '2',
    1 => '1',
    2 => '3',
  ),
  72 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  73 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  74 => 
  array (
    0 => '3',
    1 => '2',
    2 => '1',
  ),
  75 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  76 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  77 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  78 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  79 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  80 => 
  array (
    0 => '2',
    1 => '1',
  ),
  81 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  82 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
  83 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  84 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  85 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  86 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  87 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  88 => 
  array (
    0 => '2',
    1 => '1',
  ),
  89 => 
  array (
    0 => '1',
    1 => '3',
    2 => '2',
  ),
  90 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  91 => 
  array (
    0 => '2',
    1 => '1',
  ),
  92 => 
  array (
    0 => '3',
    1 => '1',
    2 => '2',
  ),
  93 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
  94 => 
  array (
    0 => '3',
  ),
  95 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
  96 => 
  array (
    0 => '3',
  ),
  97 => 
  array (
    0 => '3',
  ),
  98 => 
  array (
    0 => '2',
    1 => '3',
    2 => '1',
  ),
);
