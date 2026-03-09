# Invoice Management API (Laravel 9)

Setup Instructions

1️. Clone the Project
git clone <your-repo-url>
cd <project-folder>

2. Install Dependencies
composer install
Installs Laravel, Sanctum, and mPDF.

3. Configure Environment Variables
cp .env.example .env
Open .env and configure database:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=invoice_db
DB_USERNAME=root
DB_PASSWORD=

4. Generate App Key
php artisan key:generate

5. Run Migrations
php artisan migrate

6. Install mPDF
composer require mpdf/mpdf

7. Serve the Application
php artisan serve
API Base URL: http://127.0.0.1:8000/api

8. Test API with Postman

1.Import the provided Postman collection.
2.Create environment variable {{token}} for Bearer token.
3. Workflow:

  - Register Admin/User (POST /api/register)

  - Login (POST /api/login) → token saved automatically

  - Access protected routes (GET /invoices, POST /invoices, etc.)

  - Download PDF (GET /invoices/{id}/download)

  - Logout (POST /api/logout) → token revoked

Any request without a valid token returns:
{
  "message": "Unauthenticated."
}

9. Add Logo for PDF
- Place your logo image at public/logo.png

- Blade template resources/views/invoice_pdf.blade.php will automatically include it in generated PDFs.

-- Notes

- Admin-only routes are protected by AdminMiddleware
- User routes can view and download invoices only
- Use Laravel Sanctum tokens for authentication
- All API responses are JSON formatted for clean Postman testing


Other 

- Authentication: Laravel Sanctum (Bearer tokens)
- Admin Middleware: Protects Admin-only endpoints
- JSON Responses: All API calls return JSON
Clean MVC Architecture
PDF Blade Template: Easy logo addition and styling
Bonus Features: Pagination, multiple invoice items, Docker setup can be added easily
