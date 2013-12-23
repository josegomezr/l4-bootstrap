<?php namespace Josegomezr\L4Bootstrap;

abstract class Component
{
	
	abstract public function make();
	abstract public function addClass($class);
	abstract public function align($direction);
	abstract public function attach(Component $element);
	
	public function __toString(){
		return $this->make();
	}
}