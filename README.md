## Backend ReadMe

# Workana SoftExpert Sales System - Backend

This is the backend repository of the Workana SoftExpert Sales System. It provides the server-side logic and API for managing products, product types, sales, and user authentication.

## Installation and Setup

### Prerequisites

- PHP 7.4.0 or higher
- PostgreSQL
- Composer

### Database Setup

1. Create a PostgreSQL database named `workanasoft`.
2. Restore the database using the provided dump file located at the root of the project.
   ```bash
   pg_restore -U your_username -d workanasoft workanasoft.dump
   ```

### Backend Setup

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

## Author

- Mateus Merlim Mattos