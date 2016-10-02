<?php


namespace Model;

/**
 * Class Team
 * @package Model
 */
class Team {

    /**
     * Team constructor.
     * @param $name string The name of the Team
     */
    public function __construct($name) {
        $this->name = $name;
    }

}
