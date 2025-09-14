# 📚 Book Review System

A simple **Book Review Management System** built with **PHP, MySQL, HTML, CSS, and JavaScript**.  
It allows users to register, log in, browse books, give ratings & reviews, and admins to manage books.

---

## 🚀 Features
### 👤 User
- Register and login securely  
- Browse available books  
- Add ratings & reviews for books  
-  

### 👨‍💼 Admin
- Secure login with admin role  
- Add, update, or delete books  
-  

---

## 🛠️ Tech Stack
- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP (OOP + MVC structure)  
- **Database:** MySQL  
- **Server:** XAMPP / Apache  

---

## 📂 Project Structure

BookReviewSystem/
│── config/
│ └── database.php
│── controllers/
│ └── UserController.php
│ └── BookController.php
│ └── ReviewController.php
│ └── AdminController.php
│── models/
│ └── User.php
│ └── Book.php
│ └── Review.php
│── views/
    ------>auth---->login.php, signup.php
│ └── user/
│ └── dashboard.php
│ └── admin/
│ └── admin_dashboard.php
│── assets/
│ └── css/----
│ └── js/
│ └── images/
│── database/
│ └── bookreviewsystem.sql
│── index.php
│
│── README.md


---

## ⚙️ Installation & Setup


2️⃣ Setup Database

Open http://localhost/phpmyadmin

Create a new database named bookreviewsystem

Import the file database/bookreviewsystem1.sql

3️⃣ Configure Database

Edit config/database.php and update credentials if needed:

private $host = "localhost";
private $db_name = "bookreviewsystem";
private $username = "root";
private $password = "";

4️⃣ Run the Project

Start XAMPP (Apache & MySQL)

Place project folder in htdocs (e.g., C:/xampp/htdocs/BookReviewSystem)

Open in browser:

User: http://localhost/BookReviewSystem/index.php

Admin: http://localhost/BookReviewSystem/index.php

🔑 Default Login
Role	Email	                            Password
Admin	redowanahmed669@gmail.com            ridu1111
User	redowan.bhuiyan20@gmail.com          ridu1111
	
✨ Screenshots

(Add some screenshots of login page, user dashboard, admin panel here)

👨‍🏫 Author

Developed by 


---

👉 You just need to:  
- Replace `your-username` with your GitHub username.  
- Add your real **default admin/user accounts** if they’re different.  
- Drop in **screenshots** inside `/assets/images` and update README.  

Do you want me to also **include sample SQL insert data** (like one defaul
