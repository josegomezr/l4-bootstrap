<?php namespace Josegomezr\L4Bootstrap\Facades;

use Illuminate\Support\Facades\Facade;

class Button extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'l4-bootstrap.button'; }

}