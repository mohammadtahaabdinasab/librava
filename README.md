# 📚 **Librava - Multilingual PHP MVC Library Management System**

A fully modular, multilingual (English + Persian), environment‑based, API‑enabled **Library Management System** built using:

-   **PHP 8+ (Custom MVC Architecture)**
-   **MySQL**
-   **Bootstrap 5**
-   **HTML / CSS / JavaScript**
-   **Git & GitHub Actions**
-   **dotenv (.env + .env.local)**
-   **RESTful API Layer**

Librava is designed for both **production use** and **learning clean
software architecture**.

------------------------------------------------------------------------

# 🌍 **Multilingual Support**

Librava provides full bilingual support:

### ✔ Persian (FA) - راست‌چین

### ✔ English (EN) - Left-to-right

Structure:

    resources/lang/
    │── en.php
    │── fa.php

Switching language is done through: - User preferences
- Query parameter (`?lang=en | ?lang=fa`)
- Auto-detection via cookie/session

------------------------------------------------------------------------

# 🧩 **Core Features**

## 🔹 **1. Custom MVC Architecture**

-   Lightweight & flexible
-   Clean folder structure
-   Extendable controllers
-   Reusable model layer
-   View templating support
-   Auto-routing & fallback routes

------------------------------------------------------------------------

## 🔹 **2. Environment-Based Configuration**

The system uses **dotenv** for separate production/local environments.

### `.env`

    APP_ENV=production
    APP_DEBUG=false
    DEFAULT_LANG=en

    DB_HOST=localhost
    DB_USER=root
    DB_PASS=
    DB_NAME=librava

    API_TOKEN=prod_xxxxxxxxx

### `.env.local`

    APP_ENV=local
    APP_DEBUG=true
    DEFAULT_LANG=fa

    DB_HOST=localhost
    DB_USER=root
    DB_PASS=
    DB_NAME=librava_dev

    API_TOKEN=local_xxxxxxxx

Environment priority:

    .env.local  >  .env

------------------------------------------------------------------------

## 🔹 **3. Comprehensive RESTful API System**

Librava includes a **production-ready REST API** designed for web and mobile applications (especially Android).

### **API Overview**

- ✅ JWT Token Authentication (7-day expiry)
- ✅ Role-based Access Control (admin/user)
- ✅ Pagination with metadata
- ✅ Search functionality
- ✅ Consistent JSON responses
- ✅ Comprehensive error handling
- ✅ Mock data for development

### **Authentication**
```
POST /api/auth/login
POST /api/auth/register
POST /api/auth/refresh
GET /api/auth/me
```

### **Book Management**
```
GET /api/books (with pagination & search)
GET /api/books/:id
POST /api/books (admin only)
PUT /api/books/:id (admin only)
DELETE /api/books/:id (admin only)
```

### **User Management (Admin)**
```
GET /api/admin/users
GET /api/admin/users/:id
PUT /api/admin/users/:id
DELETE /api/admin/users/:id
GET /api/admin/dashboard
```

### **Response Format**
All endpoints return standardized JSON:
```json
{
  "status": "success|error",
  "message": "Descriptive message",
  "data": { /* response data */ },
  "errors": { /* validation errors */ },
  "meta": { /* pagination metadata */ }
}
```

### **Quick API Test**
```bash
# Login
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@librava.com","password":"admin123"}'

# Get books
curl -X GET http://localhost:8000/api/books

# Create book (with token)
curl -X POST http://localhost:8000/api/books \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{"title":"Book Title","author":"Author","published_year":2023}'
```

📖 **See `API.md` for complete documentation**
📱 **See `ANDROID-INTEGRATION.md` for mobile integration guide**
🧪 **See `TESTING.md` for quick testing with curl**

------------------------------------------------------------------------

## 🔹 **4. Existing Features
  `/api/book/{id}`   DELETE   Delete book
  `/api/users`       GET      Fetch users
  `/api/borrow`      POST     Borrow a book
  `/api/return`      POST     Return a book

### **Authentication**

All API endpoints require:

    Authorization: Bearer <API_TOKEN>

------------------------------------------------------------------------

## 🔹 **4. Library Management Module**

-   Add / edit / delete books
-   Upload cover images
-   Manage categories & tags
-   Book availability tracking
-   Search & filtering system
-   Sort by author / year / category

------------------------------------------------------------------------

## 🔹 **5. Borrowing System**

-   Register new borrow
-   Register returning
-   Overdue detection
-   Borrowing history per user
-   Automatic status change

------------------------------------------------------------------------

## 🔹 **6. User Management**

-   Admin panel
-   Member accounts
-   Role system (Admin, Librarian, Member)
-   Session management
-   Secure login

------------------------------------------------------------------------

## 🔹 **7. Bootstrap-based UI**

-   Clean responsive layout
-   RTL support for Persian
-   Dark/Light theme (optional)
-   Accessible design

------------------------------------------------------------------------

## 🔹 **8. Git + GitHub Actions**

### Included automated workflows:

-   PHP syntax check
-   Linting
-   Auto-deploy (optional)

Workflow file:

    .github/workflows/php-lint.yml

------------------------------------------------------------------------

# 📁 **Project Structure**

    librava/
    │
    ├── app/
    │   ├── controllers/
    │   ├── models/
    │   ├── views/
    │
    ├── core/
    │   ├── App.php
    │   ├── Controller.php
    │   ├── Model.php
    │   ├── Router.php
    │
    ├── resources/
    │   ├── lang/
    │   │   ├── en.php
    │   │   └── fa.php
    │   ├── templates/
    │   └── messages/
    │
    ├── config/
    │   ├── database.php
    │   ├── app.php
    │   └── routes.php
    │
    ├── public/
    │   ├── assets/
    │   │   ├── css/
    │   │   ├── js/
    │   │   ├── img/
    │   └── index.php
    │
    ├── routes/
    │   ├── web.php
    │   └── api.php
    │
    ├── storage/
    │   ├── logs/
    │   ├── cache/
    │   └── uploads/
    │
    ├── .env
    ├── .env.local
    ├── .gitignore
    └── README.md

------------------------------------------------------------------------

# ⚙️ **Installation Guide**

### **Step 1 - Clone**

``` bash
git clone https://github.com/mohammadtahaabdinasab/librava.git
```

### **Step 2 - Create environment files**

Copy `.env.example` to `.env` and `.env.local`.

### **Step 3 - Install database**

Import:

    /database/librava.sql

### **Step 4 - Start local server**

    http://localhost/librava/public

------------------------------------------------------------------------

# 🧪 **API Testing Instructions**

### Using **Postman**

1.  Import `Librava_API_Collection.json`
2.  Set variable:

```{=html}
<!-- -->
```
    {{base_url}} = http://localhost/librava/api

3.  Add auth token to headers:

```{=html}
<!-- -->
```
    Authorization: Bearer local_xxxxx

------------------------------------------------------------------------

# 🧭 **Roadmap**

-   Full JWT authentication
-   WebSockets for live notifications
-   Mobile app API mode
-   Role permissions expansion
-   Advanced search engine
-   PDF export (borrow history)
-   UI theme builder

------------------------------------------------------------------------

# 🤝 **Contributing**

1.  Fork
2.  Create branch: `feature/<feature-name>`
3.  Commit using:

```{=html}
<!-- -->
```
    feat: ...
    fix: ...
    refactor: ...
    docs: ...

4.  Pull request

------------------------------------------------------------------------

# 📄 **License**

Released under the MIT License.

------------------------------------------------------------------------

# ⭐ **Support**

If you like the project, please give it a ⭐ on GitHub!
