
## CustomerApi

Api which list,Store,Edit,Delete and Update Customers.

## Requirements

Docker

## Installation 

- Clone repository so that you can work on it 
- Go to config folder and in `database.php` file  set your DB configuration.
- Run `vendor/bin/doctrine orm:schema-tool:create`
- Run `sudo docker-compose up`

## API Endpoints
,
    * `GET /Customers`
        * Show all Customers
        
    * `GET /Customers/{id}`
        * show customer details id.
        
    * `POST /customers`
        * Add customer data
        
    * `DELETE /Customers/{id}`
            * Delete requested Customer
            
    * `PUT /Customers/{id}`
            * Update customer data
            
            
## Running the tests
   Execute the following command in your project root to install this library:
 
 	./vendor/bin/phpunit tests
 
 

## Tools Used

 - PHP 7.1.3+
 - MySQL
 - Composer 
 - Doctrine
   
