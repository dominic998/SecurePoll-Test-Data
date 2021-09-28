<?php

function epsilon($a, $b) {
    if ( abs( $a - $b ) < ( $b * 0.001 ) ) {
        return 0;
    } else {
        return 1;
    }
}

$yaml = shell_exec( sprintf( "openstv-run-election -r YamlReport MeekSTV %s", getenv('BLT_FILE') ) );
$expected = yaml_parse( $yaml );

$actual = include getenv('PHP_FILE');

$expectedElected = [];
foreach( $expected['Winners'] as $elected ) {
    $expectedElected[] = $elected + 1;
}

$results = [];
$results['file'] = getenv('BLT_FILE');
$results['elected'] = array_diff( $actual['elected'], $expectedElected );

// foreach( $expected['Round'] as $i => $round ) {
//     $actual_votes = [];
//     $expected_votes = array_slice( $round['Tally'], 0, -1 );

//     foreach( $actual['rounds'][$i]['rankings'] as $candidate ) {
//         $actual_votes[] = $candidate['total'];
//     }

//     var_dump( array_udiff( $actual_votes, $expected_votes, 'epsilon' ) );
//     // var_dump( $actual_votes );
//     // var_dump( $expected_votes );
// }

// $expected_surplus = [];
// $actual_surplus = [];
// $expected_candidate_votes = [];
// $actual_candidate_votes = [];
// foreach( $expected['Round'] as $i => $round ) {
//     // $expected_surplus[] = array_pop( $round['Tally'] );
//     foreach( $round['Tally'] as $candidate => $votes ) {
//         $expected_candidate_votes[$candidate + 1][] = $votes;
//     }
//     // $actual_surplus[] = $actual['rounds'][$i]['surplus'];
//     foreach( $actual['rounds'][$i]['rankings'] as $candidate => $votes ) {
//         $actual_candidate_votes[$candidate][] = $votes['total'];
//     }
// }

// foreach( $actual_candidate_votes as $candidate => $votes ) {
//     foreach( $votes as $i => $vote ) {
//         $match = FALSE;
//         foreach( $expected_candidate_votes[$candidate] as $key => $value ) {
//             if ( abs( $vote - $value ) < ( max( 1, $value ) * 0.002 ) ) {
//                 // $expected_candidate_votes[$candidate] = array_slice( $expected_candidate_votes[$candidate], 1 );
//                 $match = $key;
//                 break;
//             }
//         }
//         $results[$candidate][] = $match;
//     }
// }

// foreach( $actual_candidate_votes as $candidate => $votes ) {
//     foreach( $votes as $i => $vote ) {
//         $match = FALSE;
//         foreach( $expected_candidate_votes[$candidate] as $key => $value ) {
//             if ( !$match || abs( $vote - $value ) < $match ) {
//                 $match = abs( $vote - $value );
//             }
//         }
//         $results["candidates"][$candidate][] = $match;
//     }
// }

// foreach( $actual_surplus as $act_sur ) {
//     $match = FALSE;
//     foreach( $expected_surplus as $key => $exp_sur ) {
//         if ( abs( $exp_sur - $act_sur ) < ( $act_sur * 0.01 ) ) {
//             // $expected_surplus = array_slice( $expected_surplus, 1 );
//             $match = $key;
//             break;
//         }
//     }
//     $results['surplus'][] = $match;
// }

// var_dump( $results );

$foo = array_diff( $actual['elected'], $expectedElected );
$bar = array_diff( $expectedElected, $actual['elected'] );
if( $foo || $bar ) {
    echo getenv('BLT_FILE');
	echo "\n";
	var_dump( $foo );
	var_dump( $bar );
}

// foreach( $results['candidates'] as $candidateId => $candidate ) {
//     $foo = array_slice( $candidate, 2 );
//     foreach( $foo as $i => $diff ) {
//         if( $diff > 2 ) {
//             echo sprintf("blt: %s, candidate: %s, round: %s, diff: %s\n", getenv('BLT_FILE'), $candidateId, $i + 3, $diff);
//         }
//     }
// }
