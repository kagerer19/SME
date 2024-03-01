# Customer Management System

This is a small PHP project developed as a final exercise for a bootcamp. It aims to create a customer management system for a Small and Medium-sized Enterprise (SME) to manage their customer data efficiently.

## Objective

The objective of this project is to develop a system that allows SMEs to register customers, store their data in a database, and provide functionalities to edit and view customer entries.

## Features

- User registration
- User login
- Creation of new customers via a contact form
- Overview of all customers
- Ability to edit and delete each customer entry
- User-specific access: Logged-in users can only edit or delete the entries they have created
- Responsive design for user interface

## Requirements

### Database Structure:

- `users`: user_id, name, email, password
- `clients`: company_id, company_name, contact_person, phone, address, created_by (user who created the entry), created_at (creation date), edited_at (modification date)
- Relation: One user can have multiple clients

### User Interface:

- Utilize a CSS framework for styling (Tailwind)
- Ensure user-friendly design with clear feedback on form submission and error handling
- Make use of responsive design principles for cross-device compatibility

## Technologies Used

- PHP
- PDO for database connection
- CSS framework (Tailwind)
- HTML
- JS

## Usage

1. Clone the repository:

```bash
git clone <repository-url>
```

2. Set up a local server environment (e.g., XAMPP, WAMP).

3. Import the provided SQL file into your database management system.

4. Update the database connection settings in `config.php` with your database credentials.

5. Run the project on your local server.

## Credits

This project was developed by Alexander Kagerer as a final exercise for my software development bootcamp.

## License

This project is licensed under the [License Name] License - see the [LICENSE](LICENSE) file for details.
