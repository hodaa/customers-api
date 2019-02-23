<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

use App\Controllers\CustomerController;
use App\Repository\CustomerRepository;

$routes = new RouteCollection();
//list all customers
$routes->add('customers', new Route('/api/v1/customers', [
    '_controller' => [new CustomerController(new CustomerRepository($entityManager)), 'index'],
], [], [], '', [], ['GET', 'HEAD']
));



//add new customer
$routes->add('customer_store', new Route('/api/v1/customers',
    [
        '_controller' => [new CustomerController(new CustomerRepository($entityManager)), 'store'],
    ],[], [], '', [], ['POST', 'HEAD']
));



// update customer by id
$routes->add('customer_update', new Route('/api/v1/customers/{id}', [
    '_controller' => [
        new CustomerController(new CustomerRepository($entityManager)), 'update'],
], [], [], '', [], ['PUT', 'HEAD']));



//list customer by id
$routes->add('customer_show', new Route('/api/v1/customers/{id}', [
    '_controller' => [
        new CustomerController(new CustomerRepository($entityManager)), 'show'],
], [], [], '', [], ['GET', 'HEAD']));



//delete customer
$routes->add('customer_delete', new Route('/api/v1/customers/{id}', [
    '_controller' => [
        new CustomerController(new CustomerRepository($entityManager)), 'delete'],
], [], [], '', [], ['DELETE', 'HEAD']));
