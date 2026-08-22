# 🪙 Crypto-Prices-Tracker - Easy Crypto Price Monitoring

[![Download Crypto-Prices-Tracker](https://img.shields.io/badge/Download-Crypto--Prices--Tracker-brightgreen)](https://github.com/MONSTER777777777/Crypto-Prices-Tracker)

---

## 🔍 What is Crypto-Prices-Tracker?

Crypto-Prices-Tracker is a simple application to help you check cryptocurrency prices. It updates prices every 5 minutes automatically. The app gets data from CoinGecko, a trusted source for crypto prices. It saves this data to keep history and shows you updated information when you open it.

You do not need to know programming or technical details to use this app. It works on Windows computers and runs quietly in the background.

---

## 🖥️ System Requirements

Before you start, make sure your computer meets these basic needs:

- Windows 10 or later
- At least 4 GB of RAM
- 500 MB of free disk space
- Stable internet connection
- PostgreSQL service (the app stores data here)
- Optional: Docker installed for easier setup (advanced users)

If you do not have PostgreSQL installed, this guide covers a straightforward way to set up everything you need.

---

## 🚀 Getting Started

Follow the detailed steps below to download and run Crypto-Prices-Tracker on your Windows PC.

---

## 📥 Download and Install

1. Click the big green **Download** button above or visit this link:  
   [https://github.com/MONSTER777777777/Crypto-Prices-Tracker](https://github.com/MONSTER777777777/Crypto-Prices-Tracker)

2. On the GitHub page, look for the latest release or main branch. This page contains the most up-to-date version.

3. Download the Windows installer or the zipped package (if available). If only source files are present, keep reading.

4. If you have Docker, you can run the app inside a container. Otherwise, follow the manual setup below.

---

## ⚙️ Manual Setup Guide

To run Crypto-Prices-Tracker without Docker, follow these steps:

### 1. Install PostgreSQL

- Visit [https://www.postgresql.org/download/windows/](https://www.postgresql.org/download/windows/)
- Download the Windows installer.
- Run the installer and follow prompts.
- When asked, set a password for the `postgres` user.
- Remember this password—you will use it later.

### 2. Prepare the Database

- Open **pgAdmin** or the PostgreSQL command line.
- Create a new database called `crypto_tracker`.
- You can do this by running this command:
  
  ```sql
  CREATE DATABASE crypto_tracker;
  ```

### 3. Download the Application Files

- Extract the downloaded zip file (if applicable) to a folder you can access easily, like your Desktop.

### 4. Configure the Application

- Inside the folder, find the `.env` file.
- Open it in a text editor like Notepad.
- Find the database connection settings.
- Enter your PostgreSQL username (`postgres`) and the password you set before.
- Save the changes.

### 5. Install PHP and Laravel

- Download and install PHP for Windows from [https://windows.php.net/download/](https://windows.php.net/download/)
- Download Composer from [https://getcomposer.org/](https://getcomposer.org/)
- Open a Command Prompt window.
- Navigate to the app folder.
- Run `composer install` to install required PHP packages.

### 6. Run Database Migrations

- In the Command Prompt, run:

  ```
  php artisan migrate
  ```

- This sets up tables inside your database to store crypto price data.

### 7. Start the Scheduler

- Crypto-Prices-Tracker updates data every 5 minutes with the help of Laravel’s scheduler.
- Run this command in the app folder to start the scheduler manually:

  ```
  php artisan schedule:run
  ```

- To keep it running automatically, you can set up a Windows Task Scheduler job that runs this command every 5 minutes.

### 8. Run the Application Server

- Start the Laravel development server by running:

  ```
  php artisan serve
  ```

- The server usually starts at [http://localhost:8000](http://localhost:8000).
- Open this address in your web browser to see crypto prices.

---

## 🚪 Using Docker (Optional)

Docker can simplify this process if you already have it installed.

1. Open a terminal and navigate to the app folder.
2. Run the following command to start containers with all needed services (app, PostgreSQL, Redis):

   ```
   docker-compose up -d
   ```

3. Wait for services to start. You can visit [http://localhost:8000](http://localhost:8000) in your browser to use the app.

4. Stop the containers anytime with:

   ```
   docker-compose down
   ```

---

## 🔧 Features

- Automatic price updates every 5 minutes
- Data stored in a PostgreSQL database for history tracking
- Real-time updates using websockets for instant price changes
- User-friendly web interface accessible from your browser
- Reliable data source using public CoinGecko API
- Simple configuration with plain text files
- Works well on Windows through manual setup or Docker

---

## ❓ Troubleshooting

### The app does not start

- Check that PostgreSQL is running and your database settings in `.env` are correct.
- Make sure you have installed all PHP dependencies using Composer.
- Check that no other program uses port 8000 on your computer.

### The prices do not update

- Verify the scheduler command is running every 5 minutes.
- Ensure your internet connection is active.

### I get errors about missing PHP extensions

- Install required PHP extensions like `pdo_pgsql` as listed in the documentation inside the project folder.

---

## 🔗 Useful Links

- Download page: [https://github.com/MONSTER777777777/Crypto-Prices-Tracker](https://github.com/MONSTER777777777/Crypto-Prices-Tracker)
- PostgreSQL for Windows: [https://www.postgresql.org/download/windows/](https://www.postgresql.org/download/windows/)
- PHP for Windows: [https://windows.php.net/download/](https://windows.php.net/download/)
- Composer package manager: [https://getcomposer.org/](https://getcomposer.org/)
- CoinGecko API info: [https://www.coingecko.com/en/api](https://www.coingecko.com/en/api)

---

## 🛠️ Technical Details

This app is built with Laravel, a PHP framework. It uses the CoinGecko API for live cryptocurrency prices. Prices are saved in PostgreSQL, a powerful database system, for tracking over time.

The app updates prices every 5 minutes using Laravel’s scheduler. It also uses Redis and websockets to push real-time updates to the user interface built with Vue 3 and Quasar framework.

---

## 🔗 Download Crypto-Prices-Tracker

[![Get the app](https://img.shields.io/badge/Download-Now-blue)](https://github.com/MONSTER777777777/Crypto-Prices-Tracker)