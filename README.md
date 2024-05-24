# MyORM Project

## Description

MyORM Project is a simple, object-oriented PHP ORM (Object-Relational Mapping) system that provides basic CRUD operations and dynamic routing for building RESTful APIs. This project includes features like user authentication, file uploads, and JSON request handling.

## Features

- **Object-Oriented Design:** Clean and maintainable code structure with classes and namespaces.
- **CRUD Operations:** Basic Create, Read, Update, and Delete functionalities.
- **Dynamic Routing:** Flexible routing system to handle various HTTP methods and dynamic URL parameters.
- **Middleware Support:** Easily add authentication and other middleware to routes.
- **Migration System:** Simple migration system to manage database schema changes.
- **RESTful API:** Endpoints to manage users, skills, messages, and more.
- **File Uploads:** Support for handling file uploads.
- **JSON Request Handling:** Easily handle JSON requests and responses.

## Installation

1. **Clone the repository:**

   ```sh
   git clone https://github.com/yourusername/MyORM-Project.git
composer install
Configure the database:

Update the config.php file with your database credentials.
Run migrations:
php migrate

Start the server:
php -S localhost:8000 -t public

Test the application:

Open your browser and navigate to http://localhost:8000.

Usage
Example Routes
Users:

GET /api/users - Retrieve all users
POST /api/users - Create a new user
GET /api/users/{id} - Retrieve a specific user
PUT /api/users/{id} - Update a specific user
DELETE /api/users/{id} - Delete a specific user

Skills:

GET /api/skills - Retrieve all skills
POST /api/skills - Create a new skill
GET /api/skills/{id} - Retrieve a specific skill
PUT /api/skills/{id} - Update a specific skill
DELETE /api/skills/{id} - Delete a specific skill
Messages:

GET /api/messages - Retrieve all messages
POST /api/messages - Create a new message
GET /api/messages/{id} - Retrieve a specific message

Middleware Example
To secure routes with authentication middleware:

php
Copier le code
$router->get('/api/users/{id}/delete', function($id) use ($authMiddleware) {
    $authMiddleware->handle();
    $controller = new UserController();
    $controller->destroy($id);
});


Handling JSON Requests
In your controllers, you can handle JSON requests using the content() method:

php
Copier le code
$data = $this->content();

Handling File Uploads
To handle file uploads, you can use the $_FILES superglobal and move uploaded files as needed.

