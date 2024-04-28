(Employee Management System)

An employee management system is a web application that allows management of departments and employees within those departments. The system includes an authentication mechanism for users, Create, Read, Update, Delete (CRUD) operations for managing departments and employees, relationships between departments and employees, soft deletes of records, and an application programming interface (API) for interacting with the system.

Installation
Copy the repository:

git clone https://github.com/ebrahim-mohammad/Employee-Management-System.git

Environment Preparation

1. Create a new database and configure the '.env' file with contact information.
2. Run transfers and data seeds:

php artisan migrate --seed

Run the server
To start the local server:

php artisan serve

You can see API documents. 
https://documenter.getpostman.com/view/30942377/2sA3BuW8rN
