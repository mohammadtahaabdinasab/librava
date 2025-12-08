# Librava API - Android Integration Guide

Quick reference for Android developers integrating with Librava API.

## Base URL
```
http://localhost:8000/api
```
(Update to your production URL when deploying)

---

## Authentication Flow

### 1. User Login
```
POST /auth/login
Content-Type: application/json

{
  "email": "admin@librava.com",
  "password": "admin123"
}

Response (200):
{
  "status": "success",
  "data": {
    "token": "eyJhbGc...",
    "user": {
      "id": 1,
      "name": "Admin User",
      "email": "admin@librava.com",
      "role": "admin"
    }
  }
}
```

### 2. Store Token (SharedPreferences)
```kotlin
val sharedPref = context.getSharedPreferences("librava", Context.MODE_PRIVATE)
sharedPref.edit().putString("auth_token", token).apply()
```

### 3. Use Token in Requests
```
Authorization: Bearer eyJhbGc...
```

---

## Common Endpoints for Admin App

### Books Management

#### Get All Books
```
GET /books?page=1&per_page=20
```
Response: Array of books with pagination meta

#### Get Single Book
```
GET /books/1
```
Response: Single book object

#### Create Book (Admin)
```
POST /books
Authorization: Bearer <token>
Content-Type: application/json

{
  "title": "Book Title",
  "author": "Author Name",
  "published_year": 2023
}
```

#### Update Book (Admin)
```
PUT /books/1
Authorization: Bearer <token>
Content-Type: application/json

{
  "title": "Updated Title",
  "published_year": 2024
}
```

#### Delete Book (Admin)
```
DELETE /books/1
Authorization: Bearer <token>
```

---

### User Management (Admin)

#### List All Users
```
GET /admin/users?page=1&per_page=20
Authorization: Bearer <token>
```

#### Get Single User
```
GET /admin/users/2
Authorization: Bearer <token>
```

#### Update User Role/Status
```
PUT /admin/users/2
Authorization: Bearer <token>
Content-Type: application/json

{
  "role": "admin",
  "status": "active"
}
```

#### Delete User
```
DELETE /admin/users/2
Authorization: Bearer <token>
```

---

### Dashboard

#### Get Dashboard Stats
```
GET /admin/dashboard
Authorization: Bearer <token>
```

Response:
```json
{
  "total_users": 10,
  "active_users": 8,
  "admin_count": 2,
  "total_books": 25,
  "today_signups": 1
}
```

---

## HTTP Status Codes

- **200** - Success (GET, PUT)
- **201** - Created (POST)
- **400** - Bad Request (validation error)
- **401** - Unauthorized (missing/invalid token)
- **403** - Forbidden (insufficient permissions)
- **404** - Not Found (resource doesn't exist)
- **409** - Conflict (duplicate email, etc.)
- **500** - Server Error

---

## Error Handling

All error responses follow this format:
```json
{
  "status": "error",
  "message": "Human readable message",
  "errors": {
    "field_name": "error description"
  }
}
```

Example validation error:
```json
{
  "status": "error",
  "message": "Validation failed",
  "errors": {
    "email": "The email field is required.",
    "password": "Password must be at least 6 characters"
  }
}
```

---

## Android Implementation Example

### Using Retrofit

```kotlin
interface LibravaApiService {
    @POST("auth/login")
    suspend fun login(@Body request: LoginRequest): ApiResponse<LoginData>

    @GET("books")
    suspend fun getBooks(
        @Query("page") page: Int = 1,
        @Query("per_page") perPage: Int = 20
    ): ApiResponse<List<Book>>

    @POST("books")
    suspend fun createBook(
        @Body book: CreateBookRequest
    ): ApiResponse<Book>

    @PUT("books/{id}")
    suspend fun updateBook(
        @Path("id") id: Int,
        @Body book: UpdateBookRequest
    ): ApiResponse<Book>

    @DELETE("books/{id}")
    suspend fun deleteBook(@Path("id") id: Int): ApiResponse<Any>

    @GET("admin/users")
    suspend fun getUsers(
        @Query("page") page: Int = 1,
        @Query("per_page") perPage: Int = 20
    ): ApiResponse<List<User>>

    @GET("admin/dashboard")
    suspend fun getDashboard(): ApiResponse<DashboardStats>
}
```

### Interceptor for Auth Token

```kotlin
class AuthInterceptor(private val tokenProvider: () -> String?) : Interceptor {
    override fun intercept(chain: Interceptor.Chain): Response {
        val originalRequest = chain.request()
        val token = tokenProvider()

        val newRequest = if (token != null) {
            originalRequest.newBuilder()
                .header("Authorization", "Bearer $token")
                .build()
        } else {
            originalRequest
        }

        return chain.proceed(newRequest)
    }
}

// Setup Retrofit with interceptor
val client = OkHttpClient.Builder()
    .addInterceptor(AuthInterceptor { getStoredToken() })
    .build()

val retrofit = Retrofit.Builder()
    .baseUrl("http://localhost:8000/api/")
    .client(client)
    .addConverterFactory(GsonConverterFactory.create())
    .build()
```

---

## Data Classes

```kotlin
data class LoginRequest(
    val email: String,
    val password: String
)

data class LoginData(
    val token: String,
    val user: User
)

data class User(
    val id: Int,
    val name: String,
    val email: String,
    val role: String, // "admin" or "user"
    val status: String // "active" or "inactive"
)

data class Book(
    val id: Int,
    val title: String,
    val author: String,
    val published_year: Int,
    val created_at: String
)

data class CreateBookRequest(
    val title: String,
    val author: String,
    val published_year: Int
)

data class DashboardStats(
    val total_users: Int,
    val active_users: Int,
    val admin_count: Int,
    val total_books: Int,
    val today_signups: Int
)

data class ApiResponse<T>(
    val status: String, // "success" or "error"
    val message: String,
    val data: T?,
    val errors: Map<String, String>? = null,
    val meta: PaginationMeta? = null
)

data class PaginationMeta(
    val page: Int,
    val per_page: Int,
    val total: Int,
    val total_pages: Int
)
```

---

## Test Credentials

Use these for testing:

```
Admin Account:
Email: admin@librava.com
Password: admin123

Regular User:
Email: john@librava.com
Password: john123
```

---

## Production Deployment

Before deploying to production:

1. Update `BASE_URL` to your production server
2. Change JWT secret in `core/Auth.php`
3. Set up proper database (MySQL/PostgreSQL)
4. Enable HTTPS only
5. Add CORS headers if needed
6. Implement rate limiting
7. Add API versioning (e.g., `/api/v1/`)

---

## Token Expiration

Tokens expire after **7 days**. To refresh:

```
POST /auth/refresh
Authorization: Bearer <expired_token>

Response:
{
  "data": {
    "token": "new_token_here",
    "user": { ... }
  }
}
```

Store new token and use for subsequent requests.

---

## Rate Limiting (Future Enhancement)

Plan to add rate limiting:
- 100 requests per minute per IP
- 1000 requests per hour per user

---

## Support & Issues

- Check `API.md` for detailed documentation
- See `TESTING.md` for curl examples
- Review `REST-API-SUMMARY.md` for complete overview

Good luck with your Android app! 🚀
