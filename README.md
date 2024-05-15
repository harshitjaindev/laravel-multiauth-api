# laravel-multiauth-api
API multi authentication system (Admin and Users) using Laravel Sanctum

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/11.x#creating-a-laravel-project)

Clone the repository
    
    git clone https://github.com/harshitjaindev/laravel-multiauth-api.git

Switch to the repo folder

    cd laravel-multiauth-api

Install all the dependencies using composer

    composer install
    

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
	
Generate a new application key

    php artisan key:generate
	

Run the database migration command

    php artisan migrate


Start the local development server

    php artisan serve
    
APIs can now be accessed at

    http://localhost:8000/api
  

***Important*** : We can clean the database and migrate again using following command:

    php artisan migrate:refresh


### Tesing APIs in Postman ###

For testing the APIs, we have shared the API collections here:

https://github.com/harshitjaindev/laravel-multiauth-api/tree/main/Postman-Collections

We need to import the collections and environment variables accordingly. Kindly refer the below document for more information on how to import the collections and what APIs we are using.

https://github.com/harshitjaindev/laravel-multiauth-api/tree/main/API-document.docx

Note: 
1. We are using seperate table/model for admin login.
2. We need to provide correct database details for accessing database.
3. We need to provide correct email credentials to send forgot password emails.