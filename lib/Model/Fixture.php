<?php

namespace Model;

/**
 * Class Fixture
 *
 * This is a representation of a Fixture
 *
 * @package Model
 */
class Fixture {

    /**
     * Fixture constructor.
     */
    public function __construct() {
        $this->_dbi = new \DBI();
        $this->created_at = null;
        $this->teams = null;
        $this->location = null;
        $this->kickoff = null;
        $this->result = null;
    }

    /**
     * Loads the raw fixture and builds the current instance from the data
     * @param $fixture_data array An associative array representing the fixture to be processed
     * @return $this
     */
    public function load($fixture_data) {
        $this->created_at = new \DateTime($fixture_data['created_at']);
        $this->teams = array(
            new Team($fixture_data['teams'][0]),
            new Team($fixture_data['teams'][1])
        );
        $this->location = new Ground($fixture_data['location']);
        $this->kickoff = new \DateTime($fixture_data['kickoff']);
        $this->result = array_key_exists('result', $fixture_data) && count($fixture_data['result']) === 2 ? $fixture_data['result'] : null;
        return $this;
    }

    /**
     * Stores the current object
     * @return $this
     */
    public function store() {
        $this->_dbi->store_fixture($this);
        return $this;
    }

}
