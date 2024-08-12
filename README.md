## Simple E-Commerce

## Overview

This repository is a project to demonstrate and implement core e-commerce functionalities using a stack of powerful technologies. This application leverages Laravel Livewire for dynamic, real-time interactions, Filament for an intuitive admin panel, and Tailwind CSS for a CSS framework. Additionally, it integrates Midtrans for secure and efficient payment processing.

## Features

-   **Dynamic User Interface**: With Laravel Livewire, the application offers a seamless and interactive user experience without the need for complex JavaScript.
-   **Admin Panel**: Filament provides an elegant and user-friendly admin interface for managing products, orders, and other critical data.
-   **Secure Payments**: Midtrans integration enables secure and reliable payment processing, supporting multiple payment methods and handling transactions efficiently.

## Technology Stack

-   **Laravel Livewire**: Enhances Laravel applications with live, dynamic interfaces and eliminates the need for traditional front-end frameworks.
-   **Filament**: A powerful admin panel toolkit for Laravel, designed to streamline the management of backend resources.
-   **Tailwind CSS**: A utility-first CSS framework.
-   **Midtrans**: A payment gateway service integrated to handle secure transactions and support various payment methods, ensuring a smooth checkout process.

## Getting Started

To run the application locally:

1. **Clone this repository:**
    ```bash
    git clone https://github.com/your-repository/simple-ecommerce.git
    cd simple-ecommerce
    ```
2. **Install the dependencies:**
    ```
    composer install
    npm install
    ```
3. **Run the database migrations:**
    ```
    php artisan migrate
    ```
4. **(Optional) Seed the database with sample data:**
    ```
    php artisan db:seed
    ```
    If you run the seeder, copy images from the assets directory to the storage directory.
5. **Edit your .env file to configure the necessary environment variables.**
6. **Start the Laravel development server and the front-end build process:**
    ```
    php artisan serve
    npm run dev
    ```
7. **Access:**
    ```
    http://localhost:8000
    ```
    Admin
    ```
    http://localhost:8000/admin
    ```
