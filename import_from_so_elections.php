<?php
/**
 * Import election data from the Stack Overflow Moderator Elections
 * (https://stackoverflow.com/election)
 *
 * Usage:
 * 1. Go to https://stackoverflow.com/election and find an election from the table. It will also display the results of the elections (i.e. the candidates elected).
 * 2. Click the election name, there will be a link called something like "download the election data".
 * 3. This will download a ".blt" file, which is a format for OpenSTV.
 * 4. Run "php import_from_so_elections.php -f $file.blt".
 * 5. The script will write a file "$electionName.php" which is an array of arrays of all the votes in the election.
 *
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

$options = getopt("f:");
$ballotFile = $options["f"];

$ballots = file_get_contents($ballotFile);

$lines = explode("\n", $ballots);

// First line gives us number of candidates and seats
[$numCandidates, $numSeats] = explode(" ", array_shift($lines));

// The next lines are the actual votes
$votes = [];
foreach ( $lines as $index => $line ) {
    // The list of votes end with a "0"
    if ($line == 0) {
        $finalIndex = $index;
        break;
    }

    $vote = explode(" ", $line);

    // Remove the first and last element, which are not part of the vote, but
    // part of the syntax of OpenSTV.
    array_shift($vote);
    array_pop($vote);

    $votes[] = $vote;
}

// Next lines are candidate names
$candidatesNames = array_slice($lines, $finalIndex + 1, $numCandidates);

// Final line is the name of the election
$electionName = array_slice($lines, -1)[0];

file_put_contents(sprintf("%s.php", $electionName), print_r($votes, true));
