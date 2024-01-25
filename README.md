## Backend ReadMe

# Workana SoftExpert Sales System - Backend

This is the backend repository of the Workana SoftExpert Sales System. It provides the server-side logic and API for managing products, product types, sales, and user authentication.

## Installation and Setup
   
### Prerequisites

- PHP 7.4.0 or higher
- PostgreSQL
- Composer
- Docker and Docker Compose (optional, for running in containers)

### Database Setup

1. Create a PostgreSQL database named `workanasoft`.

   ```bash
   createdb workanasoft
   ```

2. Restore the database using the provided dump file located at the root of the project.

   ```bash
   psql -U username -h hostname -p port -d dbname < backup.sql
   ```

### Backend Setup

#### Running without Docker (Development)

1. Navigate to the backend directory:

   ```bash
   cd workana-softexpert
   ```

2. Install the backend dependencies using Composer:

   ```bash
   composer install
   ```

3. Start the PHP server:

   ```bash
   php -S localhost:8080 -t public
   ```

The backend will be accessible at [http://localhost:8080](http://localhost:8080).

#### Running with Docker (Development)

1. Ensure you have Docker and Docker Compose installed.

2. Navigate to the root directory of the project where the `docker-compose.yml` file is located.

3. Build and start the Docker containers:

   ```bash
   docker-compose up --build
   ```

4. The backend will be accessible at [http://localhost:8080](http://localhost:8080).

#### Running PHPUnit Tests

To run PHPUnit tests, use the following command:

```bash
composer test
```

## Features

- **Products**: Create, update, get and delete products. Products must be associated with existing product types.

- **Product Types**: Create and delete product types. Available to sellers and administrators.

- **Sales**: Create sales by adding products and quantities to the cart. The system calculates the total price and taxes for each item in the sale.

- **User Management** (For Admins): Manage users, including creating and deleting user accounts.

### Rules

- To create a product, it must be associated with an existing and not excluded product type.

- To create a sale, the product must exist and not be marked as excluded.

## Backend Stack

- PHP 8.3.2
- Doctrine ORM
- PostgreSQL
- JWT Authentication
- Hexagonal Architecture
- PHPUnit (for testing)

## Author

- Mateus Merlim Mattos