<?php

namespace TheParthy\Example;


use TheParthy\StateMachine\ModelAwareStateEngine;
use TheParthy\StateMachine\StateEngine;

class SampleEntityAwareStateEngine extends ModelAwareStateEngine{

    /**
     * DealAwareStateEngine constructor.
     */
    public function __construct(StateEngine $stateEngine)
    {
        parent::__construct($stateEngine);
    }

    protected function loadTransitonsSetup()
    {
        return [
            [
                'from' => States::START,
                'to' => States::WORKING,
            ],
            [
                'from' => States::WORKING,
                'to' => [
                    States::WAITING,
                    States::DONE,
                ]
            ],
            [
                'from' => States::WAITING,
                'to' => [
                    States::WORKING,
                    States::DONE,
                ]
            ],
            [
                'from' => States::DONE,
                'to' => [
                    States::APPROVED,
                    States::NOTAPPROVED,
                ]
            ],
            [
                'from' => States::NOTAPPROVED,
                'to' => [
                    States::WAITING,
                    States::WORKING,
                    States::APPROVED,
                ]
            ],
        ];
    }

    protected function getStateFromEntity()
    {
        return $this->entity->getState();
    }

    protected function setStateOnEntity($newState)
    {
        $this->entity->setState($newState);
    }

    protected function throwNotAllowedException()
    {
        throw new \Exception('Transition Not Allowed');
    }

    protected function throwAlreadySetException()
    {
        // TODO: Implement throwAlreadySetException() method.
    }
}