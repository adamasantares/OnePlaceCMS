<?php

if (! function_exists('currentRouteNamedOfArray')) {
    function currentRouteNamedOfArray($routesArray)
    {
        return !empty(array_filter($routesArray, array('Route', 'currentRouteNamed')));
    }
}