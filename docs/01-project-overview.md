# Project Overview

## Portfolio CMS

Portfolio CMS is a full-stack Content Management System (CMS) designed to manage and present a professional software developer portfolio. The system enables administrators to create, organize, and maintain all portfolio content through a secure administration dashboard while providing visitors with a modern, responsive, multilingual public website.

Unlike a traditional static portfolio, the application separates content management from presentation, allowing every section of the portfolio to be updated without modifying the source code. The system has been designed with scalability, maintainability, and internationalization in mind, making it suitable for personal portfolios, freelancers, consultants, and professional developers who wish to showcase their experience and projects in multiple languages.

The application follows a multilingual architecture where language-independent data is stored separately from translated content. This approach minimizes data duplication, simplifies content management, and allows new languages to be added without changing the database structure.

---

## Objectives

The primary objectives of the project are to:

* Provide a professional portfolio website with a modern user experience.
* Allow administrators to manage portfolio content through an intuitive dashboard.
* Support multiple languages using a normalized translation architecture.
* Present projects, skills, education, certifications, and professional experience in a structured and organized manner.
* Offer visitors multiple communication channels through an integrated contact system.
* Collect visitor inquiries through a contact form with message management capabilities.
* Generate statistical insights such as unread messages, visitor trends, monthly CV downloads, and portfolio activity.
* Produce downloadable curriculum vitae (CV) documents.
* Serve as a real-world demonstration of modern full-stack web development practices.

---

## Main Features

The Portfolio CMS currently includes the following modules:

### Public Website

* Home page
* About section
* Professional experience
* Projects portfolio
* Education history
* Certifications
* Technical skills
* Hobbies and interests
* Testimonials
* Contact information
* Contact form
* CV download
* Light and dark themes
* Responsive design
* Seven-language support

### Administration Dashboard

* User authentication
* Content management
* Project management
* Experience management
* Education management
* Certification management
* Skills and skill category management
* Testimonial management
* Contact information management
* Social media management
* Contact message management
* Language management
* Dashboard statistics
* Visitor analytics
* Monthly message reports
* Monthly CV download reports
* Recent activity monitoring
* Missing content alerts

---

## System Architecture

The application follows a modern client-server architecture.

The backend is responsible for business logic, authentication, database management, file handling, localization, and API responses.

The frontend is responsible for rendering the user interface using Vue.js components and communicating with the backend through Inertia.js without requiring a traditional REST API.

---

## Technology Stack

### Backend

* Laravel 13
* PHP 8.x
* MySQL
* Eloquent ORM

### Frontend

* Vue 3
* Inertia.js
* Pinia
* PrimeVue
* Tailwind CSS
* Vite

### Additional Technologies

* Laravel Validation
* Laravel Queues
* Laravel Localization
* Ziggy
* PrimeVue Theme System
* Responsive Design
* Dark Mode
* JSON-based Localization

---

## Multilingual Architecture

The application supports seven languages:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian (RTL)
* Arabic (RTL)

Instead of duplicating complete records for each language, the system stores shared information separately from translated content. Every translatable entity is associated with a translation table linked to a centralized Languages table, resulting in a scalable and normalized localization strategy.

---

## Target Users

### Administrator

Responsible for:

* Managing all portfolio content
* Uploading images and documents
* Monitoring visitor interactions
* Responding to contact messages
* Maintaining multilingual content
* Viewing dashboard statistics

### Visitors

Visitors can:

* Browse portfolio information
* View projects and experience
* Download the CV
* Read testimonials
* Contact the portfolio owner
* Navigate the website in their preferred language

---

## Design Principles

The project was developed according to the following principles:

* Clean Architecture
* Separation of Concerns
* Database Normalization
* Reusability
* Scalability
* Maintainability
* Security
* Accessibility
* Responsive Design
* Internationalization
* User Experience

---

## Expected Outcome

The Portfolio CMS provides a complete solution for managing and presenting a professional portfolio while demonstrating modern software engineering practices, including normalized database design, multilingual content management, modular architecture, responsive frontend development, and maintainable backend implementation.
