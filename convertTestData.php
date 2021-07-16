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

/**
 * This converts the php files in the test_data/ directory into a format
 * suitable for the unit tests.
 * 
 * Usage: php convertTestData.php <test data file>
 * 
 * For example, php convertTestData.php test_data/7_5_1000.php
 */

$ballots = include $argv[1];

$map = [
    '1' => 'A',
    '2' => 'B',
    '3' => 'C',
    '4' => 'D',
    '5' => 'E',
    '6' => 'F',
    '7' => 'G',
    '8' => 'H',
    '9' => 'I',
    '10' => 'J',
    '11' => 'K',
    '12' => 'L',
    '13' => 'M',
    '14' => 'N',
    '15' => 'O',
    '16' => 'P',
    '17' => 'Q',
    '18' => 'R',
    '19' => 'S',
    '20' => 'T',
];

$rankedVotes = [];
foreach ( $ballots as $vote ) {
    $blah = [];
    foreach ( $vote as $index => $candidate ) {
        $blah[$index + 1] = $map[$candidate];
    }
    if ( isset( $rankedVotes[implode("", $blah)] ) ) {
        $rankedVotes[implode("", $blah)]['count'] = $rankedVotes[implode("", $blah)]['count'] + 1;
    } else {
        $rankedVotes[implode("", $blah)] = [
            'count' => 1,
            'rank' => $blah
        ];
    }
}

echo var_export($rankedVotes, TRUE);
