# API Testing Guide

Quick testing commands for Librava REST API using curl.

## Quick Start

1. **Start the server:**
```bash
cd c:\Users\Unknow\Documents\Projects\Personal\librava
php -S localhost:8000 -t public
```

2. **In another terminal, run tests:**

### Test 1: Register a new user
```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d "{\"name\": \"Test User\", \"email\": \"test@example.com\", \"password\": \"test123\"}"
```

Expected Response (201):
```json
{
  "status": "success",
  "message": "User registered successfully",
  "data": { "id": 3, "name": "Test User", "email": "test@example.com", ... }
}
```

### Test 2: Login (get token)
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d "{\"email\": \"admin@librava.com\", \"password\": \"admin123\"}"
```

Expected Response (200):
```json
{
  "status": "success",
  "message": "Login successful",
  "data": {
    "token": "eyJhbGc...",
    "user": { "id": 1, "name": "Admin User", ... }
  }
}
```

**Save the token** from response. You'll need it for authenticated requests.

### Test 3: Get Books (public endpoint)
```bash
curl -X GET "http://localhost:8000/api/books?page=1&per_page=10"
```

Expected Response (200):
```json
{
  "status": "success",
  "message": "Books retrieved successfully",
  "data": [ { "id": 1, "title": "1984", ... }, ... ],
  "meta": { "page": 1, "per_page": 10, "total": 3, "total_pages": 1 }
}
```

### Test 4: Get authenticated user profile
```bash
curl -X GET http://localhost:8000/api/auth/me \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Test 5: Create a book (admin only)
```bash
curl -X POST http://localhost:8000/api/books \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d "{\"title\": \"New Book\", \"author\": \"Author Name\", \"published_year\": 2023}"
```

### Test 6: Get Dashboard Stats (admin only)
```bash
curl -X GET http://localhost:8000/api/admin/dashboard \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

Expected Response (200):
```json
{
  "status": "success",
  "message": "Dashboard data retrieved successfully",
  "data": {
    "total_users": 2,
    "active_users": 2,
    "admin_count": 1,
    "total_books": 3,
    "today_signups": 1
  }
}
```

### Test 7: List Users (admin only)
```bash
curl -X GET "http://localhost:8000/api/admin/users?page=1&per_page=10" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

---

## Using Postman

1. Create a new POST request to `http://localhost:8000/api/auth/login`
2. Set body to JSON:
   ```json
   {
     "email": "admin@librava.com",
     "password": "admin123"
   }
   ```
3. Send and copy the `token` from response
4. For authenticated requests, go to **Authorization** tab > Type: "Bearer Token" > Paste token
5. Now you can test protected endpoints

---

## Test Credentials (Mock Data)

**Admin User:**
- Email: `admin@librava.com`
- Password: `admin123`
- Role: admin

**Regular User:**
- Email: `john@librava.com`
- Password: `john123`
- Role: user

---

## Troubleshooting

**"Route not found" error?**
- Make sure you're sending the correct HTTP method (GET, POST, PUT, DELETE)
- Check the endpoint path (e.g., `/api/books` not `/api/book`)

**"Unauthorized" error?**
- Check if Authorization header is present: `Authorization: Bearer <token>`
- Make sure token is valid (hasn't expired - 7 day validity)

**"Forbidden" error?**
- Admin-only endpoints require `role: admin` in your token
- Try logging in with admin@librava.com account

**Server not responding?**
- Restart the PHP server: `php -S localhost:8000 -t public`
- Check if port 8000 is in use

---

## Android/Mobile Integration

To integrate with your Android app:

1. **Login endpoint:** `POST /api/auth/login`
   - Send email/password
   - Save returned `token` in SharedPreferences or similar

2. **All subsequent requests:** Include `Authorization: Bearer <token>` header

3. **Token refresh:** Use `POST /api/auth/refresh` to get new token before expiration

4. **Error handling:** Check `response.status` field:
   - `"success"` = OK
   - `"error"` = Check `response.message` and `response.errors`

Example Android code structure:
```kotlin
// Retrofit/OkHttp usage
val client = OkHttpClient.Builder()
    .addInterceptor { chain ->
        val original = chain.request()
        val request = original.newBuilder()
            .header("Authorization", "Bearer $token")
            .build()
        chain.proceed(request)
    }
    .build()
```
