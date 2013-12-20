<?php namespace Josegomezr\L4Bootstrap;

abstract class MakeableObject
{
	
	abstract public function make();
	
	public function __toString(){
		return $this->make();
	}
}