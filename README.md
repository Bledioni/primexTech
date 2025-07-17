# 🚀 PrimexTech

**PrimexTech** is a PHP-based e-commerce and inventory management system with multiple user roles — **Admin**, **Depot (Worker)**, and **User** — each with specific permissions and tasks.

---

## 👥 User Features
- 🛍️ Browse and search products
- 🛒 Add products to **cart**
- 💖 Save products to **wishlist**
- 📦 Place and track orders
- 👤 Manage personal account and view order history

---

## 🛠️ Admin Features
- ➕ Add, ✏️ update, and ❌ delete products
- 🗂️ Manage product categories
- 👷 Add, edit, or remove **depot workers**
- 📊 View and manage all user orders
- 🔐 Full access to admin control panel

---

## 🚚 Depot (Worker) Features
- 📥 View new orders assigned for shipping
- ✅ Process orders and mark them as **shipped**
- 🔄 Update shipping/delivery status

---

## 💻 Technologies Used
- 🐘 PHP (Core)
- 🗃️ MySQL (Database)
- 🌐 HTML5 & CSS3
- ⚙️ JavaScript (Vanilla)

---

## ⚙️ Installation Instructions

1. 📥 **Clone the repository**
   ```bash
   git clone https://github.com/bledini/primexTech.git
📂 Move the project to your local web server directory (e.g., htdocs for XAMPP).

🧱 Create a new MySQL database (e.g., primex_db) using phpMyAdmin.

📤 Import the SQL file located in the database folder into your new database.

⚙️ Configure your DB credentials in the configuration file (e.g., /config/db.php).

🌐 Run the app in your browser:

http://localhost/primexTech/ → User site

http://localhost/primexTech/admin/ → Admin panel

http://localhost/primexTech/depot/ → Depot dashboard

🔐 Default Test Credentials
Role	Email	Password
👑 Admin	admin@example.com	admin123
🚚 Depot	depot@example.com	depot123
👤 User	user@example.com	user123

⚠️ You can update these credentials directly in your database for production.

🧪 Project Status
🔧 This project is currently under development. Some features may still be in progress or incomplete. Stay tuned for updates!

