<?php 

namespace Mochaka\Shopify;

use Config;
use Illuminate\Support\ServiceProvider;

class ShopifyServiceProvider extends ServiceProvider {

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
		$this->package('mochaka/laravel-shopify','shopify');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
            /*
            $this->app->booting(function()
            {
                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                $loader->alias('Shopify', 'Mochaka\Shopify\Facades\Shopify');
            });
         
            */

            $this->app['shopify'] = $this->app->share(function($app)
            {
                $url = Config::get('shopify::url');
                $key = Config::get('shopify::apikey');
                $pwd = Config::get('shopify::password');
                
                \Log::info($url . '   ' . $key . '   ' . $pwd);
 
                return new Shopify($url,$key,$pwd);
            });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('shopify');
	}

}
