# Store Management System 🛒

A complete inventory and sales management web application built with **vanilla PHP** and **MySQL**, following the **MVC pattern**. This project is ideal for managing products, categories, clients, orders, and suppliers in a small retail environment.

---

## 🚀 Features

* 🧑‍💼 User login with roles (Admin, Manager)
* 📦 Product management with categories and multiple images
* 🛍️ Order creation and tracking with order items
* 👥 Client management
* 🏭 Supplier management
* 📊 Dashboard-ready structure
* 🔒 Passwords hashed with `password_hash()`
* 💾 Fully connected to MySQL using PDO

---

## 🗂️ Technologies Used

* PHP (no framework)
* MySQL
* PDO for database connection
* HTML/CSS (optional JavaScript)
* MVC architecture

---

## 🧱 Database Structure

Main tables:

* `users`, `roles`
* `products`, `categories`, `products_image`
* `clients`, `orders`, `order_items`
* `suppliers`

You can find the SQL schema in [`database/schema.sql`](database/schema.sql)

---

## ⚙️ Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Mahmoudlammadni/sotre_php_mvc.git
   cd sotre_php_mvc
   ```
