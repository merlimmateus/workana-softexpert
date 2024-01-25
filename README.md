## Frontend ReadMe

# Workana SoftExpert Sales System - Frontend

This is the frontend repository of the Workana SoftExpert Sales System. It provides the user interface for managing products, sales, and user authentication.

## Installation and Setup

### Prerequisites

- Node.js 18.3.0
- npm or yarn

### Frontend Setup

1. Navigate to the frontend directory:
   ```bash
   cd workana-softexpert-frontend
   ```

2. Install the frontend dependencies using npm or yarn:
   ```bash
   npm install
   ```

3. Build the frontend for production:
   ```bash
   npm run build
   ```

4. Install the serve package globally:
   ```bash
   npm install -g serve
   ```

5. Start the frontend production server:
   ```bash
   serve -s build -l 3000
   ```

The frontend will be accessible at [http://localhost:3000](http://localhost:3000).

## Features

The frontend provides the user interface for managing products, creating sales, and user authentication. Users can log in with different roles, including client, seller, and admin, each with different levels of access to the system.

### User Roles

- `client`: Can access products and sales.
- `seller`: Can access products, sales, and product types.
- `adm`: Can access products, sales, product types, and user management.

### Default Users

You can log in with the following default users:

- `client` User:
   - Username: client
   - Password: client

- `seller` User:
   - Username: seller
   - Password: seller

- `adm` User:
   - Username: adm
   - Password: adm

### Configure .env

Don't forget to set the .env file using your API_BASE_URL. Example below:

```bash
REACT_APP_API_URL=http://localhost:8080
```

## Frontend Stack

- React.js
- Node.js 18.3.0
- Bootstrap
- Material-UI

## Docker (Optional)

If you prefer to run the frontend using Docker, you can use the provided Dockerfile and docker-compose.yaml.

### Docker Setup

1. Make sure you have Docker installed and configured on your system.

2. Navigate to the frontend directory:
   ```bash
   cd workana-softexpert-frontend
   ```

3. Build the Docker image:
   ```bash
   docker build -t workana-frontend .
   ```

4. Run the Docker container:
   ```bash
   docker run -d -p 3000:3000 workana-frontend
   ```

The frontend will be accessible at [http://localhost:3000](http://localhost:3000) when running inside a Docker container.