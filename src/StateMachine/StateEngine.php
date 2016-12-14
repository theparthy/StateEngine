<?php
namespace TheParthy\StateMachine;

class StateEngine
{
    private $transitionsAllowed;

    /**
     * StateEngine constructor.
     */
    public function __construct()
    {
    }

    public function buildTransitionsArray($transitions)
    {
        foreach ($transitions as $transition) {
            $this->generateTransitionIdentifier($transition);
        }
    }

    private function generateTransitionIdentifier($transition)
    {
        $fromStates = $this->getValue($transition, 'from');
        $toStates = $this->getValue($transition, 'to');

        foreach ($fromStates as $from) {
            foreach ($toStates as $to) {
                $this->transitionsAllowed[] = $this->createTransitionString($from, $to);
            }
        }
    }

    /**
     * @param $transition
     * @param $key
     */
    private function getValue($transition, $key)
    {
        if (!array_key_exists($key, $transition)) {
            throw new \Exception('Key: ' . $key . ' not Set');
        }
        return (!is_array($transition[$key])) ? [$transition[$key]] : $transition[$key];
    }

    private function createTransitionString($from, $to)
    {
        return $from . '_TO_' . $to;
    }

    public function canTransitonTo($currentState, $nextState)
    {
        return in_array($this->createTransitionString($currentState, $nextState), $this->transitionsAllowed);
    }

    public function canTransitonFrom($nextState, $currentState)
    {
        return in_array($this->createTransitionString($currentState, $nextState), $this->transitionsAllowed);
    }
}
