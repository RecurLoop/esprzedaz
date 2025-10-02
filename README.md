# Laravel Application (Dockerized)

This repository contains a Dockerized Laravel environment prepared for recruitment purposes.
It includes a PHP-FPM container, Nginx, and MySQL, with support for both **development** and **production** modes depending on your `.env` configuration or build arguments.

---

## Requirements

Before running this project, make sure you have the following installed on your system:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

---

## Running the Application

To build and start the application, run:

```bash
UID=$(id -u) GID=$(id -g) APP_ENV=development docker compose up --build --detach
```

- `UID` and `GID` ensure proper file permissions between the host system and the container.
- `APP_ENV` determines whether dependencies are installed with or without development packages.

By default, the application will be available at:
👉 [http://localhost:8080/pets](http://localhost:8080/pets)

---

## Accessing the Application Container

To open a shell inside the **app** container as your current host user:

```bash
docker compose exec --user $(id -u):$(id -g) app bash
```

This ensures that any files you create inside the container will belong to your host user.

---

## Notes

- If `.env` contains `APP_ENV=production`, Composer dependencies will be installed with `--no-dev`.
- Database credentials and other environment settings can be adjusted in the `.env` file.
- Data for the MySQL container is persisted using Docker volumes.

---

## Purpose

This project is intended **exclusively for recruitment** and demonstration purposes.
