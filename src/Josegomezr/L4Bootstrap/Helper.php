<?php namespace Josegomezr\L4Bootstrap;

/**
* 
*/
class Helper
{
	static function determineHref($href) {
		if($href == "#"){
			return 2;
		}
	    if(strpos($href, '@') !== FALSE){
	        return 1; // action
	    }else if(preg_match('#^(http|https)://#', $href)){
	        return 2; // url
	    }elseif (substr_count($href, '/') > 0) {
            return 3; // uri
	    }else{
            return 4; // route
	    }
	}

	static function getLink($href)
	{
		$type = self::determineHref($href);
		switch ($type) {
			case 1:
				return action($href);
			break;

			case 2:
			case 3:
				return  $href;
			break;

			case 4:
				return route($href);
			break;
		}

	}
}