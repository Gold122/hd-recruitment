# Laravel Project with Docker

This repository contains a Laravel project configured to run within a Docker environment. Docker provides a consistent and isolated development environment, making it easy to set up and share projects.

## Prerequisites

Make sure you have the following software installed on your machine:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Getting Started

1. Clone the repository:

    ```bash
    git clone git@github.com:Gold122/hd-recruitment.git
    cd hd-recruitment
    ```

2. Copy the example environment file and configure it:

    ```bash
    cp app/.env.example app/.env
    ```

   Update the `.env` file with your database and other configurations.

3. Build and run the Docker containers:

    ```bash
    docker-compose up -d --build
    ```

7. Visit [http://localhost:8000](http://localhost:8000) in your browser to see the Laravel application.

## Import Postman Collection

1. Postman collections are available in postman directory.

2. Open Postman and click on the "Import" button.

3. Import `Dev.postman_environment.json` `hd-api.postman_collection.json` files.

4. The collection should now be available in your Postman workspace.


## Docker Commands

- Start containers: `docker-compose up -d`
- Stop containers: `docker-compose down`
- Access the Laravel application container shell: `docker-compose exec app bash`

## Customization

- Modify the `docker-compose.yml` file for additional services or changes.
- Adjust the `.env` file for Laravel-specific configurations.