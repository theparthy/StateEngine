<?php

namespace TheParthy\StateMachine;

abstract class ModelAwareStateEngine
{
    /**s
     * @var StateEngine
     */
    protected $stateEngine;
    protected $entity;

    public function __construct(StateEngine $stateEngine)
    {
        $this->stateEngine = $stateEngine;
        $this->stateEngine
             ->buildTransitionsArray($this->loadTransitonsSetup());
    }

    public function setEntity($entity)
    {
        $this->entity = $entity;
        return $this;
    }

    public function setState($newState){
        $oldState = $this->getStateFromEntity();
        if($newState == $oldState){ $this->throwAlreadySetException(); }
        if($this->stateEngine->canTransitonTo($oldState, $newState)) {
            $this->setStateOnEntity($newState);
            return true;
        }else{
            $this->throwNotAllowedException();
        }
    }

    public function canTransitonTo($newState) {
        $oldState = $this->getStateFromEntity();
        return $this->stateEngine->canTransitonTo($oldState, $newState);
    }

    abstract protected function getStateFromEntity();

    abstract protected function setStateOnEntity($value);

    abstract protected function loadTransitonsSetup();

    abstract protected function throwNotAllowedException();

    abstract protected function throwAlreadySetException();

}