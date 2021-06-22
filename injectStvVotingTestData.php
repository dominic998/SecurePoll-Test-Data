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

if ( getenv( 'MW_INSTALL_PATH' ) ) {
	$IP = getenv( 'MW_INSTALL_PATH' );
} else {
	$IP = __DIR__ . '/../../..';
}
require_once "$IP/maintenance/Maintenance.php";

class InjectStvVotingTestData extends Maintenance {

	public function __construct() {
		parent::__construct();
		$this->addDescription( <<<EOT
Add votes to an election from PHP array test data files.
EOT
		);

		$this->addArg( 'file', 'Test data file. This is assumed to be a php file which returns an array.' );

        $this->addArg( 'id', 'ID of election the votes are for.' );

		$this->requireExtension( 'SecurePoll' );
	}

	public function execute() {

		$fileName = $this->getArg( 0 );
		if ( !file_exists( $fileName ) ) {
			$this->fatalError( "The specified file \"{$fileName}\" does not exist\n" );
		}
        $file = include $fileName;

        $id = $this->getArg( 1 );
        if ( !is_int((int)$id) ) {
			$this->fatalError( "The specified election ID is not an integer.\n" );
		}

		$dbw = wfGetDB( DB_PRIMARY );

		# Start the configuration transaction
		$dbw->begin( __METHOD__ );

        // TODO Assume only one question for now...
        $question = $dbw->selectField(
            'securepoll_questions',
            'qu_entity',
            [ 'qu_election' => $id ],
            __METHOD__
        );

        // Mapping of candidates from PHP array to their ID in database.
        $candidatesDB = $dbw->selectFieldValues(
            'securepoll_options',
            'op_entity',
            [ 'op_question' => $question ],
            __METHOD__
        );
        $candidatesMapping = [];
        for ($index = 0; $index < count($candidatesDB); $index++) {
            $candidatesMapping[$index + 1] = $candidatesDB[$index];
        }

        foreach ( $file as $vote ) {

            $voteString = "";
            foreach ( $vote as $rank => $candidate ) {
                $voteString = $voteString . sprintf('Q%08X-C%08X-R%08X--',
                                                    $question,
                                                    $candidatesMapping[$candidate],
                                                    $rank
                );
            }

            $dbw->insert( 'securepoll_votes',
                          [
                              'vote_election' => $id,
                              // TODO not sure if this number matters...
                              'vote_voter' => 1,
                              'vote_voter_name' => 'Admin',
                              'vote_voter_domain' => 'localhost:8081',
                              'vote_struck' => 0,
                              'vote_record' => $voteString,
                              'vote_ip' => 'AC120001',
                              'vote_xff' => "",
                              'vote_ua' => 'Mozilla/5.0 (X11; Linux ppc64le; rv:78.0) Gecko/20100101 Firefox/78.0',
                              'vote_timestamp' => date("YmdHis"),
                              'vote_current' => 1,
                              'vote_token_match' => 1,
                              'vote_cookie_dup' => 0
                          ],
                          __METHOD__ );
        }

        $success = true;
        // TODO Need to implement proper error handling and rollback...
        if ( !$success ) {
            $dbw->rollback( __METHOD__ );
            $this->fatalError( "Failed!\n" );
        }

		$dbw->commit( __METHOD__ );
		$this->output( "Finished!\n" );
	}

}

$maintClass = InjectStvVotingTestData::class;
require_once RUN_MAINTENANCE_IF_MAIN;
