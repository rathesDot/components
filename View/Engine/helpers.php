<?php
/**
 * @author Rathes Sachchithananthan <sachchi@rathes.de>
 * @version 1.0.0
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;

if (!function_exists('base_path')){
    /**
     * return the base_path of the request
     *
     * @return string
     */
    function base_path(){
        return Request::createFromGlobals()->getBasePath();
    }
}


if (!function_exists('route')){
    /**
     * @param $route
     * @param array $param
     * @param string $routes
     * @return string
     */
    function route($route, $param = [], $routes = ''){
        $request = Request::createFromGlobals();
        if($routes == ''){
            $routes = $request->getBasePath().'/system/app/Http/routes.php';
        }

        $context = new Routing\RequestContext();
        $context->fromRequest($request);
        $generator = new Routing\Generator\UrlGenerator($routes, $context);
        return $generator->generate($route, $param);
    }
}

if (!function_exists('lang')){
    /**
     * translate the given input
     *
     * @todo get the set language or fallback to fallback-language
     * @param $input
     * @return array
     */
    function lang($input){
        $request = Request::createFromGlobals();
        $lang = new \fokuscms\Components\Language\Language( $request->getBasePath().'/content/lang');
        return $lang->translate($input, 'de-DE');
    }
}