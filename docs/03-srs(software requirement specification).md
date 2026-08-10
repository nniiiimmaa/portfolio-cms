# 1. Introduction

## 1.1 Purpose

The purpose of this Software Requirements Specification (SRS) is to define the functional and non-functional requirements of the **Portfolio CMS**, a full-stack web application developed to manage and present a professional software developer portfolio.

This document serves as the primary reference for the analysis, design, development, testing, deployment, and future maintenance of the system. It describes the system's expected behavior, architecture boundaries, user interactions, business rules, and quality requirements.

The intended audience includes:

* Software developers
* System architects
* UI/UX designers
* Quality assurance engineers
* Project maintainers
* Future contributors
* Recruiters and technical reviewers interested in understanding the project's architecture

This document provides a clear understanding of the system before implementation details are examined.

---

# 1.2 Scope

Portfolio CMS is a multilingual Content Management System designed to allow a portfolio owner to manage every aspect of a professional portfolio through an administrative dashboard while providing visitors with a modern, responsive, and interactive public website.

The system enables the administrator to create, update, organize, and publish portfolio content without modifying the application's source code.

The public website presents professional information including:

* About information
* Professional experience
* Projects
* Education
* Certifications
* Technical skills
* Testimonials
* Contact information
* Social media links

Visitors can browse the portfolio in multiple languages, download the curriculum vitae (CV), and communicate with the portfolio owner through an integrated contact form.

The administration dashboard provides tools for managing content, monitoring visitor activity, reviewing contact messages, and viewing operational statistics such as unread messages, monthly visitor counts, and CV download trends.

The application supports seven languages:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian
* Arabic

The project follows a normalized multilingual database architecture where shared data is separated from translated content to improve scalability and maintainability.

---

# 1.3 Definitions, Acronyms, and Abbreviations

| Term              | Definition                                                                      |
| ----------------- | ------------------------------------------------------------------------------- |
| CMS               | Content Management System                                                       |
| SRS               | Software Requirements Specification                                             |
| HLD               | High-Level Design                                                               |
| LLD               | Low-Level Design                                                                |
| ERD               | Entity Relationship Diagram                                                     |
| API               | Application Programming Interface                                               |
| UI                | User Interface                                                                  |
| UX                | User Experience                                                                 |
| KPI               | Key Performance Indicator                                                       |
| ORM               | Object Relational Mapping                                                       |
| CRUD              | Create, Read, Update, Delete                                                    |
| RTL               | Right-to-Left text direction                                                    |
| LTR               | Left-to-Right text direction                                                    |
| Authentication    | Process of verifying a user's identity                                          |
| Authorization     | Process of determining user permissions                                         |
| Dashboard         | Administrative control panel used to manage the system                          |
| Translation Table | Database table containing localized content for an entity                       |
| Singleton Entity  | An entity intended to have only one record in the system (e.g., About, Contact) |
| Visitor Analytics | Statistics related to visitors accessing the public portfolio                   |
| Portfolio Owner   | Administrator responsible for managing the portfolio                            |

---

# 1.4 References

The following technologies, standards, and documentation were used during the design and implementation of the project.

### Standards

* IEEE 29148 – Systems and Software Engineering – Life Cycle Processes – Requirements Engineering
* ISO 639 Language Codes
* Unicode Standard for multilingual text support

### Framework Documentation

* Laravel 13 Documentation
* Vue.js 3 Documentation
* Inertia.js Documentation
* Pinia Documentation
* PrimeVue Documentation
* Tailwind CSS Documentation
* Vite Documentation

### Database

* MySQL Documentation

### Version Control

* Git Documentation
* GitHub Documentation

---

# 1.5 Document Overview

This Software Requirements Specification is organized into the following chapters:

**Chapter 1 – Introduction**

Provides the purpose, scope, terminology, references, and overall organization of the document.

**Chapter 2 – Overall Description**

Introduces the overall system architecture, product perspective, operating environment, user classes, assumptions, and constraints.

**Chapter 3 – System Features**

Describes the functional requirements of every module within the application, including authentication, dashboard, portfolio management, multilingual content, visitor communication, and analytics.

**Chapter 4 – External Interface Requirements**

Defines the interaction between the system and users, software components, and external services.

**Chapter 5 – Non-Functional Requirements**

Specifies quality attributes including performance, security, reliability, maintainability, scalability, accessibility, usability, and localization.

**Chapter 6 – Database Requirements**

Describes the database architecture, entity relationships, normalization strategy, and multilingual data model.

**Chapter 7 – Business Rules**

Defines the operational rules governing system behavior, workflows, and administrative processes.

**Chapter 8 – Future Enhancements**

Lists planned improvements and potential extensions for future versions of the system.

**Appendices**

Contains supplementary information, diagrams, references, and supporting documentation.

# 2. Overall Description

## 2.1 Product Perspective

Portfolio CMS is a standalone web application developed to provide a complete solution for managing and presenting a professional software developer portfolio.

The system follows a client-server architecture where the backend is responsible for business logic, authentication, database management, localization, and content administration, while the frontend provides a responsive and interactive user interface.

Unlike a traditional static portfolio website, Portfolio CMS separates content from presentation. All portfolio information is managed through an administrative dashboard, allowing updates without modifying the application's source code.

The application consists of two primary subsystems:

### Public Website

The public website is accessible to all visitors and provides:

* About information
* Professional experience
* Projects
* Education
* Certifications
* Skills
* Testimonials
* Contact information
* Social media links
* Curriculum Vitae (CV) download
* Contact form
* Multilingual interface
* Responsive layout
* Dark and light themes

### Administration Dashboard

The administration dashboard is restricted to authenticated users and provides management of:

* Portfolio content
* Languages
* Contact information
* Social links
* Contact messages
* Dashboard statistics
* Visitor analytics
* CV download statistics
* Recent activity
* Content completeness monitoring

The application is designed to be modular so that new portfolio sections or administrative features can be introduced with minimal impact on the existing architecture.

---

# 2.2 Product Functions

The system provides the following high-level functions.

### Authentication

* Secure administrator login
* Session management
* Password hashing
* Remember-me functionality

### Content Management

The administrator can create, edit, delete, and organize:

* About information
* Professional experiences
* Projects
* Education records
* Certifications
* Skills
* Skill categories
* Testimonials
* Contact information
* Social media links

### Multilingual Management

The system supports multilingual content by allowing every translatable entity to maintain independent translations for each supported language.

Supported languages include:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian
* Arabic

### Project Showcase

Projects support:

* Categories
* Status
* Screenshots
* Technologies
* GitHub links
* Live demonstrations
* Featured projects

### Visitor Communication

Visitors can:

* Submit contact messages
* Download the curriculum vitae
* Browse multilingual content
* Access external social media profiles

### Administrative Monitoring

The dashboard provides:

* Portfolio statistics
* Contact message statistics
* Visitor statistics
* Monthly CV download statistics
* Recent administrative activity
* Missing content alerts

---

# 2.3 User Classes and Characteristics

The application currently supports two primary user classes.

## Administrator

The administrator is the owner and maintainer of the portfolio.

Responsibilities include:

* Managing all portfolio content
* Reviewing contact messages
* Updating translations
* Monitoring dashboard statistics
* Maintaining portfolio information

Characteristics:

* Authenticated user
* Full system permissions
* Familiar with web administration
* Technical knowledge of portfolio content

---

## Visitor

Visitors access the public website without authentication.

Visitors may:

* Browse portfolio content
* View projects
* Read testimonials
* Download the curriculum vitae
* Send contact messages
* Switch website language

Characteristics:

* Anonymous
* Read-only access
* No administrative privileges
* May access from desktop, tablet, or mobile devices

---

# 2.4 Operating Environment

## Server Environment

The application is designed to run on a standard PHP web server supporting:

* PHP 8.x
* Laravel 13
* Composer
* MySQL 8.x

Supported web servers include:

* Apache
* Nginx

---

## Client Environment

The public website and administration dashboard are accessible through modern web browsers including:

* Google Chrome
* Mozilla Firefox
* Microsoft Edge
* Safari

The interface is responsive and supports:

* Desktop computers
* Tablets
* Smartphones

---

## Development Environment

The project is developed using:

* Visual Studio Code
* Git
* GitHub
* Composer
* NPM
* Vite

---

# 2.5 Design and Implementation Constraints

The following constraints apply to the current version of the system.

## Technology Constraints

The backend shall be implemented using:

* Laravel 13
* PHP 8.x
* MySQL

The frontend shall be implemented using:

* Vue.js 3
* Inertia.js
* Pinia
* PrimeVue
* Tailwind CSS
* Vite

---

## Architectural Constraints

The system shall:

* Use a normalized relational database.
* Separate shared and translated content.
* Support multilingual content through translation tables.
* Use Inertia.js rather than a traditional REST API.
* Follow a modular architecture.
* Maintain responsive layouts for all supported devices.

---

## Security Constraints

The application shall:

* Store passwords using secure hashing algorithms.
* Restrict dashboard access to authenticated administrators.
* Validate all user input.
* Protect against common web vulnerabilities through Laravel's built-in security mechanisms.

---

## Localization Constraints

The application shall support:

* Left-to-right languages.
* Right-to-left languages.
* Database-driven multilingual content.
* Localized interface text.

---

# 2.6 User Documentation

The system documentation includes:

## Technical Documentation

* Software Requirements Specification (SRS)
* High-Level Design (HLD)
* Low-Level Design (LLD)
* Entity Relationship Diagram (ERD)
* Database Schema Documentation
* API Documentation
* UI/UX Flow Documentation

---

## Administrator Documentation

The administrator interface is designed to be intuitive and therefore requires minimal training.

Future versions may include:

* Administrator User Guide
* Installation Guide
* Deployment Guide
* Maintenance Guide

---

# 2.7 Assumptions and Dependencies

The following assumptions are made during the development and operation of the system.

## Assumptions

* The administrator has basic computer literacy.
* Visitors have internet access.
* Modern web browsers are used.
* Uploaded content complies with supported file formats.
* The server environment satisfies Laravel 13 requirements.

---

## Dependencies

The application depends on:

* PHP 8.x
* Laravel Framework
* Vue.js
* Inertia.js
* PrimeVue
* Tailwind CSS
* Pinia
* Vite
* MySQL Database
* Composer
* NPM

---

## Future Expansion

The architecture has been designed to support future enhancements, including:

* Multiple administrator accounts
* Role-based access control
* Blog management
* SEO management
* Media library
* Visitor geographic analytics
* Email notification system
* Additional dashboard reports
* Additional languages
* Public testimonial submission workflow

# 3.1 Authentication Module

## 3.1.1 Description

The Authentication Module is responsible for controlling secure access to the administration dashboard of the Portfolio CMS.

Only authenticated administrators are permitted to access protected resources such as the dashboard, portfolio management pages, and system configuration features.

The authentication mechanism ensures that unauthorized users cannot access or modify portfolio data.

This module uses Laravel's built-in authentication system and secure session management.

---

## 3.1.2 Functional Requirements

### FR-001 – Administrator Login

The system shall allow an administrator to authenticate using a registered email address and password.

---

### FR-002 – Credential Validation

The system shall validate the submitted credentials before granting access.

Invalid credentials shall prevent authentication.

---

### FR-003 – Secure Password Storage

Administrator passwords shall be stored using Laravel's secure password hashing mechanism.

Plain-text passwords shall never be stored in the database.

---

### FR-004 – Session Creation

After successful authentication, the system shall create a secure authenticated session.

---

### FR-005 – Dashboard Access

Only authenticated administrators shall be permitted to access administrative routes.

Unauthenticated users attempting to access protected pages shall be redirected to the login page.

---

### FR-006 – Logout

The system shall allow authenticated administrators to terminate their current session.

Upon logout, the session shall be invalidated and authentication tokens regenerated.

---

### FR-007 – Remember Me

The system shall support persistent login through Laravel's "Remember Me" functionality.

---

### FR-008 – Last Login Information

The system shall record the administrator's last successful login date, time, and IP address.

---

### FR-009 – Email Verification

The system shall support email verification before administrator accounts are considered verified.

---

### FR-010 – Password Reset

The system shall support secure password reset using Laravel's password reset token mechanism.

---

## 3.1.3 Business Rules

### BR-001

Only registered administrator accounts may authenticate.

---

### BR-002

Inactive administrator accounts shall not be permitted to log in.

---

### BR-003

Passwords shall never be recoverable and may only be reset.

---

### BR-004

Every successful login updates:

* Last login timestamp
* Last login IP address

---

### BR-005

An authenticated session shall be unique to a browser session unless "Remember Me" is enabled.

---

## 3.1.4 Validation Rules

| ID     | Validation Rule                                               |
| ------ | ------------------------------------------------------------- |
| VR-001 | Email is required.                                            |
| VR-002 | Email shall follow a valid email format.                      |
| VR-003 | Password is required.                                         |
| VR-004 | Password shall be compared using Laravel's hashing mechanism. |
| VR-005 | Authentication shall fail if the account is inactive.         |

---

## 3.1.5 Preconditions

Before authentication:

* The administrator account must exist.
* The account must be active.
* The administrator must provide valid credentials.
* The application server must be available.
* The database connection must be operational.

---

## 3.1.6 Postconditions

After a successful login:

* The administrator is authenticated.
* A secure session is created.
* Session identifiers are regenerated.
* The administrator is redirected to the dashboard.
* The last login timestamp is updated.
* The last login IP address is updated.

After logout:

* The authenticated session is destroyed.
* Session identifiers are invalidated.
* The administrator is redirected to the login page.

---

## 3.1.7 Security Requirements

The Authentication Module shall satisfy the following security requirements:

* Passwords shall be securely hashed.
* Authentication sessions shall use secure Laravel session management.
* Cross-Site Request Forgery (CSRF) protection shall be enabled.
* Authentication routes shall use HTTPS in production environments.
* Session fixation attacks shall be mitigated by regenerating session identifiers after login.
* Protected routes shall require authentication middleware.
* Password reset tokens shall expire according to Laravel's configured security policy.

---

## 3.1.8 Error Handling

The system shall handle authentication errors as follows:

| Error            | System Response                                                               |
| ---------------- | ----------------------------------------------------------------------------- |
| Invalid email    | Display validation error.                                                     |
| Invalid password | Display authentication error without revealing which credential is incorrect. |
| Inactive account | Deny login and display an authorization message.                              |
| Unverified email | Redirect user to email verification workflow (if enabled).                    |
| Session expired  | Redirect administrator to the login page.                                     |
| Server error     | Display a generic error message and log the exception.                        |

# 3.2 Dashboard Module

## 3.2.1 Description

The Dashboard Module serves as the central management interface of the Portfolio CMS. It provides administrators with an overview of the portfolio's current status, visitor engagement, communication activity, and system health.

Rather than requiring administrators to navigate through multiple pages, the dashboard presents the most important metrics and alerts in a single location, enabling quick decision-making and efficient portfolio management.

The dashboard is only accessible to authenticated administrators.

---

# 3.2.2 Key Performance Indicators (KPI Cards)

The dashboard shall display a set of KPI cards summarizing the current state of the portfolio.

The initial version of the system shall include the following KPI cards:

* Total Projects
* Total Skills
* Total Certifications
* Total Testimonials
* Total Contact Messages
* Unread Messages
* Monthly Visitors
* Monthly CV Downloads

Each KPI card shall display:

* Metric title
* Current value
* Associated icon
* Optional percentage change compared to the previous month (future enhancement)

---

# 3.2.3 Messages Chart

The dashboard shall display a chart illustrating the number of contact messages received over time.

The initial implementation shall provide:

* Monthly message count
* Current year visualization

Future versions may include:

* Daily statistics
* Weekly statistics
* Year-over-year comparison
* Message status distribution

---

# 3.2.4 Visitor Statistics

The dashboard shall display visitor analytics collected by the application.

The initial implementation shall include:

* Monthly visitors

Future versions may include:

* Daily visitors
* Weekly visitors
* Browser usage
* Operating systems
* Device types
* Geographic distribution
* Returning visitors
* Most visited pages

---

# 3.2.5 CV Download Statistics

The dashboard shall display statistics related to curriculum vitae downloads.

The initial implementation shall include:

* Monthly CV downloads

Future versions may include:

* Daily downloads
* Annual downloads
* Download trends
* Download conversion rate

---

# 3.2.6 Recent Activity

The dashboard shall display the latest administrative activities performed within the system.

Examples include:

* New project created
* Project updated
* Certification added
* Testimonial approved
* Contact information updated
* New message received
* Message marked as read
* Message archived

Recent activities shall be displayed in reverse chronological order.

---

# 3.2.7 Missing Content Alerts

The dashboard shall notify the administrator when important portfolio content is missing or incomplete.

Examples include:

* About section not configured
* Contact information missing
* No featured project
* No testimonials available
* Missing translations
* Missing project screenshots
* Missing social links
* Missing certifications
* Missing skills

Each alert shall include:

* Alert title
* Brief description
* Severity level
* Link to the corresponding management page

---

# 3.2.8 Functional Requirements

### FR-011 – Dashboard Access

The system shall display the dashboard immediately after successful administrator authentication.

---

### FR-012 – KPI Cards

The system shall display portfolio statistics using KPI cards.

---

### FR-013 – Contact Message Statistics

The dashboard shall display the total number of received contact messages.

---

### FR-014 – Unread Messages

The dashboard shall display the number of unread contact messages.

---

### FR-015 – Messages Chart

The dashboard shall display a monthly contact message chart.

---

### FR-016 – Visitor Statistics

The dashboard shall display monthly visitor statistics.

---

### FR-017 – CV Download Statistics

The dashboard shall display monthly CV download statistics.

---

### FR-018 – Recent Activity

The dashboard shall display the latest administrative activities.

---

### FR-019 – Missing Content Alerts

The dashboard shall display alerts when required portfolio content is missing or incomplete.

---

### FR-020 – Real-Time Data

Dashboard information shall always reflect the latest data stored in the database.

---

# 3.2.9 Business Rules

### BR-006

Only authenticated administrators may access the dashboard.

---

### BR-007

Dashboard statistics shall be calculated directly from the database.

---

### BR-008

Unread messages are defined as messages whose status is **"new"**.

---

### BR-009

Recent activities shall be ordered from newest to oldest.

---

### BR-010

Missing content alerts shall only be displayed when the corresponding data is absent or incomplete.

---

# 3.2.10 Validation Rules

| ID     | Validation Rule                                                     |
| ------ | ------------------------------------------------------------------- |
| VR-006 | Dashboard access requires authentication.                           |
| VR-007 | Charts shall ignore deleted records.                                |
| VR-008 | KPI values shall be non-negative integers.                          |
| VR-009 | Visitor statistics shall only include successfully recorded visits. |
| VR-010 | CV download statistics shall only count successful download events. |

---

# 3.2.11 Preconditions

Before displaying the dashboard:

* The administrator must be authenticated.
* Database services must be available.
* Statistical data must be accessible.
* Required dashboard services must be operational.

---

# 3.2.12 Postconditions

After loading the dashboard:

* KPI cards are displayed.
* Charts are populated.
* Recent activities are listed.
* Missing content alerts are evaluated.
* Dashboard statistics accurately represent the current system state.

---

# 3.2.13 Error Handling

The dashboard shall gracefully handle data retrieval failures.

| Error                          | System Response                                               |
| ------------------------------ | ------------------------------------------------------------- |
| Database unavailable           | Display an error notification and log the exception.          |
| Statistics unavailable         | Display empty charts with an informative message.             |
| Visitor statistics unavailable | Display zero values instead of causing dashboard failure.     |
| Activity retrieval failure     | Display an empty activity list.                               |
| Unexpected server error        | Display a generic system error message and log the exception. |

# 3.3 About Module

## 3.3.1 Description

The About Module is responsible for presenting the portfolio owner's personal and professional introduction on the public website.

Unlike most other modules, the About Module is designed as a **singleton entity**, meaning that only one About record exists within the system. This allows the administrator to maintain a single profile while providing localized content for every supported language.

The module combines language-independent information, such as the profile image and availability status, with language-specific content including the name, professional title, biography, and availability message.

The About section serves as the primary introduction to the portfolio and is typically the first content viewed by visitors.

---

# 3.3.2 Functional Requirements

### FR-021 – Create About Information

The system shall allow the administrator to create the portfolio owner's About information.

---

### FR-022 – Update About Information

The administrator shall be able to modify the existing About information.

---

### FR-023 – Upload Profile Image

The administrator shall be able to upload or replace the profile image.

---

### FR-024 – Manage Availability

The administrator shall be able to enable or disable public availability.

---

### FR-025 – Manage Translations

The administrator shall be able to manage translated About information for each supported language.

---

### FR-026 – Display Public About Section

The public website shall display the About section using the visitor's selected language.

---

### FR-027 – Fallback Behavior

If a translation is unavailable for the selected language, the system shall display the default language translation.

---

# 3.3.3 Business Rules

### BR-011

Only one About record shall exist within the system.

---

### BR-012

The profile image shall be shared across all languages.

---

### BR-013

The availability status shall be shared across all languages.

---

### BR-014

The following fields shall be translated:

* Name
* Professional title
* Description
* Availability text

---

### BR-015

The About section shall only be displayed on the public website when it is marked as available.

---

# 3.3.4 Translation Rules

The About Module follows the application's multilingual architecture.

Language-independent information is stored in the `abouts` table.

Translated content is stored in the `about_translations` table.

Each translation is uniquely identified by:

* About record
* Language

The system currently supports:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian
* Arabic

---

# 3.3.5 Validation Rules

| ID     | Validation Rule                                                   |
| ------ | ----------------------------------------------------------------- |
| VR-011 | Name is required.                                                 |
| VR-012 | Professional title is required.                                   |
| VR-013 | Description is required.                                          |
| VR-014 | Only one About record may exist.                                  |
| VR-015 | Each language may have only one translation for the About record. |
| VR-016 | Uploaded image shall be a valid image format.                     |

---

# 3.3.6 Preconditions

Before managing the About section:

* The administrator must be authenticated.
* At least one language must exist.
* The database must be available.

---

# 3.3.7 Postconditions

After saving the About information:

* The About record is updated.
* Translations are stored.
* The public website reflects the latest content.
* Visitors view the localized About section according to the selected language.

---

# 3.3.8 Error Handling

| Error                   | System Response                                        |
| ----------------------- | ------------------------------------------------------ |
| Missing required fields | Display validation errors.                             |
| Duplicate About record  | Reject creation request.                               |
| Duplicate translation   | Reject duplicate translation for the same language.    |
| Invalid image           | Display upload validation error.                       |
| Database failure        | Display a generic error message and log the exception. |

---

# 3.3.9 Data Model

### About

Stores language-independent information:

* Availability
* Profile image

### About Translation

Stores language-specific information:

* Name
* Professional title
* Biography
* Availability message

Relationship:

```text
About
    │
    ├───────────────┐
    │               │
About Translation (English)
About Translation (Portuguese)
About Translation (Spanish)
About Translation (German)
About Translation (Turkish)
About Translation (Persian)
About Translation (Arabic)
```

This design minimizes data duplication while allowing complete localization of public content.

# 3.4 Experience Module

## 3.4.1 Description

The Experience Module manages the portfolio owner's professional work experience and displays it on the public website as a chronological timeline.

Each experience entry represents a professional position held by the portfolio owner and includes information such as the company, employment period, technologies used, company logo, and localized descriptions.

The module separates language-independent information from translated content, allowing the administrator to maintain a single experience record while providing descriptions in multiple languages.

Experiences are manually ordered by the administrator, enabling complete control over their presentation regardless of the employment dates.

---

# 3.4.2 Functional Requirements

### FR-028 – Create Experience

The system shall allow the administrator to create a new professional experience.

---

### FR-029 – Update Experience

The administrator shall be able to modify an existing experience.

---

### FR-030 – Delete Experience

The administrator shall be able to permanently remove an experience.

---

### FR-031 – Upload Company Logo

The administrator shall be able to upload or replace a company logo.

---

### FR-032 – Manage Technologies

The administrator shall be able to associate one or more technologies with an experience.

---

### FR-033 – Manage Employment Period

The administrator shall specify:

* Start date
* End date (optional)
* Current employment status

---

### FR-034 – Manage Experience Order

The administrator shall determine the display order of experiences.

---

### FR-035 – Manage Translations

The administrator shall create and update translated information for every supported language.

---

### FR-036 – Display Experiences

The public website shall display experiences in the administrator-defined order.

---

### FR-037 – Display Current Employment

If an experience is marked as current, the public website shall indicate that the position is ongoing.

---

# 3.4.3 Business Rules

### BR-016

Each experience shall represent a single employment period.

---

### BR-017

When **Current** is enabled:

* End date may be empty.
* The public website shall indicate that the employment is ongoing.

---

### BR-018

If **Current** is disabled:

* End date should be provided.

---

### BR-019

Experiences shall be displayed according to the **Order** field rather than the employment dates.

---

### BR-020

Company logos are shared across all languages.

---

### BR-021

The technologies list is shared across all languages.

---

### BR-022

The following fields shall be translated:

* Position
* Description

---

# 3.4.4 Translation Rules

The Experience Module follows the multilingual architecture adopted throughout the system.

Language-independent information is stored in the `experiences` table.

Translated information is stored in the `experience_translations` table.

Each translation is uniquely identified by:

* Experience
* Language

Supported languages include:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian
* Arabic

---

# 3.4.5 Ordering Rules

Experiences are manually ordered by the administrator.

The system shall sort experiences using the **Order** field in ascending order.

This approach ensures consistent presentation regardless of employment dates and allows the administrator to highlight the most relevant experiences.

---

# 3.4.6 Validation Rules

| ID     | Validation Rule                                                   |
| ------ | ----------------------------------------------------------------- |
| VR-017 | Company name is required.                                         |
| VR-018 | Start date is required.                                           |
| VR-019 | Start date shall not be later than the end date.                  |
| VR-020 | Position is required for every translation.                       |
| VR-021 | Description is required for every translation.                    |
| VR-022 | Company logo shall be a valid image when provided.                |
| VR-023 | Each language may contain only one translation for an experience. |

---

# 3.4.7 Preconditions

Before managing experiences:

* The administrator must be authenticated.
* At least one language must exist.
* Database services must be available.

---

# 3.4.8 Postconditions

After saving an experience:

* Experience information is stored.
* Technologies are associated.
* Company logo is updated (if provided).
* Translations are saved.
* The public portfolio immediately reflects the updated information.

---

# 3.4.9 Error Handling

| Error                    | System Response                                        |
| ------------------------ | ------------------------------------------------------ |
| Missing required fields  | Display validation errors.                             |
| Invalid employment dates | Reject the operation.                                  |
| Duplicate translation    | Reject duplicate translation for the same language.    |
| Invalid logo format      | Display upload validation error.                       |
| Database failure         | Display a generic error message and log the exception. |

---

# 3.4.10 Data Model

### Experience

Stores language-independent information:

* Company
* Company logo
* Location
* Start date
* End date
* Current employment status
* Technologies
* Display order

### Experience Translation

Stores language-specific information:

* Position
* Description

Relationship:

```text id="vrrvwg"
Experience
      │
      ├───────────────┐
      │               │
Experience Translation (English)
Experience Translation (Portuguese)
Experience Translation (Spanish)
Experience Translation (German)
Experience Translation (Turkish)
Experience Translation (Persian)
Experience Translation (Arabic)
```

This normalized structure eliminates duplicated data while allowing each experience to be fully localized across all supported languages.

# 3.5 Projects Module

## 3.5.1 Description

The Projects Module is responsible for managing and presenting the portfolio owner's software projects. It is one of the core components of the Portfolio CMS and demonstrates the administrator's technical skills, professional experience, and completed work.

Each project consists of language-independent information (such as project type, status, links, images, and technologies) and language-specific information (such as title and description).

The module supports multiple screenshots for each project, allowing visitors to visually explore the application's functionality.

Projects may be categorized, marked as featured, assigned a development status, and displayed in a manually defined order.

---

# 3.5.2 Functional Requirements

### FR-038 – Create Project

The system shall allow the administrator to create a new project.

---

### FR-039 – Update Project

The administrator shall be able to modify an existing project.

---

### FR-040 – Delete Project

The administrator shall be able to permanently remove a project and its associated screenshots.

---

### FR-041 – Upload Project Logo

The administrator shall be able to upload or replace the project's logo.

---

### FR-042 – Manage Project Images

The administrator shall be able to:

* Upload multiple screenshots
* Delete screenshots
* Change screenshot order

---

### FR-043 – Assign Project Type

Each project may be assigned to a project type.

Examples include:

* Personal Project
* Commercial Project
* Open Source Project
* Academic Project

---

### FR-044 – Assign Project Status

Each project may be assigned a development status.

Examples include:

* Completed
* In Progress
* Archived

---

### FR-045 – Manage Technologies

The administrator shall associate one or more technologies with each project.

---

### FR-046 – Configure External Links

The administrator may configure:

* GitHub repository
* Live demonstration URL

---

### FR-047 – Featured Projects

The administrator shall be able to mark a project as featured.

Featured projects may receive visual emphasis on the public website.

---

### FR-048 – Project Ordering

The administrator shall determine the display order of projects.

---

### FR-049 – Manage Translations

The administrator shall create and update translated titles and descriptions for every supported language.

---

### FR-050 – Display Projects

The public website shall display projects using the visitor's selected language.

---

# 3.5.3 Business Rules

### BR-023

Each project shall have a unique slug.

---

### BR-024

Project logos shall be shared across all languages.

---

### BR-025

Project screenshots shall be shared across all languages.

---

### BR-026

Project technologies shall be shared across all languages.

---

### BR-027

Project type and status shall be shared across all languages.

---

### BR-028

Projects shall be displayed according to the administrator-defined display order.

---

### BR-029

Featured projects shall receive higher visual priority on the public website.

---

### BR-030

The following fields shall be translated:

* Project title
* Project description

---

# 3.5.4 Project Types

The system shall support configurable project types.

Each type consists of:

* Identifier
* Slug
* Color
* Localized name

Examples:

* Personal
* Commercial
* Academic
* Open Source

Project types shall be reusable across multiple projects.

---

# 3.5.5 Project Status

The system shall support configurable project statuses.

Each status consists of:

* Identifier
* Slug
* Color
* Localized name

Examples:

* Completed
* In Progress
* Maintenance
* Archived

Statuses shall visually communicate the project's current state.

---

# 3.5.6 Project Images

Each project may contain multiple screenshots.

Every screenshot shall include:

* Image path
* Image type
* Display order

Screenshots shall be displayed as an image gallery on the public portfolio.

---

# 3.5.7 Translation Rules

The Projects Module follows the multilingual database architecture.

Language-independent information is stored in:

* Projects
* Project Types
* Project Statuses
* Project Images

Translated information is stored in:

* Project Translations
* Project Type Translations
* Project Status Translations

Each translation is uniquely identified by:

* Entity
* Language

Supported languages include:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian
* Arabic

---

# 3.5.8 Validation Rules

| ID     | Validation Rule                                             |
| ------ | ----------------------------------------------------------- |
| VR-024 | Project slug shall be unique.                               |
| VR-025 | Project title is required.                                  |
| VR-026 | Project description is required.                            |
| VR-027 | Project type shall exist if specified.                      |
| VR-028 | Project status shall exist if specified.                    |
| VR-029 | GitHub URL shall be valid when provided.                    |
| VR-030 | Live URL shall be valid when provided.                      |
| VR-031 | Screenshots shall be valid image files.                     |
| VR-032 | Each language may contain only one translation per project. |

---

# 3.5.9 Preconditions

Before managing projects:

* Administrator must be authenticated.
* Required project types should exist.
* Required project statuses should exist.
* At least one language must exist.
* Database services must be available.

---

# 3.5.10 Postconditions

After saving a project:

* Project information is stored.
* Technologies are associated.
* Screenshots are stored.
* Translations are updated.
* Public project listings immediately reflect the latest data.

---

# 3.5.11 Error Handling

| Error                   | System Response                                        |
| ----------------------- | ------------------------------------------------------ |
| Duplicate slug          | Reject the operation and display validation error.     |
| Missing required fields | Display validation errors.                             |
| Invalid URL             | Reject invalid external links.                         |
| Invalid image           | Reject upload and display validation error.            |
| Missing translation     | Display fallback language on the public website.       |
| Database failure        | Display a generic error message and log the exception. |

---

# 3.5.12 Data Model

The Projects Module consists of the following entities:

### Project

Stores language-independent information:

* Project type
* Project status
* Slug
* Logo
* GitHub URL
* Live URL
* Featured status
* Display order
* Technologies

---

### Project Translation

Stores:

* Title
* Description

---

### Project Type

Stores reusable project categories.

---

### Project Type Translation

Stores localized project type names.

---

### Project Status

Stores reusable project status definitions.

---

### Project Status Translation

Stores localized status names.

---

### Project Image

Stores:

* Screenshot path
* Image type
* Display order

Relationship:

```text
Project
│
├── Project Translation (7 languages)
│
├── Project Images (1..N)
│
├── Project Type
│      └── Project Type Translation (7 languages)
│
└── Project Status
       └── Project Status Translation (7 languages)
```

This architecture minimizes duplicated data while allowing projects, project types, and project statuses to be fully localized independently.

# 3.6 Education Module

## 3.6.1 Description

The Education Module manages the portfolio owner's academic background and educational achievements.

Each education record represents a degree, diploma, course, or academic program completed (or currently being pursued) by the portfolio owner.

The module combines language-independent information, such as study dates, academic score, institution logo, and verification links, with language-specific information including institution name, degree, field of study, location, and description.

Education records are manually ordered by the administrator, allowing the most relevant qualifications to appear first regardless of chronology.

---

# 3.6.2 Functional Requirements

### FR-051 – Create Education Record

The system shall allow the administrator to create a new education record.

---

### FR-052 – Update Education Record

The administrator shall be able to modify an existing education record.

---

### FR-053 – Delete Education Record

The administrator shall be able to permanently remove an education record.

---

### FR-054 – Upload Institution Logo

The administrator shall be able to upload or replace the institution logo.

---

### FR-055 – Manage Study Period

The administrator shall specify:

* Start date
* End date
* Current study status

---

### FR-056 – Record Academic Score

The administrator may specify the academic score or GPA when applicable.

---

### FR-057 – Verification Information

The administrator may provide:

* Verification ID
* Verification URL

to allow visitors to verify academic credentials.

---

### FR-058 – Manage Display Order

The administrator shall define the display order of education records.

---

### FR-059 – Manage Translations

The administrator shall create and update translated education information for every supported language.

---

### FR-060 – Display Education

The public website shall display education records using the visitor's selected language.

---

# 3.6.3 Business Rules

### BR-031

Each education record represents a single academic qualification.

---

### BR-032

Institution logos shall be shared across all languages.

---

### BR-033

Verification information shall be shared across all languages.

---

### BR-034

Academic scores are optional.

---

### BR-035

If **Current** is enabled:

* End date may be empty.
* The public website shall indicate that the education is ongoing.

---

### BR-036

Education records shall be displayed according to the administrator-defined display order.

---

### BR-037

The following fields shall be translated:

* Institution
* Degree
* Field of study
* Location
* Description

---

# 3.6.4 Translation Rules

The Education Module follows the application's multilingual architecture.

Language-independent information is stored in the `education` table.

Translated information is stored in the `education_translations` table.

Each translation is uniquely identified by:

* Education record
* Language

Supported languages include:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian
* Arabic

---

# 3.6.5 Validation Rules

| ID     | Validation Rule                                                      |
| ------ | -------------------------------------------------------------------- |
| VR-033 | Start date is required.                                              |
| VR-034 | Start date shall not be later than the end date.                     |
| VR-035 | Institution name is required.                                        |
| VR-036 | Degree is required.                                                  |
| VR-037 | Institution logo shall be a valid image when provided.               |
| VR-038 | Verification URL shall be valid when provided.                       |
| VR-039 | Academic score shall be numeric when provided.                       |
| VR-040 | Each language may contain only one translation per education record. |

---

# 3.6.6 Preconditions

Before managing education records:

* The administrator must be authenticated.
* At least one language must exist.
* Database services must be available.

---

# 3.6.7 Postconditions

After saving an education record:

* Education information is stored.
* Institution logo is updated.
* Verification information is stored.
* Translations are updated.
* The public portfolio immediately reflects the latest information.

---

# 3.6.8 Error Handling

| Error                    | System Response                                        |
| ------------------------ | ------------------------------------------------------ |
| Missing required fields  | Display validation errors.                             |
| Invalid study dates      | Reject the operation.                                  |
| Invalid verification URL | Display validation error.                              |
| Invalid institution logo | Reject upload and display validation error.            |
| Duplicate translation    | Reject duplicate translation for the same language.    |
| Database failure         | Display a generic error message and log the exception. |

---

# 3.6.9 Data Model

### Education

Stores language-independent information:

* Start date
* End date
* Current status
* Academic score
* Institution logo
* Verification ID
* Verification URL
* Display order

---

### Education Translation

Stores language-specific information:

* Institution
* Degree
* Field of study
* Location
* Description

Relationship:

```text
Education
      │
      ├───────────────┐
      │               │
Education Translation (English)
Education Translation (Portuguese)
Education Translation (Spanish)
Education Translation (German)
Education Translation (Turkish)
Education Translation (Persian)
Education Translation (Arabic)
```

This normalized structure avoids data duplication while allowing each education record to be fully localized for all supported languages.

# 3.7 Skills Module

## 3.7.1 Description

The Skills Module is responsible for managing and presenting the portfolio owner's technical and professional competencies.

Skills are organized into reusable categories (e.g., Programming Languages, Front-End, Back-End, Databases, Tools, Cloud Services) to provide visitors with a structured overview of the portfolio owner's expertise.

Each skill contains language-independent information, such as proficiency level, years of experience, icon, featured status, and display order, while localized information such as the skill name and description is stored separately.

The module also supports highlighting selected skills to emphasize the portfolio owner's strongest competencies.

---

# 3.7.2 Functional Requirements

### FR-061 – Create Skill Category

The system shall allow the administrator to create a new skill category.

---

### FR-062 – Update Skill Category

The administrator shall be able to modify an existing skill category.

---

### FR-063 – Delete Skill Category

The administrator shall be able to delete a skill category.

Deleting a category shall also remove its associated skills.

---

### FR-064 – Create Skill

The administrator shall be able to create a new skill.

---

### FR-065 – Update Skill

The administrator shall be able to modify an existing skill.

---

### FR-066 – Delete Skill

The administrator shall be able to permanently remove a skill.

---

### FR-067 – Assign Category

Each skill shall belong to exactly one skill category.

---

### FR-068 – Configure Skill Level

The administrator may specify a proficiency level for each skill.

---

### FR-069 – Configure Years of Experience

The administrator may specify the number of years of experience associated with a skill.

---

### FR-070 – Featured Skills

The administrator shall be able to mark selected skills as featured.

Featured skills may receive visual emphasis on the public website.

---

### FR-071 – Skill Ordering

The administrator shall determine the display order of both skill categories and individual skills.

---

### FR-072 – Manage Translations

The administrator shall create and update translated names and descriptions for every supported language.

---

### FR-073 – Display Skills

The public website shall display skills using the visitor's selected language.

---

# 3.7.3 Business Rules

### BR-038

Each skill shall belong to exactly one category.

---

### BR-039

Skill icons shall be shared across all languages.

---

### BR-040

Skill proficiency levels shall be shared across all languages.

---

### BR-041

Years of experience shall be shared across all languages.

---

### BR-042

Skill categories shall be displayed according to their display order.

---

### BR-043

Skills within each category shall be displayed according to their display order.

---

### BR-044

Featured skills shall receive greater visual emphasis on the public portfolio.

---

### BR-045

The following fields shall be translated:

For Skill Categories:

* Category name

For Skills:

* Skill name
* Skill description

---

# 3.7.4 Skill Categories

Skill categories are reusable organizational groups that improve the readability of the portfolio.

Each category includes:

* Slug
* Icon
* Display order
* Localized name

Example categories include:

* Programming Languages
* Front-End Development
* Back-End Development
* Databases
* DevOps
* Tools
* Cloud Platforms
* UI/UX
* Version Control

---

# 3.7.5 Skill Levels

The system supports optional proficiency levels.

The current implementation stores a numeric level ranging from **0 to 100**.

This value may be presented visually as:

* Progress bars
* Circular indicators
* Percentage labels

The administrator is responsible for determining the assigned proficiency level.

---

# 3.7.6 Featured Skills

Featured skills allow important technologies to receive additional emphasis.

Examples include:

* Laravel
* Vue.js
* PHP
* MySQL
* JavaScript

The public website may display featured skills separately or with enhanced styling.

---

# 3.7.7 Translation Rules

The Skills Module follows the application's multilingual architecture.

Language-independent information is stored in:

* Skill Categories
* Skills

Translated information is stored in:

* Skill Category Translations
* Skill Translations

Each translation is uniquely identified by:

* Entity
* Language

Supported languages include:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian
* Arabic

---

# 3.7.8 Validation Rules

| ID     | Validation Rule                                                    |
| ------ | ------------------------------------------------------------------ |
| VR-041 | Skill category slug shall be unique.                               |
| VR-042 | Skill slug shall be unique.                                        |
| VR-043 | Every skill shall belong to a category.                            |
| VR-044 | Skill name is required.                                            |
| VR-045 | Category name is required.                                         |
| VR-046 | Skill level shall be between 0 and 100 when provided.              |
| VR-047 | Years of experience shall be a positive integer when provided.     |
| VR-048 | Each language may contain only one translation per skill.          |
| VR-049 | Each language may contain only one translation per skill category. |

---

# 3.7.9 Preconditions

Before managing skills:

* The administrator must be authenticated.
* At least one language must exist.
* At least one skill category should exist before creating skills.
* Database services must be available.

---

# 3.7.10 Postconditions

After saving a skill:

* Skill information is stored.
* Skill category relationships are updated.
* Translations are updated.
* Public skill listings immediately reflect the latest information.

---

# 3.7.11 Error Handling

| Error                       | System Response                                        |
| --------------------------- | ------------------------------------------------------ |
| Duplicate slug              | Reject the operation.                                  |
| Missing category            | Reject skill creation.                                 |
| Invalid proficiency level   | Display validation error.                              |
| Invalid years of experience | Display validation error.                              |
| Duplicate translation       | Reject duplicate translation for the same language.    |
| Database failure            | Display a generic error message and log the exception. |

---

# 3.7.12 Data Model

The Skills Module consists of four entities.

### Skill Category

Stores:

* Slug
* Icon
* Display order

---

### Skill Category Translation

Stores:

* Category name

---

### Skill

Stores:

* Category
* Slug
* Icon
* Proficiency level
* Years of experience
* Featured status
* Display order

---

### Skill Translation

Stores:

* Skill name
* Description

Relationship:

```text
Skill Category
│
├── Skill Category Translation (7 languages)
│
└── Skills (1..N)
        │
        └── Skill Translation (7 languages)
```

This architecture allows reusable skill categories while maintaining complete multilingual support and eliminating duplicated data.

# 3.8 Certifications Module

## 3.8.1 Description

The Certifications Module manages the portfolio owner's professional certifications, licenses, training programs, and industry credentials.

Each certification represents an officially recognized qualification issued by an educational institution, professional organization, or certification authority.

The module combines language-independent information, such as issue dates, expiration dates, credential identifiers, verification links, certificate images, and display order, with language-specific information including the certification title, issuing organization, issuing country, and description.

The Certifications Module enables visitors to verify credentials through external verification services when available, increasing the credibility of the portfolio.

---

# 3.8.2 Functional Requirements

### FR-074 – Create Certification

The system shall allow the administrator to create a new certification.

---

### FR-075 – Update Certification

The administrator shall be able to modify an existing certification.

---

### FR-076 – Delete Certification

The administrator shall be able to permanently remove a certification.

---

### FR-077 – Upload Certificate Image

The administrator shall be able to upload or replace the certificate image.

---

### FR-078 – Manage Certification Dates

The administrator shall specify:

* Issue date
* Expiration date (optional)

---

### FR-079 – Configure Verification Information

The administrator may provide:

* Credential ID
* Credential verification URL

to allow visitors to verify the certification.

---

### FR-080 – Manage Display Order

The administrator shall define the order in which certifications appear on the public website.

---

### FR-081 – Manage Translations

The administrator shall create and update translated certification information for every supported language.

---

### FR-082 – Display Certifications

The public website shall display certifications using the visitor's selected language.

---

# 3.8.3 Business Rules

### BR-046

Each certification represents one professional credential.

---

### BR-047

Certificate images shall be shared across all languages.

---

### BR-048

Credential IDs shall be shared across all languages.

---

### BR-049

Verification URLs shall be shared across all languages.

---

### BR-050

Expiration dates are optional.

A null expiration date indicates that the certification does not expire.

---

### BR-051

Certifications shall be displayed according to the administrator-defined display order.

---

### BR-052

The following fields shall be translated:

* Certification title
* Issuer name
* Issuer country
* Description

---

# 3.8.4 Credential Verification

The module supports external credential verification.

When available, the administrator may store:

* Credential Identifier
* Verification URL

The public website may display a **Verify Credential** button that redirects visitors to the issuing organization's verification page.

If verification information is unavailable, the button shall not be displayed.

---

# 3.8.5 Certification Expiration

Certifications may optionally include an expiration date.

Possible states include:

* Permanent certification
* Time-limited certification
* Renewable certification

If an expiration date exists, future versions of the system may notify the administrator before expiration.

---

# 3.8.6 Translation Rules

The Certifications Module follows the application's multilingual architecture.

Language-independent information is stored in the `certifications` table.

Translated information is stored in the `certification_translations` table.

Each translation is uniquely identified by:

* Certification
* Language

Supported languages include:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian
* Arabic

---

# 3.8.7 Validation Rules

| ID     | Validation Rule                                                   |
| ------ | ----------------------------------------------------------------- |
| VR-050 | Issue date is required.                                           |
| VR-051 | Issue date shall not be later than the expiration date.           |
| VR-052 | Certification title is required.                                  |
| VR-053 | Issuer name is required.                                          |
| VR-054 | Verification URL shall be valid when provided.                    |
| VR-055 | Certificate image shall be a valid image when provided.           |
| VR-056 | Each language may contain only one translation per certification. |

---

# 3.8.8 Preconditions

Before managing certifications:

* The administrator must be authenticated.
* At least one language must exist.
* Database services must be available.

---

# 3.8.9 Postconditions

After saving a certification:

* Certification information is stored.
* Verification information is updated.
* Certificate image is updated.
* Translations are stored.
* The public portfolio immediately reflects the latest information.

---

# 3.8.10 Error Handling

| Error                     | System Response                                        |
| ------------------------- | ------------------------------------------------------ |
| Missing required fields   | Display validation errors.                             |
| Invalid dates             | Reject the operation.                                  |
| Invalid verification URL  | Display validation error.                              |
| Invalid certificate image | Reject upload and display validation error.            |
| Duplicate translation     | Reject duplicate translation for the same language.    |
| Database failure          | Display a generic error message and log the exception. |

---

# 3.8.11 Data Model

### Certification

Stores language-independent information:

* Issue date
* Expiration date
* Credential ID
* Verification URL
* Certificate image
* Display order

---

### Certification Translation

Stores language-specific information:

* Certification title
* Issuing organization
* Issuer country
* Description

Relationship:

```text
Certification
      │
      ├───────────────┐
      │               │
Certification Translation (English)
Certification Translation (Portuguese)
Certification Translation (Spanish)
Certification Translation (German)
Certification Translation (Turkish)
Certification Translation (Persian)
Certification Translation (Arabic)
```

This normalized architecture ensures that verification data and credential metadata are stored only once while allowing certification content to be fully localized across all supported languages.

# 3.9 Testimonials Module

## 3.9.1 Description

The Testimonials Module manages recommendations and feedback provided by clients, colleagues, employers, professors, or collaborators.

Testimonials provide social proof of the portfolio owner's professional capabilities and help increase visitor confidence.

Each testimonial contains language-independent information, such as the reviewer's photograph, company logo, rating, approval status, featured status, and display order, while localized information includes the reviewer's name, position, company, and testimonial message.

To ensure content quality and authenticity, testimonials must be approved by the administrator before becoming publicly visible.

---

# 3.9.2 Functional Requirements

### FR-083 – Create Testimonial

The system shall allow the administrator to create a new testimonial.

---

### FR-084 – Update Testimonial

The administrator shall be able to modify an existing testimonial.

---

### FR-085 – Delete Testimonial

The administrator shall be able to permanently remove a testimonial.

---

### FR-086 – Upload Reviewer Photograph

The administrator shall be able to upload or replace the reviewer's photograph.

---

### FR-087 – Upload Company Logo

The administrator shall be able to upload or replace the company logo associated with the testimonial.

---

### FR-088 – Manage Rating

The administrator may assign a rating to each testimonial.

---

### FR-089 – Approve Testimonials

The administrator shall be able to approve or reject testimonials.

Only approved testimonials shall be visible on the public website.

---

### FR-090 – Featured Testimonials

The administrator shall be able to mark testimonials as featured.

Featured testimonials may receive greater visual emphasis on the public website.

---

### FR-091 – Manage Display Order

The administrator shall define the order in which testimonials appear.

---

### FR-092 – Manage Translations

The administrator shall create and update translated testimonial information for every supported language.

---

### FR-093 – Display Testimonials

The public website shall display approved testimonials using the visitor's selected language.

---

# 3.9.3 Business Rules

### BR-053

Testimonials are not publicly visible until approved.

---

### BR-054

Reviewer photographs are shared across all languages.

---

### BR-055

Company logos are shared across all languages.

---

### BR-056

Ratings are shared across all languages.

---

### BR-057

Testimonials shall be displayed according to the administrator-defined display order.

---

### BR-058

Featured testimonials shall receive higher visual priority.

---

### BR-059

The following fields shall be translated:

* Reviewer's name
* Position
* Company
* Testimonial message

---

# 3.9.4 Approval Workflow

Each testimonial follows a simple approval workflow.

Possible states include:

* Created
* Approved
* Removed

Only testimonials marked as **Approved** shall be displayed on the public website.

This workflow allows the administrator to control the quality and authenticity of published testimonials.

---

# 3.9.5 Rating System

Testimonials may optionally include a rating.

Ratings represent the reviewer's overall evaluation of the portfolio owner's work.

The current implementation stores ratings as integers.

Future versions may support:

* Half-star ratings
* Average rating calculations
* Rating analytics

---

# 3.9.6 Translation Rules

The Testimonials Module follows the application's multilingual architecture.

Language-independent information is stored in the `testimonials` table.

Translated information is stored in the `testimonial_translations` table.

Each translation is uniquely identified by:

* Testimonial
* Language

Supported languages include:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian
* Arabic

---

# 3.9.7 Validation Rules

| ID     | Validation Rule                                                 |
| ------ | --------------------------------------------------------------- |
| VR-057 | Reviewer's name is required.                                    |
| VR-058 | Testimonial message is required.                                |
| VR-059 | Rating shall be between 1 and 5 when provided.                  |
| VR-060 | Reviewer photograph shall be a valid image when provided.       |
| VR-061 | Company logo shall be a valid image when provided.              |
| VR-062 | Each language may contain only one translation per testimonial. |

---

# 3.9.8 Preconditions

Before managing testimonials:

* The administrator must be authenticated.
* At least one language must exist.
* Database services must be available.

---

# 3.9.9 Postconditions

After saving a testimonial:

* Testimonial information is stored.
* Reviewer images are updated.
* Approval status is preserved.
* Translations are stored.
* Approved testimonials become available on the public website.

---

# 3.9.10 Error Handling

| Error                   | System Response                                        |
| ----------------------- | ------------------------------------------------------ |
| Missing required fields | Display validation errors.                             |
| Invalid rating          | Display validation error.                              |
| Invalid image           | Reject upload and display validation error.            |
| Duplicate translation   | Reject duplicate translation for the same language.    |
| Database failure        | Display a generic error message and log the exception. |

---

# 3.9.11 Data Model

### Testimonial

Stores language-independent information:

* Reviewer photograph
* Company logo
* Rating
* Approval status
* Featured status
* Display order

---

### Testimonial Translation

Stores language-specific information:

* Reviewer's name
* Position
* Company
* Testimonial message

Relationship:

```text
Testimonial
      │
      ├───────────────┐
      │               │
Testimonial Translation (English)
Testimonial Translation (Portuguese)
Testimonial Translation (Spanish)
Testimonial Translation (German)
Testimonial Translation (Turkish)
Testimonial Translation (Persian)
Testimonial Translation (Arabic)
```

This architecture separates presentation-independent information from localized content while ensuring that only administrator-approved testimonials are publicly displayed.

# 3.10 Contact Module

## 3.10.1 Description

The Contact Module manages the portfolio owner's public contact information displayed on the website.

This module allows visitors to access various communication channels, including email, WhatsApp, and location information. It also provides localized contact details such as address, working hours, and descriptive text.

Unlike other content modules, the Contact Module is designed as a **singleton entity**, meaning that only one contact record exists within the system. This ensures that the portfolio always displays a single, centralized source of contact information.

The Contact Module is independent from the Contact Messages Module, which is responsible for processing messages submitted through the contact form.

---

# 3.10.2 Functional Requirements

### FR-094 – Create Contact Information

The system shall allow the administrator to create the portfolio's contact information.

---

### FR-095 – Update Contact Information

The administrator shall be able to modify the existing contact information.

---

### FR-096 – Manage Email Address

The administrator shall be able to configure the public email address.

---

### FR-097 – Manage WhatsApp Number

The administrator shall be able to configure the public WhatsApp contact number.

---

### FR-098 – Configure Google Maps

The administrator shall be able to configure a Google Maps URL pointing to the portfolio owner's location.

---

### FR-099 – Manage Availability

The administrator shall be able to indicate whether they are currently available for work or collaboration.

---

### FR-100 – Manage Translations

The administrator shall create and update localized contact information for every supported language.

---

### FR-101 – Display Contact Information

The public website shall display contact information using the visitor's selected language.

---

# 3.10.3 Business Rules

### BR-060

Only one Contact record shall exist within the system.

---

### BR-061

Email addresses are shared across all languages.

---

### BR-062

WhatsApp numbers are shared across all languages.

---

### BR-063

Google Maps URLs are shared across all languages.

---

### BR-064

Availability status is shared across all languages.

---

### BR-065

The following fields shall be translated:

* Description
* Address
* City
* State
* Country
* Postal code
* Working hours

---

### BR-066

If the Contact Module is marked as unavailable, the public website shall indicate that the portfolio owner is currently unavailable for new opportunities.

---

# 3.10.4 Contact Channels

The module supports multiple communication methods.

Current implementation:

* Email
* WhatsApp
* Google Maps

Future versions may support additional communication channels without modifying the database architecture.

Examples include:

* Telephone
* Calendly
* Microsoft Teams
* Zoom
* Discord

---

# 3.10.5 Translation Rules

The Contact Module follows the application's multilingual architecture.

Language-independent information is stored in the `contacts` table.

Translated information is stored in the `contact_translations` table.

Each translation is uniquely identified by:

* Contact record
* Language

Supported languages include:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian
* Arabic

---

# 3.10.6 Validation Rules

| ID     | Validation Rule                                                                 |
| ------ | ------------------------------------------------------------------------------- |
| VR-063 | Public email shall be a valid email address when provided.                      |
| VR-064 | WhatsApp number shall follow the configured international format when provided. |
| VR-065 | Google Maps URL shall be valid when provided.                                   |
| VR-066 | Description is optional.                                                        |
| VR-067 | Each language may contain only one translation per contact record.              |
| VR-068 | Only one Contact record may exist within the system.                            |

---

# 3.10.7 Preconditions

Before managing contact information:

* The administrator must be authenticated.
* At least one language must exist.
* Database services must be available.

---

# 3.10.8 Postconditions

After saving contact information:

* Public contact channels are updated.
* Localized contact information is stored.
* The public website immediately reflects the latest information.

---

# 3.10.9 Error Handling

| Error                                     | System Response                                        |
| ----------------------------------------- | ------------------------------------------------------ |
| Invalid email                             | Display validation error.                              |
| Invalid WhatsApp number                   | Display validation error.                              |
| Invalid Google Maps URL                   | Display validation error.                              |
| Duplicate translation                     | Reject duplicate translation for the same language.    |
| Attempt to create a second Contact record | Reject the operation.                                  |
| Database failure                          | Display a generic error message and log the exception. |

---

# 3.10.10 Data Model

### Contact

Stores language-independent information:

* Public email
* WhatsApp number
* Google Maps URL
* Availability status

---

### Contact Translation

Stores language-specific information:

* Description
* Address
* City
* State
* Country
* Postal code
* Working hours

Relationship:

```text
Contact
      │
      ├───────────────┐
      │               │
Contact Translation (English)
Contact Translation (Portuguese)
Contact Translation (Spanish)
Contact Translation (German)
Contact Translation (Turkish)
Contact Translation (Persian)
Contact Translation (Arabic)
```

This normalized architecture stores contact channels only once while allowing visitors from different regions to view localized address information and descriptions in their preferred language.

# 3.11 Contact Messages Module

## 3.11.1 Description

The Contact Messages Module manages all messages submitted through the public contact form.

It provides a communication channel between visitors and the portfolio owner by collecting inquiries, project proposals, collaboration requests, and other messages.

Each submitted message stores the visitor's contact information, message content, and technical metadata such as IP address, browser information, and referral source.

The administrator can monitor, review, organize, and respond to incoming messages through the administration dashboard.

The module also supplies statistical information used by the Dashboard, including unread message counts and monthly message trends.

---

# 3.11.2 Functional Requirements

### FR-102 – Submit Contact Message

Visitors shall be able to submit messages using the public contact form.

---

### FR-103 – Validate Form Submission

The system shall validate all submitted fields before storing the message.

---

### FR-104 – Store Message

Validated messages shall be stored in the database.

---

### FR-105 – Capture Technical Information

The system shall automatically record:

* IP address
* User Agent
* Referrer URL
* Submission timestamp

---

### FR-106 – Initial Status

Newly submitted messages shall automatically receive the status:

**New**

---

### FR-107 – View Messages

The administrator shall be able to browse all submitted messages.

---

### FR-108 – View Message Details

The administrator shall be able to read the complete contents of a message.

---

### FR-109 – Mark Message as Read

Opening a message shall allow it to be marked as **Read**.

---

### FR-110 – Mark Message as Replied

The administrator shall be able to mark a message as **Replied** after responding outside the system.

---

### FR-111 – Archive Message

The administrator shall be able to archive messages that no longer require attention.

---

### FR-112 – Dashboard Statistics

The module shall provide statistics including:

* Total messages
* Unread messages
* Messages received per month

---

# 3.11.3 Business Rules

### BR-067

Every newly submitted message shall have the status:

**New**

---

### BR-068

The system shall automatically store the submission timestamp.

---

### BR-069

Technical metadata shall be collected automatically.

Visitors shall not be able to modify:

* IP address
* User Agent
* Referrer

---

### BR-070

Messages are never translated.

They shall always be stored exactly as submitted by the visitor.

---

### BR-071

Message status may only be one of the following:

* New
* Read
* Replied
* Archived

---

### BR-072

Unread messages shall contribute to the Dashboard KPI card.

---

### BR-073

Monthly message statistics shall be available for dashboard charts.

---

# 3.11.4 Message Lifecycle

Every message follows the lifecycle below:

```text
New
 │
 ▼
Read
 │
 ├──────────────┐
 ▼              ▼
Replied     Archived
```

Status descriptions:

| Status   | Description                                                   |
| -------- | ------------------------------------------------------------- |
| New      | Message has not yet been viewed.                              |
| Read     | Administrator has opened the message.                         |
| Replied  | Administrator has responded to the sender.                    |
| Archived | Message has been closed and removed from the active workflow. |

---

# 3.11.5 Visitor Privacy

To assist with security and diagnostics, the system stores limited technical metadata.

Collected information includes:

* IP address
* Browser user agent
* Referrer URL
* Submission timestamp

This information is intended solely for administrative and security purposes.

---

# 3.11.6 Validation Rules

| ID     | Validation Rule                                               |
| ------ | ------------------------------------------------------------- |
| VR-069 | Name is required.                                             |
| VR-070 | Email is required and shall be valid.                         |
| VR-071 | Message is required.                                          |
| VR-072 | Subject is optional.                                          |
| VR-073 | Phone number is optional.                                     |
| VR-074 | Message status shall be one of: New, Read, Replied, Archived. |

---

# 3.11.7 Preconditions

Before submitting a message:

* The public website shall be available.
* The contact form shall be accessible.
* Database services shall be available.

---

# 3.11.8 Postconditions

After a successful submission:

* The message is stored.
* Technical metadata is recorded.
* Status is initialized as **New**.
* Dashboard statistics are updated.
* The visitor receives a success confirmation.

---

# 3.11.9 Error Handling

| Error                   | System Response                                        |
| ----------------------- | ------------------------------------------------------ |
| Missing required fields | Display validation errors.                             |
| Invalid email address   | Display validation error.                              |
| Database failure        | Display a generic error message and log the exception. |
| Unexpected system error | Prevent data loss and log the exception.               |

---

# 3.11.10 Dashboard Integration

The Contact Messages Module provides data for the administration dashboard.

The following dashboard widgets depend on this module:

* Total Messages KPI
* Unread Messages KPI
* Monthly Messages Chart
* Recent Activity Panel

Future versions may also provide:

* Average response time
* Monthly reply rate
* Messages by country
* Messages by referral source

---

# 3.11.11 Data Model

### Contact Message

Stores:

* Visitor name
* Email
* Phone number
* Subject
* Message
* IP address
* Browser user agent
* Referrer
* Status
* Read timestamp
* Replied timestamp
* Creation timestamp

Relationship:

```text id="b76hzq"
Visitor
   │
   ▼
Contact Message
```

Unlike the other content modules, Contact Messages do not have translation tables because the content must always remain exactly as submitted by the visitor. This preserves the authenticity of communications and avoids altering user-generated content.

# 3.12 Languages Module

## 3.12.1 Description

The Languages Module manages all languages supported by the portfolio management system.

It provides the foundation for the application's multilingual architecture by defining the available languages, their display order, text direction, activation status, and language codes.

Every multilingual module within the system references this module to store localized content. Rather than duplicating data, the application stores language-independent information in the main tables and language-specific content in dedicated translation tables linked to a language.

The current implementation supports seven languages:

* English
* Portuguese
* Spanish
* German
* Turkish
* Persian
* Arabic

The architecture has been designed to allow additional languages to be added in the future without requiring changes to existing modules.

---

# 3.12.2 Functional Requirements

### FR-113 – Create Language

The administrator shall be able to register a new language.

---

### FR-114 – Update Language

The administrator shall be able to modify language information.

---

### FR-115 – Activate or Deactivate Language

The administrator shall be able to enable or disable a language.

Inactive languages shall not be available on the public website.

---

### FR-116 – Configure Display Order

The administrator shall define the order in which languages appear in the language selector.

---

### FR-117 – Configure Text Direction

The administrator shall specify the writing direction of each language.

Supported values:

* Left-to-right (LTR)
* Right-to-left (RTL)

---

### FR-118 – Retrieve Active Languages

The public website shall display only active languages.

---

### FR-119 – Use Selected Language

The system shall load translated content according to the visitor's selected language.

---

# 3.12.3 Business Rules

### BR-074

Each language shall have a unique language code.

---

### BR-075

Each language shall have exactly one writing direction.

---

### BR-076

Inactive languages shall not appear in the public language selector.

---

### BR-077

The system shall preserve all translations even if a language becomes inactive.

---

### BR-078

The display order shall determine the sequence shown in the language switcher.

---

### BR-079

All translation modules shall reference the Languages Module through foreign keys.

---

# 3.12.4 Supported Languages

The initial release supports the following languages.

| Language   | Code | Direction |
| ---------- | ---- | --------- |
| English    | en   | LTR       |
| Portuguese | pt   | LTR       |
| Spanish    | es   | LTR       |
| German     | de   | LTR       |
| Turkish    | tr   | LTR       |
| Persian    | fa   | RTL       |
| Arabic     | ar   | RTL       |

The architecture supports adding additional languages in future releases.

---

# 3.12.5 Translation Architecture

The application follows a normalized multilingual database design.

Each content entity stores language-independent information in its primary table.

Localized content is stored in dedicated translation tables.

Example:

```text id="9ez5a9"
Project
      │
      ├──────────────┐
      │              │
Project Translation ───► Language
```

This architecture avoids duplicated data while allowing unlimited language support.

---

# 3.12.6 Modules Using Translations

The Languages Module is referenced by the following translation tables:

* About Translations
* Experience Translations
* Project Type Translations
* Project Status Translations
* Project Translations
* Education Translations
* Certification Translations
* Skill Category Translations
* Skill Translations
* Testimonial Translations
* Contact Translations

Each translation record references exactly one language.

---

# 3.12.7 Validation Rules

| ID     | Validation Rule                            |
| ------ | ------------------------------------------ |
| VR-075 | Language code shall be unique.             |
| VR-076 | Language name is required.                 |
| VR-077 | Native language name is required.          |
| VR-078 | Direction shall be either LTR or RTL.      |
| VR-079 | Display order shall be a positive integer. |

---

# 3.12.8 Preconditions

Before managing languages:

* The administrator must be authenticated.
* Database services must be available.

---

# 3.12.9 Postconditions

After creating or updating a language:

* The language list is updated.
* Public language selection reflects active languages.
* Existing translations remain unchanged.
* Display order is refreshed.

---

# 3.12.10 Error Handling

| Error                     | System Response                                        |
| ------------------------- | ------------------------------------------------------ |
| Duplicate language code   | Reject the operation.                                  |
| Invalid writing direction | Display validation error.                              |
| Missing required fields   | Display validation errors.                             |
| Database failure          | Display a generic error message and log the exception. |

---

# 3.12.11 Data Model

### Language

Stores:

* Language code
* Language name
* Native name
* Writing direction
* Active status
* Display order

Relationship:

```text id="dz9uk8"
Language
    │
    ├──────────────► About Translation
    ├──────────────► Experience Translation
    ├──────────────► Project Translation
    ├──────────────► Project Type Translation
    ├──────────────► Project Status Translation
    ├──────────────► Education Translation
    ├──────────────► Certification Translation
    ├──────────────► Skill Category Translation
    ├──────────────► Skill Translation
    ├──────────────► Testimonial Translation
    └──────────────► Contact Translation
```

The Languages Module serves as the central multilingual reference for the entire portfolio management system. Every localized content record is associated with exactly one language, ensuring consistency, scalability, and maintainability across all translated modules.

# 3.13 Administration Dashboard Module

## 3.13.1 Description

The Administration Dashboard serves as the central control panel of the Portfolio Management System.

It provides the administrator with an overview of the application's current status through key performance indicators (KPIs), statistical charts, recent activities, system alerts, and quick navigation to management modules.

The dashboard is designed to present the most important information immediately after login, enabling the administrator to monitor portfolio activity and identify items requiring attention.

The current implementation focuses on portfolio statistics rather than user management, since the system is intended for a single administrator.

---

# 3.13.2 Functional Requirements

### FR-120 – Display Dashboard

The system shall display the administration dashboard after successful authentication.

---

### FR-121 – Display KPI Cards

The dashboard shall display summary cards containing important portfolio statistics.

Current KPI cards include:

* Total Projects
* Total Certifications
* Total Skills
* Total Messages
* Unread Messages
* Total Testimonials
* Total CV Downloads

---

### FR-122 – Display Monthly Messages Chart

The dashboard shall display the number of received contact messages grouped by month.

---

### FR-123 – Display Monthly CV Downloads Chart

The dashboard shall display the number of CV downloads grouped by month.

---

### FR-124 – Display Visitor Statistics

The dashboard shall display visitor statistics grouped by month.

---

### FR-125 – Display Recent Activity

The dashboard shall display a chronological list of recent administrative activities.

Examples include:

* New contact message received
* Project created
* Project updated
* Certification added
* Testimonial approved

---

### FR-126 – Display Missing Content Alerts

The dashboard shall notify the administrator when important portfolio sections contain missing or incomplete content.

---

### FR-127 – Refresh Statistics

Dashboard statistics shall automatically reflect the latest database information.

---

# 3.13.3 Business Rules

### BR-080

Only authenticated administrators may access the dashboard.

---

### BR-081

Dashboard statistics shall always be generated from the latest available data.

---

### BR-082

Unread messages shall be highlighted until marked as read.

---

### BR-083

Visitor statistics shall represent unique portfolio visits recorded by the visitor tracking system.

---

### BR-084

CV download statistics shall count successful download events.

---

### BR-085

Recent activities shall be ordered from newest to oldest.

---

### BR-086

Missing Content Alerts shall only display unresolved issues.

---

# 3.13.4 Dashboard Widgets

The initial release includes the following widgets.

## KPI Cards

Displays:

* Total Projects
* Total Certifications
* Total Skills
* Total Testimonials
* Total Messages
* Unread Messages
* Total CV Downloads

---

## Messages Chart

Displays:

* Messages received per month

Visualization:

* Bar Chart

---

## Visitor Statistics Chart

Displays:

* Visitors per month

Visualization:

* Line Chart

---

## CV Downloads Chart

Displays:

* CV downloads per month

Visualization:

* Bar Chart

---

## Recent Activity

Displays the latest administrative events, including:

* Content creation
* Content updates
* New messages
* Testimonial approvals

---

## Missing Content Alerts

Displays warnings such as:

* About section not configured
* Contact information missing
* No featured projects
* Missing translations
* No active social links
* Empty testimonials section

---

# 3.13.5 Dashboard Statistics

The dashboard currently reports:

* Total projects
* Total certifications
* Total skills
* Total testimonials
* Total contact messages
* Total unread messages
* Monthly messages
* Monthly visitors
* Monthly CV downloads

Future versions may include:

* Project views
* Visitor countries
* Device statistics
* Browser statistics
* Referral sources
* Average response time
* Most visited projects

---

# 3.13.6 Validation Rules

| ID     | Validation Rule                                                         |
| ------ | ----------------------------------------------------------------------- |
| VR-080 | Only authenticated administrators may access dashboard data.            |
| VR-081 | Statistics shall never include deleted records.                         |
| VR-082 | Charts shall group records using the application's configured timezone. |

---

# 3.13.7 Preconditions

Before accessing the dashboard:

* Administrator authentication is required.
* Database services must be available.

---

# 3.13.8 Postconditions

After loading the dashboard:

* KPI cards are updated.
* Charts display current statistics.
* Recent activities are loaded.
* Missing content alerts are generated.

---

# 3.13.9 Error Handling

| Error                         | System Response                                  |
| ----------------------------- | ------------------------------------------------ |
| Authentication failure        | Redirect to login page.                          |
| Database unavailable          | Display dashboard error message.                 |
| Statistics generation failure | Display partial dashboard and log the exception. |

---

# 3.13.10 Data Sources

The dashboard aggregates information from multiple modules.

| Widget                 | Source                      |
| ---------------------- | --------------------------- |
| Projects KPI           | Projects Module             |
| Certifications KPI     | Certifications Module       |
| Skills KPI             | Skills Module               |
| Testimonials KPI       | Testimonials Module         |
| Messages KPI           | Contact Messages Module     |
| Unread Messages KPI    | Contact Messages Module     |
| Messages Chart         | Contact Messages Module     |
| Visitor Statistics     | Visitor Tracking Module     |
| CV Downloads           | CV Download Tracking Module |
| Recent Activity        | Multiple Modules            |
| Missing Content Alerts | Multiple Modules            |

---

# 3.13.11 Data Model

The Administration Dashboard does not maintain its own database tables.

Instead, it aggregates information from existing modules and presents the results through statistical widgets.

Relationship overview:

```text id="1fr2mt"
Projects ───────────────┐
Skills ─────────────────┤
Certifications ─────────┤
Testimonials ───────────┤
Contact Messages ───────┤
Visitor Tracking ───────┤
CV Download Tracking ───┤
                         ▼
              Administration Dashboard
```

The Administration Dashboard functions as the analytical center of the Portfolio Management System by consolidating operational data into meaningful statistics, visualizations, and alerts that assist the administrator in monitoring portfolio performance and maintaining content quality.

# 3.14 Visitor Analytics Module

## 3.14.1 Description

The Visitor Analytics Module records anonymous visits to the public portfolio website for statistical and reporting purposes.

The module enables the administrator to monitor portfolio traffic by collecting visit events and generating monthly statistics displayed on the Administration Dashboard.

The primary objective of this module is to provide high-level insights into portfolio popularity without collecting personally identifiable information (PII).

The collected data is used exclusively for internal analytics and dashboard reporting.

---

# 3.14.2 Functional Requirements

### FR-128 – Record Visitor

The system shall record each visitor accessing the public portfolio.

---

### FR-129 – Record Visit Timestamp

The system shall store the date and time of each recorded visit.

---

### FR-130 – Generate Monthly Statistics

The system shall generate monthly visitor statistics.

---

### FR-131 – Display Visitor Statistics

The Administration Dashboard shall display visitor statistics using graphical charts.

---

### FR-132 – Count Total Visitors

The system shall calculate the total number of recorded visits.

---

### FR-133 – Provide Dashboard Data

The module shall provide visitor statistics to the Dashboard Module.

---

# 3.14.3 Business Rules

### BR-087

Visitor analytics shall only be collected from the public website.

---

### BR-088

Visitor statistics shall be used exclusively for administrative reporting.

---

### BR-089

The system shall not require visitor authentication.

---

### BR-090

Visitor information shall not be publicly accessible.

---

### BR-091

Monthly visitor statistics shall be calculated from recorded visit dates.

---

# 3.14.4 Collected Information

The module currently records anonymous visit events.

The minimum information required includes:

* Visit date
* Visit time

Future versions may optionally record:

* IP address
* Browser
* Device type
* Operating system
* Referral source
* Country
* Session duration

These fields are optional enhancements and are not required for the initial release.

---

# 3.14.5 Dashboard Integration

The Visitor Analytics Module provides data to the Administration Dashboard.

Current dashboard widgets include:

* Total Visitors
* Visitors per Month

Future widgets may include:

* Visitors by Country
* Visitors by Browser
* Visitors by Device
* Returning Visitors
* Daily Traffic
* Weekly Traffic

---

# 3.14.6 Validation Rules

| ID     | Validation Rule                                       |
| ------ | ----------------------------------------------------- |
| VR-083 | Every recorded visit shall include a valid timestamp. |
| VR-084 | Statistics shall ignore invalid or corrupted records. |

---

# 3.14.7 Preconditions

Before recording visitor statistics:

* The public website shall be available.
* Database services shall be operational.

---

# 3.14.8 Postconditions

After recording a visit:

* The visit is stored.
* Monthly statistics are updated.
* Dashboard reports reflect the latest available information.

---

# 3.14.9 Error Handling

| Error                         | System Response                                                                             |
| ----------------------------- | ------------------------------------------------------------------------------------------- |
| Database unavailable          | Skip analytics recording and log the exception without interrupting the visitor experience. |
| Statistics generation failure | Display unavailable statistics on the dashboard and log the exception.                      |

---

# 3.14.10 Privacy Considerations

The Visitor Analytics Module is designed to respect visitor privacy.

The current implementation focuses on anonymous traffic measurement.

The system should avoid storing personally identifiable information unless required for future functionality and applicable privacy regulations.

If additional analytics data is collected in future versions, administrators shall ensure compliance with applicable privacy laws and regulations.

---

# 3.14.11 Data Model

The Visitor Analytics Module stores anonymous visit events.

Relationship overview:

```text id="gj6xpl"
Public Visitor
       │
       ▼
Visitor Analytics
       │
       ▼
Administration Dashboard
```

The Visitor Analytics Module provides statistical information used by the Administration Dashboard while remaining independent of the application's content management modules.

# 3.15 CV Download Module

## 3.15.1 Description

The CV Download Module manages the public download of the portfolio owner's curriculum vitae (CV) and records download statistics for administrative reporting.

Visitors can download the latest version of the CV directly from the public website, while the system records each successful download for statistical purposes.

The collected information is used by the Administration Dashboard to provide download analytics and measure visitor engagement.

The module is designed to maintain a single active CV file that can be replaced by the administrator whenever a newer version becomes available.

---

# 3.15.2 Functional Requirements

### FR-134 – Upload CV

The administrator shall be able to upload a CV document.

---

### FR-135 – Replace CV

The administrator shall be able to replace the currently available CV with a newer version.

---

### FR-136 – Download CV

Visitors shall be able to download the latest published CV from the public website.

---

### FR-137 – Record Download

The system shall record every successful CV download.

---

### FR-138 – Generate Download Statistics

The system shall generate monthly CV download statistics.

---

### FR-139 – Display Download Statistics

The Administration Dashboard shall display CV download statistics.

---

# 3.15.3 Business Rules

### BR-092

Only one CV shall be publicly available at any given time.

---

### BR-093

Uploading a new CV shall replace the previously published version.

---

### BR-094

Only successful downloads shall be counted.

---

### BR-095

Download statistics shall be used exclusively for administrative reporting.

---

### BR-096

The public website shall always serve the latest published CV.

---

# 3.15.4 Download Workflow

The CV download process follows the workflow below.

```text
Visitor
   │
   ▼
Clicks Download CV
   │
   ▼
System verifies CV exists
   │
   ▼
Download starts
   │
   ▼
Download event recorded
   │
   ▼
Dashboard statistics updated
```

---

# 3.15.5 Dashboard Integration

The CV Download Module provides information for the Administration Dashboard.

Current dashboard widgets include:

* Total CV Downloads
* CV Downloads per Month

Future dashboard widgets may include:

* Downloads by Country
* Downloads by Referral Source
* Downloads by Device
* Downloads by Browser
* Daily Download Statistics

---

# 3.15.6 Validation Rules

| ID     | Validation Rule                                                      |
| ------ | -------------------------------------------------------------------- |
| VR-085 | Only supported document formats may be uploaded (e.g., PDF).         |
| VR-086 | The uploaded file shall not exceed the configured maximum file size. |
| VR-087 | A download shall only be recorded after a successful file response.  |

---

# 3.15.7 Preconditions

Before downloading the CV:

* A published CV shall exist.
* The storage system shall be accessible.
* The public website shall be available.

---

# 3.15.8 Postconditions

After a successful download:

* The visitor receives the latest CV.
* A download event is recorded.
* Dashboard statistics are updated.

---

# 3.15.9 Error Handling

| Error                                        | System Response                                           |
| -------------------------------------------- | --------------------------------------------------------- |
| No CV available                              | Display an informative message to the visitor.            |
| File missing                                 | Log the error and notify the administrator.               |
| Storage unavailable                          | Display a download error without exposing system details. |
| Database failure during statistics recording | Continue the download and log the exception.              |

---

# 3.15.10 Privacy Considerations

The current implementation records only anonymous download events for statistical purposes.

Personally identifiable information is not required for download counting.

Future versions may optionally record additional anonymous metadata such as:

* Download date
* Country
* Browser
* Device type
* Referral source

---

# 3.15.11 Data Model

The CV Download Module consists of two logical components:

* CV file management
* Download event tracking

Relationship overview:

```text
Administrator
      │
      ▼
Published CV
      │
      ▼
Visitor Download
      │
      ▼
Download Statistics
      │
      ▼
Administration Dashboard
```

The CV Download Module enables visitors to access the latest published curriculum vitae while providing administrators with valuable engagement metrics through download analytics displayed on the Administration Dashboard.

# 4. External Interface Requirements

This chapter describes all external interfaces used by the Portfolio Management System, including user interaction, hardware dependencies, software integrations, and communication protocols.

The application is a web-based system consisting of a public portfolio website and a secure administration portal. Both interfaces are accessed through modern web browsers and communicate with the Laravel backend through the Inertia.js framework.

---

# 4.1 User Interfaces

## 4.1.1 Public Website

The public website allows visitors to browse portfolio information.

The interface includes:

* Hero Section
* About
* Experience
* Projects
* Education
* Certifications
* Skills
* Testimonials
* Contact
* Footer
* Language Selector
* Theme Switcher
* CV Download Button

The public interface is fully responsive and supports desktop, tablet, and mobile devices.

---

## 4.1.2 Administration Portal

The administration portal provides authenticated access for content management.

The interface includes:

* Dashboard
* Sidebar Navigation
* CRUD Forms
* Data Tables
* Dialog Windows
* Confirmation Dialogs
* Toast Notifications
* Charts
* KPI Cards
* Recent Activity
* Missing Content Alerts

The administration portal is optimized for desktop usage.

---

## 4.1.3 User Experience

The application follows modern UI/UX principles including:

* Responsive layout
* Consistent spacing
* Accessible color contrast
* Dark and Light themes
* Smooth page transitions
* Immediate feedback through Toast Notifications
* Confirmation dialogs for destructive actions
* Loading indicators
* Form validation feedback

---

# 4.2 Hardware Interfaces

The Portfolio Management System does not require specialized hardware.

Minimum requirements include:

Administrator:

* Desktop or Laptop Computer
* Keyboard
* Mouse
* Internet Connection

Visitors:

* Desktop
* Laptop
* Tablet
* Smartphone

Supported operating systems include:

* Windows
* Linux
* macOS
* Android
* iOS

---

# 4.3 Software Interfaces

The application integrates with the following software components.

## Backend

* Laravel 12+
* PHP 8.3+
* MySQL
* Composer

---

## Frontend

* Vue.js 3
* Inertia.js
* PrimeVue
* Tailwind CSS
* Vite
* Pinia
* Vue I18n

---

## Development Tools

* Visual Studio Code
* Git
* GitHub
* MySQL Workbench
* dbdiagram.io

---

## Browser Support

The application supports modern browsers including:

* Google Chrome
* Mozilla Firefox
* Microsoft Edge
* Safari

---

# 4.4 Communication Interfaces

Communication between the frontend and backend occurs using HTTPS over HTTP.

The application communicates through:

* Inertia.js Requests
* Laravel Routing
* JSON Responses
* Multipart File Uploads

The system supports:

* Secure Authentication
* Form Submission
* Image Upload
* CV Download
* Dashboard Data Retrieval
* CRUD Operations

All communication between the client and server is encrypted using HTTPS in production environments.

The application uses UTF-8 encoding to ensure proper handling of multilingual content, including English, Portuguese, Spanish, German, Turkish, Persian, and Arabic.

# 5. Non-Functional Requirements

This chapter defines the quality attributes of the Portfolio Management System. These requirements describe how the system should operate rather than the functionality it provides.

---

# 5.1 Performance Requirements

### NFR-001

The public website shall load its initial page within **3 seconds** under normal network conditions.

### NFR-002

Page navigation shall be completed within **2 seconds**.

### NFR-003

CRUD operations shall complete within **2 seconds** under normal workload.

### NFR-004

Dashboard statistics shall be generated within **5 seconds**.

### NFR-005

Large image uploads shall be processed without blocking the application interface.

---

# 5.2 Security Requirements

### NFR-006

Only authenticated administrators shall access the administration portal.

### NFR-007

Passwords shall be stored using Laravel's secure hashing algorithm.

### NFR-008

All forms shall be protected against CSRF attacks.

### NFR-009

All user inputs shall be validated on the server.

### NFR-010

Database queries shall use Laravel Eloquent or Query Builder to prevent SQL Injection.

### NFR-011

Uploaded files shall be validated before storage.

### NFR-012

Production deployments shall use HTTPS.

---

# 5.3 Reliability Requirements

### NFR-013

The system shall maintain database consistency during CRUD operations.

### NFR-014

Unexpected exceptions shall be logged.

### NFR-015

Failures in optional modules shall not interrupt the entire application.

---

# 5.4 Availability Requirements

### NFR-016

The public portfolio should remain continuously available except during scheduled maintenance.

### NFR-017

Maintenance operations shall minimize downtime.

---

# 5.5 Scalability Requirements

### NFR-018

The multilingual architecture shall support additional languages without database redesign.

### NFR-019

New content modules shall follow the existing translation architecture.

### NFR-020

The system architecture shall support future feature expansion.

---

# 5.6 Maintainability Requirements

### NFR-021

The application shall follow the MVC architecture.

### NFR-022

Frontend and backend logic shall remain separated.

### NFR-023

Source code shall follow consistent coding standards.

### NFR-024

Business logic shall be reusable.

### NFR-025

Documentation shall remain synchronized with implementation.

---

# 5.7 Usability Requirements

### NFR-026

The interface shall remain consistent throughout the application.

### NFR-027

Validation messages shall clearly explain input errors.

### NFR-028

Administrative tasks shall require minimal navigation.

### NFR-029

The dashboard shall present the most important information immediately after login.

---

# 5.8 Accessibility Requirements

### NFR-030

The application shall support keyboard navigation.

### NFR-031

Color combinations shall provide sufficient contrast.

### NFR-032

Interactive components shall provide visible focus indicators.

### NFR-033

Text shall remain readable across supported devices.

---

# 5.9 Compatibility Requirements

### NFR-034

The application shall support modern web browsers including:

* Google Chrome
* Mozilla Firefox
* Microsoft Edge
* Safari

### NFR-035

The application shall function correctly on desktop, tablet, and mobile devices.

---

# 5.10 Localization Requirements

### NFR-036

The application shall support seven languages.

### NFR-037

The interface shall automatically adapt to Left-to-Right (LTR) and Right-to-Left (RTL) languages.

### NFR-038

Every multilingual content module shall use the translation-table architecture.

### NFR-039

UTF-8 encoding shall be used throughout the application.

---

# 5.11 Backup and Recovery Requirements

### NFR-040

Database backups should be performed regularly.

### NFR-041

Application files should be backed up periodically.

### NFR-042

System restoration procedures should allow recovery after unexpected failures.

---

# 5.12 Logging and Monitoring Requirements

### NFR-043

Application exceptions shall be logged.

### NFR-044

Failed authentication attempts shall be logged.

### NFR-045

Visitor statistics shall be recorded.

### NFR-046

CV downloads shall be recorded.

---

# 5.13 Data Integrity Requirements

### NFR-047

Foreign key relationships shall maintain referential integrity.

### NFR-048

Cascade operations shall prevent orphan records.

### NFR-049

Unique constraints shall prevent duplicated data where required.

### NFR-050

Database transactions shall be used when multiple related operations are performed.

---

# 5.14 Privacy Requirements

### NFR-051

Personal information submitted through the contact form shall not be publicly accessible.

### NFR-052

Visitor statistics shall be used only for administrative purposes.

### NFR-053

Sensitive system information shall never be exposed to visitors.

---

# 5.15 Coding Standards and Quality Requirements

### NFR-054

Backend development shall follow Laravel best practices.

### NFR-055

Frontend development shall follow Vue.js best practices.

### NFR-056

The application shall use consistent naming conventions.

### NFR-057

Source code shall be modular and reusable.

### NFR-058

All production code shall be version controlled using Git.

### NFR-059

Documentation shall be maintained throughout the project lifecycle.

### NFR-060

The project shall follow a layered architecture that separates presentation, business logic, and data access.

# 6. Appendices

This chapter contains supplementary information that supports the specification and implementation of the Portfolio Management System.

---

# 6.1 Abbreviations

| Abbreviation | Meaning                               |
| ------------ | ------------------------------------- |
| API          | Application Programming Interface     |
| CMS          | Content Management System             |
| CRUD         | Create, Read, Update, Delete          |
| CSRF         | Cross-Site Request Forgery            |
| CSS          | Cascading Style Sheets                |
| DBMS         | Database Management System            |
| ERD          | Entity Relationship Diagram           |
| HLD          | High-Level Design                     |
| HTML         | HyperText Markup Language             |
| HTTP         | HyperText Transfer Protocol           |
| HTTPS        | HyperText Transfer Protocol Secure    |
| JSON         | JavaScript Object Notation            |
| KPI          | Key Performance Indicator             |
| LLD          | Low-Level Design                      |
| MVC          | Model-View-Controller                 |
| ORM          | Object Relational Mapping             |
| PHP          | Hypertext Preprocessor                |
| REST         | Representational State Transfer       |
| RTL          | Right-to-Left                         |
| LTR          | Left-to-Right                         |
| SPA          | Single Page Application               |
| SQL          | Structured Query Language             |
| SRS          | Software Requirements Specification   |
| UI           | User Interface                        |
| UX           | User Experience                       |
| UTF-8        | Unicode Transformation Format – 8-bit |

---

# 6.2 Glossary

| Term             | Definition                                                                                                                    |
| ---------------- | ----------------------------------------------------------------------------------------------------------------------------- |
| Administrator    | The authenticated user responsible for managing portfolio content.                                                            |
| Portfolio        | The public website presenting professional information, projects, education, certifications, skills, and contact information. |
| Translation      | Localized content stored for a specific language.                                                                             |
| Dashboard        | The administration homepage displaying statistics and portfolio insights.                                                     |
| Featured Project | A project highlighted on the public portfolio homepage.                                                                       |
| Visitor          | Any person browsing the public website without authentication.                                                                |
| Testimonial      | Feedback received from clients or colleagues.                                                                                 |
| KPI              | A measurable indicator used to evaluate application performance and activity.                                                 |

---

# 6.3 References

The following references were used during the design and implementation of the system.

## Frameworks

* Laravel Framework Documentation
* Vue.js Documentation
* Inertia.js Documentation
* PrimeVue Documentation
* Tailwind CSS Documentation

---

## Standards

* IEEE 830 Software Requirements Specification
* IEEE 29148 Systems and Software Requirements Engineering

---

## Development Tools

* Composer
* Vite
* Git
* GitHub
* MySQL
* MySQL Workbench
* Visual Studio Code
* dbdiagram.io

---

# 6.4 Assumptions

The following assumptions were considered during development.

* The system is intended for a single administrator.
* Internet connectivity is available.
* Modern web browsers are used.
* The administrator has permission to upload portfolio content.
* Visitors access only the public website.
* The database server is available during normal operation.

---

# 6.5 Constraints

The following constraints apply to the current implementation.

* Backend implemented using Laravel.
* Frontend implemented using Vue.js and Inertia.js.
* Database implemented using MySQL.
* PrimeVue is the primary UI component library.
* Tailwind CSS is used for styling.
* Images are uploaded and managed by the administrator.
* Seven languages are supported in the initial release.

---

# 6.6 Future Enhancements

The following features are planned for future versions of the application.

## Analytics

* Visitor countries
* Browser statistics
* Device statistics
* Traffic sources
* Returning visitors

---

## Portfolio

* Blog module
* Portfolio categories
* Search functionality
* Portfolio filtering
* Portfolio tags

---

## Communication

* Email notifications
* Contact message labels
* Contact message search
* Spam detection

---

## Dashboard

* Additional charts
* Export statistics
* Real-time analytics
* Interactive reports

---

## System

* Multi-administrator support
* Role-based permissions
* Activity logs
* Audit trail
* Automatic backups

---

# 6.7 Document Revision History

| Version | Date            | Description                                                                             |
| ------- | --------------- | --------------------------------------------------------------------------------------- |
| 1.0     | Initial Release | First complete Software Requirements Specification for the Portfolio Management System. |

# 7. Approval

This chapter records the approval of the Software Requirements Specification (SRS) and confirms that all stakeholders agree with the documented requirements before implementation or future revisions.

---

# 7.1 Document Approval

The Portfolio Management System Software Requirements Specification shall be reviewed and approved before being considered the baseline specification for the project.

Approval indicates that the documented requirements accurately describe the intended functionality, quality attributes, constraints, and scope of the system.

---

# 7.2 Approval Roles

| Role                       | Responsibility                                                              |
| -------------------------- | --------------------------------------------------------------------------- |
| Project Owner              | Defines the project vision, requirements, and priorities.                   |
| System Designer            | Reviews the architecture and system design feasibility.                     |
| Software Developer         | Reviews technical feasibility and implementation details.                   |
| Quality Assurance Reviewer | Reviews the completeness, consistency, and testability of the requirements. |

For this project, all roles are performed by the project owner.

---

# 7.3 Approval Criteria

The document shall be considered approved when the following conditions are satisfied:

* The project scope is clearly defined.
* All functional requirements have been reviewed.
* All non-functional requirements have been reviewed.
* The system architecture is considered feasible.
* Database requirements are complete.
* User interface requirements are complete.
* Future enhancements have been identified.
* The document is internally consistent.
* No unresolved critical issues remain.

---

# 7.4 Document Baseline

After approval, this version of the SRS becomes the official baseline for the Portfolio Management System.

Future modifications shall be documented through version updates and revision history.

---

# 7.5 Change Management

Any future modification to this specification shall:

* Be documented.
* Include the reason for the change.
* Include the affected sections.
* Increment the document version.
* Update the revision history.

Changes shall be reviewed before becoming part of the official specification.

---

# 7.6 Sign-off

| Role                       | Name               | Signature          | Date       |
| -------------------------- | ------------------ | ------------------ | ---------- |
| Project Owner              | __________________ | __________________ | __________ |
| System Designer            | __________________ | __________________ | __________ |
| Software Developer         | __________________ | __________________ | __________ |
| Quality Assurance Reviewer | __________________ | __________________ | __________ |

For this project, the Project Owner is responsible for approving and maintaining the specification throughout the development lifecycle.

# 8. Document Control

This chapter defines how the Software Requirements Specification (SRS) is managed throughout the project lifecycle. It ensures that future revisions remain traceable, consistent, and properly documented.

---

# 8.1 Document Information

| Property       | Value                                     |
| -------------- | ----------------------------------------- |
| Document Title | Software Requirements Specification (SRS) |
| Project        | Portfolio Management System               |
| Version        | 1.0                                       |
| Status         | Approved                                  |
| Language       | English                                   |
| Document Type  | Software Engineering Documentation        |
| Author         | Project Owner                             |
| Last Updated   | August 2026                               |

---

# 8.2 Version Control

Each revision of this document shall receive a new version number according to the following convention.

| Version | Description                                     |
| ------- | ----------------------------------------------- |
| 0.x     | Draft versions                                  |
| 1.0     | Initial approved release                        |
| 1.x     | Minor updates and clarifications                |
| 2.x     | Major revisions introducing significant changes |

---

# 8.3 Change Log

All modifications shall be recorded in the change log.

| Version | Date        | Author        | Description                                                 |
| ------- | ----------- | ------------- | ----------------------------------------------------------- |
| 1.0     | August 2026 | Project Owner | Initial release of the Software Requirements Specification. |

Future revisions shall append new entries without removing previous records.

---

# 8.4 Document Distribution

This document may be distributed to the following audiences:

* Project Owner
* Software Developers
* UI/UX Designers
* Quality Assurance Engineers
* Reviewers
* Future Contributors

The latest approved version shall be considered the authoritative reference.

---

# 8.5 Document Storage

The SRS should be stored alongside the project source code and documentation.

Recommended structure:

```text
docs/
├── SRS.pdf
├── HLD.pdf
├── LLD.pdf
├── ERD.pdf
├── API_Documentation.pdf
├── UI_UX_Flow.pdf
├── Deployment_Guide.pdf
├── Testing_Guide.pdf
├── User_Manual.pdf
└── Administrator_Manual.pdf
```

Version-controlled storage using Git is recommended to maintain revision history.

---

# 8.6 Review Schedule

The SRS should be reviewed:

* Before major feature implementation.
* Before major software releases.
* After significant architectural changes.
* When introducing new system modules.
* During project maintenance.

Regular reviews help ensure that the documentation accurately reflects the implemented system.

---

# 8.7 Related Documents

The Software Requirements Specification serves as the foundation for the remaining project documentation.

The following documents are directly derived from this specification:

* High-Level Design (HLD)
* Low-Level Design (LLD)
* Entity Relationship Diagram (ERD)
* Database Schema Documentation
* REST API Documentation
* UI/UX Flow Documentation
* Deployment Guide
* Testing Documentation
* User Manual
* Administrator Manual

All related documentation shall remain consistent with the latest approved version of this SRS.
