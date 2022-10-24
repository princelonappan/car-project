## Overview

This application provides the following API features.

- Get the car details by Car ID 
- Upload the car related CSV/JSON file
- Create the Car 

## Requirements and dependencies

- PHP >= 7.2

## Features

- This system allows to search the car details by ID.
- Upload the different formats (csv, json) and contain various cars related data to database
- Create the car entry into the database by passing the car related information.

## Available APIs

**API for uploading the CSV/JSON file**

- Upload the file in the 'file' key
- Use the POST Request
- Use the form-data option
- This will insert data in the uploaded file to the database

```bash
$  http://localhost:8000/car/upload-files
```
**API for fetching the Car details**

- Use the GET Request

```bash
$  http://localhost:8000/car/68
```
**API for saving the Car details**

- Use the POST Request
- Sample Payload for saving the details
```bash
 {
    "Inside height": null,
    "Inside length": null,
    "Car year": "2015",
    "Location": "Rønde",
    "Inside width": null,
    "Fuel type": "Petrol",
    "License plate": "AZ 49 013",
    "Car Model": "Clio",
    "Number of doors": "5",
    "Transmission": "Manual",
    "Number of seats": "5",
    "Car Brand": "Renault"
}
```

```bash
$  http://localhost:8000/car/save
```

## Installation

First, clone the repo:
```bash
$ git clone https://github.com/princelonappan/car-project.git
```

#### Create the Database and run SQL File

- Create the database and import the sql (oscar_car_rental.sql) file to the database.
- Need to update the database configuration details in the Database\DatabaseConnector.php file

#### Running as a Docker container

The following docker command will run the application.

```
$ cd car-project
$ docker-compose up -d
```
This will start the application.

#### Run on local using 

The following docker command will run the application.

```
$ cd car-project
$ composer install
$ php -S localhost:8000
```
This will start the application.

#### Run Test

- Identify the container id by running '**docker ps**' 
- Run the following command - 
- **docker exec -ti *containerid* bash**
- Run the command **php bin/phpunit**

