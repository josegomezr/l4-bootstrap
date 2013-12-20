<?php namespace Josegomezr\L4Bootstrap;

class AnchorButton extends Button {

	static function create($displayName="", $href="#")
	{
		$that = parent::create("a", $displayName);
		$that->attributes["href"] = Helper::getLink($href);
		return $that;
	}

}