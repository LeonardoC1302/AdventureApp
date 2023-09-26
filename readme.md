# Adventure App Costa Rica
## Project Description
This is a web development project that allows users to make reservations and select activities for their trip to Costa Rica. The project includes an admin panel for managing reservations and activities. It also features user login and registration system with token authentication and a 'forgot my password' option. The project implements PHP, CSS, JavaScript, and Fetch API to check an external API. JSON is implemented for retrieving and sending data to the API.

## Getting Started
- Ensure you have PHP 8.0 or higher installed on your local machine. You can check your PHP version by running the following command in your terminal:
``` bash
php -v
```
- You will also need to have MySQL installed on your local machine. You can check your MySQL version by running the following command in your terminal:
``` bash
mysql --version
```
- Composer is required to install the PHP dependencies. You can check if you have composer installed by running the following command in your terminal:
``` bash
composer --version
```

- You will also need to have npm installed on your local machine. You can check your npm version by running the following command in your terminal:
``` bash
npm --version
```

## Installation and Usage
1. Clone this repository into your local machine:
``` bash
git clone https://github.com/LeonardoC1302/AdventureApp.git
```
2. Create a new database named "adventureapp_mvc" on your local machine and use the "adventureappcr.sql" file to create the tables and populate the database.
3. Head to the "includes" folder and create a new file named ".env". Fill the file with the following code:
```
DB_HOST = 
DB_USER = 
DB_PASS = 
DB_NAME = 

EMAIL_HOST = 
EMAIL_PORT = 
EMAIL_USER = 
EMAIL_PASS = 

APP_URL = 
```
*Fill the variables with your database, email credentials and URL provider.
4. Install the dependencies using composer:
``` bash
composer install
```
5. Install the dependencies using npm:
``` bash
npm install
```
6. Run gulp to compile the sass files:
``` bash
npx gulp
```
7. Run the project on your local machine:
``` bash
php -S localhost:3000
```

## Technologies Used
- HTML
- CSS (SASS)
- JavaScript
- PHP
- MySQL
- Mailtrap
- Composer & Gulp
- Fetch API

## Features
## Features
- User login and registration: Users can register an account and login to the website. Depending on the user's role, they will have access to different features.
- Admin panel to manage reservations and activities: The admin panel allows the user to add, edit, and activities as well as manage reservations.
- Reservation and activity selection: Users can make reservations and select activities for their trip to Costa Rica.
- User registration system with token authentication: A token-based authentication is added on the registration system for added security.
- 'Forgot my password' option: Users can reset their password if they forget it.
- External API integration: The project utilizes Fetch API to check an external API for additional functionality.
- JSON implementation: JSON is used to retrieve and send data to the external API.

## Project Screenshots
### Login Page
![alt text](/assets/images/login.png)
### Home Page
![alt text](/assets/images/reservation.png)
### Admin Panel
![alt text](/assets/images/admin.png)