<?php

/**
 * Loading ballots from file foo.blt.
 * Ballot file contains 5 candidates and 72 ballots.
 * No candidates have withdrawn.
 * Ballot file contains 72 non-empty ballots.
 * 
 * Counting votes for 5_2_72 using Meek STV.
 * 5 candidates running for 2 seats.
 * 
 *  R|A                 |B                 |C                 |D                 
 *   |------------------+------------------+------------------+------------------
 *   |E                 |Exhausted         |Surplus           |Threshold         
 * ==============================================================================
 *  1|         10.000000|         38.000000|          9.000000|          7.000000
 *   |          8.000000|          0.000000|         13.999999|         24.000001
 *   |---------------------------------------------------------------------------
 *   | Count of first choices. Candidate B has reached the threshold and is
 *   | elected.
 * ==============================================================================
 *  2|         23.999998|         24.000002|          9.000000|          7.000000
 *   |          8.000000|          0.000000|          0.000001|         24.000001
 *   |---------------------------------------------------------------------------
 *   | Count after transferring surplus votes. Keep factors of candidates who
 *   | have exceeded the threshold: B, 0.631579.
 * ==============================================================================
 *  3|         23.999998|         24.000002|          9.000000|                  
 *   |          8.000000|          7.000000|          4.666666|         21.666667
 *   |---------------------------------------------------------------------------
 *   | Count after eliminating D and transferring votes. All losing candidates
 *   | are eliminated. Candidate A has reached the threshold and is elected.
 * 
 * Winners are A and B.
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
    0 => '2',
    1 => '1',
  ),
  24 => 
  array (
    0 => '2',
    1 => '1',
  ),
  25 => 
  array (
    0 => '2',
    1 => '1',
  ),
  26 => 
  array (
    0 => '2',
    1 => '1',
  ),
  27 => 
  array (
    0 => '2',
    1 => '1',
  ),
  28 => 
  array (
    0 => '2',
    1 => '1',
  ),
  29 => 
  array (
    0 => '2',
    1 => '1',
  ),
  30 => 
  array (
    0 => '2',
    1 => '1',
  ),
  31 => 
  array (
    0 => '2',
    1 => '1',
  ),
  32 => 
  array (
    0 => '2',
    1 => '1',
  ),
  33 => 
  array (
    0 => '2',
    1 => '1',
  ),
  34 => 
  array (
    0 => '2',
    1 => '1',
  ),
  35 => 
  array (
    0 => '2',
    1 => '1',
  ),
  36 => 
  array (
    0 => '2',
    1 => '1',
  ),
  37 => 
  array (
    0 => '2',
    1 => '1',
  ),
  38 => 
  array (
    0 => '2',
    1 => '1',
  ),
  39 => 
  array (
    0 => '2',
    1 => '1',
  ),
  40 => 
  array (
    0 => '2',
    1 => '1',
  ),
  41 => 
  array (
    0 => '2',
    1 => '1',
  ),
  42 => 
  array (
    0 => '2',
    1 => '1',
  ),
  43 => 
  array (
    0 => '2',
    1 => '1',
  ),
  44 => 
  array (
    0 => '2',
    1 => '1',
  ),
  45 => 
  array (
    0 => '2',
    1 => '1',
  ),
  46 => 
  array (
    0 => '2',
    1 => '1',
  ),
  47 => 
  array (
    0 => '2',
    1 => '1',
  ),
  48 => 
  array (
    0 => '3',
  ),
  49 => 
  array (
    0 => '3',
  ),
  50 => 
  array (
    0 => '3',
  ),
  51 => 
  array (
    0 => '3',
  ),
  52 => 
  array (
    0 => '3',
  ),
  53 => 
  array (
    0 => '3',
  ),
  54 => 
  array (
    0 => '3',
  ),
  55 => 
  array (
    0 => '3',
  ),
  56 => 
  array (
    0 => '3',
  ),
  57 => 
  array (
    0 => '4',
  ),
  58 => 
  array (
    0 => '4',
  ),
  59 => 
  array (
    0 => '4',
  ),
  60 => 
  array (
    0 => '4',
  ),
  61 => 
  array (
    0 => '4',
  ),
  62 => 
  array (
    0 => '4',
  ),
  63 => 
  array (
    0 => '4',
  ),
  64 => 
  array (
    0 => '5',
  ),
  65 => 
  array (
    0 => '5',
  ),
  66 => 
  array (
    0 => '5',
  ),
  67 => 
  array (
    0 => '5',
  ),
  68 => 
  array (
    0 => '5',
  ),
  69 => 
  array (
    0 => '5',
  ),
  70 => 
  array (
    0 => '5',
  ),
  71 => 
  array (
    0 => '5',
  ),
);
