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

  		$this->app['l4-bootstrap.button'] = $this->app->share(function($app) {
            return new Button;
        });

  		$this->app['l4-bootstrap.anchorButton'] = $this->app->share(function($app) {
            return new AnchorButton;
        });


        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Navbar', 'Josegomezr\L4Bootstrap\Facades\Navbar');
            $loader->alias('NavbarItem', 'Josegomezr\L4Bootstrap\Facades\NavbarItem');
            $loader->alias('NavMenu', 'Josegomezr\L4Bootstrap\Facades\NavMenu');
            $loader->alias('Button', 'Josegomezr\L4Bootstrap\Facades\Button');
            $loader->alias('AnchorButton', 'Josegomezr\L4Bootstrap\Facades\AnchorButton');
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