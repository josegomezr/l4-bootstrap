<?php namespace Josegomezr\L4Bootstrap\Facades;

use Illuminate\Support\Facades\Facade;

class Navbar extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'l4-bootstrap.navBar'; }

    const fixedTop = "fixed-top";
	const fixedBottom = "fixed-bottom";
	const staticTop = "static-top";
	const inverse = "inverse";

}