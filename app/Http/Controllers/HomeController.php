<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class HomeController extends BaseController{
	/**
	 * 
	 */
	public function index(){
		$api = app('Dingo\Api\Routing\Router');
		//dump($api);
		$routes = $api->getRoutes();
		//dump($routes);

		foreach ($routes as $version => $routeCollection) {
			dump($version);
			$versionRoutes = collect($routeCollection->getRoutes());
			foreach ($versionRoutes as $ruta) {
				$data = $ruta->getAction();
				dump($data);
			}
		}

		return view('index', compact(["routes"]));
	}
}
?>