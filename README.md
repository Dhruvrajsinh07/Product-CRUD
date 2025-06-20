🛒 Product CRUD Application with User Authentication
A modular PHP and MySQL CRUD application featuring user registration, login, session-based authentication, and product/category management with a clean Bootstrap 5 user interface.
🚀 Features

User Authentication:
User registration and login with session management
Secure password hashing
Session-protected pages with unauthorized access prevention


CRUD Operations:
Create, Read, Update, Delete operations for products and categories
RESTful API endpoints for seamless data handling


Frontend:
Responsive UI built with Bootstrap 5
AJAX-powered form submissions with real-time validation
User-friendly dashboard for managing products and categories


Security:
PDO for secure database queries
Session-based authentication with redirects for protected routes


Modular Design:
Organized folder structure for scalability and maintainability



📂 Project Structure
product_crud/
├── api/
│   ├── category/         # Category CRUD API endpoints (create, read, update, delete)
│   ├── product/          # Product CRUD API endpoints
│   └── user/             # User authentication APIs (login, register)
├── assets/
│   ├── css/              # Custom styles for login, register, and dashboard pages
│   └── js/               # JavaScript for AJAX calls and frontend functionality
├── database/
│   └── db.sql            # Database schema and optional seed data
├── includes/
│   ├── init.php          # Database connection setup and session initialization
│   └── header.php        # Common header with session checks and UI components
├── pages/
│   ├── category/         # Category management UI pages
│   ├── product/          # Product management UI pages
│   ├── update_c/         # Category update UI pages
│   ├── update_p/         # Product update UI pages
│   ├── index.php         # Login page (entry point)
│   ├── register.php      # User registration page
│   └── logout.php        # User logout script
├── index.php             # Dashboard page (protected, post-login)

⚙️ Requirements

PHP: Version 7.4 or newer
Database: MySQL or MariaDB
Web Server: Apache or Nginx (e.g., XAMPP, WAMP, or LAMP)
Browser: JavaScript-enabled browser
Dependencies:
Bootstrap 5 (included via CDN or local assets)
jQuery (for AJAX and DOM manipulation)
FontAwesome or Lucide Icons (for UI icons)



🛠 Installation & Setup

Clone the Repository:
git clone https://github.com/Dhruvrajsinh07/Product-CRUD-with-PHP.git


Set Up the Database:

Import database/db.sql using phpMyAdmin or MySQL CLI to create the database and tables.

mysql -u your_username -p your_database < database/db.sql


Configure Database Connection:

Update database credentials (host, username, password, database name) in:includes/init.php




Start Web Server:

Ensure Apache/Nginx and MySQL services are running (e.g., via XAMPP/WAMP).
Place the project folder in your server's root directory (e.g., htdocs for XAMPP).


Access the Application:

Open your browser and navigate to:http://localhost/product_crud/pages/index.php




Register or Log In:

Create a new account via register.php or log in with existing credentials.
After login, you’ll be redirected to the dashboard (index.php).



🔐 Authentication Flow

Registration: Handled via AJAX in /api/user/register.php. Passwords are securely hashed.
Login: Processed via /api/user/login.php, storing user data in PHP sessions.
Protected Pages: Session checks in includes/header.php ensure only authenticated users access the dashboard, product, and category pages.
Logout: pages/logout.php destroys the session and redirects to the login page.

💻 Technologies Used

Backend: PHP (with PDO for secure database queries)
Database: MySQL or MariaDB
Frontend: Bootstrap 5, jQuery, FontAwesome/Lucide Icons
API: RESTful endpoints for user, product, and category management
Other: AJAX for asynchronous form submissions

📜 License
This project is open-source and licensed for personal and educational use under the MIT License.
👨‍💻 Author
DhruvrajsinhGitHub: Dhruvrajsinh07
🤝 Contributing
Contributions are welcome! Please fork the repository and submit a pull request with your improvements.
📞 Support
For issues or questions, open an issue on the GitHub repository.
