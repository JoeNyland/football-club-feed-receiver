<?php


namespace Model;

/**
 * Class Player
 * @package Model
 */
class Player {

    /**
     * Player constructor.
     * @param $name string The name of the Player
     */
    public function __construct($name) {
        $this->name = $name;
    }

}
