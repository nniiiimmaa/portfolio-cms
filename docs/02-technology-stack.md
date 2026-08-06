# Technology Stack

The Portfolio CMS is built using a modern full-stack architecture that combines a Laravel backend with a Vue.js frontend. The selected technologies were chosen to provide maintainability, scalability, performance, and an excellent developer experience.

---

# Backend

| Technology             | Version  | Purpose                               |
| ---------------------- | -------- | ------------------------------------- |
| PHP                    | 8.x      | Server-side programming language      |
| Laravel                | 13       | Backend framework                     |
| Eloquent ORM           | Laravel  | Database abstraction and ORM          |
| MySQL                  | 8.x      | Relational database management system |
| Laravel Validation     | Built-in | Request validation                    |
| Laravel Queues         | Built-in | Background job processing             |
| Laravel Localization   | Built-in | Application localization              |
| Laravel Authentication | Built-in | User authentication and authorization |
| Laravel Migrations     | Built-in | Database version control              |
| Laravel Seeders        | Built-in | Initial data generation               |
| Laravel Factories      | Built-in | Testing and development data          |

---

# Frontend

| Technology      | Version | Purpose                                     |
| --------------- | ------- | ------------------------------------------- |
| Vue.js          | 3       | Frontend framework                          |
| Inertia.js      | Latest  | Connects Laravel and Vue without a REST API |
| Pinia           | Latest  | State management                            |
| PrimeVue        | Latest  | UI component library                        |
| PrimeUIX Themes | Latest  | Theme customization                         |
| Tailwind CSS    | Latest  | Utility-first CSS framework                 |
| Vite            | Latest  | Frontend build tool                         |
| Ziggy           | Latest  | Laravel route generation for Vue            |
| Vue I18n        | Latest  | Client-side localization                    |

---

# Styling & Design

| Technology        | Purpose                                   |
| ----------------- | ----------------------------------------- |
| Tailwind CSS      | Layout and utility styling                |
| PrimeVue          | UI components                             |
| CSS Variables     | Design tokens                             |
| Responsive Design | Mobile, tablet, and desktop compatibility |
| Dark Mode         | Theme switching                           |
| Light Mode        | Default visual theme                      |

---

# Localization

| Technology                  | Purpose                      |
| --------------------------- | ---------------------------- |
| Vue I18n                    | Frontend translations        |
| Laravel Localization        | Backend localization         |
| Database Translation Tables | Dynamic multilingual content |

### Supported Languages

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian (RTL)
* Arabic (RTL)

---

# Development Tools

| Tool               | Purpose                    |
| ------------------ | -------------------------- |
| Visual Studio Code | Source code editor         |
| Git                | Version control            |
| GitHub             | Source code repository     |
| Composer           | PHP dependency manager     |
| NPM                | JavaScript package manager |

---

# Database

| Technology          | Purpose                              |
| ------------------- | ------------------------------------ |
| MySQL               | Primary relational database          |
| Eloquent ORM        | Object-relational mapping            |
| Database Migrations | Schema management                    |
| Seeders             | Initial database population          |
| Factories           | Test and development data generation |

---

# File Storage

The application stores uploaded assets such as:

* Project logos
* Project screenshots
* Institution logos
* Certification images
* Testimonial photos
* Company logos
* User profile photos
* About section images

using Laravel's filesystem and the application's public storage structure.

---

# Architecture

The application follows a modern client-server architecture.

```text
Browser
      │
      ▼
Vue.js + Inertia.js
      │
      ▼
Laravel Application
      │
      ▼
MySQL Database
```

The frontend communicates directly with Laravel through Inertia.js, eliminating the need for a separate REST API while preserving a clear separation between presentation and business logic.

---

# Key Technologies Summary

| Category         | Technology                      |
| ---------------- | ------------------------------- |
| Backend          | Laravel 13                      |
| Language         | PHP 8.x                         |
| Frontend         | Vue 3                           |
| State Management | Pinia                           |
| UI Components    | PrimeVue                        |
| Styling          | Tailwind CSS                    |
| Build Tool       | Vite                            |
| ORM              | Eloquent                        |
| Database         | MySQL                           |
| Localization     | Vue I18n + Laravel Localization |
| Routing          | Ziggy                           |
| Version Control  | Git                             |
| Package Managers | Composer, NPM                   |
