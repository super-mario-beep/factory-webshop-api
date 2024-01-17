# Factory Webshop API

The Factory Webshop API is an API for managing orders, products, and categories in an e-commerce webshop. It provides endpoints for creating orders, retrieving product information, and managing categories.

## Getting Started

These instructions will help you set up and run the Factory Webshop API locally for development and testing purposes.

### Prerequisites

- PHP >= 8.1
- Composer
- Laravel
- MySQL
- [Other dependencies]

### Installing
#### *Note: Docker also avialable
1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/factory-webshop-api.git
    ```

2. Navigate to the project directory:

    ```bash
    cd factory-webshop-api
    ```

3. Install dependencies:

    ```bash
    composer install
    ```

4. Copy the example environment file:

    ```bash
    cp .env.example .env
    ```

5. Configure your `.env` file with the appropriate database settings and other configuration.

6. Generate the application key:

    ```bash
    php artisan key:generate
    ```

7. Run database migrations:

    ```bash
    php artisan migrate
    ```

8. Start the development server:

    ```bash
    php artisan serve
    ```

## Running Tests

To run the automated tests, use the following command:

```bash
php artisan test
```

##  Example of API requests

### Get your order information
```bash
GET /api/orders/{order_id}
```

### Place new order
```bash
POST /api/orders
```

```bash
{
    "products": [
        {
            "sku": "LAP-100-A",
            "quantity": 2
        },
        {
            "sku": "LAP-100-B",
            "quantity": 2
        },
        {
            "sku": "LAP-100-C",
            "quantity": 2
        }
    ],
    "contact": {
        "name": "Doe",
        "email": "doe@gmail.com",
        "phone_number": "+123 456 7890",
        "address": "My street 1",
        "city": "Zagreb",
        "country": "Croatia"
    }   
}
```
#### *Note: if user do not have pricelist, default prices will apply

### Get products
```bash
GET /api/products
```
```bash
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "sku": "LAP-100-A",
            "name": "Laptops 100, Mark: 100A",
            "description": "Laborum exercitationem necessitatibus enim temporibus veniam ullam dolorum. Dolorum asperiores repudiandae veritatis maiores dolorem illum voluptatem. Alias et ut et culpa voluptatem exercitationem.",
            "price": "18.77",
        }
    }
    ...
}
```
