<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class HomeController extends BaseController{
	/**
	 * 
	 */
	public function index(){
		$rows = [];
        $api = app('Dingo\Api\Routing\Router');
		//dump($api);
		$routes = $api->getRoutes();
		//dump($routes);

		foreach ($routes as $version => $routeCollection) {
			$versionRoutes = collect($routeCollection->getRoutes());
			foreach ($versionRoutes as $ruta) {
                $data = $ruta->getAction();
                $rows[] = [
                    "host"      => "",
                    "method"    => implode("|",$data["methods"]),
                    "uri"       => $data["uri"],
                    "name"      => (empty($data["as"]))? "":$data["as"],
                    "action"    => $data["uses"],
                    "protected" => "",
                    "version"   => $version
                ];
			}
		}

		dump($rows);
		return view('index', compact(["routes"]));
	}
}
?>