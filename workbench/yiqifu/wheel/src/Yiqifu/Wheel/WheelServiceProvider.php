<?php namespace Yiqifu\Wheel;

use Illuminate\Support\ServiceProvider;

class WheelServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('yiqifu/wheel');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//$this->app is just an array that holds all of the class instances. $this->app->share is a closure that will return an instance of your class. This means, when you try to use this package, it will be resolved using this instance from the IoC container.
		$this->app['wheel'] = $this->app->share(function($app)
		{
			return new Wheel;
		});

		//This allows the facade to work without the developer having to add it to the Alias array in app/config/app.php. Props to Chris Fidao for this.
		$this->app->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Wheel', 'Yiqifu\Wheel\Facades\Wheel');
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('wheel');
	}

}
