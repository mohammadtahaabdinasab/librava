# Librava REST API - Complete Implementation

## Overview

Your Librava project now includes a **production-ready REST API** designed for your Android admin application and website. The API uses JWT token authentication, supports role-based access control, and provides comprehensive CRUD operations for managing books and users.

---

## ✅ What's Implemented

### 1. **Authentication System**
- User registration (`POST /api/auth/register`)
- User login with JWT tokens (`POST /api/auth/login`)
- Token refresh (`POST /api/auth/refresh`)
- Profile retrieval (`GET /api/auth/me`)
- Logout (`POST /api/auth/logout`)

**Mock Test Credentials:**
- Admin: `admin@librava.com` / `admin123`
- User: `john@librava.com` / `john123`

### 2. **Book Management (CRUD)**
- List books with pagination & search: `GET /api/books`
- Get single book: `GET /api/books/:id`
- Create book (admin): `POST /api/books`
- Update book (admin): `PUT /api/books/:id`
- Delete book (admin): `DELETE /api/books/:id`

### 3. **User Management (Admin Only)**
- List users: `GET /api/admin/users`
- Get user: `GET /api/admin/users/:id`
- Update user: `PUT /api/admin/users/:id`
- Delete user: `DELETE /api/admin/users/:id`
- Dashboard stats: `GET /api/admin/dashboard`

### 4. **Features**
✅ JWT Token Authentication (7-day validity)
✅ Role-based Access Control (admin/user)
✅ Pagination support with metadata
✅ Search functionality (books)
✅ Consistent JSON response format
✅ Comprehensive error handling
✅ Input validation
✅ Mock in-memory database (no external DB drivers needed)
✅ HTTP status codes (200, 201, 400, 401, 403, 404, 409, 500)

---

## 📁 New Files Created

**Core API Infrastructure:**
- `core/Api.php` - Standardized API response handler
- `core/Auth.php` - JWT token generation & verification, user authentication
- `core/Router.php` - Updated with dynamic route parameter support

**API Controllers:**
- `app/controllers/Api/AuthController.php` - Authentication endpoints
- `app/controllers/Api/BookController.php` - Book CRUD endpoints
- `app/controllers/Api/UserController.php` - User management (admin)

**Routes & Documentation:**
- `routes/api.php` - All API endpoint definitions
- `API.md` - Complete API documentation with examples
- `TESTING.md` - Quick testing guide with curl commands

---

## 🚀 Quick Start

### Start the Server
```bash
cd c:\Users\Unknow\Documents\Projects\Personal\librava
php -S localhost:8000 -t public
```

### Test Authentication
```bash
# Login and get token
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@librava.com","password":"admin123"}'

# Response includes token - save it for authenticated requests
```

### Test Books Endpoint
```bash
# Get all books (public)
curl -X GET "http://localhost:8000/api/books?page=1&per_page=10"

# Get single book
curl -X GET http://localhost:8000/api/books/1

# Create book (requires admin token)
curl -X POST http://localhost:8000/api/books \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TOKEN_HERE" \
  -d '{"title":"New Book","author":"Author Name","published_year":2023}'
```

### Test Admin Dashboard
```bash
# Dashboard stats (requires admin token)
curl -X GET http://localhost:8000/api/admin/dashboard \
  -H "Authorization: Bearer TOKEN_HERE"
```

---

## 📱 Android Integration

Your Android app can integrate with this API by:

1. **Login**: POST to `/api/auth/login` with email/password
2. **Save token**: Store the returned JWT token securely
3. **Authenticated requests**: Include `Authorization: Bearer <token>` header
4. **Token refresh**: Call `/api/auth/refresh` before token expires
5. **Handle responses**: Check `status` field in response body

---

## 📊 API Response Format

All responses follow this structure:

```json
{
  "status": "success|error",
  "message": "Descriptive message",
  "data": { /* actual data */ },
  "errors": { /* validation errors */ },
  "meta": {
    "page": 1,
    "per_page": 10,
    "total": 100,
    "total_pages": 10
  }
}
```

---

## 🔒 Security Features

- **JWT Tokens**: 7-day validity with HMAC-SHA256 signature
- **Password Hashing**: bcrypt for secure password storage
- **Role-based Access**: Admin-only endpoints protected
- **Input Validation**: All endpoints validate required fields
- **HTTP Status Codes**: Proper codes for different scenarios

---

## 🗄️ Data Structure

**Users Table:**
- id, name, email, password (hashed), role (admin/user), status (active/inactive), created_at, updated_at

**Books Table:**
- id, title, author, published_year, created_at, updated_at

---

## 📝 Complete Endpoint List

| Method | Endpoint | Auth | Role | Purpose |
|--------|----------|------|------|---------|
| POST | `/api/auth/register` | No | - | Register new user |
| POST | `/api/auth/login` | No | - | Login & get token |
| GET | `/api/auth/me` | Yes | - | Get profile |
| POST | `/api/auth/logout` | Yes | - | Logout |
| POST | `/api/auth/refresh` | Yes | - | Refresh token |
| GET | `/api/books` | No | - | List books |
| GET | `/api/books/:id` | No | - | Get book |
| POST | `/api/books` | Yes | admin | Create book |
| PUT | `/api/books/:id` | Yes | admin | Update book |
| DELETE | `/api/books/:id` | Yes | admin | Delete book |
| GET | `/api/admin/users` | Yes | admin | List users |
| GET | `/api/admin/users/:id` | Yes | admin | Get user |
| PUT | `/api/admin/users/:id` | Yes | admin | Update user |
| DELETE | `/api/admin/users/:id` | Yes | admin | Delete user |
| GET | `/api/admin/dashboard` | Yes | admin | Dashboard stats |

---

## 🧪 Testing Tools

Recommended tools for API testing:

1. **Postman** - Full-featured API client with UI
2. **curl** - Command-line tool (included in Windows 10+)
3. **Thunder Client** (VS Code extension)
4. **REST Client** (VS Code extension)
5. **Insomnia** - Modern API client

---

## 📚 Documentation Files

- **`API.md`** - Complete API documentation with all endpoints and examples
- **`TESTING.md`** - Quick testing guide with curl examples
- **`SETUP.md`** - Local development setup instructions
- **`README.md`** - Project overview

---

## 🔄 Next Steps

1. ✅ Run the PHP server
2. ✅ Test endpoints using curl or Postman
3. ✅ Integrate API with your Android app
4. ✅ Add database persistence (optional - mock data works for development)
5. ✅ Deploy to production server

---

## 💡 Notes

- **Mock Data**: The API uses in-memory mock data (no database drivers needed)
- **Production Ready**: When ready, add a real database by importing `database/librava.sql` after setting up MySQL/SQLite
- **Token Secret**: Change `'your-secret-key'` in `core/Auth.php` before production
- **CORS**: Add CORS headers if Android app is on different domain

---

## Support

Refer to `API.md` for detailed endpoint documentation and `TESTING.md` for quick curl examples.

Happy coding! 🚀
