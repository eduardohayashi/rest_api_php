# rest_api_php
Simple REST API whith PHP/Symfony4

## Requirements
* PHP 7.1+
* Composer
* MySQL (local or remote)

## Install
```
git clone https://github.com/eduardohayashi/rest_api_php.git
cd rest_api_php
cp .env.dist .env
composer install
```

## Configure 
Change the .env file and set a valid database connection.
```
DATABASE_URL=mysql://user:password@127.0.0.1:3306/database
```

Run the folowing to start the web server
```
bin/console server:start
```

Run the folowing to run the functional tests
```
bin/phpunit src/Tests
```

# API Routes
For this API all the fields accept just string data. To change this it is needed to change the type on Entity desired and run the Doctrine helper again (doctrine:schema:update)

## * Create User
This will create a new user. All the fields are mandatory.

**Endpoint:** /api/adduser

**Method:** PUT 

**Data example:**
{
	"name": "Someone",
	"email": "email@email",
	"birthday": "2019-04-24",
	"gender": "Male"
}

```
curl -X PUT "http://127.0.0.1:8000/api/adduser" -H 'Content-Type: application/json' -d '{"name": "Someone",
 "email": "email@email", "birthday": "2019-04-24", "gender": "Male"}'
 ```


## * List all users
This will bring all users registered on the system

**Endpoint:** /api/user

**Method:** GET 

```
curl "http://127.0.0.1:8000/api/user"
```


## * View specific User
This will bring only one user, filtered by name - case insensitive

*PS: To add another filters is just to add other filterAction on UserController.php*

**Endpoint:** /api/user/{someone}

**Method:** GET 


```
curl "http://127.0.0.1:8000/api/user/someone"
```


## * Update User
This will update a user record. It is needed the record ID and the data to be changed.

All the fields are mandatory

**Endpoint:** /api/updateuser/{ID}

**Method:** PUT 

**Data example:**
{
	"name": "Someother",
	"email": "email2@email",
	"birthday": "2019-04-25",
	"gender": "Female"
}

```
curl -X PUT "http://127.0.0.1:8000/api/updateuser/1" -H 'Content-Type: application/json' -d '{"name": "Someother",
 "email": "email2@email", "birthday": "2019-04-24", "gender": "Female"}'
 ```



## * Delete User
This will remove the user (hard delete)

It is needed the record ID. That action is irreversible.

**Endpoint:** /api/deleteuser/{ID}

**Method:** DELETE 

```
curl -X DELETE "http://127.0.0.1:8000/api/deleteuser/1"
```

