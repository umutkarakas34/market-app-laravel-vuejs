# Market-App API

This is a simple API for a market application built with Laravel. It provides basic functionalities like user registration, login, product management, and order placement.

## Technologies Used

- **Backend:** Laravel
- **Frontend:** Vue.js
- **Database:** MySQL (or any Laravel-supported database)
- **Authentication:** Laravel Sanctum
- **HTTP Client:** Axios (for frontend requests)

## API Endpoints

### Authentication

- **`POST /api/register`**  
  Registers a new user with name, email, and password.

- **`POST /api/login`**  
  Logs in the user and provides an access token.

- **`POST /api/logout`**  
  Logs out the user and revokes the access token.

### Products

- **`GET /api/products`**  
  Retrieves a list of available products.

- **`POST /api/products`**  
  Creates a new product (Admin only).

- **`PUT /api/products/{product}`**  
  Updates an existing product (Admin only).

- **`DELETE /api/products/{product}`**  
  Deletes a product (Admin only).

### Orders

- **`GET /api/user/orders`**  
  Retrieves the list of orders placed by the authenticated user.

- **`POST /api/orders`**  
  Places an order for a product.

### Admin Orders

- **`GET /api/admin/orders`**  
  Retrieves all orders made by users (Admin only).

## Error Handling

- **401 Unauthorized:** Authentication required.
- **403 Forbidden:** Access restricted to admins.
- **404 Not Found:** Resource not found.
- **422 Unprocessable Entity:** Validation error.

---

This is a basic market-app API designed for handling users, products, and orders with simple admin functionalities.
