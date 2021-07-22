Generating test data
====================

The two scripts `generate_stv_voting_test_data.php` will `generate_stv_voting_test_data_1.php` generate a test election in the OpenSTV/OpaVote .blt format.

How to generate test data
-------------------------

1. Clone this repository (`git clone https://github.com/dominic998/SecurePoll-Test-Data.git`) and change to the directory you cloned (e.g. `cd SecurePoll-Test-Data`)
2. Run: `docker build -t openstv .`
3. Make desired changes to `generate_stv_voting_test_data.php` or `generate_stv_voting_test_data_1.php` (see below)
4. Run: `docker run -v "$PWD:/var/www/html/w" openstv php generate_stv_voting_test_data.php` or `docker run -v "$PWD:/var/www/html/w" openstv php generate_stv_voting_test_data_1.php`

This should generate a file in the current directory, ending in `blt`. For example, `3_2_99_1308473267.blt`.

You can run the test data file you just generated against OpenSTV, to check what the "correct" outcome should be:
`docker run -v "$PWD:/var/www/html/w" openstv openstv-run-election MeekSTV <filename>.blt`

How to modify the test data you generate
----------------------------------------

You will probably want to modify some of the variables in those scripts to generate different test data.

* `$candidates`: an array of candidate names, I suggest just using numbers, e.g. `[1, 2, 3, 4, 5, ...]`
* `$numSeats`: number of seats the candidates are competing for
* `$totalVotes`: total number of votes to simulate in the election
* `$voteDistribution`: This is different depending on which script you are using:
  * For `generate_stv_voting_test_data.php` this is an array of arrays. The first array is the number of people who have voted for each candidate as their first choice. The second array is the number of people who have voted for each candidate as their second choice. And so on. For example:
    ```
    $voteDistribution = [
       [10, 20, 30], // 10 voters put candidate 1 as their first preference, 20 put candidate 2 as their first preference, and 30 put candidate 3 as their first preference
       [11, 12, 13], // 11 voters put candidate 1 as their second preference, 12 put candidate 2 as their second preference, and 13 put candidate 3 as their second preference
       ...
    ];
    ```
  * For `generate_stv_voting_test_data_1.php` is an array of arrays. The first array is the number of people who have voted for each candidate as their first choice. But, the format needs to be an associative array where the keys are the names of the candidates, for example:
    ```
    1 => [ // First preferences
          1 => 10, // 10 voters put candidate 1 as their first preference
          2 => 20, // 20 voters put candidate 2 as their first preference
          3 => 30, // 30 voters put candidate 3 as their first preference
  	...
    ]
    ```
    The second (and subsequent) arrays need themselves to be an array of arrays. The first array is the number of people who, having put candidate 1 as their first choice, voted for each candidate as their second (or subsequent) choice. It needs to be an associative array where the keys are the names of the candidates. For example:
    ```
    2 => [   // Second preferences
        1 => [   // Candidate 1
            2 => 6, // Of the people who voted candidate 1 as their first choice, 6 put candidate 2 as their second choice
            3 => 7, // Of the people who voted candidate 1 as their first choice, 7 put candidate 3 as their second choice
  	  ...
        ],
        2 => [   // Candidate 2
            1 => 2, // Of the people who voted candidate 2 as their first choice, 2 put candidate 1 as their second choice
            3 => 4, // Of the people who voted candidate 2 as their first choice, 4 put candidate 3 as their second choice
  	  ...
        ],
        ...
    ],
    3 => [   // Third preferences
        1 => [   // Candidate 1
            2 => 4, // Of the people who voted candidate 1 as their first choice, 4 put candidate 2 as their third choice
            3 => 5, // Of the people who voted candidate 1 as their first choice, 5 put candidate 3 as their third choice
  	  ...
        ],
        ...
    ],
    ...
    ```
    So, putting it all together, we end up with:
    ```
    $voteDistribution = [
        1 => [ // First preferences
            1 => 10, // 10 voters put candidate 1 as their first preference
            2 => 20, // 20 voters put candidate 2 as their first preference
            3 => 30, // 30 voters put candidate 3 as their first preference
            ...
        ],
        2 => [   // Second preferences
            1 => [   // Candidate 1
                2 => 6, // Of the people who voted candidate 1 as their first choice, 6 put candidate 2 as their second choice
                3 => 7, // Of the people who voted candidate 1 as their first choice, 7 put candidate 3 as their second choice
                ...
            ],
            2 => [   // Candidate 2
                1 => 2, // Of the people who voted candidate 2 as their first choice, 2 put candidate 1 as their second choice
                3 => 4, // Of the people who voted candidate 2 as their first choice, 4 put candidate 3 as their second choice
                ...
            ],
            ...
        ],
        3 => [   // Third preferences
            1 => [   // Candidate 1
                2 => 4, // Of the people who voted candidate 1 as their first choice, 4 put candidate 2 as their third choice
                3 => 5, // Of the people who voted candidate 1 as their first choice, 5 put candidate 3 as their third choice
                ...
            ],
            ...
        ],
        ...
    ];
    ```

Unit testing
============

You can run OpenSTV/OpaVote .blt files (like the ones you generated above) as unit tests against our STV implementation.

1. Copy `unit_test_stv.sh` to your MediaWiki core repository
2. Copy any .blt files (like the test data files you just generated) to your MediaWiki core repository
3. Copy `STVTallierTest_drw.php` to `extensions/SecurePoll/tests/phpunit/unit/` in the MediaWiki core repository
4. In your MediaWiki core repository, start your MediaWiki docker container (e.g. `docker-compose up -d`)
5. Run: `docker-compose exec mediawiki bash unit_test_stv.sh -f <filename>.blt`
