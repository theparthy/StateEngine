<?php

namespace TheParthy\Example;


class SampleEntity {

    private $currentState;

    /**
     * SampleEntity constructor.
     *
     * @param $currentState
     */
    public function __construct($currentState)
    {
        $this->currentState = $currentState;
    }

    public function getState() {
        return $this->currentState;
    }

    public function setState($newState) {
        $this->currentState = $newState;
    }
}
