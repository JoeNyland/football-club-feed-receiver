<?php

/**
 * Class DBI
 *
 * This is an abstract layer above the database, allowing the application to be DB type agnostic.
 */
class DBI {

    /**
     * Stores a fixture event in the DB.
     * Provides 'upsert' functionality to allow a new model to be stored, or an existing model to be updated with new
     * values.
     *
     * @param \Model\Fixture $fixture A Fixture object to persist
     */
    public function store_fixture(\Model\Fixture $fixture) {
        // ToDo: Complete this method
        error_log('Storing a fixture');
    }

    /**
     * Stores a fixture event in the DB.
     * Provides 'upsert' functionality to allow a new model to be stored, or an existing model to be updated with new
     * values.
     *
     * @param \Model\MatchReport $match_report A MatchReport object to persist
     */
    public function store_match_report(\Model\MatchReport $match_report) {
        // ToDo: Complete this method
        error_log('Storing a match report');
    }

}
