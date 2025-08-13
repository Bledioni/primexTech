PrimexTech
PrimexTech is a PHP-based e-commerce and inventory management system with three user roles — Admin, Depot (Worker), and User — each having unique permissions and tasks.

1. User Features
Browse and search products

Add products to the cart

Save products to the wishlist

Place and track orders

Manage personal account and view order history

----------------------------------------------

2. Admin Features
Add, update, and delete products

Manage product categories

Add, edit, or remove depot workers

View and manage all user orders

Full access to the admin control panel

----------------------------------------------

3. Depot (Worker) Features
View new orders assigned for shipping

Process orders and mark them as shipped

Update shipping and delivery status

Update product stock using QR code scanning

----------------------------------------------

4. Technologies Used
PHP (Core)

MySQL (Database)

HTML5 & CSS3

JavaScript (Vanilla)

----------------------------------------------

5. Installation Instructions
Clone the repository

bash
Copy
Edit
git clone https://github.com/Bledioni/primexTech.git
Move the project to your local web server directory (e.g., htdocs for XAMPP)

Create a new MySQL database (e.g., primex_db) using phpMyAdmin

Import the SQL file from the database folder into your new database

Configure your database credentials in /config/db.php

Open the app in your browser:

User site: http://localhost/primexTech/

Admin panel: http://localhost/primexTech/admin/

Depot dashboard: http://localhost/primexTech/depot/

----------------------------------------------

6. Default Test Credentials
Role	Email	Password
Admin	admin@example.com	admin123
Depot	depot@example.com	depot123
User	user@example.com	user123