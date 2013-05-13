<?php

use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;

/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * odkaz 'Front:Homepage:default' 				=> '../yetti/sandbox/www/',
	 * odkaz 'Front:Homepage:ONakupu:jakNakupovat'	=> '../yetti/sandbox/www/o-nakupu/jak-nakupovat
	 * @return Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
		
		//$router[] = new Route('index.php', 'Front:Homepage:default', Route::ONE_WAY);
		//$router[] = new Route('<presenter>/[<action>][/<id>]', 'Front:Homepage:default');
		
		
		//vychozi hodnoty
		$router[] = new Route('admin/<presenter>/<action>[/<id>]', array(
				'module'	=> 'Admin',
				'presenter'	=> 'Homepage',
				'action'	=> 'default',
				'id'		=> NULL
		));
		
		$router[] = new Route('<presenter>/<action>[/<id>]', array(
			'module'    => 'Front',
			'presenter'	=> 'Homepage',
			'action'	=> 'default',
			'id'		=> NULL
		));
		
		
		return $router;
	}

}
