# 🏡 Hendy Residence Website

A web application project built to manage the **Hendy Residence** website. This app is developed using **CodeIgniter 3.1.13** with SCSS for styling and follows the HMVC design pattern for clean modular development.

---

## 📦 Features

- User authentication with CSRF protection
- Modular page architecture using HMVC pattern
- SCSS-based styling with custom themes
- Flash messaging for user feedback
- Secure route protection via hooks
- MySQL-based data persistence

---

## 🛠️ Installation & Setup

### 1. Requirements

- PHP 7.4
- MySQL
- Apache or any local web server
- Visual Studio Code (optional but recommended)

### 2. Clone the Repository

```bash
git https://github.com/jbcanillo/hendy_residences.git
cd hendy-residence
```

---

### 3. Configure the Database Environment

1. Create a new MySQL database named: **`hendy_residences_dev_db`**
2. Open the file: `application/config/database.php`
3. Update the database connection credentials (hostname, username, password, and database name) to match your local setup.

---

### 4. 🎨 Compile SCSS to CSS

To compile SCSS files into CSS using **Visual Studio Code**, follow these steps:

1. Open the project folder in **VSCode**
2. Install the extension: **Live Sass Compiler**
3. Open **Settings** and search for `Sass`, or navigate to:  
   `Extensions → Live Sass Compiler → Settings`
4. Locate **"Settings: Formats"** and click **"Edit in settings.json"**
5. Add or update the configuration as shown below:

```json
"liveSassCompile.settings.formats": [
  {
    "format": "expanded",
    "extensionName": ".css",
    "savePath": "/assets/css/",
    "savePathReplacementPairs": null
  }
]
```

6. Click **"Watch Sass"** on the bottom toolbar in VSCode.
   ✅ Once running, the following compiled CSS files will be generated in the `assets/css/` folder:
   - `bootstrap.css`
   - `core.css`
   - `library.css`

---

### 5. 🧩 Database Migration

To set up the initial database schema:

1. Open your browser and visit:  
   [http://localhost/hendy_residences/migrate](http://localhost/hendy_residences/migrate)
2. After running the migration, check your database to ensure the **`user`** table exists and includes a default admin record.

---

### 6. 🚀 Running the Application

1. Access the application via:  
[http://localhost/hendy_residences](http://localhost/hendy_residences)

2. Log in using the default admin credentials:
      `Email: admin@example.com`
      `Password: admin123`
---

### 🔍 Key Development Decisions

- **SCSS** was used extensively to enable flexible theming and quick UI customization.
- Built on **CodeIgniter 3.1.13**, fully compatible with **PHP 7.4**.
- A basic **migration system** is included for easy database versioning during development.
- Implements **clean URL routing** via `routes.php` for better readability and SEO-friendliness.
- The **HMVC** pattern is followed for modular organization and cleaner separation of concerns.
- **Server-side validation** and **CSRF protection** are implemented using CodeIgniter’s built-in tools.
- **Authentication hooks** are used to restrict access to protected routes, ensuring only logged-in users can access them.
- For user feedback (errors and success messages), **flashdata** is utilized to enhance user experience.
