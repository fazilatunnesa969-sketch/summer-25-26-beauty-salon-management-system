# LA MIRROR Beauty Salon Management System

A web-based Beauty Salon Management System developed to manage salon operations efficiently through different user roles.

The system provides separate functionalities for **Manager, Receptionist, Beautician, and Customer**, allowing the salon to manage appointments, services, payments, safety information, service timing, invoices, and customer history in one centralized system.

---

## 📌 Project Description

LA MIRROR Beauty Salon Management System is designed to digitalize the daily operations of a beauty salon.

Customers can book appointments and provide safety information, receptionists can manage appointments and payments, beauticians can manage services and safety alerts, and managers can oversee the overall salon management process.

---

## 🎯 Project Objectives

The main objectives of this project are:

- To manage salon appointments digitally
- To reduce manual appointment management
- To manage customers and their information
- To assign beauticians to appointments
- To manage invoices and payment status
- To provide customer safety and allergy information
- To track ongoing beauty services
- To maintain customer appointment history
- To improve communication between salon staff
- To provide a centralized salon management system

---

## 👥 User Roles

The system contains four main user roles:

### 1. Manager

The Manager is responsible for overall salon management.

Main responsibilities include:

- Manage salon services
- Manage users and staff
- Monitor salon activities
- Manage salon information
- Oversee the overall system

---

### 2. Receptionist

The Receptionist manages appointments, beautician assignments, invoices, and payments.

Main features:

- Appointment Queue
- Search Appointments
- Assign Beauticians
- Confirm Appointments
- Add Appointments
- Create Invoices
- Update Payment Status
- Search Invoices
- Delete Invoices
- Manage Notices

---

### 3. Beautician

The Beautician manages customer services and safety information.

Main features:

- View confirmed appointments
- Service Timer
- Start Service
- Complete Service
- View Safety Alerts
- View customer allergy/safety information
- Manage Customer Follow-Ups
- View Beautician Notices

---

### 4. Customer

Customers can manage their appointments and personal information.

Main features:

- Customer Registration
- Login
- Book Appointment
- Select Beauty Services
- Select Date and Time
- Provide Safety/Allergy Information
- Make Payment
- View Appointments
- Cancel Appointment
- Reschedule Appointment
- View Payment History
- View Customer Profile
- View Appointment History

---

## ✨ Key Features

- Role-based authentication
- Customer registration and login
- Online appointment booking
- Appointment management
- Beautician assignment
- Invoice management
- Payment status management
- Customer safety alerts
- Allergy and skin sensitivity information
- Service timer
- Customer follow-up management
- Customer appointment history
- Appointment search
- Invoice search
- Notice management

---

## 🛠️ Technologies Used

### Frontend

- HTML5
- CSS3
- JavaScript

### Backend

- PHP

### Database

- MySQL

### Development Tools

- XAMPP
- phpMyAdmin
- Git
- GitHub

---

## 📂 Project Structure

```text
summer-25-26-beauty-salon-management-system/
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── config/
│   └── database.php
│
├── controllers/
│   ├── AuthController.php
│   ├── HomeController.php
│   └── ReceptionistController.php
│
├── helpers/
│   └── auth.php
│
├── models/
│   ├── Appointment.php
│   ├── Invoice.php
│   ├── Notice.php
│   └── User.php
│
├── views/
│   ├── dashboard/
│   ├── receptionist/
│   ├── partials/
│   ├── home.php
│   ├── login.php
│   └── signup.php
│
├── index.php
├── .gitignore
└── README.md
