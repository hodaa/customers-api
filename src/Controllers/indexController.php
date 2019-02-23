<?php

namespace App\Controllers;

class indexController
{
    public function index()
    {
        die("osama");
        $id = (int) $request->getAttribute('id');
        $response = new Zend\Diactoros\Response();
        $response->getBody()->write("You asked for blog entry {$id}.");
        return $response;
    }
}
