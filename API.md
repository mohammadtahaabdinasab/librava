# Librava REST API Documentation

Complete REST API for Librava admin application (Web & Android).

## Base URL
```
http://localhost:8000/api
```

## Authentication
All protected endpoints require a Bearer token in the `Authorization` header:
```
Authorization: Bearer <token>
```

Tokens are valid for 7 days. Use `/auth/refresh` to get a new token before expiration.

---

## Authentication Endpoints

### Register User
**POST** `/auth/register`

Register a new user account.

**Request:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123"
}
```

**Response (201):**
```json
{
  "status": "success",
  "message": "User registered successfully",
  "data": {
    "id": 3,
    "name": "John Doe",
    "email": "john@example.com",
    "role": "user",
    "status": "active",
    "created_at": "2025-12-05 19:30:00",
    "updated_at": "2025-12-05 19:30:00"
  },
  "meta": []
}
```

### Login
**POST** `/auth/login`

Authenticate user and get JWT token.

**Request:**
```json
{
  "email": "admin@librava.com",
  "password": "admin123"
}
```

**Response (200):**
```json
{
  "status": "success",
  "message": "Login successful",
  "data": {
    "token": "eyJhbGc...",
    "user": {
      "id": 1,
      "name": "Admin User",
      "email": "admin@librava.com",
      "role": "admin",
      "status": "active",
      "created_at": "2025-12-05 10:00:00",
      "updated_at": "2025-12-05 10:00:00"
    }
  },
  "meta": []
}
```

**Test Credentials:**
- Admin: `admin@librava.com` / `admin123`
- User: `john@librava.com` / `john123`

### Get Profile
**GET** `/auth/me`

Get authenticated user's profile. Requires authentication.

**Response (200):**
```json
{
  "status": "success",
  "message": "Profile retrieved successfully",
  "data": {
    "id": 1,
    "name": "Admin User",
    "email": "admin@librava.com",
    "role": "admin",
    "status": "active"
  },
  "meta": []
}
```

### Refresh Token
**POST** `/auth/refresh`

Get a new token. Requires authentication.

**Response (200):**
```json
{
  "status": "success",
  "message": "Token refreshed successfully",
  "data": {
    "token": "eyJhbGc...",
    "user": { ... }
  },
  "meta": []
}
```

### Logout
**POST** `/auth/logout`

Logout user (client-side: remove token).

**Response (200):**
```json
{
  "status": "success",
  "message": "Logged out successfully",
  "data": null,
  "meta": []
}
```

---

## Book Endpoints

### List Books
**GET** `/books?page=1&per_page=10&search=title`

Get paginated list of books with search support.

**Query Parameters:**
- `page` (optional, default: 1) - Page number
- `per_page` (optional, default: 10) - Items per page
- `search` (optional) - Search by title or author

**Response (200):**
```json
{
  "status": "success",
  "message": "Books retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "1984",
      "author": "George Orwell",
      "published_year": 1949,
      "created_at": "2025-12-05 10:00:00"
    },
    {
      "id": 2,
      "title": "To Kill a Mockingbird",
      "author": "Harper Lee",
      "published_year": 1960,
      "created_at": "2025-12-05 10:00:00"
    }
  ],
  "meta": {
    "page": 1,
    "per_page": 10,
    "total": 3,
    "total_pages": 1
  }
}
```

### Get Book
**GET** `/books/:id`

Get a single book by ID.

**Response (200):**
```json
{
  "status": "success",
  "message": "Book retrieved successfully",
  "data": {
    "id": 1,
    "title": "1984",
    "author": "George Orwell",
    "published_year": 1949,
    "created_at": "2025-12-05 10:00:00"
  },
  "meta": []
}
```

### Create Book
**POST** `/books`

Create a new book. **Requires admin authentication.**

**Request:**
```json
{
  "title": "The Hobbit",
  "author": "J.R.R. Tolkien",
  "published_year": 1937
}
```

**Response (201):**
```json
{
  "status": "success",
  "message": "Book created successfully",
  "data": {
    "id": 4,
    "title": "The Hobbit",
    "author": "J.R.R. Tolkien",
    "published_year": 1937,
    "created_at": "2025-12-05 20:00:00"
  },
  "meta": []
}
```

### Update Book
**PUT** `/books/:id`

Update a book. **Requires admin authentication.**

**Request:**
```json
{
  "title": "Updated Title",
  "published_year": 1940
}
```

**Response (200):**
```json
{
  "status": "success",
  "message": "Book updated successfully",
  "data": {
    "id": 1,
    "title": "Updated Title",
    "author": "George Orwell",
    "published_year": 1940,
    "created_at": "2025-12-05 10:00:00",
    "updated_at": "2025-12-05 20:00:00"
  },
  "meta": []
}
```

### Delete Book
**DELETE** `/books/:id`

Delete a book. **Requires admin authentication.**

**Response (200):**
```json
{
  "status": "success",
  "message": "Book deleted successfully",
  "data": { "id": 1 },
  "meta": []
}
```

---

## Admin Endpoints

All admin endpoints require admin role authentication.

### List Users
**GET** `/admin/users?page=1&per_page=10`

Get paginated list of all users.

**Response (200):**
```json
{
  "status": "success",
  "message": "Users retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Admin User",
      "email": "admin@librava.com",
      "role": "admin",
      "status": "active",
      "created_at": "2025-12-05 10:00:00"
    },
    {
      "id": 2,
      "name": "John Doe",
      "email": "john@librava.com",
      "role": "user",
      "status": "active",
      "created_at": "2025-12-05 15:00:00"
    }
  ],
  "meta": {
    "page": 1,
    "per_page": 10,
    "total": 2,
    "total_pages": 1
  }
}
```

### Get User
**GET** `/admin/users/:id`

Get a single user by ID.

**Response (200):**
```json
{
  "status": "success",
  "message": "User retrieved successfully",
  "data": {
    "id": 2,
    "name": "John Doe",
    "email": "john@librava.com",
    "role": "user",
    "status": "active",
    "created_at": "2025-12-05 15:00:00"
  },
  "meta": []
}
```

### Update User
**PUT** `/admin/users/:id`

Update user role or status.

**Request:**
```json
{
  "role": "admin",
  "status": "inactive"
}
```

**Response (200):**
```json
{
  "status": "success",
  "message": "User updated successfully",
  "data": {
    "id": 2,
    "name": "John Doe",
    "email": "john@librava.com",
    "role": "admin",
    "status": "inactive",
    "updated_at": "2025-12-05 20:00:00"
  },
  "meta": []
}
```

### Delete User
**DELETE** `/admin/users/:id`

Delete a user. Cannot delete your own account.

**Response (200):**
```json
{
  "status": "success",
  "message": "User deleted successfully",
  "data": { "id": 2 },
  "meta": []
}
```

### Dashboard Stats
**GET** `/admin/dashboard`

Get dashboard statistics.

**Response (200):**
```json
{
  "status": "success",
  "message": "Dashboard data retrieved successfully",
  "data": {
    "total_users": 2,
    "active_users": 2,
    "admin_count": 1,
    "total_books": 3,
    "today_signups": 1,
    "last_updated": "2025-12-05 20:00:00"
  },
  "meta": []
}
```

---

## Error Responses

### 400 Bad Request
```json
{
  "status": "error",
  "message": "Validation failed",
  "data": null,
  "errors": {
    "email": "The email field is required.",
    "password": "Password must be at least 6 characters"
  }
}
```

### 401 Unauthorized
```json
{
  "status": "error",
  "message": "Unauthorized",
  "data": null,
  "errors": []
}
```

### 403 Forbidden
```json
{
  "status": "error",
  "message": "Forbidden: Admin access required",
  "data": null,
  "errors": []
}
```

### 404 Not Found
```json
{
  "status": "error",
  "message": "Book not found",
  "data": null,
  "errors": []
}
```

### 409 Conflict
```json
{
  "status": "error",
  "message": "Email already exists",
  "data": null,
  "errors": []
}
```

---

## Example API Calls

### Using curl

**Register:**
```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Jane Doe",
    "email": "jane@example.com",
    "password": "password123"
  }'
```

**Login:**
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@librava.com",
    "password": "admin123"
  }'
```

**Get Profile:**
```bash
curl -X GET http://localhost:8000/api/auth/me \
  -H "Authorization: Bearer eyJhbGc..."
```

**List Books:**
```bash
curl -X GET "http://localhost:8000/api/books?page=1&per_page=5"
```

**Create Book (Admin):**
```bash
curl -X POST http://localhost:8000/api/books \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer eyJhbGc..." \
  -d '{
    "title": "The Great Gatsby",
    "author": "F. Scott Fitzgerald",
    "published_year": 1925
  }'
```

**List Users (Admin):**
```bash
curl -X GET http://localhost:8000/api/admin/users \
  -H "Authorization: Bearer eyJhbGc..."
```

---

## Status Codes

- `200 OK` - Successful GET, PUT
- `201 Created` - Successful POST
- `400 Bad Request` - Invalid input/validation errors
- `401 Unauthorized` - Missing or invalid token
- `403 Forbidden` - Insufficient permissions
- `404 Not Found` - Resource not found
- `409 Conflict` - Resource conflict (e.g., email exists)
- `500 Internal Server Error` - Server error

---

## Response Format

All responses follow this standard format:

```json
{
  "status": "success|error",
  "message": "Human readable message",
  "data": null | object | array,
  "errors": {},
  "meta": {
    "page": 1,
    "per_page": 10,
    "total": 100,
    "total_pages": 10
  }
}
```

**Fields:**
- `status` - "success" or "error"
- `message` - Descriptive message
- `data` - Response payload (null for errors)
- `errors` - Validation errors (only in error responses)
- `meta` - Pagination/metadata (optional)
