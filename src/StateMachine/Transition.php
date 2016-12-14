<?php
namespace TheParthy\StateMachine;


class Transition
{
    private $fromState;
    private $toState;
    /**
     * @var string
     */
    private $joiner;

    /**
     * Transition constructor.
     */
    public function __construct($fromState, $toState, $joiner = '_TO_')
    {
        $this->fromState = $fromState;
        $this->toState = $toState;
        $this->joiner = $joiner;
    }

    public function getTransitionName(){
        return $this->fromState . $this->joiner . $this->toState;
    }
}