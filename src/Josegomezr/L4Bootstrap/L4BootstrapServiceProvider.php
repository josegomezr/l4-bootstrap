<?php namespace Josegomezr\L4Bootstrap;

use Illuminate\Support\ServiceProvider;

class L4BootstrapServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */

	public function register()
	{
		//Register 'underlyingclass' instance container to our UnderlyingClass object
        $this->app['l4-bootstrap.navBar'] = $this->app->share(function($app) {
            return new Navbar;
        });
  		
  		$this->app['l4-bootstrap.navbarItem'] = $this->app->share(function($app) {
            return new NavbarItem;
        });
	
  		$this->app['l4-bootstrap.navMenu'] = $this->app->share(function($app) {
            return new NavMenu;
        });

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array("l4-bootstrap");
	}

}