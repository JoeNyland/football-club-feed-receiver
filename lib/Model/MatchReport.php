<?php


namespace Model;

/**
 * Class MatchReport
 * @package Model
 */
class MatchReport {

    /**
     * MatchReport constructor.
     */
    public function __construct() {
        $this->_dbi = new \DBI();
        // ToDo: Complete this constructor to initialise instance variables
    }

    /**
     * Loads the raw match report and builds the current instance from the data
     * @param $match_report array An associative array representing the match report to be processed
     * @return $this
     */
    public function load($match_report) {
        // ToDo: Process $match_report and populate the current object with the data contained within it
        return $this;
    }

    /**
     * Stores the current object
     * @return $this
     */
    public function store() {
        $this->_dbi->store_match_report($this);
        return $this;
    }

}
