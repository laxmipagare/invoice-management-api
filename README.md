# Invoice Management API (Laravel 9)

## Project Overview
This project is a **RESTful Invoice Management API** built with **Laravel 9**, **MySQL**, and **mPDF** for PDF generation.  
It is designed to handle user authentication, role-based access control, invoice CRUD operations, and dynamic PDF invoice generation.  

---

## Features

### 1. Authentication
- **Register** (`POST /api/register`) – Users can register as Admin or User.
- **Login** (`POST /api/login`) – Returns an authentication Bearer token.
- **Logout** (`POST /api/logout`) – Revokes the current user token.

### 2. Role-Based Access
- **Admin:** Can create, update, delete, view, and download invoices.
- **User:** Can view and download invoices, cannot create, edit, or delete.

### 3. Invoice Management
- **Create Invoice** (`POST /api/invoices`) – Admin only.
- **List Invoices** (`GET /api/invoices`)
- **Get Single Invoice** (`GET /api/invoices/{id}`).
- **Update Invoice** (`PUT /api/invoices/{id}`) – Admin only.
- **Delete Invoice** (`DELETE /api/invoices/{id}`) – Admin only.
- **Download PDF Invoice** (`GET /api/invoices/{id}/download`).

### 4. PDF Generation
- Uses **Blade views** and **mPDF** for formatting.
- Includes:
  - Company name and logo
  - Customer name & email
  - Invoice date & ID
  - Total amount
  - Status
- PDFs are generated dynamically.

### 5. API Response Format
- JSON responses with proper HTTP status codes.
- Example unauthenticated response:

```json
{
  "message": "Unauthenticated."
}