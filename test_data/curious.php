<?php

/**
 * This vote configuration shows some inconsistent behaviour. In OpenSTV, in the
 * second round candidate B's (corresponding to Candidate 2 in the array) votes
 * are not reallocated to Candidate A (Candidate 1 in the array). In Apache
 * Steve, they are. Compare output from both of these tools below.
 *
 * == OpenSTV ==
 * Counting votes for Election Title using Meek STV.
 * 5 candidates running for 3 seats.
 * 
 *  R|A                 |B                 |C                 |D                 
 *   |------------------+------------------+------------------+------------------
 *   |E                 |Exhausted         |Surplus           |Threshold         
 * ==============================================================================
 *  1|         10.000000|         13.000000|         12.000000|          7.000000
 *   |          8.000000|          0.000000|          0.499999|         12.500001
 *   |---------------------------------------------------------------------------
 *   | Count of first choices. Candidate B has reached the threshold and is
 *   | elected.
 * ==============================================================================
 *  2|         10.000000|         13.000000|         12.000000|                  
 *   |          8.000000|          7.000000|          3.499998|         10.750001
 *   |---------------------------------------------------------------------------
 *   | Count after eliminating D and transferring votes. All losing candidates
 *   | are eliminated. Candidate C has reached the threshold and is elected.
 * ==============================================================================
 *  3|         12.249988|         10.750012|         10.750008|                  
 *   |          8.000000|          8.249992|          2.437499|         10.437503
 *   |---------------------------------------------------------------------------
 *   | Count after transferring surplus votes. Keep factors of candidates who
 *   | have exceeded the threshold: B, 0.826924 and C, 0.895834. Candidate A has
 *   | reached the threshold and is elected.
 * 
 * Winners are A, B, and C.
 *
 * == Apache Steve==
 * Iteration 1
 * AA                       1.000000000    10.000000000
 * AC                       1.000000000    12.000000000
 * AB                       1.000000000    13.000000000
 * AE                       1.000000000     8.000000000
 * AD                       1.000000000     7.000000000
 * Non-transferable                         0.000000000
 * Total                                   50.000000000
 * Quota = 12.499999997
 * Elected: AB
 * Total Surplus = 0.500000003
 * Lowest Difference = 8.000000000 - 7.000000000 = 1.000000000
 * Remove Lowest (unforced)
 * Eliminated: AD
 * Iteration 2
 * AA                       1.000000000    10.500000003
 * AC                       1.000000000    12.000000000
 * AB                       0.961538461    12.499999997
 * AE                       1.000000000     8.000000000
 * AD                       0.000000000     0.000000000
 * Non-transferable                         7.000000000
 * Total                                   50.000000000
 * Quota = 10.749999997
 * Elected: AC
 * Total Surplus = 3.000000002
 * Lowest Difference = 10.500000003 - 8.000000000 = 2.500000003
 * Iteration 3
 * AA                       1.000000000    12.250000003
 * AC                       0.895833333    10.749999997
 * AB                       0.826923077    10.749999997
 * AE                       1.000000000     8.000000000
 * AD                       0.000000000     0.000000000
 * Non-transferable                         8.250000003
 * Total                                   50.000000000
 * Quota = 10.437499997
 * Elected: AA
 * Total Surplus = 2.437500007
 * Lowest Difference = 10.749999997 - 8.000000000 = 2.749999997
 * Remove Lowest (unforced)
 * Eliminated: AE
 * All seats full
 */

return array (
  0 => 
  array (
    0 => '1',
  ),
  1 => 
  array (
    0 => '1',
  ),
  2 => 
  array (
    0 => '1',
  ),
  3 => 
  array (
    0 => '1',
  ),
  4 => 
  array (
    0 => '1',
  ),
  5 => 
  array (
    0 => '1',
  ),
  6 => 
  array (
    0 => '1',
  ),
  7 => 
  array (
    0 => '1',
  ),
  8 => 
  array (
    0 => '1',
  ),
  9 => 
  array (
    0 => '1',
  ),
  10 => 
  array (
    0 => '2',
    1 => '1',
  ),
  11 => 
  array (
    0 => '2',
    1 => '1',
  ),
  12 => 
  array (
    0 => '2',
    1 => '1',
  ),
  13 => 
  array (
    0 => '2',
    1 => '1',
  ),
  14 => 
  array (
    0 => '2',
    1 => '1',
  ),
  15 => 
  array (
    0 => '2',
    1 => '1',
  ),
  16 => 
  array (
    0 => '2',
    1 => '1',
  ),
  17 => 
  array (
    0 => '2',
    1 => '1',
  ),
  18 => 
  array (
    0 => '2',
    1 => '1',
  ),
  19 => 
  array (
    0 => '2',
    1 => '1',
  ),
  20 => 
  array (
    0 => '2',
    1 => '1',
  ),
  21 => 
  array (
    0 => '2',
    1 => '1',
  ),
  22 => 
  array (
    0 => '2',
    1 => '1',
  ),
  23 => 
  array (
    0 => '3',
  ),
  24 => 
  array (
    0 => '3',
  ),
  25 => 
  array (
    0 => '3',
  ),
  26 => 
  array (
    0 => '3',
  ),
  27 => 
  array (
    0 => '3',
  ),
  28 => 
  array (
    0 => '3',
  ),
  29 => 
  array (
    0 => '3',
  ),
  30 => 
  array (
    0 => '3',
  ),
  31 => 
  array (
    0 => '3',
  ),
  32 => 
  array (
    0 => '3',
  ),
  33 => 
  array (
    0 => '3',
  ),
  34 => 
  array (
    0 => '3',
  ),
  35 => 
  array (
    0 => '4',
  ),
  36 => 
  array (
    0 => '4',
  ),
  37 => 
  array (
    0 => '4',
  ),
  38 => 
  array (
    0 => '4',
  ),
  39 => 
  array (
    0 => '4',
  ),
  40 => 
  array (
    0 => '4',
  ),
  41 => 
  array (
    0 => '4',
  ),
  42 => 
  array (
    0 => '5',
  ),
  43 => 
  array (
    0 => '5',
  ),
  44 => 
  array (
    0 => '5',
  ),
  45 => 
  array (
    0 => '5',
  ),
  46 => 
  array (
    0 => '5',
  ),
  47 => 
  array (
    0 => '5',
  ),
  48 => 
  array (
    0 => '5',
  ),
  49 => 
  array (
    0 => '5',
  ),
);
