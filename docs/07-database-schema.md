# Database Schema Documentation

**Project:** Portfolio Management System

**Version:** 1.0

**Database Engine:** MySQL

**Framework:** Laravel 13

**ORM:** Laravel Eloquent ORM

**Author:** Nima Khazforoosh

**Last Updated:** August 2026

---

# 1. Introduction

## 1.1 Purpose

This document provides the complete database schema specification for the Portfolio Management System.

The purpose of this document is to describe the logical and physical structure of the application's relational database, including every database table, column, relationship, constraint, index, and design decision.

This document serves as the primary technical reference for developers, database administrators, software architects, and future maintainers of the system.

---

## 1.2 Scope

This documentation covers every business-related table used by the Portfolio Management System.

The schema includes:

* User Management
* Portfolio Information
* Professional Experience
* Projects
* Project Images
* Project Types
* Project Statuses
* Education
* Certifications
* Skills
* Skill Categories
* Testimonials
* Contact Information
* Social Links
* Languages
* Translation Tables
* Contact Messages

Laravel infrastructure tables are also documented where applicable, including authentication, caching, queues, and session management.

---

## 1.3 Objectives

The database has been designed to satisfy the following objectives:

* Maintain data integrity
* Eliminate unnecessary data redundancy
* Support multilingual content
* Enforce referential integrity
* Improve maintainability
* Optimize query performance
* Support future scalability
* Simplify application development through Laravel Eloquent

---

## 1.4 Database Engine

The application uses **MySQL** as its primary relational database management system.

MySQL was selected because it provides:

* Excellent Laravel integration
* Strong relational capabilities
* Foreign key support
* Transaction management
* High reliability
* Wide industry adoption
* Efficient indexing
* Mature ecosystem

The database schema is fully managed through Laravel Migration files, allowing the database structure to be version-controlled and deployed consistently across development, staging, and production environments.

---

## 1.5 Database Architecture

The Portfolio Management System follows a normalized relational database architecture.

Business entities are separated into independent tables connected through foreign key relationships.

The schema is organized into the following logical domains:

### Authentication

* Users
* Sessions
* Password Reset Tokens

### Portfolio Content

* About
* Experience
* Projects
* Education
* Certifications
* Skills
* Testimonials
* Contact Information
* Social Links

### Classification

* Project Types
* Project Statuses
* Skill Categories

### Localization

* Languages
* Translation Tables

### Communication

* Contact Messages

### Infrastructure

* Cache
* Queue Jobs
* Failed Jobs
* Job Batches

This modular organization simplifies future maintenance and allows each business domain to evolve independently.

---

## 1.6 Design Principles

The database has been designed according to the following principles:

* Third Normal Form (3NF)
* Referential Integrity
* Entity Separation
* Data Consistency
* Minimal Redundancy
* Scalability
* Performance Optimization
* Laravel Convention Compliance

These principles ensure that the database remains maintainable while supporting future expansion.

---

## 1.7 Translation Strategy

The Portfolio Management System supports multiple languages through a dedicated translation architecture.

Rather than storing localized content directly inside business tables, each multilingual entity has an associated translation table.

For example:

* abouts → about_translations
* experiences → experience_translations
* projects → project_translations
* education → education_translations
* certifications → certification_translations
* skill_categories → skill_category_translations
* skills → skill_translations
* testimonials → testimonial_translations
* contacts → contact_translations

Each translation record references a language stored in the **languages** table.

This design provides:

* Unlimited language support
* Reduced data duplication
* Simplified maintenance
* Flexible localization

---

## 1.8 Document Organization

This document is organized into the following sections:

1. Introduction
2. Database Overview
3. Naming Conventions
4. Database Tables
5. Relationships
6. Constraints
7. Index Strategy
8. Normalization
9. Future Extensions
10. Summary

Each table is documented individually with its purpose, structure, relationships, constraints, and implementation details, providing a complete technical specification of the database schema.

# 2. Database Overview

## 2.1 Overview

The Portfolio Management System uses a relational database built on **MySQL** to store all application data. The database is structured around business entities that represent the major functional areas of the system, including portfolio content, user management, localization, communication, and supporting infrastructure.

The schema has been designed to provide high data integrity, efficient querying, and long-term maintainability while following Laravel's database conventions and best practices.

---

## 2.2 Database Statistics

The database consists of multiple logical modules that collectively support the application's functionality.

### Business Tables

* Users
* About
* Experience
* Projects
* Project Images
* Project Types
* Project Statuses
* Education
* Certifications
* Skill Categories
* Skills
* Testimonials
* Contacts
* Social Links
* Languages
* Contact Messages

### Translation Tables

* About Translations
* Experience Translations
* Project Translations
* Project Type Translations
* Project Status Translations
* Education Translations
* Certification Translations
* Skill Category Translations
* Skill Translations
* Testimonial Translations
* Contact Translations

### Infrastructure Tables

* Sessions
* Password Reset Tokens
* Cache
* Cache Locks
* Jobs
* Job Batches
* Failed Jobs

The separation between business entities, translation entities, and infrastructure tables keeps the schema organized and easy to maintain.

---

## 2.3 Business Domains

The database is organized into several functional domains.

### Authentication

Responsible for administrator authentication and session management.

Main tables:

* users
* sessions
* password_reset_tokens

---

### Portfolio Content

Stores all portfolio information displayed on the public website.

Main tables:

* abouts
* experiences
* projects
* education
* certifications
* skills
* testimonials
* contacts
* social_links

---

### Classification

Stores reusable classifications shared by other entities.

Main tables:

* project_types
* project_statuses
* skill_categories

---

### Localization

Provides multilingual support throughout the application.

Main tables:

* languages
* *_translations

---

### Communication

Stores messages submitted through the contact form.

Main tables:

* contact_messages

---

### Infrastructure

Supports Laravel framework functionality.

Main tables:

* cache
* cache_locks
* jobs
* job_batches
* failed_jobs

---

## 2.4 Translation Architecture

The database implements a dedicated translation architecture to support multiple languages.

Each multilingual entity consists of:

* One primary table containing language-independent data.
* One translation table containing localized content.

For example:

| Primary Table    | Translation Table           |
| ---------------- | --------------------------- |
| abouts           | about_translations          |
| experiences      | experience_translations     |
| projects         | project_translations        |
| education        | education_translations      |
| certifications   | certification_translations  |
| skill_categories | skill_category_translations |
| skills           | skill_translations          |
| testimonials     | testimonial_translations    |
| contacts         | contact_translations        |

Every translation record references both:

* The parent entity.
* A language defined in the **languages** table.

This architecture allows the application to support additional languages without modifying the database schema.

---

## 2.5 Relationship Model

The schema primarily uses **one-to-many** relationships.

Examples include:

* One Project → Many Project Images
* One Project → Many Project Translations
* One Skill Category → Many Skills
* One Skill → Many Skill Translations
* One Certification → Many Certification Translations
* One Language → Many Translation Records

Foreign key constraints enforce these relationships and preserve referential integrity.

---

## 2.6 Data Flow

Data enters the database through the administration portal, where authenticated administrators create, update, and manage portfolio content.

The public website retrieves this information through Laravel's Eloquent ORM and displays the appropriate translations according to the visitor's selected language.

Visitor interactions, such as contact form submissions, are stored separately within the **contact_messages** table for later review and response by administrators.

---

## 2.7 Database Characteristics

The database possesses the following characteristics:

* Relational design
* Normalized schema
* Strong referential integrity
* Modular organization
* Multilingual support
* Version-controlled structure through Laravel migrations
* Optimized indexing for frequently queried columns
* Consistent naming conventions

These characteristics contribute to the reliability, maintainability, and scalability of the application.

---

## 2.8 Summary

The Portfolio Management System database provides a structured and scalable foundation for managing multilingual portfolio content and application data.

Its modular organization, translation architecture, and normalized relational design simplify development, improve maintainability, and allow the application to evolve without significant structural modifications.

The following chapter defines the naming conventions and standards used throughout the database schema.

# 3. Naming Conventions

## 3.1 Overview

To ensure consistency, readability, and maintainability, the Portfolio Management System follows a standardized database naming convention based on Laravel best practices and common relational database design principles.

Consistent naming conventions make the database easier to understand, reduce development errors, and simplify collaboration among developers.

---

## 3.2 Table Naming Convention

All database tables use **snake_case** naming and, following Laravel conventions, are named in the **plural** form.

### Examples

| Entity        | Table Name     |
| ------------- | -------------- |
| User          | users          |
| About         | abouts         |
| Experience    | experiences    |
| Project       | projects       |
| Education     | education      |
| Certification | certifications |
| Skill         | skills         |
| Testimonial   | testimonials   |
| Contact       | contacts       |
| Language      | languages      |

Translation tables follow the naming pattern:

```
<entity>_translations
```

### Examples

* about_translations
* experience_translations
* project_translations
* education_translations
* certification_translations
* skill_translations
* testimonial_translations
* contact_translations

---

## 3.3 Column Naming Convention

All database columns use **snake_case**.

Examples include:

* first_name
* last_name
* start_date
* end_date
* credential_url
* github_url
* created_at
* updated_at

Abbreviations are avoided unless they are widely recognized (such as **id**, **url**, or **ip**).

---

## 3.4 Primary Keys

Every business table uses a single-column primary key named:

```
id
```

The primary key is an auto-incrementing unsigned bigint generated using Laravel's:

```php
$table->id();
```

This convention provides consistency across all entities and aligns with Laravel's Eloquent ORM.

---

## 3.5 Foreign Keys

Foreign keys follow the naming pattern:

```
<entity>_id
```

Examples include:

* about_id
* experience_id
* project_id
* language_id
* certification_id
* skill_id
* skill_category_id
* testimonial_id
* contact_id
* project_type_id
* project_status_id

This naming convention clearly identifies relationships between tables and enables Laravel to infer relationships automatically.

---

## 3.6 Timestamp Columns

All business entities include Laravel's standard timestamp fields:

* created_at
* updated_at

Additional timestamp columns are used when required by business logic, for example:

* email_verified_at
* last_login_at
* read_at
* replied_at

Timestamp column names describe the event they record.

---

## 3.7 Boolean Columns

Boolean columns use descriptive names that clearly indicate a true or false state.

Examples include:

* active
* available
* current
* featured
* approved

Boolean fields default to meaningful values whenever appropriate.

---

## 3.8 Ordering Columns

Entities that require manual display ordering include an integer column named:

```
order
```

Examples include:

* experiences
* projects
* skills
* certifications
* testimonials
* social_links

This column allows administrators to control presentation order without affecting primary keys.

---

## 3.9 URL Columns

Columns storing external links end with the suffix:

```
_url
```

Examples include:

* github_url
* live_url
* verification_url
* credential_url
* google_maps_url

This naming convention immediately identifies fields that contain web addresses.

---

## 3.10 Image Columns

Image file paths are stored using descriptive names such as:

* image
* photo
* logo
* path

These columns store relative file paths rather than binary image data.

---

## 3.11 Translation Tables

Every translation table contains two required foreign keys:

* Parent entity identifier
* language_id

Example:

```
about_translations
```

contains:

* about_id
* language_id

This structure ensures each translation belongs to exactly one entity and one language.

---

## 3.12 Constraint Naming

Laravel automatically generates foreign key constraint names using the following pattern:

```
<table>_<column>_foreign
```

Examples include:

* projects_project_type_id_foreign
* skills_skill_category_id_foreign
* about_translations_language_id_foreign

Unique constraints follow Laravel's default naming convention unless explicitly defined.

---

## 3.13 Index Naming

Indexes follow Laravel's default naming convention.

Examples include:

* contact_messages_status_index
* contact_messages_email_index
* contact_messages_created_at_index

This convention keeps index names predictable and easy to identify.

---

## 3.14 JSON Columns

Columns storing structured collections use the JSON data type.

Examples include:

* technologies

Using JSON allows flexible storage of multiple technology values while maintaining a normalized overall schema.

---

## 3.15 Naming Consistency

The database naming conventions have been designed to achieve:

* Readability
* Consistency
* Predictability
* Laravel compatibility
* Maintainability
* Scalability

Adhering to these conventions simplifies development, improves code quality, and ensures the database remains understandable as the application evolves.

---

## 3.16 Summary

A consistent naming strategy is essential for building maintainable software systems.

By following Laravel conventions and established relational database design practices, the Portfolio Management System database remains intuitive, organized, and easy to extend.

The following chapter documents each database table in detail, including its purpose, columns, constraints, indexes, and relationships.

# 4. Database Tables

# 4.1 users

## 4.1.1 Purpose

The **users** table stores administrator accounts for the Portfolio Management System.

Users in this table are responsible for accessing the administration portal and managing all portfolio content, including projects, skills, education, certifications, testimonials, contact information, and multilingual translations.

This table is **not** intended to store public website visitors. Visitors interact with the system anonymously through the contact form without requiring authentication.

---

## 4.1.2 Table Information

| Property      | Value                            |
| ------------- | -------------------------------- |
| Table Name    | users                            |
| Purpose       | Administrator account management |
| Primary Key   | id                               |
| Engine        | InnoDB                           |
| Character Set | utf8mb4                          |
| Storage Type  | Business Entity                  |

---

## 4.1.3 Columns

| Column            | Data Type    | Nullable | Default           | Description                                               |
| ----------------- | ------------ | -------- | ----------------- | --------------------------------------------------------- |
| id                | BIGINT       | No       | Auto Increment    | Unique identifier for the administrator.                  |
| first_name        | VARCHAR(255) | No       | —                 | Administrator's first name.                               |
| last_name         | VARCHAR(255) | No       | —                 | Administrator's last name.                                |
| username          | VARCHAR(255) | No       | —                 | Unique username used for authentication.                  |
| email             | VARCHAR(255) | No       | —                 | Unique email address used for login and notifications.    |
| email_verified_at | TIMESTAMP    | Yes      | NULL              | Date and time when the email address was verified.        |
| password          | VARCHAR(255) | No       | —                 | Securely hashed user password.                            |
| photo             | VARCHAR(255) | Yes      | NULL              | Profile image path.                                       |
| active            | BOOLEAN      | No       | TRUE              | Indicates whether the account is active.                  |
| last_login_at     | TIMESTAMP    | Yes      | NULL              | Date and time of the most recent successful login.        |
| last_login_ip     | VARCHAR(45)  | Yes      | NULL              | IP address used during the last successful login.         |
| remember_token    | VARCHAR(100) | Yes      | NULL              | Token used for persistent authentication ("Remember Me"). |
| created_at        | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                                |
| updated_at        | TIMESTAMP    | No       | Current Timestamp | Record modification timestamp.                            |

---

## 4.1.4 Primary Key

| Column |
| ------ |
| id     |

The primary key uniquely identifies each administrator account within the system.

---

## 4.1.5 Unique Constraints

| Column   | Description                         |
| -------- | ----------------------------------- |
| username | Prevents duplicate usernames.       |
| email    | Prevents duplicate email addresses. |

---

## 4.1.6 Foreign Keys

This table does not contain any foreign keys.

---

## 4.1.7 Relationships

### One-to-Many

A single administrator may own multiple authenticated sessions.

| Related Table | Relationship                                                      |
| ------------- | ----------------------------------------------------------------- |
| sessions      | One User → Many Sessions (logical relationship through `user_id`) |

---

## 4.1.8 Indexes

| Column   | Type         |
| -------- | ------------ |
| id       | Primary Key  |
| username | Unique Index |
| email    | Unique Index |

These indexes improve authentication performance and enforce account uniqueness.

---

## 4.1.9 Business Rules

The following business rules apply to the **users** table:

* Every administrator must have a unique username.
* Every administrator must have a unique email address.
* Passwords must never be stored in plain text.
* Only hashed passwords are stored.
* Inactive users cannot access the administration portal.
* The last successful login date and IP address are updated after each successful authentication.
* Profile photos are optional.

---

## 4.1.10 Security Considerations

The **users** table stores sensitive authentication information.

Security measures include:

* Password hashing using Laravel's Hash facade.
* Unique authentication credentials.
* Session-based authentication.
* Optional email verification.
* Remember token support.
* Account activation status control.

No password is ever stored or transmitted in plain text.

---

## 4.1.11 Referenced By

The following tables reference the **users** table:

| Table    | Column  | Relationship                                           |
| -------- | ------- | ------------------------------------------------------ |
| sessions | user_id | Optional reference to the authenticated administrator. |

---

## 4.1.12 Notes

The **users** table is the core authentication entity of the Portfolio Management System.

Although the current implementation is designed for a single administrator, the schema supports multiple administrator accounts without requiring structural modifications, providing flexibility for future system expansion.


# 4.2 sessions

## 4.2.1 Purpose

The **sessions** table stores active user session information for authenticated administrators.

Laravel uses this table when the application is configured to use the **database session driver**. It maintains session state across HTTP requests and enables secure authentication throughout the administration portal.

Unlike business entities, this table is part of the application's infrastructure and is managed automatically by Laravel.

---

## 4.2.2 Table Information

| Property      | Value                |
| ------------- | -------------------- |
| Table Name    | sessions             |
| Purpose       | Session management   |
| Primary Key   | id                   |
| Engine        | InnoDB               |
| Character Set | utf8mb4              |
| Storage Type  | Infrastructure Table |

---

## 4.2.3 Columns

| Column        | Data Type    | Nullable | Default | Description                                              |
| ------------- | ------------ | -------- | ------- | -------------------------------------------------------- |
| id            | VARCHAR(255) | No       | —       | Unique session identifier.                               |
| user_id       | BIGINT       | Yes      | NULL    | Authenticated administrator associated with the session. |
| ip_address    | VARCHAR(45)  | Yes      | NULL    | Client IP address.                                       |
| user_agent    | TEXT         | Yes      | NULL    | Browser and operating system information.                |
| payload       | LONGTEXT     | No       | —       | Serialized session data managed by Laravel.              |
| last_activity | INTEGER      | No       | —       | UNIX timestamp representing the last activity time.      |

---

## 4.2.4 Primary Key

| Column |
| ------ |
| id     |

Each session is uniquely identified by its session identifier.

---

## 4.2.5 Foreign Keys

| Column  | References | On Delete                    |
| ------- | ---------- | ---------------------------- |
| user_id | users.id   | NULL (nullable relationship) |

The relationship is optional because unauthenticated sessions may exist before a user logs in.

---

## 4.2.6 Relationships

### Many-to-One

| Related Table | Relationship             |
| ------------- | ------------------------ |
| users         | Many Sessions → One User |

A single administrator may have multiple active sessions simultaneously.

---

## 4.2.7 Indexes

| Column        | Type        |
| ------------- | ----------- |
| id            | Primary Key |
| user_id       | Index       |
| last_activity | Index       |

These indexes improve session lookup performance and facilitate automatic cleanup of expired sessions.

---

## 4.2.8 Business Rules

The following rules apply to the **sessions** table:

* Every session must have a unique identifier.
* Session data is generated and maintained automatically by Laravel.
* A session may exist without an authenticated user.
* Expired sessions are periodically removed according to the application's session configuration.
* Session payload data should never be modified manually.

---

## 4.2.9 Security Considerations

The **sessions** table contains sensitive authentication data.

Security measures include:

* Secure random session identifiers.
* Server-side session storage.
* Automatic session expiration.
* Session regeneration after authentication to mitigate session fixation attacks.
* Protection through Laravel's session middleware.

The session payload is intended solely for internal framework use.

---

## 4.2.10 Referenced By

No other database tables reference the **sessions** table.

---

## 4.2.11 Notes

The **sessions** table is automatically managed by Laravel and requires no direct interaction from application developers.

Its primary purpose is to maintain authenticated administrator sessions securely and efficiently, ensuring consistent access control across the administration portal.

# 4.3 password_reset_tokens

## 4.3.1 Purpose

The **password_reset_tokens** table stores temporary password reset tokens used during the password recovery process.

When an administrator requests a password reset, Laravel generates a secure token and stores it in this table. The token is later validated before allowing the administrator to create a new password.

This table is managed automatically by Laravel's authentication system and is considered an infrastructure table rather than a business entity.

---

## 4.3.2 Table Information

| Property      | Value                 |
| ------------- | --------------------- |
| Table Name    | password_reset_tokens |
| Purpose       | Password recovery     |
| Primary Key   | email                 |
| Engine        | InnoDB                |
| Character Set | utf8mb4               |
| Storage Type  | Infrastructure Table  |

---

## 4.3.3 Columns

| Column     | Data Type    | Nullable | Default | Description                                               |
| ---------- | ------------ | -------- | ------- | --------------------------------------------------------- |
| email      | VARCHAR(255) | No       | —       | Email address associated with the password reset request. |
| token      | VARCHAR(255) | No       | —       | Secure password reset token generated by Laravel.         |
| created_at | TIMESTAMP    | Yes      | NULL    | Date and time when the reset token was created.           |

---

## 4.3.4 Primary Key

| Column |
| ------ |
| email  |

The email address acts as the primary key, ensuring that only one active password reset token exists per administrator.

---

## 4.3.5 Foreign Keys

This table does not define explicit foreign key constraints.

Although the **email** column corresponds to the administrator's email address in the **users** table, Laravel intentionally does not enforce a database-level foreign key because password reset requests may occur independently of application logic.

---

## 4.3.6 Relationships

### Logical Relationship

| Related Table | Relationship                                                                |
| ------------- | --------------------------------------------------------------------------- |
| users         | One User → One Active Password Reset Token (logical relationship via email) |

---

## 4.3.7 Indexes

| Column | Type        |
| ------ | ----------- |
| email  | Primary Key |

Since the primary key is the email address, no additional indexes are required.

---

## 4.3.8 Business Rules

The following business rules apply:

* Only one active reset token may exist for a given email address.
* Tokens are generated securely by Laravel.
* Tokens are temporary and expire according to the application's authentication configuration.
* A new password reset request replaces any existing token for the same email address.
* Tokens are removed after successful password reset or expiration.

---

## 4.3.9 Security Considerations

The **password_reset_tokens** table contains highly sensitive authentication data.

Security measures include:

* Cryptographically secure token generation.
* Temporary token validity.
* Token expiration based on application configuration.
* Protection against replay attacks by invalidating tokens after successful use.
* Password reset process handled entirely by Laravel's authentication system.

Administrators should never manually insert, update, or delete records in this table.

---

## 4.3.10 Referenced By

No database tables reference the **password_reset_tokens** table.

---

## 4.3.11 Notes

The **password_reset_tokens** table is part of Laravel's built-in authentication infrastructure.

Its purpose is limited to securely supporting the password recovery workflow for administrator accounts. Because the table is framework-managed, application code should interact with it only through Laravel's password reset services rather than direct database operations.

# 4.4 abouts

## 4.4.1 Purpose

The **abouts** table stores the language-independent information for the **About Me** section of the portfolio website.

This table contains only data that is common across all supported languages, such as the profile image and publication status. All multilingual content, including the user's name, professional title, biography, and availability text, is stored separately in the **about_translations** table.

This separation follows the application's multilingual database architecture and eliminates data duplication.

---

## 4.4.2 Table Information

| Property      | Value                                                 |
| ------------- | ----------------------------------------------------- |
| Table Name    | abouts                                                |
| Purpose       | Stores language-independent About section information |
| Primary Key   | id                                                    |
| Engine        | InnoDB                                                |
| Character Set | utf8mb4                                               |
| Storage Type  | Business Entity                                       |

---

## 4.4.3 Columns

| Column     | Data Type    | Nullable | Default           | Description                                                           |
| ---------- | ------------ | -------- | ----------------- | --------------------------------------------------------------------- |
| id         | BIGINT       | No       | Auto Increment    | Unique identifier of the About record.                                |
| available  | BOOLEAN      | No       | FALSE             | Indicates whether the About section is visible on the public website. |
| image      | VARCHAR(255) | Yes      | NULL              | Profile image displayed in the About section.                         |
| created_at | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                                            |
| updated_at | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                                          |

---

## 4.4.4 Primary Key

| Column |
| ------ |
| id     |

The primary key uniquely identifies each About record.

---

## 4.4.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.4.6 Relationships

### One-to-Many

| Related Table      | Relationship                        |
| ------------------ | ----------------------------------- |
| about_translations | One About → Many About Translations |

Each About record may have multiple translations, with one translation for each supported language.

---

## 4.4.7 Indexes

| Column | Type        |
| ------ | ----------- |
| id     | Primary Key |

No additional indexes are required due to the expected low volume of records.

---

## 4.4.8 Business Rules

The following business rules apply:

* The About section may be enabled or disabled using the **available** field.
* The profile image is shared across all languages.
* All textual information must be stored in the corresponding translation table.
* Every supported language should have exactly one translation record for each About entry.
* Deleting an About record automatically deletes all associated translations.

---

## 4.4.9 Security Considerations

The **abouts** table stores only public portfolio information and does not contain sensitive or confidential data.

Modification of records is restricted to authenticated administrators through the administration portal.

Image paths are validated before storage to ensure that only authorized files are referenced.

---

## 4.4.10 Referenced By

| Table              | Column   | Relationship |
| ------------------ | -------- | ------------ |
| about_translations | about_id | One-to-Many  |

The **about_translations** table references this table through the **about_id** foreign key.

---

## 4.4.11 Notes

The application is designed to support multiple About records if required in the future. However, under the current business requirements, the system is expected to maintain a single About entry representing the portfolio owner's profile.

Separating language-independent data from localized content improves normalization, simplifies localization, and allows new languages to be added without modifying the primary entity.

# 4.5 about_translations

## 4.5.1 Purpose

The **about_translations** table stores all language-dependent information for the **About Me** section of the portfolio website.

Rather than storing multilingual content directly within the **abouts** table, this table maintains a separate record for each supported language. This design allows the application to support unlimited languages while maintaining a normalized database structure.

Each record represents the localized content of a single About entity in one specific language.

---

## 4.5.2 Table Information

| Property      | Value                                  |
| ------------- | -------------------------------------- |
| Table Name    | about_translations                     |
| Purpose       | Stores localized About section content |
| Primary Key   | id                                     |
| Engine        | InnoDB                                 |
| Character Set | utf8mb4                                |
| Storage Type  | Translation Entity                     |

---

## 4.5.3 Columns

| Column            | Data Type    | Nullable | Default           | Description                                           |
| ----------------- | ------------ | -------- | ----------------- | ----------------------------------------------------- |
| id                | BIGINT       | No       | Auto Increment    | Unique identifier of the translation record.          |
| about_id          | BIGINT       | No       | —                 | References the About entity being translated.         |
| language_id       | BIGINT       | No       | —                 | References the language of the translation.           |
| name              | VARCHAR(255) | No       | —                 | Portfolio owner's name in the selected language.      |
| title             | VARCHAR(255) | No       | —                 | Professional title displayed in the About section.    |
| description       | TEXT         | No       | —                 | Biography or personal introduction.                   |
| availability_text | VARCHAR(255) | Yes      | NULL              | Localized availability message displayed to visitors. |
| created_at        | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                            |
| updated_at        | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                          |

---

## 4.5.4 Primary Key

| Column |
| ------ |
| id     |

Each translation record is uniquely identified by its primary key.

---

## 4.5.5 Foreign Keys

| Column      | References   | On Delete |
| ----------- | ------------ | --------- |
| about_id    | abouts.id    | Cascade   |
| language_id | languages.id | Cascade   |

Deleting either the parent About entity or the associated language automatically removes the translation record.

---

## 4.5.6 Relationships

### Many-to-One

| Related Table | Relationship                           |
| ------------- | -------------------------------------- |
| abouts        | Many About Translations → One About    |
| languages     | Many About Translations → One Language |

Each translation belongs to exactly one About entity and one language.

---

## 4.5.7 Unique Constraints

| Columns                |
| ---------------------- |
| about_id + language_id |

This composite unique constraint ensures that only one translation exists for a given About record in a specific language.

---

## 4.5.8 Indexes

| Column                 | Type                   |
| ---------------------- | ---------------------- |
| id                     | Primary Key            |
| about_id               | Foreign Key Index      |
| language_id            | Foreign Key Index      |
| about_id + language_id | Unique Composite Index |

These indexes improve lookup performance when retrieving translations.

---

## 4.5.9 Business Rules

The following business rules apply:

* Every translation must belong to an existing About record.
* Every translation must belong to an existing language.
* Each About entity may contain only one translation per language.
* Localized text is mandatory except for the availability message.
* The application retrieves translations according to the visitor's selected language.

---

## 4.5.10 Security Considerations

The **about_translations** table stores only public-facing content.

All text submitted through the administration portal is validated before persistence to prevent invalid or malicious input.

Modification of translation records is restricted to authenticated administrators.

---

## 4.5.11 Referenced By

No database tables reference the **about_translations** table.

---

## 4.5.12 Notes

The separation of localized content into the **about_translations** table is a core architectural principle of the Portfolio Management System.

This approach provides several benefits:

* Unlimited language support.
* Elimination of duplicated language-independent data.
* Simplified maintenance.
* Improved database normalization.
* Consistent localization strategy across all portfolio entities.

The same translation pattern is consistently applied throughout the application for other multilingual entities such as Experiences, Projects, Education, Certifications, Skills, Testimonials, and Contacts.

# 4.6 experiences

## 4.6.1 Purpose

The **experiences** table stores the language-independent information for the **Professional Experience** section of the Portfolio Management System.

Each record represents a professional work experience, including the employer, employment period, company logo, work location, technologies used, and display order.

Localized information such as the job position and job description is stored separately in the **experience_translations** table.

This separation follows the multilingual database architecture implemented throughout the application.

---

## 4.6.2 Table Information

| Property      | Value                                                           |
| ------------- | --------------------------------------------------------------- |
| Table Name    | experiences                                                     |
| Purpose       | Stores language-independent professional experience information |
| Primary Key   | id                                                              |
| Engine        | InnoDB                                                          |
| Character Set | utf8mb4                                                         |
| Storage Type  | Business Entity                                                 |

---

## 4.6.3 Columns

| Column       | Data Type        | Nullable | Default           | Description                                     |
| ------------ | ---------------- | -------- | ----------------- | ----------------------------------------------- |
| id           | BIGINT           | No       | Auto Increment    | Unique identifier of the experience record.     |
| company      | VARCHAR(255)     | No       | —                 | Employer or company name.                       |
| logo         | VARCHAR(255)     | Yes      | NULL              | Company logo image path.                        |
| location     | VARCHAR(255)     | Yes      | NULL              | Company location.                               |
| start_date   | DATE             | No       | —                 | Employment start date.                          |
| end_date     | DATE             | Yes      | NULL              | Employment end date.                            |
| current      | BOOLEAN          | No       | FALSE             | Indicates whether this is the current position. |
| technologies | JSON             | Yes      | NULL              | Technologies used during the employment period. |
| order        | UNSIGNED INTEGER | No       | 0                 | Display order on the portfolio website.         |
| created_at   | TIMESTAMP        | No       | Current Timestamp | Record creation timestamp.                      |
| updated_at   | TIMESTAMP        | No       | Current Timestamp | Last modification timestamp.                    |

---

## 4.6.4 Primary Key

| Column |
| ------ |
| id     |

Each professional experience is uniquely identified by its primary key.

---

## 4.6.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.6.6 Relationships

### One-to-Many

| Related Table           | Relationship                                  |
| ----------------------- | --------------------------------------------- |
| experience_translations | One Experience → Many Experience Translations |

Each experience may have multiple translations, with one translation for every supported language.

---

## 4.6.7 Indexes

| Column | Type        |
| ------ | ----------- |
| id     | Primary Key |

The table does not require additional indexes because portfolio experience records are relatively small in number and are typically retrieved as a complete ordered list.

---

## 4.6.8 Business Rules

The following business rules apply:

* Every experience must have a company name.
* Every experience must have a valid start date.
* If **current = TRUE**, the **end_date** should be NULL.
* Technologies are stored as a JSON array to support multiple technology entries.
* The **order** field determines the display sequence on the public portfolio.
* Localized information must be stored exclusively in the translation table.
* Deleting an experience automatically deletes all associated translations.

---

## 4.6.9 Security Considerations

The **experiences** table stores public portfolio information.

Only authenticated administrators may create, update, or delete records through the administration portal.

Uploaded company logos are validated before storage, and JSON technology data is validated to ensure correct formatting.

---

## 4.6.10 Referenced By

| Table                   | Column        | Relationship |
| ----------------------- | ------------- | ------------ |
| experience_translations | experience_id | One-to-Many  |

The **experience_translations** table references this entity through the **experience_id** foreign key.

---

## 4.6.11 Notes

The **experiences** table contains only language-independent data.

Fields such as the company name, employment dates, technologies, and logo remain identical regardless of the selected language. Textual content that varies by language, including the job position and detailed description, is stored separately in **experience_translations**.

This design maintains Third Normal Form (3NF), minimizes redundancy, and provides a consistent localization strategy across the Portfolio Management System.

# 4.7 experience_translations

## 4.7.1 Purpose

The **experience_translations** table stores all language-dependent information for professional experience records.

Each record contains the localized job position and description for a single experience in one specific language.

By separating multilingual content from the primary **experiences** table, the application supports unlimited languages while maintaining a normalized relational database structure.

---

## 4.7.2 Table Information

| Property      | Value                                                |
| ------------- | ---------------------------------------------------- |
| Table Name    | experience_translations                              |
| Purpose       | Stores localized professional experience information |
| Primary Key   | id                                                   |
| Engine        | InnoDB                                               |
| Character Set | utf8mb4                                              |
| Storage Type  | Translation Entity                                   |

---

## 4.7.3 Columns

| Column        | Data Type    | Nullable | Default           | Description                                                              |
| ------------- | ------------ | -------- | ----------------- | ------------------------------------------------------------------------ |
| id            | BIGINT       | No       | Auto Increment    | Unique identifier of the translation record.                             |
| experience_id | BIGINT       | No       | —                 | References the professional experience being translated.                 |
| language_id   | BIGINT       | No       | —                 | References the language of the translation.                              |
| position      | VARCHAR(255) | No       | —                 | Localized job title or position.                                         |
| description   | TEXT         | No       | —                 | Localized description of responsibilities, achievements, and experience. |
| created_at    | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                                               |
| updated_at    | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                                             |

---

## 4.7.4 Primary Key

| Column |
| ------ |
| id     |

Each translation record is uniquely identified by its primary key.

---

## 4.7.5 Foreign Keys

| Column        | References     | On Delete |
| ------------- | -------------- | --------- |
| experience_id | experiences.id | Cascade   |
| language_id   | languages.id   | Cascade   |

Cascade deletion ensures that translations are automatically removed when either the parent experience or the associated language is deleted.

---

## 4.7.6 Relationships

### Many-to-One

| Related Table | Relationship                                  |
| ------------- | --------------------------------------------- |
| experiences   | Many Experience Translations → One Experience |
| languages     | Many Experience Translations → One Language   |

Each translation belongs to exactly one professional experience and one language.

---

## 4.7.7 Unique Constraints

| Columns                     |
| --------------------------- |
| experience_id + language_id |

This composite unique constraint guarantees that only one translation exists for each experience in a particular language.

---

## 4.7.8 Indexes

| Column                      | Type                   |
| --------------------------- | ---------------------- |
| id                          | Primary Key            |
| experience_id               | Foreign Key Index      |
| language_id                 | Foreign Key Index      |
| experience_id + language_id | Unique Composite Index |

These indexes improve translation lookup performance while preventing duplicate translations.

---

## 4.7.9 Business Rules

The following business rules apply:

* Every translation must belong to an existing professional experience.
* Every translation must reference an existing language.
* A professional experience may have only one translation per language.
* Both the job position and description are mandatory.
* The application retrieves the translation corresponding to the visitor's selected language.

---

## 4.7.10 Security Considerations

The **experience_translations** table stores public-facing content.

Only authenticated administrators may create, modify, or remove translation records.

Input validation is performed before persistence to ensure data quality and to prevent malformed or malicious content from being stored.

---

## 4.7.11 Referenced By

No database tables reference the **experience_translations** table.

---

## 4.7.12 Notes

The **experience_translations** table implements the multilingual strategy used throughout the Portfolio Management System.

Separating localized content from language-independent information provides several advantages:

* Unlimited language support.
* Reduced data duplication.
* Improved maintainability.
* Better database normalization.
* Consistent localization architecture across all business entities.

This design pattern is reused by all other multilingual modules, including Projects, Education, Certifications, Skills, Testimonials, Contacts, and the About section.

# 4.8 project_types

## 4.8.1 Purpose

The **project_types** table stores the available categories used to classify portfolio projects.

Each project may optionally belong to a single project type, such as **Web Application**, **Mobile Application**, **Desktop Application**, **API**, or **Open Source**.

The table contains only language-independent information. The localized display name of each project type is stored separately in the **project_type_translations** table.

Using a dedicated classification table improves consistency, simplifies maintenance, and allows new project types to be added without modifying existing project records.

---

## 4.8.2 Table Information

| Property      | Value                                    |
| ------------- | ---------------------------------------- |
| Table Name    | project_types                            |
| Purpose       | Stores project classification categories |
| Primary Key   | id                                       |
| Engine        | InnoDB                                   |
| Character Set | utf8mb4                                  |
| Storage Type  | Classification Entity                    |

---

## 4.8.3 Columns

| Column     | Data Type    | Nullable | Default           | Description                                         |
| ---------- | ------------ | -------- | ----------------- | --------------------------------------------------- |
| id         | BIGINT       | No       | Auto Increment    | Unique identifier of the project type.              |
| slug       | VARCHAR(255) | No       | —                 | Unique machine-readable identifier.                 |
| color      | VARCHAR(7)   | Yes      | NULL              | Hexadecimal color associated with the project type. |
| created_at | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                          |
| updated_at | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                        |

---

## 4.8.4 Primary Key

| Column |
| ------ |
| id     |

Each project type is uniquely identified by its primary key.

---

## 4.8.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.8.6 Relationships

### One-to-Many

| Related Table             | Relationship                                      |
| ------------------------- | ------------------------------------------------- |
| projects                  | One Project Type → Many Projects                  |
| project_type_translations | One Project Type → Many Project Type Translations |

A single project type may classify multiple projects and may contain multiple translations.

---

## 4.8.7 Unique Constraints

| Column |
| ------ |
| slug   |

The slug uniquely identifies each project type throughout the application.

---

## 4.8.8 Indexes

| Column | Type         |
| ------ | ------------ |
| id     | Primary Key  |
| slug   | Unique Index |

The unique slug index enables efficient lookups and guarantees uniqueness.

---

## 4.8.9 Business Rules

The following business rules apply:

* Every project type must have a unique slug.
* The slug is language-independent and should never be translated.
* The color value is optional.
* Projects may reference a project type, but the relationship is optional.
* If a project type is deleted, related projects retain their records and their **project_type_id** is automatically set to **NULL**.
* Localized names are stored exclusively in the translation table.

---

## 4.8.10 Security Considerations

The **project_types** table stores administrative classification data.

Only authenticated administrators may create, update, or remove project types.

The slug must be validated to ensure uniqueness and consistency across the application.

Color values should be validated as hexadecimal color codes.

---

## 4.8.11 Referenced By

| Table                     | Column          | Relationship           |
| ------------------------- | --------------- | ---------------------- |
| projects                  | project_type_id | One-to-Many (Nullable) |
| project_type_translations | project_type_id | One-to-Many            |

The **projects** table references project types through an optional foreign key, while translations reference the parent classification entity.

---

## 4.8.12 Notes

The **project_types** table serves as a reusable classification entity shared by all portfolio projects.

Separating project classifications from the projects themselves provides several advantages:

* Centralized management of project categories.
* Consistent categorization across the application.
* Simplified localization through dedicated translation tables.
* Reduced data duplication.
* Easier expansion when introducing new project categories in future versions of the system.

# 4.9 project_type_translations

## 4.9.1 Purpose

The **project_type_translations** table stores the localized names of project types.

Each record represents the translation of a single project type in one specific language. This allows project categories to be displayed appropriately based on the visitor's selected language while keeping language-independent information centralized in the **project_types** table.

This table is part of the application's multilingual architecture and follows the same translation pattern used throughout the Portfolio Management System.

---

## 4.9.2 Table Information

| Property      | Value                               |
| ------------- | ----------------------------------- |
| Table Name    | project_type_translations           |
| Purpose       | Stores localized project type names |
| Primary Key   | id                                  |
| Engine        | InnoDB                              |
| Character Set | utf8mb4                             |
| Storage Type  | Translation Entity                  |

---

## 4.9.3 Columns

| Column          | Data Type    | Nullable | Default           | Description                                   |
| --------------- | ------------ | -------- | ----------------- | --------------------------------------------- |
| id              | BIGINT       | No       | Auto Increment    | Unique identifier of the translation record.  |
| project_type_id | BIGINT       | No       | —                 | References the project type being translated. |
| language_id     | BIGINT       | No       | —                 | References the language of the translation.   |
| name            | VARCHAR(255) | No       | —                 | Localized display name of the project type.   |
| created_at      | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                    |
| updated_at      | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                  |

---

## 4.9.4 Primary Key

| Column |
| ------ |
| id     |

Each translation record is uniquely identified by its primary key.

---

## 4.9.5 Foreign Keys

| Column          | References       | On Delete |
| --------------- | ---------------- | --------- |
| project_type_id | project_types.id | Cascade   |
| language_id     | languages.id     | Cascade   |

Cascade deletion ensures that translations are automatically removed when either the parent project type or the associated language is deleted.

---

## 4.9.6 Relationships

### Many-to-One

| Related Table | Relationship                                      |
| ------------- | ------------------------------------------------- |
| project_types | Many Project Type Translations → One Project Type |
| languages     | Many Project Type Translations → One Language     |

Each translation belongs to exactly one project type and one language.

---

## 4.9.7 Unique Constraints

| Columns                       |
| ----------------------------- |
| project_type_id + language_id |

This composite unique constraint guarantees that only one translation exists for each project type in a given language.

---

## 4.9.8 Indexes

| Column                        | Type                   |
| ----------------------------- | ---------------------- |
| id                            | Primary Key            |
| project_type_id               | Foreign Key Index      |
| language_id                   | Foreign Key Index      |
| project_type_id + language_id | Unique Composite Index |

These indexes improve translation retrieval performance and prevent duplicate localization records.

---

## 4.9.9 Business Rules

The following business rules apply:

* Every translation must belong to an existing project type.
* Every translation must reference an existing language.
* Each project type may have only one translation per language.
* The translated name is mandatory.
* The application selects the appropriate translation according to the visitor's currently selected language.

---

## 4.9.10 Security Considerations

The **project_type_translations** table stores only public-facing localization data.

Only authenticated administrators are permitted to create, modify, or delete translation records.

All translated names are validated before persistence to ensure consistency and prevent invalid input.

---

## 4.9.11 Referenced By

No database tables reference the **project_type_translations** table.

---

## 4.9.12 Notes

The **project_type_translations** table allows project categories to be presented naturally in every supported language while maintaining a normalized database design.

Separating localized labels from the primary classification entity provides:

* Unlimited language support.
* Simplified maintenance.
* Consistent multilingual architecture.
* Reduced data redundancy.
* Easier expansion when introducing additional languages.

This translation strategy is consistently applied across all multilingual entities within the Portfolio Management System.

# 4.10 project_statuses

## 4.10.1 Purpose

The **project_statuses** table stores the lifecycle status classifications assigned to portfolio projects.

Each project may optionally reference a project status to indicate its current development stage, such as **Completed**, **In Progress**, **Maintenance**, **Planned**, or **Archived**.

The table contains only language-independent information. Localized status names are stored separately in the **project_status_translations** table.

Using a dedicated status table ensures consistency across all projects and simplifies future expansion.

---

## 4.10.2 Table Information

| Property      | Value                             |
| ------------- | --------------------------------- |
| Table Name    | project_statuses                  |
| Purpose       | Stores project lifecycle statuses |
| Primary Key   | id                                |
| Engine        | InnoDB                            |
| Character Set | utf8mb4                           |
| Storage Type  | Classification Entity             |

---

## 4.10.3 Columns

| Column     | Data Type    | Nullable | Default           | Description                                   |
| ---------- | ------------ | -------- | ----------------- | --------------------------------------------- |
| id         | BIGINT       | No       | Auto Increment    | Unique identifier of the project status.      |
| slug       | VARCHAR(255) | No       | —                 | Unique machine-readable status identifier.    |
| color      | VARCHAR(7)   | Yes      | NULL              | Hexadecimal color associated with the status. |
| created_at | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                    |
| updated_at | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                  |

---

## 4.10.4 Primary Key

| Column |
| ------ |
| id     |

Each project status is uniquely identified by its primary key.

---

## 4.10.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.10.6 Relationships

### One-to-Many

| Related Table               | Relationship                                          |
| --------------------------- | ----------------------------------------------------- |
| projects                    | One Project Status → Many Projects                    |
| project_status_translations | One Project Status → Many Project Status Translations |

Each project status may be assigned to multiple projects and may contain multiple localized translations.

---

## 4.10.7 Unique Constraints

| Column |
| ------ |
| slug   |

Each status slug must be unique throughout the system.

---

## 4.10.8 Indexes

| Column | Type         |
| ------ | ------------ |
| id     | Primary Key  |
| slug   | Unique Index |

The unique slug index enables efficient retrieval and prevents duplicate status definitions.

---

## 4.10.9 Business Rules

The following business rules apply:

* Every project status must have a unique slug.
* The slug is language-independent and must remain stable.
* The color value is optional and may be used for visual representation within the user interface.
* Projects may reference a project status, but the relationship is optional.
* If a project status is deleted, related projects remain intact and their **project_status_id** is automatically set to **NULL**.
* Localized status names are maintained exclusively in the translation table.

---

## 4.10.10 Security Considerations

The **project_statuses** table stores administrative configuration data.

Only authenticated administrators may create, modify, or remove project statuses.

Slug uniqueness and color formatting are validated before persistence.

---

## 4.10.11 Referenced By

| Table                       | Column            | Relationship           |
| --------------------------- | ----------------- | ---------------------- |
| projects                    | project_status_id | One-to-Many (Nullable) |
| project_status_translations | project_status_id | One-to-Many            |

Projects optionally reference a project status, while translations reference the parent status entity.

---

## 4.10.12 Notes

The **project_statuses** table centralizes project lifecycle management within the Portfolio Management System.

Separating status definitions into a dedicated classification entity provides several advantages:

* Standardized project lifecycle terminology.
* Simplified management of status values.
* Consistent visual representation through optional color codes.
* Efficient localization using dedicated translation tables.
* Reduced redundancy and improved maintainability.

This design follows the same architectural pattern as **project_types**, ensuring consistency across the application's classification entities.

# 4.11 project_status_translations

## 4.11.1 Purpose

The **project_status_translations** table stores the localized display names of project statuses.

Each record represents the translation of a single project status in one specific language. This allows project statuses to be presented in the visitor's selected language while maintaining language-independent information within the **project_statuses** table.

This table follows the multilingual architecture implemented throughout the Portfolio Management System.

---

## 4.11.2 Table Information

| Property      | Value                                 |
| ------------- | ------------------------------------- |
| Table Name    | project_status_translations           |
| Purpose       | Stores localized project status names |
| Primary Key   | id                                    |
| Engine        | InnoDB                                |
| Character Set | utf8mb4                               |
| Storage Type  | Translation Entity                    |

---

## 4.11.3 Columns

| Column            | Data Type    | Nullable | Default           | Description                                     |
| ----------------- | ------------ | -------- | ----------------- | ----------------------------------------------- |
| id                | BIGINT       | No       | Auto Increment    | Unique identifier of the translation record.    |
| project_status_id | BIGINT       | No       | —                 | References the project status being translated. |
| language_id       | BIGINT       | No       | —                 | References the language of the translation.     |
| name              | VARCHAR(255) | No       | —                 | Localized display name of the project status.   |
| created_at        | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                      |
| updated_at        | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                    |

---

## 4.11.4 Primary Key

| Column |
| ------ |
| id     |

Each translation record is uniquely identified by its primary key.

---

## 4.11.5 Foreign Keys

| Column            | References          | On Delete |
| ----------------- | ------------------- | --------- |
| project_status_id | project_statuses.id | Cascade   |
| language_id       | languages.id        | Cascade   |

Cascade deletion ensures that translation records are automatically removed if either the parent project status or the associated language is deleted.

---

## 4.11.6 Relationships

### Many-to-One

| Related Table    | Relationship                                          |
| ---------------- | ----------------------------------------------------- |
| project_statuses | Many Project Status Translations → One Project Status |
| languages        | Many Project Status Translations → One Language       |

Each translation belongs to exactly one project status and one language.

---

## 4.11.7 Unique Constraints

| Columns                         |
| ------------------------------- |
| project_status_id + language_id |

This composite unique constraint guarantees that only one translation exists for each project status in a given language.

---

## 4.11.8 Indexes

| Column                          | Type                   |
| ------------------------------- | ---------------------- |
| id                              | Primary Key            |
| project_status_id               | Foreign Key Index      |
| language_id                     | Foreign Key Index      |
| project_status_id + language_id | Unique Composite Index |

These indexes improve localization lookup performance while preventing duplicate translations.

---

## 4.11.9 Business Rules

The following business rules apply:

* Every translation must belong to an existing project status.
* Every translation must reference an existing language.
* A project status may have only one translation per language.
* The translated status name is mandatory.
* The application retrieves the translation corresponding to the currently selected language.

---

## 4.11.10 Security Considerations

The **project_status_translations** table contains only public localization data.

Modification of translation records is restricted to authenticated administrators.

Input validation ensures that translated names are valid and consistent across supported languages.

---

## 4.11.11 Referenced By

No database tables reference the **project_status_translations** table.

---

## 4.11.12 Notes

The **project_status_translations** table completes the multilingual implementation of project lifecycle classifications.

Separating localized names from the parent **project_statuses** entity provides several benefits:

* Unlimited language support.
* Centralized status management.
* Reduced data redundancy.
* Improved maintainability.
* Consistent localization architecture throughout the application.

This implementation mirrors the translation strategy used for all other multilingual entities within the Portfolio Management System, ensuring a uniform and scalable database design.

# 4.12 projects

## 4.12.1 Purpose

The **projects** table is the central entity of the Portfolio Management System. It stores the language-independent information for every portfolio project displayed on the public website.

Each record represents a single project and contains its technical metadata, publication settings, repository links, live demonstration links, development timeline, associated technologies, and relationships with project classifications.

Localized information such as the project title, summary, and detailed description is stored separately in the **project_translations** table.

---

## 4.12.2 Table Information

| Property      | Value                                                     |
| ------------- | --------------------------------------------------------- |
| Table Name    | projects                                                  |
| Purpose       | Stores language-independent portfolio project information |
| Primary Key   | id                                                        |
| Engine        | InnoDB                                                    |
| Character Set | utf8mb4                                                   |
| Storage Type  | Business Entity                                           |

---

## 4.12.3 Columns

| Column            | Data Type        | Nullable | Default           | Description                                          |
| ----------------- | ---------------- | -------- | ----------------- | ---------------------------------------------------- |
| id                | BIGINT           | No       | Auto Increment    | Unique identifier of the project.                    |
| project_type_id   | BIGINT           | Yes      | NULL              | References the project classification.               |
| project_status_id | BIGINT           | Yes      | NULL              | References the project lifecycle status.             |
| slug              | VARCHAR(255)     | No       | —                 | Unique machine-readable project identifier.          |
| github_url        | VARCHAR(255)     | Yes      | NULL              | URL of the project's source code repository.         |
| live_url          | VARCHAR(255)     | Yes      | NULL              | URL of the deployed project.                         |
| start_date        | DATE             | Yes      | NULL              | Project development start date.                      |
| end_date          | DATE             | Yes      | NULL              | Project completion date.                             |
| featured          | BOOLEAN          | No       | FALSE             | Indicates whether the project should be highlighted. |
| technologies      | JSON             | Yes      | NULL              | Technologies used during project development.        |
| order             | UNSIGNED INTEGER | No       | 0                 | Display order on the portfolio website.              |
| created_at        | TIMESTAMP        | No       | Current Timestamp | Record creation timestamp.                           |
| updated_at        | TIMESTAMP        | No       | Current Timestamp | Last modification timestamp.                         |

---

## 4.12.4 Primary Key

| Column |
| ------ |
| id     |

Each project is uniquely identified by its primary key.

---

## 4.12.5 Foreign Keys

| Column            | References          | On Delete |
| ----------------- | ------------------- | --------- |
| project_type_id   | project_types.id    | Set NULL  |
| project_status_id | project_statuses.id | Set NULL  |

Both foreign keys are optional, allowing projects to remain valid even if their classification records are removed.

---

## 4.12.6 Relationships

### Many-to-One

| Related Table    | Relationship                       |
| ---------------- | ---------------------------------- |
| project_types    | Many Projects → One Project Type   |
| project_statuses | Many Projects → One Project Status |

### One-to-Many

| Related Table        | Relationship                            |
| -------------------- | --------------------------------------- |
| project_translations | One Project → Many Project Translations |
| project_images       | One Project → Many Project Images       |

Each project may contain multiple translations and multiple images.

---

## 4.12.7 Unique Constraints

| Column |
| ------ |
| slug   |

The slug uniquely identifies every project and is used to generate SEO-friendly URLs.

---

## 4.12.8 Indexes

| Column            | Type              |
| ----------------- | ----------------- |
| id                | Primary Key       |
| slug              | Unique Index      |
| project_type_id   | Foreign Key Index |
| project_status_id | Foreign Key Index |

These indexes optimize project retrieval, filtering, and routing operations.

---

## 4.12.9 Business Rules

The following business rules apply:

* Every project must have a unique slug.
* A project may optionally belong to a project type.
* A project may optionally have a project status.
* Multiple technologies are stored as a JSON array.
* Repository and live demonstration URLs are optional.
* Featured projects receive higher visibility on the public portfolio.
* Display order is controlled through the **order** column.
* All multilingual content is stored exclusively in the translation table.
* Deleting a project automatically removes its translations and associated images.

---

## 4.12.10 Security Considerations

The **projects** table stores public portfolio information.

Only authenticated administrators may manage project records through the administration portal.

Project URLs, JSON technology data, and uploaded assets are validated before persistence to ensure data integrity and security.

---

## 4.12.11 Referenced By

| Table                | Column     | Relationship |
| -------------------- | ---------- | ------------ |
| project_translations | project_id | One-to-Many  |
| project_images       | project_id | One-to-Many  |

The **project_translations** and **project_images** tables reference the parent project entity.

---

## 4.12.12 Notes

The **projects** table is one of the core entities of the Portfolio Management System and serves as the foundation for showcasing professional work.

Its design intentionally separates language-independent metadata from localized content, providing:

* Full multilingual support.
* SEO-friendly routing through unique slugs.
* Flexible project classification.
* Support for multiple project images.
* Simplified maintenance and scalability.
* Compliance with Third Normal Form (3NF).

This modular architecture enables the portfolio to grow without requiring structural changes to the database.

# 4.13 project_translations

## 4.13.1 Purpose

The **project_translations** table stores all language-dependent content for portfolio projects.

Each record represents the localized information of a single project in one specific language. This includes the project title, short summary, detailed description, and optional SEO metadata.

By separating multilingual content from the primary **projects** table, the application supports unlimited languages while maintaining a normalized relational database structure.

---

## 4.13.2 Table Information

| Property      | Value                            |
| ------------- | -------------------------------- |
| Table Name    | project_translations             |
| Purpose       | Stores localized project content |
| Primary Key   | id                               |
| Engine        | InnoDB                           |
| Character Set | utf8mb4                          |
| Storage Type  | Translation Entity               |

---

## 4.13.3 Columns

| Column            | Data Type    | Nullable | Default           | Description                                            |
| ----------------- | ------------ | -------- | ----------------- | ------------------------------------------------------ |
| id                | BIGINT       | No       | Auto Increment    | Unique identifier of the translation record.           |
| project_id        | BIGINT       | No       | —                 | References the project being translated.               |
| language_id       | BIGINT       | No       | —                 | References the language of the translation.            |
| title             | VARCHAR(255) | No       | —                 | Localized project title.                               |
| short_description | TEXT         | Yes      | NULL              | Short summary displayed in project cards and previews. |
| description       | LONGTEXT     | No       | —                 | Detailed project description.                          |
| seo_title         | VARCHAR(255) | Yes      | NULL              | Localized SEO page title.                              |
| seo_description   | TEXT         | Yes      | NULL              | Localized SEO meta description.                        |
| created_at        | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                             |
| updated_at        | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                           |

---

## 4.13.4 Primary Key

| Column |
| ------ |
| id     |

Each translation record is uniquely identified by its primary key.

---

## 4.13.5 Foreign Keys

| Column      | References   | On Delete |
| ----------- | ------------ | --------- |
| project_id  | projects.id  | Cascade   |
| language_id | languages.id | Cascade   |

Cascade deletion ensures that translations are automatically removed when either the parent project or the associated language is deleted.

---

## 4.13.6 Relationships

### Many-to-One

| Related Table | Relationship                             |
| ------------- | ---------------------------------------- |
| projects      | Many Project Translations → One Project  |
| languages     | Many Project Translations → One Language |

Each translation belongs to exactly one project and one language.

---

## 4.13.7 Unique Constraints

| Columns                  |
| ------------------------ |
| project_id + language_id |

This composite unique constraint guarantees that only one translation exists for each project in a given language.

---

## 4.13.8 Indexes

| Column                   | Type                   |
| ------------------------ | ---------------------- |
| id                       | Primary Key            |
| project_id               | Foreign Key Index      |
| language_id              | Foreign Key Index      |
| project_id + language_id | Unique Composite Index |

These indexes optimize multilingual content retrieval while preventing duplicate translation records.

---

## 4.13.9 Business Rules

The following business rules apply:

* Every translation must belong to an existing project.
* Every translation must reference an existing language.
* A project may have only one translation per language.
* The project title and detailed description are mandatory.
* The short description and SEO metadata are optional.
* The application retrieves the translation that matches the visitor's currently selected language.

---

## 4.13.10 Security Considerations

The **project_translations** table stores public-facing content.

Only authenticated administrators may create, update, or delete translation records.

All text fields are validated before persistence to ensure content quality and to prevent invalid or malicious input.

---

## 4.13.11 Referenced By

No database tables reference the **project_translations** table.

---

## 4.13.12 Notes

The **project_translations** table provides the multilingual content layer for one of the most important entities within the Portfolio Management System.

Separating localized content from language-independent project metadata provides several advantages:

* Unlimited language support.
* Reduced data redundancy.
* Improved database normalization.
* Centralized project metadata.
* Consistent localization architecture.
* Simplified maintenance and future scalability.

This implementation follows the same translation strategy used throughout the application, ensuring a uniform database design across all multilingual entities.

# 4.14 project_images

## 4.14.1 Purpose

The **project_images** table stores the images associated with portfolio projects.

Each project may contain multiple images that are displayed in galleries, sliders, previews, or detailed project pages. Images are stored independently from the main **projects** table to support an unlimited number of images per project and to maintain database normalization.

This table contains only image metadata. The actual image files are stored in the application's file storage.

---

## 4.14.2 Table Information

| Property      | Value                            |
| ------------- | -------------------------------- |
| Table Name    | project_images                   |
| Purpose       | Stores project image information |
| Primary Key   | id                               |
| Engine        | InnoDB                           |
| Character Set | utf8mb4                          |
| Storage Type  | Business Entity                  |

---

## 4.14.3 Columns

| Column     | Data Type        | Nullable | Default           | Description                                                       |
| ---------- | ---------------- | -------- | ----------------- | ----------------------------------------------------------------- |
| id         | BIGINT           | No       | Auto Increment    | Unique identifier of the project image.                           |
| project_id | BIGINT           | No       | —                 | References the parent project.                                    |
| image      | VARCHAR(255)     | No       | —                 | Relative path of the stored image.                                |
| alt_text   | VARCHAR(255)     | Yes      | NULL              | Alternative text used for accessibility and SEO.                  |
| featured   | BOOLEAN          | No       | FALSE             | Indicates whether the image is the primary image for the project. |
| order      | UNSIGNED INTEGER | No       | 0                 | Display order within the project gallery.                         |
| created_at | TIMESTAMP        | No       | Current Timestamp | Record creation timestamp.                                        |
| updated_at | TIMESTAMP        | No       | Current Timestamp | Last modification timestamp.                                      |

---

## 4.14.4 Primary Key

| Column |
| ------ |
| id     |

Each project image is uniquely identified by its primary key.

---

## 4.14.5 Foreign Keys

| Column     | References  | On Delete |
| ---------- | ----------- | --------- |
| project_id | projects.id | Cascade   |

Cascade deletion ensures that all images belonging to a project are automatically removed when the parent project is deleted.

---

## 4.14.6 Relationships

### Many-to-One

| Related Table | Relationship                      |
| ------------- | --------------------------------- |
| projects      | Many Project Images → One Project |

Each image belongs to exactly one project, while each project may contain multiple images.

---

## 4.14.7 Indexes

| Column     | Type              |
| ---------- | ----------------- |
| id         | Primary Key       |
| project_id | Foreign Key Index |

These indexes optimize image retrieval for project galleries.

---

## 4.14.8 Business Rules

The following business rules apply:

* Every image must belong to an existing project.
* Every image must have a valid file path.
* The **featured** field identifies the primary image displayed in project listings.
* Images are displayed according to the **order** column.
* The alternative text is optional but recommended for accessibility and search engine optimization.
* Deleting a project automatically deletes all associated image records.

---

## 4.14.9 Security Considerations

The **project_images** table stores only metadata describing uploaded images.

Security measures include:

* Image type validation before upload.
* File size validation.
* Secure storage of uploaded files.
* Validation of image paths before persistence.
* Administrative access only for image management.

The actual binary image data is never stored directly in the database.

---

## 4.14.10 Referenced By

No database tables reference the **project_images** table.

---

## 4.14.11 Notes

The **project_images** table provides a flexible gallery system for portfolio projects.

Separating images from the **projects** table offers several advantages:

* Unlimited number of images per project.
* Cleaner database normalization.
* Improved maintainability.
* Independent image ordering.
* Support for featured images.
* Easier future expansion, such as image captions, thumbnails, or multiple image formats.

This design ensures that the Portfolio Management System can efficiently manage rich visual content while maintaining a scalable relational database structure.

# 4.15 education

## 4.15.1 Purpose

The **education** table stores the language-independent information for the **Education** section of the Portfolio Management System.

Each record represents an educational qualification, degree, diploma, or academic achievement. The table contains institution-specific and timeline information that remains identical across all supported languages.

Localized content such as the degree title, field of study, and educational description is stored separately in the **education_translations** table.

This design follows the multilingual architecture implemented throughout the application.

---

## 4.15.2 Table Information

| Property      | Value                                             |
| ------------- | ------------------------------------------------- |
| Table Name    | education                                         |
| Purpose       | Stores language-independent education information |
| Primary Key   | id                                                |
| Engine        | InnoDB                                            |
| Character Set | utf8mb4                                           |
| Storage Type  | Business Entity                                   |

---

## 4.15.3 Columns

| Column      | Data Type        | Nullable | Default           | Description                                           |
| ----------- | ---------------- | -------- | ----------------- | ----------------------------------------------------- |
| id          | BIGINT           | No       | Auto Increment    | Unique identifier of the education record.            |
| institution | VARCHAR(255)     | No       | —                 | Name of the educational institution.                  |
| logo        | VARCHAR(255)     | Yes      | NULL              | Institution logo image path.                          |
| location    | VARCHAR(255)     | Yes      | NULL              | Institution location.                                 |
| start_date  | DATE             | No       | —                 | Education start date.                                 |
| end_date    | DATE             | Yes      | NULL              | Graduation or completion date.                        |
| current     | BOOLEAN          | No       | FALSE             | Indicates whether the education is currently ongoing. |
| order       | UNSIGNED INTEGER | No       | 0                 | Display order on the portfolio website.               |
| created_at  | TIMESTAMP        | No       | Current Timestamp | Record creation timestamp.                            |
| updated_at  | TIMESTAMP        | No       | Current Timestamp | Last modification timestamp.                          |

---

## 4.15.4 Primary Key

| Column |
| ------ |
| id     |

Each education record is uniquely identified by its primary key.

---

## 4.15.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.15.6 Relationships

### One-to-Many

| Related Table          | Relationship                                |
| ---------------------- | ------------------------------------------- |
| education_translations | One Education → Many Education Translations |

Each education record may have multiple translations, with one translation for every supported language.

---

## 4.15.7 Indexes

| Column | Type        |
| ------ | ----------- |
| id     | Primary Key |

No additional indexes are required due to the relatively small number of education records.

---

## 4.15.8 Business Rules

The following business rules apply:

* Every education record must have an institution name.
* Every education record must have a valid start date.
* If **current = TRUE**, the **end_date** should be NULL.
* Institution logos are optional.
* The **order** field determines the display sequence on the public portfolio.
* Localized information must be stored exclusively in the translation table.
* Deleting an education record automatically deletes all associated translations.

---

## 4.15.9 Security Considerations

The **education** table stores only publicly visible portfolio information.

Only authenticated administrators may create, update, or delete education records through the administration portal.

Uploaded institution logos are validated before storage to ensure file integrity and security.

---

## 4.15.10 Referenced By

| Table                  | Column       | Relationship |
| ---------------------- | ------------ | ------------ |
| education_translations | education_id | One-to-Many  |

The **education_translations** table references this entity through the **education_id** foreign key.

---

## 4.15.11 Notes

The **education** table stores only language-independent academic information.

Details such as institution name, study period, logo, and location remain constant regardless of language, while translated content such as the degree title, field of study, and academic description is maintained separately in the **education_translations** table.

This separation improves normalization, simplifies localization, and ensures consistency with the multilingual architecture used throughout the Portfolio Management System.

# 4.16 education_translations

## 4.16.1 Purpose

The **education_translations** table stores all language-dependent information for education records.

Each record contains the localized academic information for a single education entry in one specific language, including the degree name, field of study, and educational description.

Separating localized content from the **education** table enables the Portfolio Management System to support multiple languages while maintaining a normalized relational database structure.

---

## 4.16.2 Table Information

| Property      | Value                                  |
| ------------- | -------------------------------------- |
| Table Name    | education_translations                 |
| Purpose       | Stores localized education information |
| Primary Key   | id                                     |
| Engine        | InnoDB                                 |
| Character Set | utf8mb4                                |
| Storage Type  | Translation Entity                     |

---

## 4.16.3 Columns

| Column         | Data Type    | Nullable | Default           | Description                                                          |
| -------------- | ------------ | -------- | ----------------- | -------------------------------------------------------------------- |
| id             | BIGINT       | No       | Auto Increment    | Unique identifier of the translation record.                         |
| education_id   | BIGINT       | No       | —                 | References the education record being translated.                    |
| language_id    | BIGINT       | No       | —                 | References the language of the translation.                          |
| degree         | VARCHAR(255) | No       | —                 | Localized degree or qualification name.                              |
| field_of_study | VARCHAR(255) | Yes      | NULL              | Localized field of study or specialization.                          |
| description    | TEXT         | Yes      | NULL              | Localized description of the education, achievements, or coursework. |
| created_at     | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                                           |
| updated_at     | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                                         |

---

## 4.16.4 Primary Key

| Column |
| ------ |
| id     |

Each translation record is uniquely identified by its primary key.

---

## 4.16.5 Foreign Keys

| Column       | References   | On Delete |
| ------------ | ------------ | --------- |
| education_id | education.id | Cascade   |
| language_id  | languages.id | Cascade   |

Cascade deletion ensures that translations are automatically removed when either the parent education record or the associated language is deleted.

---

## 4.16.6 Relationships

### Many-to-One

| Related Table | Relationship                                |
| ------------- | ------------------------------------------- |
| education     | Many Education Translations → One Education |
| languages     | Many Education Translations → One Language  |

Each translation belongs to exactly one education record and one language.

---

## 4.16.7 Unique Constraints

| Columns                    |
| -------------------------- |
| education_id + language_id |

This composite unique constraint guarantees that only one translation exists for each education entry in a given language.

---

## 4.16.8 Indexes

| Column                     | Type                   |
| -------------------------- | ---------------------- |
| id                         | Primary Key            |
| education_id               | Foreign Key Index      |
| language_id                | Foreign Key Index      |
| education_id + language_id | Unique Composite Index |

These indexes improve translation retrieval performance while preventing duplicate localization records.

---

## 4.16.9 Business Rules

The following business rules apply:

* Every translation must belong to an existing education record.
* Every translation must reference an existing language.
* Each education entry may have only one translation per language.
* The degree name is mandatory.
* The field of study and description are optional.
* The application retrieves the translation corresponding to the visitor's selected language.

---

## 4.16.10 Security Considerations

The **education_translations** table stores public-facing academic information.

Only authenticated administrators may create, update, or delete translation records.

All localized content is validated before persistence to ensure consistency and prevent invalid or malicious input.

---

## 4.16.11 Referenced By

No database tables reference the **education_translations** table.

---

## 4.16.12 Notes

The **education_translations** table provides multilingual support for the Education section of the portfolio.

Separating localized content from the primary **education** entity provides several advantages:

* Unlimited language support.
* Elimination of duplicated data.
* Improved database normalization.
* Easier maintenance.
* Consistent multilingual architecture.
* Simplified addition of new languages.

This implementation follows the same localization strategy used throughout the Portfolio Management System for About, Experiences, Projects, Certifications, Skills, Testimonials, and Contacts.

# 4.17 certifications

## 4.17.1 Purpose

The **certifications** table stores the language-independent information for professional certifications, licenses, and credentials displayed within the Portfolio Management System.

Each record represents a single certification earned by the portfolio owner. The table contains information such as issue dates, expiration dates, credential identifiers, verification links, certificate images, and display order.

Localized information, including the certification title, issuing organization, country, and description, is stored separately in the **certification_translations** table.

This design follows the multilingual architecture implemented throughout the application.

---

## 4.17.2 Table Information

| Property      | Value                                                 |
| ------------- | ----------------------------------------------------- |
| Table Name    | certifications                                        |
| Purpose       | Stores language-independent certification information |
| Primary Key   | id                                                    |
| Engine        | InnoDB                                                |
| Character Set | utf8mb4                                               |
| Storage Type  | Business Entity                                       |

---

## 4.17.3 Columns

| Column          | Data Type        | Nullable | Default           | Description                                    |
| --------------- | ---------------- | -------- | ----------------- | ---------------------------------------------- |
| id              | BIGINT           | No       | Auto Increment    | Unique identifier of the certification.        |
| issue_date      | DATE             | No       | —                 | Date the certification was issued.             |
| expiration_date | DATE             | Yes      | NULL              | Certification expiration date, if applicable.  |
| credential_id   | VARCHAR(255)     | Yes      | NULL              | Official credential or certificate identifier. |
| credential_url  | VARCHAR(255)     | Yes      | NULL              | URL for online credential verification.        |
| image           | VARCHAR(255)     | Yes      | NULL              | Certificate image or badge path.               |
| order           | UNSIGNED INTEGER | No       | 0                 | Display order on the portfolio website.        |
| created_at      | TIMESTAMP        | No       | Current Timestamp | Record creation timestamp.                     |
| updated_at      | TIMESTAMP        | No       | Current Timestamp | Last modification timestamp.                   |

---

## 4.17.4 Primary Key

| Column |
| ------ |
| id     |

Each certification is uniquely identified by its primary key.

---

## 4.17.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.17.6 Relationships

### One-to-Many

| Related Table              | Relationship                                        |
| -------------------------- | --------------------------------------------------- |
| certification_translations | One Certification → Many Certification Translations |

Each certification may have multiple translations, with one translation for every supported language.

---

## 4.17.7 Indexes

| Column | Type        |
| ------ | ----------- |
| id     | Primary Key |

No additional indexes are required because certification records are typically retrieved as an ordered collection.

---

## 4.17.8 Business Rules

The following business rules apply:

* Every certification must have an issue date.
* Certifications without an expiration date are considered permanently valid.
* Credential identifiers and verification URLs are optional.
* Certificate images are optional.
* The **order** field controls the presentation order on the public portfolio.
* All localized information must be stored in the **certification_translations** table.
* Deleting a certification automatically removes all associated translations.

---

## 4.17.9 Security Considerations

The **certifications** table stores public professional information.

Only authenticated administrators may create, modify, or delete certification records.

Credential verification URLs and uploaded certificate images are validated before persistence to ensure data integrity.

---

## 4.17.10 Referenced By

| Table                      | Column           | Relationship |
| -------------------------- | ---------------- | ------------ |
| certification_translations | certification_id | One-to-Many  |

The **certification_translations** table references this entity through the **certification_id** foreign key.

---

## 4.17.11 Notes

The **certifications** table stores only language-independent certification metadata.

Information such as issue dates, expiration dates, verification URLs, credential identifiers, and images remains identical regardless of language, while translated information such as the certification title, issuer, and description is maintained separately in the **certification_translations** table.

This design maintains Third Normal Form (3NF), minimizes redundancy, and ensures consistency with the multilingual architecture used throughout the Portfolio Management System.

# 4.18 certification_translations

## 4.18.1 Purpose

The **certification_translations** table stores all language-dependent information for professional certifications.

Each record represents the localized content of a single certification in one specific language. This includes the certification title, issuing organization, country, and descriptive information.

Separating localized content from the **certifications** table enables the application to support multiple languages while maintaining a normalized relational database structure.

---

## 4.18.2 Table Information

| Property      | Value                                      |
| ------------- | ------------------------------------------ |
| Table Name    | certification_translations                 |
| Purpose       | Stores localized certification information |
| Primary Key   | id                                         |
| Engine        | InnoDB                                     |
| Character Set | utf8mb4                                    |
| Storage Type  | Translation Entity                         |

---

## 4.18.3 Columns

| Column           | Data Type    | Nullable | Default           | Description                                                |
| ---------------- | ------------ | -------- | ----------------- | ---------------------------------------------------------- |
| id               | BIGINT       | No       | Auto Increment    | Unique identifier of the translation record.               |
| certification_id | BIGINT       | No       | —                 | References the certification being translated.             |
| language_id      | BIGINT       | No       | —                 | References the language of the translation.                |
| title            | VARCHAR(255) | No       | —                 | Localized certification title.                             |
| issuer           | VARCHAR(255) | No       | —                 | Localized issuing organization or institution.             |
| country          | VARCHAR(255) | Yes      | NULL              | Localized country where the certification was issued.      |
| description      | TEXT         | Yes      | NULL              | Localized description or additional certification details. |
| created_at       | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                                 |
| updated_at       | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                               |

---

## 4.18.4 Primary Key

| Column |
| ------ |
| id     |

Each translation record is uniquely identified by its primary key.

---

## 4.18.5 Foreign Keys

| Column           | References        | On Delete |
| ---------------- | ----------------- | --------- |
| certification_id | certifications.id | Cascade   |
| language_id      | languages.id      | Cascade   |

Cascade deletion ensures that translation records are automatically removed if either the parent certification or the associated language is deleted.

---

## 4.18.6 Relationships

### Many-to-One

| Related Table  | Relationship                                        |
| -------------- | --------------------------------------------------- |
| certifications | Many Certification Translations → One Certification |
| languages      | Many Certification Translations → One Language      |

Each translation belongs to exactly one certification and one language.

---

## 4.18.7 Unique Constraints

| Columns                        |
| ------------------------------ |
| certification_id + language_id |

This composite unique constraint guarantees that only one translation exists for each certification in a specific language.

---

## 4.18.8 Indexes

| Column                         | Type                   |
| ------------------------------ | ---------------------- |
| id                             | Primary Key            |
| certification_id               | Foreign Key Index      |
| language_id                    | Foreign Key Index      |
| certification_id + language_id | Unique Composite Index |

These indexes improve localization lookup performance while preventing duplicate translations.

---

## 4.18.9 Business Rules

The following business rules apply:

* Every translation must belong to an existing certification.
* Every translation must reference an existing language.
* A certification may have only one translation per language.
* The certification title and issuing organization are mandatory.
* The country and description fields are optional.
* The application retrieves the translation corresponding to the visitor's selected language.

---

## 4.18.10 Security Considerations

The **certification_translations** table stores public professional information.

Only authenticated administrators may create, update, or delete translation records.

All localized text is validated before persistence to ensure consistency and to prevent invalid or malicious input.

---

## 4.18.11 Referenced By

No database tables reference the **certification_translations** table.

---

## 4.18.12 Notes

The **certification_translations** table provides multilingual support for professional certifications while maintaining a clean separation between language-independent metadata and localized content.

This architecture offers several advantages:

* Unlimited language support.
* Reduced data redundancy.
* Improved normalization.
* Consistent localization strategy.
* Simplified maintenance.
* Easy expansion when additional languages are introduced.

This implementation follows the same multilingual design pattern used across the Portfolio Management System for About, Experiences, Projects, Education, Skills, Testimonials, and Contacts.

# 4.19 skill_categories

## 4.19.1 Purpose

The **skill_categories** table stores the language-independent classification of technical and professional skills displayed in the Portfolio Management System.

Each category groups related skills together, improving organization and presentation on the portfolio website. Typical categories include **Programming Languages**, **Frontend Development**, **Backend Development**, **Databases**, **DevOps**, **Frameworks**, and **Tools**.

The category name is multilingual and is therefore stored separately in the **skill_category_translations** table.

---

## 4.19.2 Table Information

| Property      | Value                             |
| ------------- | --------------------------------- |
| Table Name    | skill_categories                  |
| Purpose       | Stores skill category definitions |
| Primary Key   | id                                |
| Engine        | InnoDB                            |
| Character Set | utf8mb4                           |
| Storage Type  | Classification Entity             |

---

## 4.19.3 Columns

| Column     | Data Type        | Nullable | Default           | Description                                     |
| ---------- | ---------------- | -------- | ----------------- | ----------------------------------------------- |
| id         | BIGINT           | No       | Auto Increment    | Unique identifier of the skill category.        |
| slug       | VARCHAR(255)     | No       | —                 | Unique machine-readable identifier.             |
| icon       | VARCHAR(255)     | Yes      | NULL              | Icon representing the category.                 |
| color      | VARCHAR(7)       | Yes      | NULL              | Hexadecimal color associated with the category. |
| order      | UNSIGNED INTEGER | No       | 0                 | Display order on the portfolio website.         |
| created_at | TIMESTAMP        | No       | Current Timestamp | Record creation timestamp.                      |
| updated_at | TIMESTAMP        | No       | Current Timestamp | Last modification timestamp.                    |

---

## 4.19.4 Primary Key

| Column |
| ------ |
| id     |

Each skill category is uniquely identified by its primary key.

---

## 4.19.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.19.6 Relationships

### One-to-Many

| Related Table               | Relationship                                          |
| --------------------------- | ----------------------------------------------------- |
| skills                      | One Skill Category → Many Skills                      |
| skill_category_translations | One Skill Category → Many Skill Category Translations |

A single skill category may contain multiple skills and multiple translations.

---

## 4.19.7 Unique Constraints

| Column |
| ------ |
| slug   |

Each category slug must be unique throughout the application.

---

## 4.19.8 Indexes

| Column | Type         |
| ------ | ------------ |
| id     | Primary Key  |
| slug   | Unique Index |

These indexes ensure fast category lookups and maintain slug uniqueness.

---

## 4.19.9 Business Rules

The following business rules apply:

* Every category must have a unique slug.
* Category names are stored exclusively in the translation table.
* Icons and colors are optional.
* The **order** field determines the display sequence on the public website.
* Deleting a category automatically deletes all associated translations.
* If a category is deleted, associated skills are also removed through the defined foreign key cascade.

---

## 4.19.10 Security Considerations

The **skill_categories** table stores administrative configuration data.

Only authenticated administrators may create, modify, or delete skill categories.

Slug uniqueness, icon values, and color values are validated before persistence.

---

## 4.19.11 Referenced By

| Table                       | Column            | Relationship |
| --------------------------- | ----------------- | ------------ |
| skills                      | skill_category_id | One-to-Many  |
| skill_category_translations | skill_category_id | One-to-Many  |

The **skills** table references the category through the **skill_category_id** foreign key, while translations reference the parent classification entity.

---

## 4.19.12 Notes

The **skill_categories** table provides a reusable classification system for organizing technical and professional skills.

This design offers several advantages:

* Logical grouping of related skills.
* Consistent presentation across the portfolio.
* Simplified maintenance.
* Efficient multilingual support.
* Scalability for future categories.
* Compliance with Third Normal Form (3NF).

This classification architecture is consistent with the implementation of **project_types** and **project_statuses**, providing a uniform design throughout the Portfolio Management System.

# 4.20 skill_category_translations

## 4.20.1 Purpose

The **skill_category_translations** table stores the localized names of skill categories.

Each record represents the translation of a single skill category in one specific language. This enables the Portfolio Management System to display skill category names according to the visitor's selected language while maintaining language-independent information in the **skill_categories** table.

This table follows the same multilingual architecture used throughout the application.

---

## 4.20.2 Table Information

| Property      | Value                                 |
| ------------- | ------------------------------------- |
| Table Name    | skill_category_translations           |
| Purpose       | Stores localized skill category names |
| Primary Key   | id                                    |
| Engine        | InnoDB                                |
| Character Set | utf8mb4                               |
| Storage Type  | Translation Entity                    |

---

## 4.20.3 Columns

| Column            | Data Type    | Nullable | Default           | Description                                     |
| ----------------- | ------------ | -------- | ----------------- | ----------------------------------------------- |
| id                | BIGINT       | No       | Auto Increment    | Unique identifier of the translation record.    |
| skill_category_id | BIGINT       | No       | —                 | References the skill category being translated. |
| language_id       | BIGINT       | No       | —                 | References the language of the translation.     |
| name              | VARCHAR(255) | No       | —                 | Localized display name of the skill category.   |
| created_at        | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                      |
| updated_at        | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                    |

---

## 4.20.4 Primary Key

| Column |
| ------ |
| id     |

Each translation record is uniquely identified by its primary key.

---

## 4.20.5 Foreign Keys

| Column            | References          | On Delete |
| ----------------- | ------------------- | --------- |
| skill_category_id | skill_categories.id | Cascade   |
| language_id       | languages.id        | Cascade   |

Cascade deletion ensures that translation records are automatically removed when either the parent skill category or the associated language is deleted.

---

## 4.20.6 Relationships

### Many-to-One

| Related Table    | Relationship                                          |
| ---------------- | ----------------------------------------------------- |
| skill_categories | Many Skill Category Translations → One Skill Category |
| languages        | Many Skill Category Translations → One Language       |

Each translation belongs to exactly one skill category and one language.

---

## 4.20.7 Unique Constraints

| Columns                         |
| ------------------------------- |
| skill_category_id + language_id |

This composite unique constraint guarantees that only one translation exists for each skill category in a given language.

---

## 4.20.8 Indexes

| Column                          | Type                   |
| ------------------------------- | ---------------------- |
| id                              | Primary Key            |
| skill_category_id               | Foreign Key Index      |
| language_id                     | Foreign Key Index      |
| skill_category_id + language_id | Unique Composite Index |

These indexes improve translation lookup performance while preventing duplicate localization records.

---

## 4.20.9 Business Rules

The following business rules apply:

* Every translation must belong to an existing skill category.
* Every translation must reference an existing language.
* A skill category may have only one translation per language.
* The localized category name is mandatory.
* The application retrieves the translation corresponding to the visitor's currently selected language.

---

## 4.20.10 Security Considerations

The **skill_category_translations** table stores public-facing localization data.

Only authenticated administrators may create, update, or delete translation records.

All translated names are validated before persistence to ensure consistency and to prevent invalid or malicious input.

---

## 4.20.11 Referenced By

No database tables reference the **skill_category_translations** table.

---

## 4.20.12 Notes

The **skill_category_translations** table provides multilingual support for skill categories while maintaining a normalized database structure.

Separating localized names from the parent **skill_categories** entity provides several advantages:

* Unlimited language support.
* Reduced data redundancy.
* Centralized category management.
* Simplified maintenance.
* Consistent localization architecture.
* Easy expansion when additional languages are introduced.

This implementation follows the same translation strategy used throughout the Portfolio Management System for all multilingual entities.

# 4.21 skills

## 4.21.1 Purpose

The **skills** table stores the language-independent information for technical and professional skills displayed in the Portfolio Management System.

Each record represents a single skill and belongs to a skill category. The table stores metadata such as the associated category, proficiency level, icon, years of experience, display order, and publication status.

Localized information, including the skill name and description, is stored separately in the **skill_translations** table.

This separation ensures a normalized database structure and provides complete multilingual support.

---

## 4.21.2 Table Information

| Property      | Value                                         |
| ------------- | --------------------------------------------- |
| Table Name    | skills                                        |
| Purpose       | Stores language-independent skill information |
| Primary Key   | id                                            |
| Engine        | InnoDB                                        |
| Character Set | utf8mb4                                       |
| Storage Type  | Business Entity                               |

---

## 4.21.3 Columns

| Column              | Data Type        | Nullable | Default           | Description                                        |
| ------------------- | ---------------- | -------- | ----------------- | -------------------------------------------------- |
| id                  | BIGINT           | No       | Auto Increment    | Unique identifier of the skill.                    |
| skill_category_id   | BIGINT           | No       | —                 | References the parent skill category.              |
| icon                | VARCHAR(255)     | Yes      | NULL              | Icon representing the skill.                       |
| level               | TINYINT UNSIGNED | No       | 0                 | Skill proficiency level (typically 0–100).         |
| years_of_experience | DECIMAL(4,1)     | Yes      | NULL              | Years of practical experience with the skill.      |
| featured            | BOOLEAN          | No       | FALSE             | Indicates whether the skill should be highlighted. |
| order               | UNSIGNED INTEGER | No       | 0                 | Display order on the portfolio website.            |
| created_at          | TIMESTAMP        | No       | Current Timestamp | Record creation timestamp.                         |
| updated_at          | TIMESTAMP        | No       | Current Timestamp | Last modification timestamp.                       |

---

## 4.21.4 Primary Key

| Column |
| ------ |
| id     |

Each skill is uniquely identified by its primary key.

---

## 4.21.5 Foreign Keys

| Column            | References          | On Delete |
| ----------------- | ------------------- | --------- |
| skill_category_id | skill_categories.id | Cascade   |

Cascade deletion ensures that all skills belonging to a deleted category are automatically removed.

---

## 4.21.6 Relationships

### Many-to-One

| Related Table    | Relationship                     |
| ---------------- | -------------------------------- |
| skill_categories | Many Skills → One Skill Category |

### One-to-Many

| Related Table      | Relationship                        |
| ------------------ | ----------------------------------- |
| skill_translations | One Skill → Many Skill Translations |

Each skill belongs to one category and may contain multiple translations.

---

## 4.21.7 Unique Constraints

This table does not define any unique constraints beyond its primary key.

Multiple skills may share the same category, icon, or proficiency level.

---

## 4.21.8 Indexes

| Column            | Type              |
| ----------------- | ----------------- |
| id                | Primary Key       |
| skill_category_id | Foreign Key Index |

These indexes improve category filtering and relationship performance.

---

## 4.21.9 Business Rules

The following business rules apply:

* Every skill must belong to an existing skill category.
* The proficiency level represents the relative expertise of the portfolio owner.
* The **featured** field determines whether the skill receives additional emphasis on the public portfolio.
* The **order** field controls the display sequence.
* The icon is optional.
* Localized information is stored exclusively in the **skill_translations** table.
* Deleting a skill automatically deletes all associated translations.

---

## 4.21.10 Security Considerations

The **skills** table stores public portfolio information.

Only authenticated administrators may create, update, or delete skill records.

Input validation is performed for:

* Skill category references.
* Proficiency level values.
* Years of experience.
* Icon identifiers.

---

## 4.21.11 Referenced By

| Table              | Column   | Relationship |
| ------------------ | -------- | ------------ |
| skill_translations | skill_id | One-to-Many  |

The **skill_translations** table references the parent skill through the **skill_id** foreign key.

---

## 4.21.12 Notes

The **skills** table is designed to separate technical metadata from localized content.

This architecture provides several benefits:

* Consistent categorization of skills.
* Efficient multilingual support.
* Simplified maintenance.
* Flexible ordering and highlighting.
* Reduced data redundancy.
* Compliance with Third Normal Form (3NF).

Combined with **skill_categories** and **skill_translations**, this table forms the complete skill management module of the Portfolio Management System.

# 4.22 skill_translations

## 4.22.1 Purpose

The **skill_translations** table stores all language-dependent information for technical and professional skills.

Each record represents the localized content of a single skill in one specific language. This includes the skill name and an optional description that provides additional information about the technology or competency.

Separating multilingual content from the **skills** table enables the Portfolio Management System to support unlimited languages while maintaining a normalized database structure.

---

## 4.22.2 Table Information

| Property      | Value                              |
| ------------- | ---------------------------------- |
| Table Name    | skill_translations                 |
| Purpose       | Stores localized skill information |
| Primary Key   | id                                 |
| Engine        | InnoDB                             |
| Character Set | utf8mb4                            |
| Storage Type  | Translation Entity                 |

---

## 4.22.3 Columns

| Column      | Data Type    | Nullable | Default           | Description                                  |
| ----------- | ------------ | -------- | ----------------- | -------------------------------------------- |
| id          | BIGINT       | No       | Auto Increment    | Unique identifier of the translation record. |
| skill_id    | BIGINT       | No       | —                 | References the skill being translated.       |
| language_id | BIGINT       | No       | —                 | References the language of the translation.  |
| name        | VARCHAR(255) | No       | —                 | Localized skill name.                        |
| description | TEXT         | Yes      | NULL              | Localized description of the skill.          |
| created_at  | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                   |
| updated_at  | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                 |

---

## 4.22.4 Primary Key

| Column |
| ------ |
| id     |

Each translation record is uniquely identified by its primary key.

---

## 4.22.5 Foreign Keys

| Column      | References   | On Delete |
| ----------- | ------------ | --------- |
| skill_id    | skills.id    | Cascade   |
| language_id | languages.id | Cascade   |

Cascade deletion ensures that translations are automatically removed when either the parent skill or the associated language is deleted.

---

## 4.22.6 Relationships

### Many-to-One

| Related Table | Relationship                           |
| ------------- | -------------------------------------- |
| skills        | Many Skill Translations → One Skill    |
| languages     | Many Skill Translations → One Language |

Each translation belongs to exactly one skill and one language.

---

## 4.22.7 Unique Constraints

| Columns                |
| ---------------------- |
| skill_id + language_id |

This composite unique constraint guarantees that only one translation exists for each skill in a given language.

---

## 4.22.8 Indexes

| Column                 | Type                   |
| ---------------------- | ---------------------- |
| id                     | Primary Key            |
| skill_id               | Foreign Key Index      |
| language_id            | Foreign Key Index      |
| skill_id + language_id | Unique Composite Index |

These indexes improve multilingual lookup performance while preventing duplicate translation records.

---

## 4.22.9 Business Rules

The following business rules apply:

* Every translation must belong to an existing skill.
* Every translation must reference an existing language.
* A skill may have only one translation per language.
* The localized skill name is mandatory.
* The description is optional.
* The application retrieves the translation corresponding to the visitor's selected language.

---

## 4.22.10 Security Considerations

The **skill_translations** table stores public-facing content.

Only authenticated administrators may create, update, or delete translation records.

All translated content is validated before persistence to ensure consistency and to prevent invalid or malicious input.

---

## 4.22.11 Referenced By

No database tables reference the **skill_translations** table.

---

## 4.22.12 Notes

The **skill_translations** table provides multilingual support for the Skills module while maintaining a normalized relational database.

Separating localized information from the parent **skills** entity provides several advantages:

* Unlimited language support.
* Centralized technical metadata.
* Elimination of duplicated data.
* Improved maintainability.
* Consistent localization architecture.
* Easy scalability when introducing additional languages.

This implementation follows the same multilingual design pattern used throughout the Portfolio Management System for About, Experiences, Projects, Education, Certifications, Testimonials, and Contacts.

# 4.23 social_links

## 4.23.1 Purpose

The **social_links** table stores the social media profiles and external contact links associated with the portfolio owner.

Each record represents one social platform or external service, such as GitHub, LinkedIn, X (Twitter), Facebook, Instagram, YouTube, Behance, Dribbble, Stack Overflow, or a personal website.

Unlike most portfolio entities, social links do not require translations because the platform names and URLs are language-independent.

---

## 4.23.2 Table Information

| Property      | Value                                          |
| ------------- | ---------------------------------------------- |
| Table Name    | social_links                                   |
| Purpose       | Stores social media and external profile links |
| Primary Key   | id                                             |
| Engine        | InnoDB                                         |
| Character Set | utf8mb4                                        |
| Storage Type  | Business Entity                                |

---

## 4.23.3 Columns

| Column     | Data Type        | Nullable | Default           | Description                                       |
| ---------- | ---------------- | -------- | ----------------- | ------------------------------------------------- |
| id         | BIGINT           | No       | Auto Increment    | Unique identifier of the social link.             |
| platform   | VARCHAR(255)     | No       | —                 | Name of the social media platform or service.     |
| url        | VARCHAR(255)     | No       | —                 | URL pointing to the user's profile.               |
| icon       | VARCHAR(255)     | Yes      | NULL              | Icon identifier used for displaying the platform. |
| order      | UNSIGNED INTEGER | No       | 0                 | Display order on the public portfolio.            |
| created_at | TIMESTAMP        | No       | Current Timestamp | Record creation timestamp.                        |
| updated_at | TIMESTAMP        | No       | Current Timestamp | Last modification timestamp.                      |

---

## 4.23.4 Primary Key

| Column |
| ------ |
| id     |

Each social link is uniquely identified by its primary key.

---

## 4.23.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.23.6 Relationships

The **social_links** table is an independent entity and does not have relationships with other business tables.

---

## 4.23.7 Unique Constraints

| Column   |
| -------- |
| platform |

Each platform should appear only once in the portfolio.

---

## 4.23.8 Indexes

| Column   | Type         |
| -------- | ------------ |
| id       | Primary Key  |
| platform | Unique Index |

These indexes ensure fast lookups while preventing duplicate platform entries.

---

## 4.23.9 Business Rules

The following business rules apply:

* Every social link must have a platform name.
* Every social link must contain a valid URL.
* Only one record may exist for each platform.
* The **order** field determines the display sequence on the public portfolio.
* Icons are optional and may reference Google Icons, PrimeIcons, Font Awesome, or another supported icon library.

---

## 4.23.10 Security Considerations

The **social_links** table stores publicly visible information.

Only authenticated administrators may create, modify, or delete records.

All URLs are validated before persistence to ensure they are properly formatted and use supported protocols (HTTPS is recommended).

---

## 4.23.11 Referenced By

No database tables reference the **social_links** table.

---

## 4.23.12 Notes

The **social_links** table provides a centralized location for managing all external profile links displayed throughout the portfolio.

Its independent design offers several advantages:

* Simple administration.
* Easy addition or removal of platforms.
* Flexible ordering.
* No multilingual maintenance requirements.
* Minimal database complexity.

Because platform names are globally recognized and URLs are language-independent, this table intentionally does not use a translation table.

# 4.24 testimonials

## 4.24.1 Purpose

The **testimonials** table stores the language-independent information for testimonials displayed on the portfolio website.

Each record represents feedback or recommendations provided by clients, colleagues, managers, or collaborators. The table stores metadata such as the reviewer's photo, company, job title, rating, publication status, and display order.

The testimonial text and reviewer name are language-dependent and are stored separately in the **testimonial_translations** table.

This design supports multilingual content while maintaining a normalized database structure.

---

## 4.24.2 Table Information

| Property      | Value                                               |
| ------------- | --------------------------------------------------- |
| Table Name    | testimonials                                        |
| Purpose       | Stores language-independent testimonial information |
| Primary Key   | id                                                  |
| Engine        | InnoDB                                              |
| Character Set | utf8mb4                                             |
| Storage Type  | Business Entity                                     |

---

## 4.24.3 Columns

| Column     | Data Type        | Nullable | Default           | Description                                              |
| ---------- | ---------------- | -------- | ----------------- | -------------------------------------------------------- |
| id         | BIGINT           | No       | Auto Increment    | Unique identifier of the testimonial.                    |
| photo      | VARCHAR(255)     | Yes      | NULL              | Reviewer's profile image.                                |
| company    | VARCHAR(255)     | Yes      | NULL              | Company or organization of the reviewer.                 |
| position   | VARCHAR(255)     | Yes      | NULL              | Professional position of the reviewer.                   |
| rating     | TINYINT UNSIGNED | No       | 5                 | Rating assigned to the testimonial (1–5).                |
| featured   | BOOLEAN          | No       | FALSE             | Indicates whether the testimonial should be highlighted. |
| order      | UNSIGNED INTEGER | No       | 0                 | Display order on the public website.                     |
| created_at | TIMESTAMP        | No       | Current Timestamp | Record creation timestamp.                               |
| updated_at | TIMESTAMP        | No       | Current Timestamp | Last modification timestamp.                             |

---

## 4.24.4 Primary Key

| Column |
| ------ |
| id     |

Each testimonial is uniquely identified by its primary key.

---

## 4.24.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.24.6 Relationships

### One-to-Many

| Related Table            | Relationship                                    |
| ------------------------ | ----------------------------------------------- |
| testimonial_translations | One Testimonial → Many Testimonial Translations |

Each testimonial may have multiple translations, with one translation for each supported language.

---

## 4.24.7 Indexes

| Column | Type        |
| ------ | ----------- |
| id     | Primary Key |

No additional indexes are required due to the relatively small number of testimonial records.

---

## 4.24.8 Business Rules

The following business rules apply:

* The rating must be between **1** and **5**.
* The reviewer's photo is optional.
* Company and position information are optional.
* The **featured** field determines whether the testimonial receives additional prominence.
* The **order** field controls the display sequence.
* Localized reviewer names and testimonial content are stored exclusively in the **testimonial_translations** table.
* Deleting a testimonial automatically removes all associated translations.

---

## 4.24.9 Security Considerations

The **testimonials** table stores public-facing content.

Only authenticated administrators may create, update, or delete testimonial records.

Uploaded images are validated before storage, and rating values are validated to ensure they remain within the accepted range.

---

## 4.24.10 Referenced By

| Table                    | Column         | Relationship |
| ------------------------ | -------------- | ------------ |
| testimonial_translations | testimonial_id | One-to-Many  |

The **testimonial_translations** table references the parent testimonial entity.

---

## 4.24.11 Notes

The **testimonials** table stores only metadata that remains identical across all supported languages.

Separating localized testimonial content into the **testimonial_translations** table provides:

* Unlimited language support.
* Improved database normalization.
* Reduced data duplication.
* Consistent multilingual architecture.
* Simplified maintenance and future scalability.

This implementation follows the same design pattern used throughout the Portfolio Management System for other multilingual entities.

# 4.25 testimonial_translations

## 4.25.1 Purpose

The **testimonial_translations** table stores all language-dependent information for testimonials displayed on the portfolio website.

Each record represents the localized version of a single testimonial in one specific language. This includes the reviewer's name and the testimonial content.

Separating localized content from the **testimonials** table enables the Portfolio Management System to support multiple languages while maintaining a normalized relational database structure.

---

## 4.25.2 Table Information

| Property      | Value                                |
| ------------- | ------------------------------------ |
| Table Name    | testimonial_translations             |
| Purpose       | Stores localized testimonial content |
| Primary Key   | id                                   |
| Engine        | InnoDB                               |
| Character Set | utf8mb4                              |
| Storage Type  | Translation Entity                   |

---

## 4.25.3 Columns

| Column         | Data Type    | Nullable | Default           | Description                                  |
| -------------- | ------------ | -------- | ----------------- | -------------------------------------------- |
| id             | BIGINT       | No       | Auto Increment    | Unique identifier of the translation record. |
| testimonial_id | BIGINT       | No       | —                 | References the testimonial being translated. |
| language_id    | BIGINT       | No       | —                 | References the language of the translation.  |
| reviewer_name  | VARCHAR(255) | No       | —                 | Localized name of the reviewer.              |
| content        | TEXT         | No       | —                 | Localized testimonial text.                  |
| created_at     | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                   |
| updated_at     | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                 |

---

## 4.25.4 Primary Key

| Column |
| ------ |
| id     |

Each translation record is uniquely identified by its primary key.

---

## 4.25.5 Foreign Keys

| Column         | References      | On Delete |
| -------------- | --------------- | --------- |
| testimonial_id | testimonials.id | Cascade   |
| language_id    | languages.id    | Cascade   |

Cascade deletion ensures that translations are automatically removed when either the parent testimonial or the associated language is deleted.

---

## 4.25.6 Relationships

### Many-to-One

| Related Table | Relationship                                    |
| ------------- | ----------------------------------------------- |
| testimonials  | Many Testimonial Translations → One Testimonial |
| languages     | Many Testimonial Translations → One Language    |

Each translation belongs to exactly one testimonial and one language.

---

## 4.25.7 Unique Constraints

| Columns                      |
| ---------------------------- |
| testimonial_id + language_id |

This composite unique constraint guarantees that only one translation exists for each testimonial in a given language.

---

## 4.25.8 Indexes

| Column                       | Type                   |
| ---------------------------- | ---------------------- |
| id                           | Primary Key            |
| testimonial_id               | Foreign Key Index      |
| language_id                  | Foreign Key Index      |
| testimonial_id + language_id | Unique Composite Index |

These indexes improve multilingual lookup performance while preventing duplicate translation records.

---

## 4.25.9 Business Rules

The following business rules apply:

* Every translation must belong to an existing testimonial.
* Every translation must reference an existing language.
* A testimonial may have only one translation per language.
* The reviewer name is mandatory.
* The testimonial content is mandatory.
* The application retrieves the translation corresponding to the visitor's selected language.

---

## 4.25.10 Security Considerations

The **testimonial_translations** table stores public-facing content.

Only authenticated administrators may create, update, or delete translation records.

All translated text is validated before persistence to ensure content quality and to prevent invalid or malicious input.

---

## 4.25.11 Referenced By

No database tables reference the **testimonial_translations** table.

---

## 4.25.12 Notes

The **testimonial_translations** table provides multilingual support for testimonial content while maintaining a clean separation between language-independent metadata and localized text.

This architecture provides several advantages:

* Unlimited language support.
* Reduced data redundancy.
* Improved normalization.
* Consistent localization architecture.
* Easier maintenance.
* Future scalability as additional languages are introduced.

This implementation follows the same translation pattern used across all multilingual entities within the Portfolio Management System.

# 4.26 contacts

## 4.26.1 Purpose

The **contacts** table stores the language-independent information used in the **Contact** section of the Portfolio Management System.

This entity contains the portfolio owner's contact details, including email address, phone number, physical location, map link, business hours, and other information that remains identical regardless of the selected language.

Localized content such as the contact section title, introductory text, and address description is stored separately in the **contact_translations** table.

This separation follows the multilingual architecture implemented throughout the application.

---

## 4.26.2 Table Information

| Property      | Value                                           |
| ------------- | ----------------------------------------------- |
| Table Name    | contacts                                        |
| Purpose       | Stores language-independent contact information |
| Primary Key   | id                                              |
| Engine        | InnoDB                                          |
| Character Set | utf8mb4                                         |
| Storage Type  | Business Entity                                 |

---

## 4.26.3 Columns

| Column         | Data Type    | Nullable | Default           | Description                              |
| -------------- | ------------ | -------- | ----------------- | ---------------------------------------- |
| id             | BIGINT       | No       | Auto Increment    | Unique identifier of the contact record. |
| email          | VARCHAR(255) | No       | —                 | Public contact email address.            |
| phone          | VARCHAR(50)  | Yes      | NULL              | Public contact phone number.             |
| address        | VARCHAR(255) | Yes      | NULL              | Physical address or location.            |
| map_url        | VARCHAR(255) | Yes      | NULL              | Google Maps or other map service URL.    |
| business_hours | VARCHAR(255) | Yes      | NULL              | Working or availability hours.           |
| created_at     | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.               |
| updated_at     | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.             |

---

## 4.26.4 Primary Key

| Column |
| ------ |
| id     |

Each contact record is uniquely identified by its primary key.

---

## 4.26.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.26.6 Relationships

### One-to-Many

| Related Table        | Relationship                            |
| -------------------- | --------------------------------------- |
| contact_translations | One Contact → Many Contact Translations |

Each contact record may contain multiple translations, with one translation for every supported language.

---

## 4.26.7 Unique Constraints

| Column |
| ------ |
| email  |

The public contact email address must be unique.

---

## 4.26.8 Indexes

| Column | Type         |
| ------ | ------------ |
| id     | Primary Key  |
| email  | Unique Index |

These indexes provide efficient lookup and enforce uniqueness of the public email address.

---

## 4.26.9 Business Rules

The following business rules apply:

* Every contact record must contain a valid email address.
* Phone number, address, map URL, and business hours are optional.
* Contact information is intended for public display.
* Localized text is stored exclusively in the **contact_translations** table.
* Deleting a contact record automatically deletes all associated translations.

---

## 4.26.10 Security Considerations

The **contacts** table stores publicly accessible information.

Only authenticated administrators may create, update, or delete contact information.

All email addresses, URLs, and phone numbers are validated before persistence to ensure correctness and security.

---

## 4.26.11 Referenced By

| Table                | Column     | Relationship |
| -------------------- | ---------- | ------------ |
| contact_translations | contact_id | One-to-Many  |

The **contact_translations** table references the parent contact entity.

---

## 4.26.12 Notes

The **contacts** table centralizes all language-independent contact information used throughout the Portfolio Management System.

Separating technical contact details from localized presentation content provides several advantages:

* Consistent multilingual architecture.
* Reduced data redundancy.
* Improved database normalization.
* Easier maintenance.
* Simplified updates to public contact information.
* Better scalability as new languages are introduced.

This implementation follows the same multilingual design pattern used across the application's core entities.

# 4.27 contact_translations

## 4.27.1 Purpose

The **contact_translations** table stores all language-dependent content for the **Contact** section of the Portfolio Management System.

Each record represents the localized content of a single contact record in one specific language. This includes the section title, introductory text, address description, and any additional localized information displayed on the public contact page.

Separating multilingual content from the **contacts** table enables the system to support unlimited languages while maintaining a normalized relational database structure.

---

## 4.27.2 Table Information

| Property      | Value                                    |
| ------------- | ---------------------------------------- |
| Table Name    | contact_translations                     |
| Purpose       | Stores localized contact section content |
| Primary Key   | id                                       |
| Engine        | InnoDB                                   |
| Character Set | utf8mb4                                  |
| Storage Type  | Translation Entity                       |

---

## 4.27.3 Columns

| Column              | Data Type    | Nullable | Default           | Description                                                       |
| ------------------- | ------------ | -------- | ----------------- | ----------------------------------------------------------------- |
| id                  | BIGINT       | No       | Auto Increment    | Unique identifier of the translation record.                      |
| contact_id          | BIGINT       | No       | —                 | References the contact record being translated.                   |
| language_id         | BIGINT       | No       | —                 | References the language of the translation.                       |
| title               | VARCHAR(255) | No       | —                 | Localized title of the contact section.                           |
| description         | TEXT         | Yes      | NULL              | Localized introductory or descriptive text.                       |
| address_description | TEXT         | Yes      | NULL              | Localized description of the physical address or office location. |
| created_at          | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                                        |
| updated_at          | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                                      |

---

## 4.27.4 Primary Key

| Column |
| ------ |
| id     |

Each translation record is uniquely identified by its primary key.

---

## 4.27.5 Foreign Keys

| Column      | References   | On Delete |
| ----------- | ------------ | --------- |
| contact_id  | contacts.id  | Cascade   |
| language_id | languages.id | Cascade   |

Cascade deletion ensures that translation records are automatically removed when either the parent contact record or the associated language is deleted.

---

## 4.27.6 Relationships

### Many-to-One

| Related Table | Relationship                             |
| ------------- | ---------------------------------------- |
| contacts      | Many Contact Translations → One Contact  |
| languages     | Many Contact Translations → One Language |

Each translation belongs to exactly one contact record and one language.

---

## 4.27.7 Unique Constraints

| Columns                  |
| ------------------------ |
| contact_id + language_id |

This composite unique constraint guarantees that only one translation exists for each contact record in a given language.

---

## 4.27.8 Indexes

| Column                   | Type                   |
| ------------------------ | ---------------------- |
| id                       | Primary Key            |
| contact_id               | Foreign Key Index      |
| language_id              | Foreign Key Index      |
| contact_id + language_id | Unique Composite Index |

These indexes improve multilingual lookup performance while preventing duplicate translation records.

---

## 4.27.9 Business Rules

The following business rules apply:

* Every translation must belong to an existing contact record.
* Every translation must reference an existing language.
* A contact record may have only one translation per language.
* The contact section title is mandatory.
* The description and address description are optional.
* The application retrieves the translation corresponding to the visitor's selected language.

---

## 4.27.10 Security Considerations

The **contact_translations** table stores public-facing content.

Only authenticated administrators may create, update, or delete translation records.

All translated text is validated before persistence to ensure content quality and to prevent invalid or malicious input.

---

## 4.27.11 Referenced By

No database tables reference the **contact_translations** table.

---

## 4.27.12 Notes

The **contact_translations** table provides multilingual support for the Contact section while maintaining a clean separation between language-independent contact information and localized presentation content.

This architecture offers several advantages:

* Unlimited language support.
* Reduced data redundancy.
* Improved database normalization.
* Consistent localization architecture.
* Simplified maintenance.
* Easy scalability as additional languages are introduced.

This implementation follows the same multilingual design pattern used throughout the Portfolio Management System for all translated entities.

# 4.28 languages

## 4.28.1 Purpose

The **languages** table stores the list of supported languages available within the Portfolio Management System.

Each record defines one application language and provides the metadata required by the localization system, including its language code, display name, native name, and writing direction.

All translation tables reference this entity to associate localized content with a specific language.

---

## 4.28.2 Table Information

| Property      | Value                                  |
| ------------- | -------------------------------------- |
| Table Name    | languages                              |
| Purpose       | Stores supported application languages |
| Primary Key   | id                                     |
| Engine        | InnoDB                                 |
| Character Set | utf8mb4                                |
| Storage Type  | Reference Entity                       |

---

## 4.28.3 Columns

| Column      | Data Type         | Nullable | Default           | Description                              |
| ----------- | ----------------- | -------- | ----------------- | ---------------------------------------- |
| id          | BIGINT            | No       | Auto Increment    | Unique identifier of the language.       |
| code        | VARCHAR(10)       | No       | —                 | Language code (ISO 639-1 or compatible). |
| name        | VARCHAR(100)      | No       | —                 | English name of the language.            |
| native_name | VARCHAR(100)      | No       | —                 | Native name of the language.             |
| direction   | ENUM('ltr','rtl') | No       | ltr               | Text writing direction.                  |
| created_at  | TIMESTAMP         | No       | Current Timestamp | Record creation timestamp.               |
| updated_at  | TIMESTAMP         | No       | Current Timestamp | Last modification timestamp.             |

---

## 4.28.4 Primary Key

| Column |
| ------ |
| id     |

Each language is uniquely identified by its primary key.

---

## 4.28.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.28.6 Relationships

### One-to-Many

The **languages** table is referenced by every translation table in the system.

| Related Table               | Relationship                                    |
| --------------------------- | ----------------------------------------------- |
| about_translations          | One Language → Many About Translations          |
| experience_translations     | One Language → Many Experience Translations     |
| project_type_translations   | One Language → Many Project Type Translations   |
| project_status_translations | One Language → Many Project Status Translations |
| project_translations        | One Language → Many Project Translations        |
| education_translations      | One Language → Many Education Translations      |
| certification_translations  | One Language → Many Certification Translations  |
| skill_category_translations | One Language → Many Skill Category Translations |
| skill_translations          | One Language → Many Skill Translations          |
| testimonial_translations    | One Language → Many Testimonial Translations    |
| contact_translations        | One Language → Many Contact Translations        |

---

## 4.28.7 Unique Constraints

| Column |
| ------ |
| code   |

Each language code must be unique.

---

## 4.28.8 Indexes

| Column | Type         |
| ------ | ------------ |
| id     | Primary Key  |
| code   | Unique Index |

These indexes ensure efficient language lookup and prevent duplicate language definitions.

---

## 4.28.9 Business Rules

The following business rules apply:

* Every language must have a unique language code.
* Every language must define its writing direction.
* The **code** should follow ISO 639-1 conventions whenever possible.
* The **native_name** should be written in its own language.
* All translation tables must reference a valid language.
* Removing a language automatically removes all translations associated with that language.

---

## 4.28.10 Security Considerations

The **languages** table stores application configuration data.

Only authenticated administrators may create, update, or remove supported languages.

Deleting a language should be performed carefully because all associated translation records are automatically deleted through cascading foreign key constraints.

---

## 4.28.11 Referenced By

| Table                       | Column      |
| --------------------------- | ----------- |
| about_translations          | language_id |
| experience_translations     | language_id |
| project_type_translations   | language_id |
| project_status_translations | language_id |
| project_translations        | language_id |
| education_translations      | language_id |
| certification_translations  | language_id |
| skill_category_translations | language_id |
| skill_translations          | language_id |
| testimonial_translations    | language_id |
| contact_translations        | language_id |

The **languages** table acts as the central reference table for all multilingual content within the application.

---

## 4.28.12 Notes

The **languages** table forms the foundation of the application's internationalization (i18n) architecture.

By centralizing supported languages into a dedicated reference entity, the Portfolio Management System achieves:

* Unlimited language support.
* Consistent translation management.
* Standardized language identification.
* Automatic support for left-to-right (LTR) and right-to-left (RTL) layouts.
* Simplified localization maintenance.
* Full compliance with the multilingual database architecture implemented throughout the system.

# 4.28 contact_messages

## 4.28.1 Purpose

The **contact_messages** table stores messages submitted by visitors through the public contact form of the Portfolio Management System.

Each record represents a single inquiry sent by a visitor and contains the sender's contact information, message content, and metadata used for administration, spam prevention, auditing, and message management.

Unlike the portfolio content entities, this table stores user-generated data and is not multilingual.

---

## 4.28.2 Table Information

| Property      | Value                                              |
| ------------- | -------------------------------------------------- |
| Table Name    | contact_messages                                   |
| Purpose       | Stores messages submitted through the contact form |
| Primary Key   | id                                                 |
| Engine        | InnoDB                                             |
| Character Set | utf8mb4                                            |
| Storage Type  | Business Entity                                    |

---

## 4.28.3 Columns

| Column     | Data Type    | Nullable | Default           | Description                                          |
| ---------- | ------------ | -------- | ----------------- | ---------------------------------------------------- |
| id         | BIGINT       | No       | Auto Increment    | Unique identifier of the message.                    |
| name       | VARCHAR(255) | No       | —                 | Sender's full name.                                  |
| email      | VARCHAR(255) | No       | —                 | Sender's email address.                              |
| phone      | VARCHAR(255) | Yes      | NULL              | Sender's phone number.                               |
| subject    | VARCHAR(255) | Yes      | NULL              | Subject of the message.                              |
| message    | LONGTEXT     | No       | —                 | Message content submitted by the visitor.            |
| ip_address | VARCHAR(45)  | Yes      | NULL              | Visitor IP address.                                  |
| user_agent | TEXT         | Yes      | NULL              | Visitor browser and device information.              |
| is_read    | BOOLEAN      | No       | FALSE             | Indicates whether the message has been read.         |
| replied_at | TIMESTAMP    | Yes      | NULL              | Timestamp indicating when the administrator replied. |
| created_at | TIMESTAMP    | No       | Current Timestamp | Record creation timestamp.                           |
| updated_at | TIMESTAMP    | No       | Current Timestamp | Last modification timestamp.                         |

---

## 4.28.4 Primary Key

| Column |
| ------ |
| id     |

Each contact message is uniquely identified by its primary key.

---

## 4.28.5 Foreign Keys

This table does not contain any foreign keys.

---

## 4.28.6 Relationships

The **contact_messages** table is an independent entity and does not have direct relationships with other business tables.

---

## 4.28.7 Indexes

| Column     | Type        |
| ---------- | ----------- |
| id         | Primary Key |
| email      | Index       |
| is_read    | Index       |
| created_at | Index       |

These indexes improve filtering, searching, and administration performance.

---

## 4.28.8 Business Rules

The following business rules apply:

* Every message must contain a sender name.
* Every message must contain a valid email address.
* The message body is mandatory.
* Phone number and subject are optional.
* New messages are marked as **unread** by default.
* When an administrator replies to a message, the **replied_at** timestamp is recorded.
* IP address and browser information are captured for security, auditing, and spam prevention purposes.

---

## 4.28.9 Security Considerations

The **contact_messages** table stores user-generated content and requires additional security measures.

The application should:

* Validate all submitted input.
* Sanitize message content before display.
* Validate email address format.
* Store visitor IP address for abuse detection.
* Store browser information for auditing purposes.
* Protect against spam using CAPTCHA or rate limiting.
* Restrict access to authenticated administrators only.

Because this table contains personal contact information, access should be limited according to the application's authorization policies.

---

## 4.28.10 Referenced By

No database tables reference the **contact_messages** table.

---

## 4.28.11 Notes

The **contact_messages** table serves as the communication log between visitors and the portfolio owner.

Unlike the other portfolio entities, it stores dynamic user-generated content rather than administrator-managed portfolio information.

Its design provides:

* Permanent message history.
* Read/unread management.
* Reply tracking.
* Security auditing.
* Spam investigation support.
* Administrative message management.

This table completes the database structure of the Portfolio Management System and supports the visitor communication workflow implemented through the public contact form.

# 5. Relationships

The database uses relational database principles to establish connections between entities and maintain data consistency. Relationships are primarily implemented through foreign keys and are represented in the application's Eloquent models using Laravel relationship methods.

The database contains several types of relationships, including one-to-one, one-to-many, and many-to-one relationships. The most significant relationship pattern in the system is the translation structure, where multilingual content is separated from the main entity tables and associated with the `languages` table.

The relationships are designed to ensure that:

* Each record is associated with its appropriate parent entity.
* Multilingual content can be managed independently for each supported language.
* Referential integrity is maintained through foreign keys.
* Reusable entities such as languages, project types, and project statuses are not duplicated.
* Deleting a parent record does not leave unnecessary orphaned records.
* The database structure remains normalized and scalable.

## 5.1 Relationship Overview

The main relationships in the database can be divided into the following categories:

| Relationship Category     | Description                                                                           |
| ------------------------- | ------------------------------------------------------------------------------------- |
| Entity-to-Translation     | Connects a main entity with its language-specific translations.                       |
| Language-to-Translation   | Connects each translation record with the language in which it is written.            |
| Project-to-Project Type   | Associates each project with its corresponding project type.                          |
| Project-to-Project Status | Associates each project with its current status.                                      |
| Project-to-Project Images | Allows a project to have multiple images.                                             |
| Skill Category-to-Skills  | Groups multiple skills under a skill category.                                        |
| Entity-to-Translation     | Provides multilingual versions of supported entities.                                 |
| User-to-System Data       | Represents the authenticated administrative user responsible for managing the system. |

The database primarily follows a parent-child relationship model. The parent table contains the main entity, while the child table contains records that depend on the parent.

## 5.2 One-to-Many Relationships

A one-to-many relationship occurs when one record in a parent table can be associated with multiple records in a child table.

This is one of the most frequently used relationship types in the database.

### 5.2.1 About to About Translations

The `abouts` table has a one-to-many relationship with the `about_translations` table.

One `abouts` record can have multiple translations, with each translation corresponding to a different language.

**Relationship:**

```text
abouts
   │
   └───< about_translations
```

The `about_translations` table contains the foreign key referencing the corresponding record in `abouts`.

This structure allows the same About content to be represented in multiple languages without duplicating the main About entity.

### 5.2.2 Experience to Experience Translations

The `experiences` table has a one-to-many relationship with the `experience_translations` table.

One experience can contain multiple language-specific translations.

**Relationship:**

```text
experiences
   │
   └───< experience_translations
```

The translation records contain the localized textual information associated with the corresponding experience.

### 5.2.3 Education to Education Translations

The `education` table has a one-to-many relationship with the `education_translations` table.

One education record can have multiple translations.

**Relationship:**

```text
education
   │
   └───< education_translations
```

This allows educational information to be displayed according to the language selected by the visitor.

### 5.2.4 Skill Category to Skills

The `skill_categories` table has a one-to-many relationship with the `skills` table.

One skill category can contain multiple skills.

**Relationship:**

```text
skill_categories
   │
   └───< skills
```

For example, a category such as "Frontend" may contain multiple skills such as Vue.js, JavaScript, HTML, and CSS.

This relationship allows skills to be organized into logical groups without duplicating category information.

### 5.2.5 Skill Category to Skill Category Translations

The `skill_categories` table has a one-to-many relationship with the `skill_category_translations` table.

One skill category can have multiple translated names or descriptions.

**Relationship:**

```text
skill_categories
   │
   └───< skill_category_translations
```

Each translation belongs to one specific skill category and one specific language.

### 5.2.6 Certification to Certification Translations

The `certifications` table has a one-to-many relationship with the `certification_translations` table.

One certification can have multiple language-specific translations.

**Relationship:**

```text
certifications
   │
   └───< certification_translations
```

This allows certification information to be localized while keeping the certification's core data in a single record.

### 5.2.7 Testimonial to Testimonial Translations

The `testimonials` table has a one-to-many relationship with the `testimonial_translations` table.

One testimonial can have multiple translations.

**Relationship:**

```text
testimonials
   │
   └───< testimonial_translations
```

The main testimonial record stores the entity-level information, while translated textual content is stored separately.

### 5.2.8 Contact to Contact Translations

The `contacts` table has a one-to-many relationship with the `contact_translations` table.

One contact record can have multiple language-specific translations.

**Relationship:**

```text
contacts
   │
   └───< contact_translations
```

This allows contact-related labels, descriptions, or other localized content to be managed independently from the main contact entity.

### 5.2.9 Project to Project Images

The `projects` table has a one-to-many relationship with the `project_images` table.

One project can contain multiple images.

**Relationship:**

```text
projects
   │
   └───< project_images
```

This relationship allows a project to have a gallery containing multiple images without storing multiple image paths directly in the `projects` table.

The `project_images` table therefore acts as a child table for project-specific media.

## 5.3 Translation Relationships

Multilingual functionality is implemented using a dedicated translation-table architecture.

Instead of storing multiple language versions directly in the main entity tables, the system separates translated content into dedicated translation tables.

The general relationship structure is:

```text
                ┌───< entity_translations
                │
entity ─────────┤
                │
                └───< entity_translations
                           │
                           └───> languages
```

Each translation record belongs to:

1. One parent entity.
2. One language.

For example:

```text
abouts
   │
   └───< about_translations >─── languages
```

The same pattern is applied to the other translatable entities.

### 5.3.1 Translation Tables

The following tables use the translation relationship pattern:

| Main Entity        | Translation Table             |
| ------------------ | ----------------------------- |
| `abouts`           | `about_translations`          |
| `experiences`      | `experience_translations`     |
| `education`        | `education_translations`      |
| `skill_categories` | `skill_category_translations` |
| `certifications`   | `certification_translations`  |
| `testimonials`     | `testimonial_translations`    |
| `contacts`         | `contact_translations`        |

The translation tables contain the language-specific fields while the main tables contain the language-independent information.

## 5.4 Language Relationships

The `languages` table acts as a centralized reference table for the multilingual system.

A single language can be associated with many translation records across the database.

Therefore, `languages` has one-to-many relationships with all translation tables.

The general structure is:

```text
languages
   │
   ├───< about_translations
   ├───< experience_translations
   ├───< education_translations
   ├───< skill_category_translations
   ├───< certification_translations
   ├───< testimonial_translations
   └───< contact_translations
```

For example:

```text
languages
   │
   └───< about_translations
```

One language can therefore be used by many About translations.

The same language record can simultaneously be referenced by translations belonging to experiences, education records, certifications, testimonials, and other multilingual entities.

This approach avoids storing language names, language codes, or text-direction information repeatedly in every translation record.

## 5.5 Project Relationships

Projects represent one of the central entities of the portfolio system and therefore have several relationships with supporting tables.

The project relationship structure is:

```text
project_types ───< projects >─── project_statuses
                       │
                       └───< project_images
```

A project therefore depends on reference data such as its type and status and can contain multiple associated images.

### 5.5.1 Project to Project Type

The `project_types` table has a one-to-many relationship with the `projects` table.

One project type can be assigned to multiple projects.

```text
project_types
   │
   └───< projects
```

Each project references one project type through its foreign key.

For example, multiple projects may belong to the same type, such as:

* Web Application
* Mobile Application
* API
* Desktop Application

The exact available types are controlled by the data stored in `project_types`.

### 5.5.2 Project to Project Status

The `project_statuses` table has a one-to-many relationship with the `projects` table.

One project status can be assigned to multiple projects.

```text
project_statuses
   │
   └───< projects
```

Each project references one status.

This allows multiple projects to share the same status without duplicating status information.

Examples of statuses may include:

* Completed
* In Progress
* Planned
* Archived

The actual values are managed through the `project_statuses` table.

### 5.5.3 Project to Project Images

The `projects` table has a one-to-many relationship with `project_images`.

```text
projects
   │
   └───< project_images
```

A project may therefore contain zero, one, or multiple images.

Each image belongs to exactly one project.

This design is preferable to storing multiple image columns directly in the `projects` table because the number of images associated with a project is variable.

## 5.6 Skill Relationships

Skills are organized through skill categories.

The relationship is:

```text
skill_categories
   │
   └───< skills
```

Each skill belongs to one skill category, while a skill category can contain multiple skills.

The category provides organizational information, while the individual skill represents the specific technical or professional competency.

A category can also have multilingual information through `skill_category_translations`:

```text
skill_categories
   ├───< skills
   │
   └───< skill_category_translations
```

This separates skill organization from language-specific category information.

## 5.7 Certification Relationships

Certifications consist of a main certification entity and its language-specific content.

The relationship is:

```text
certifications
   │
   └───< certification_translations
```

One certification may have multiple translations, while each translation belongs to exactly one certification.

This allows certification information to remain structurally consistent across all supported languages.

## 5.8 Testimonial Relationships

Testimonials use the same translation-oriented architecture.

```text
testimonials
   │
   └───< testimonial_translations
```

The `testimonials` table represents the main testimonial entity, while `testimonial_translations` stores language-dependent content.

This prevents duplicate testimonial entities from being created simply because the testimonial is available in multiple languages.

## 5.9 Contact Relationships

The contact section uses a similar multilingual structure:

```text
contacts
   │
   └───< contact_translations
```

The main contact entity stores the language-independent information, while the translation table contains localized content.

The database also contains the `contact_messages` table, which is used to store messages submitted through the public contact form.

`contact_messages` is conceptually related to the contact functionality but is a separate entity representing individual user submissions.

This separation allows the contact information displayed on the website to remain independent from messages submitted by visitors.

## 5.10 User Relationships

The `users` table represents authenticated users who have access to the administrative portion of the application.

The current schema uses the `users` table primarily for authentication and administrative access.

The database does not require a direct foreign-key relationship between `users` and the portfolio content tables in the current implementation.

This means that administrative ownership is handled at the application level rather than by assigning every content record to a specific user.

The structure can therefore be represented as:

```text
users

   │
   │  Application-level administration
   │
   ├── manages → abouts
   ├── manages → experiences
   ├── manages → projects
   ├── manages → education
   ├── manages → skills
   ├── manages → certifications
   ├── manages → testimonials
   ├── manages → contacts
   └── manages → social_links
```

These are **logical/application relationships**, not database foreign-key relationships.

If multi-user administration is required in the future, explicit ownership or audit relationships can be introduced.

## 5.11 Social Media Relationships

The `social_links` table represents social media and external profile links displayed on the portfolio.

The current schema treats each social link as an independent record rather than creating separate tables for every social media platform.

This approach avoids unnecessary table proliferation and allows new platforms to be added without modifying the database structure.

The relationship can therefore be considered independent:

```text
social_links
```

No foreign-key relationship with a specific content entity is required in the current design.

The application determines where and how social links are displayed.

## 5.12 Contact Message Relationships

The `contact_messages` table stores individual messages submitted by website visitors.

Each message represents an independent communication record containing information such as:

* Sender name
* Sender email
* Phone number
* Subject
* Message content
* IP address
* User agent
* Message status or administrative processing information

The current schema does not require each message to reference a `users` record because website visitors are not required to authenticate before submitting a contact form.

Therefore:

```text
contact_messages
```

is an independent entity from the authenticated administrative `users` entity.

The administrator can access and manage these messages through the administrative interface.

## 5.13 Referential Integrity

Foreign-key relationships are used to maintain referential integrity between related tables.

A child record must reference an existing parent record when a foreign key is defined.

For example, an `about_translations` record cannot reference an `abouts` record that does not exist.

The same principle applies to:

* Translation records and their parent entities.
* Translation records and languages.
* Projects and project types.
* Projects and project statuses.
* Project images and projects.
* Skills and skill categories.

Referential integrity prevents invalid references and reduces the possibility of orphaned records.

## 5.14 Cascade Behavior

Dependent records should be removed or handled appropriately when their parent record is deleted.

For example, when an `abouts` record is deleted, its associated `about_translations` records should not remain in the database as orphaned records.

The same principle applies to other parent-child relationships, such as:

```text
abouts → about_translations
experiences → experience_translations
education → education_translations
skill_categories → skills
skill_categories → skill_category_translations
certifications → certification_translations
testimonials → testimonial_translations
contacts → contact_translations
projects → project_images
```

Where appropriate, foreign keys should use cascading deletion so that dependent records are automatically removed when their parent is deleted.

The exact `ON DELETE` behavior should be defined consistently in the Laravel migrations and documented in the database constraints section.

## 5.15 Relationship Summary

The overall database relationship structure can be summarized as follows:

```text
                                  ┌───< about_translations >─── languages
                                  │
                              abouts
                                  │

                          experiences
                              │
                              └───< experience_translations >─── languages

                           education
                              │
                              └───< education_translations >─── languages

                     skill_categories
                       │           │
                       │           └───< skill_category_translations >─── languages
                       │
                       └───< skills

                       certifications
                              │
                              └───< certification_translations >─── languages

                            projects
                           /   │    \
                          /    │     \
                         /     │      └───< project_images
                        /      │
             project_types   project_statuses

                          testimonials
                              │
                              └───< testimonial_translations >─── languages

                            contacts
                              │
                              └───< contact_translations >─── languages

                            users

                        social_links

                      contact_messages
```

The database therefore follows a structured relational model in which reusable reference entities are separated from transactional or content entities, and multilingual content is represented through dedicated translation tables.

This relationship architecture provides a clear separation of concerns, maintains referential integrity, supports the application's multilingual requirements, and allows the portfolio CMS to be extended without requiring major structural changes to existing entities.

# 6. Index Strategy

The database index strategy is designed to improve query performance while maintaining an appropriate balance between read efficiency, storage requirements, and write performance.

Indexes allow the database management system to locate records more efficiently without scanning the entire table. They are particularly important for columns that are frequently used in `WHERE`, `JOIN`, `ORDER BY`, and uniqueness operations.

The database uses several types of indexes, including:

* Primary key indexes.
* Unique indexes.
* Foreign key indexes.
* Composite indexes.
* Indexes on frequently queried attributes.

The indexing strategy follows the principle of indexing columns according to their actual usage rather than indiscriminately indexing every column.

## 6.1 Indexing Objectives

The primary objectives of the indexing strategy are:

1. Improve query performance for frequently accessed data.
2. Optimize foreign-key lookups and joins.
3. Enforce uniqueness requirements.
4. Improve filtering and searching operations.
5. Support efficient retrieval of multilingual content.
6. Reduce unnecessary full-table scans.
7. Maintain acceptable insert, update, and delete performance.
8. Avoid excessive indexes that increase storage and maintenance overhead.

Indexes should therefore be created when they provide a meaningful performance or integrity benefit.

## 6.2 Primary Key Indexes

Every main database table uses a primary key to uniquely identify each record.

The standard primary key for the application is the `id` column.

Examples include:

```text
users.id
abouts.id
about_translations.id
experiences.id
experience_translations.id
project_types.id
project_statuses.id
projects.id
project_images.id
education.id
education_translations.id
skill_categories.id
skill_category_translations.id
skills.id
certifications.id
certification_translations.id
social_links.id
testimonials.id
testimonial_translations.id
contacts.id
contact_translations.id
languages.id
contact_messages.id
```

Primary keys are automatically indexed by MySQL and provide efficient direct record lookup.

For example:

```sql
SELECT *
FROM projects
WHERE id = 10;
```

The database can use the primary key index to locate the record efficiently.

## 6.3 Unique Indexes

Unique indexes are used when a column or combination of columns must contain unique values.

The primary purpose of a unique index is to enforce data integrity while also providing efficient lookup.

### 6.3.1 Users Table

The `users` table contains unique identifying attributes such as:

```text
username
email
```

These values should not be duplicated between users.

The unique indexes ensure that two users cannot be registered with the same username or email address.

Example:

```sql
SELECT *
FROM users
WHERE email = 'example@example.com';
```

The unique index on `email` allows this lookup to be performed efficiently while enforcing uniqueness.

### 6.3.2 Projects Table

The `projects` table contains a unique `slug`.

The slug is used to identify a project through a URL-friendly value.

Example:

```text
/projects/my-portfolio
/projects/e-commerce-platform
```

The unique index guarantees that two projects cannot have the same slug.

Example query:

```sql
SELECT *
FROM projects
WHERE slug = 'my-portfolio';
```

This is both a uniqueness requirement and a frequent lookup operation, making a unique index appropriate.

### 6.3.3 Languages Table

The `languages` table contains a language `code` that identifies each supported language.

The language code should be unique because each language must have one unique identifier within the application.

Examples include:

```text
en
es
pt
fa
tr
ar
de
```

A unique index prevents duplicate language codes.

## 6.4 Foreign Key Indexes

Foreign keys are frequently used when joining related tables.

Indexes on foreign-key columns allow the database to locate related records more efficiently.

The following types of relationships require foreign-key indexing:

```text
about_translations.about_id
about_translations.language_id

experience_translations.experience_id
experience_translations.language_id

education_translations.education_id
education_translations.language_id

skill_category_translations.skill_category_id
skill_category_translations.language_id

skills.skill_category_id

certification_translations.certification_id
certification_translations.language_id

testimonial_translations.testimonial_id
testimonial_translations.language_id

contact_translations.contact_id
contact_translations.language_id

projects.project_type_id
projects.project_status_id

project_images.project_id
```

These indexes improve queries involving joins between parent and child tables.

For example:

```sql
SELECT *
FROM project_images
WHERE project_id = 10;
```

The index on `project_id` allows the database to locate the images associated with the project without scanning the entire `project_images` table.

## 6.5 Translation Index Strategy

Because the application supports multiple languages, translation tables are an important part of the indexing strategy.

A translation record is normally identified by two logical dimensions:

1. The parent entity.
2. The language.

For example:

```text
about_id + language_id
experience_id + language_id
education_id + language_id
```

Queries frequently use both values together.

A typical query is:

```sql
SELECT *
FROM about_translations
WHERE about_id = 1
AND language_id = 3;
```

Therefore, translation tables should use composite indexes where appropriate.

## 6.6 Composite Indexes

A composite index contains multiple columns and is useful when queries commonly filter by those columns together.

The translation tables are the primary candidates for composite indexing.

### 6.6.1 About Translations

Recommended composite index:

```text
(about_id, language_id)
```

This optimizes queries that retrieve the translation for a specific About record in a specific language.

Example:

```sql
SELECT *
FROM about_translations
WHERE about_id = 1
AND language_id = 2;
```

### 6.6.2 Experience Translations

Recommended composite index:

```text
(experience_id, language_id)
```

This allows efficient retrieval of a specific experience translation.

### 6.6.3 Education Translations

Recommended composite index:

```text
(education_id, language_id)
```

This supports language-specific education queries.

### 6.6.4 Skill Category Translations

Recommended composite index:

```text
(skill_category_id, language_id)
```

This allows the application to efficiently retrieve the translated category name for a particular skill category.

### 6.6.5 Certification Translations

Recommended composite index:

```text
(certification_id, language_id)
```

This supports language-specific certification queries.

### 6.6.6 Testimonial Translations

Recommended composite index:

```text
(testimonial_id, language_id)
```

This supports retrieving the correct testimonial translation for the selected language.

### 6.6.7 Contact Translations

Recommended composite index:

```text
(contact_id, language_id)
```

This supports language-specific contact content retrieval.

## 6.7 Unique Composite Indexes for Translations

In addition to improving query performance, composite indexes can enforce the rule that an entity can have only one translation for a particular language.

For example, an About entity should not have two English translations.

The following unique composite constraint can therefore be applied:

```text
UNIQUE (about_id, language_id)
```

The same principle applies to the other translation tables:

```text
UNIQUE (experience_id, language_id)

UNIQUE (education_id, language_id)

UNIQUE (skill_category_id, language_id)

UNIQUE (certification_id, language_id)

UNIQUE (testimonial_id, language_id)

UNIQUE (contact_id, language_id)
```

This guarantees that each entity has at most one translation for each supported language.

For example, the following combination is valid:

```text
about_id = 1
language_id = 1
```

But another record with:

```text
about_id = 1
language_id = 1
```

would violate the unique constraint.

A different language is allowed:

```text
about_id = 1
language_id = 2
```

This structure provides both data integrity and efficient language-specific lookup.

## 6.8 Search and Filtering Indexes

Some columns are likely to be used frequently for filtering or searching.

Indexes should be considered for these columns when the corresponding queries become sufficiently frequent or the tables become sufficiently large.

Potential candidates include:

```text
projects.slug
projects.project_type_id
projects.project_status_id
skills.skill_category_id
project_images.project_id
languages.code
```

The final index configuration should be based on actual query patterns and database execution plans.

Indexes should not be added solely because a column may theoretically be searchable.

## 6.9 Project Index Strategy

The `projects` table is expected to be one of the more frequently accessed content tables.

Potential indexes include:

| Column              | Index Type  | Purpose                       |
| ------------------- | ----------- | ----------------------------- |
| `id`                | Primary     | Unique project identification |
| `slug`              | Unique      | URL lookup and uniqueness     |
| `project_type_id`   | Foreign Key | Filtering projects by type    |
| `project_status_id` | Foreign Key | Filtering projects by status  |

For example, the following query can benefit from the project type index:

```sql
SELECT *
FROM projects
WHERE project_type_id = 2;
```

Similarly, filtering by project status can use the corresponding foreign-key index.

## 6.10 Project Images Index Strategy

The `project_images` table is accessed primarily through its relationship with `projects`.

The `project_id` column should therefore be indexed.

Example:

```sql
SELECT *
FROM project_images
WHERE project_id = 10
ORDER BY id;
```

The index allows the database to efficiently locate all images belonging to a particular project.

If the table later introduces an explicit ordering column such as `sort_order`, a composite index such as:

```text
(project_id, sort_order)
```

may be considered.

This would support efficient retrieval of project images in their intended display order.

## 6.11 Skill Index Strategy

The `skills` table is organized by `skill_category_id`.

The foreign-key index on `skill_category_id` allows efficient retrieval of all skills belonging to a specific category.

Example:

```sql
SELECT *
FROM skills
WHERE skill_category_id = 3;
```

If the application frequently sorts or filters skills within categories using another column, a composite index may be introduced based on the actual query pattern.

## 6.12 Contact Message Index Strategy

The `contact_messages` table represents visitor-submitted messages and may become one of the most frequently queried administrative tables.

Potential index candidates include fields used by the administration interface for filtering and ordering.

Examples include:

```text
created_at
read/status field
email
```

The `created_at` column is particularly useful when messages are displayed in chronological or reverse-chronological order.

For example:

```sql
SELECT *
FROM contact_messages
ORDER BY created_at DESC;
```

An index on `created_at` can improve retrieval when the table contains a large number of messages.

If the administration interface frequently retrieves unread messages, an index involving the message status field may also be beneficial.

The exact index should depend on the final structure of the `contact_messages` table and the queries generated by the application.

## 6.13 Timestamp Indexes

Laravel tables commonly contain:

```text
created_at
updated_at
```

These columns should not automatically be indexed on every table.

A timestamp should be indexed only when the application frequently performs operations such as:

```sql
ORDER BY created_at DESC
```

or:

```sql
WHERE created_at >= ...
```

For example, dashboard statistics may query records by month or date range.

If the application frequently performs date-based reporting on `contact_messages`, an index on `created_at` can improve those operations.

However, unnecessary timestamp indexes should be avoided because every additional index increases the cost of insert and update operations.

## 6.14 Indexing Multilingual Queries

The application's multilingual architecture makes language-based filtering a common operation.

A typical query may retrieve the translation associated with:

```text
Entity ID
+
Language ID
```

For example:

```sql
SELECT *
FROM experience_translations
WHERE experience_id = 5
AND language_id = 1;
```

The composite index:

```text
(experience_id, language_id)
```

is therefore appropriate because it reflects the actual query pattern.

The column order is also important.

For queries that begin with the parent entity and then filter by language, the parent foreign key should appear first:

```text
(entity_id, language_id)
```

This follows the leftmost-prefix principle of composite indexes.

## 6.15 Index Naming Convention

Indexes should follow a consistent naming convention to make the database structure easier to understand and maintain.

Recommended naming patterns include:

```text
PRIMARY
UNIQUE:      table_column_unique
FOREIGN KEY: table_column_foreign
INDEX:       table_column_index
COMPOSITE:   table_column1_column2_index
UNIQUE COMPOSITE:
            table_column1_column2_unique
```

Examples:

```text
projects_slug_unique
projects_project_type_id_index
projects_project_status_id_index
project_images_project_id_index
about_translations_about_id_language_id_unique
```

Laravel migrations normally generate appropriate foreign-key and unique constraint names automatically, but explicit names may be used when greater control is required.

## 6.16 Index Maintenance Considerations

Indexes improve read performance but introduce additional overhead.

Whenever a record is inserted, updated, or deleted, affected indexes may also need to be updated.

Therefore, excessive indexing can result in:

* Increased disk usage.
* Increased memory requirements.
* Slower insert operations.
* Slower update operations.
* Slower delete operations.
* Increased database maintenance overhead.

The database should therefore maintain only indexes that provide a clear performance or integrity benefit.

## 6.17 Index Selection Based on Query Patterns

Index decisions should be based on actual application behavior.

The most important queries to consider include:

```text
Retrieve a project by slug.
Retrieve translations for a selected language.
Retrieve all projects of a specific type.
Retrieve all projects with a specific status.
Retrieve all images belonging to a project.
Retrieve all skills belonging to a category.
Retrieve recent contact messages.
Retrieve unread contact messages.
Retrieve records for dashboard statistics.
```

Indexes should be evaluated against these query patterns.

When performance problems appear, MySQL query execution plans can be analyzed using:

```sql
EXPLAIN
```

For example:

```sql
EXPLAIN
SELECT *
FROM projects
WHERE slug = 'my-project';
```

The execution plan can be used to determine whether the appropriate index is being utilized.

## 6.18 Avoiding Redundant Indexes

Redundant indexes should be avoided.

For example, if a unique index already exists on:

```text
projects.slug
```

creating another standard index on the same column is unnecessary.

Similarly, if a composite unique index exists on:

```text
(about_id, language_id)
```

it may already provide the required lookup capability for queries beginning with `about_id`.

The database design should therefore be reviewed periodically to identify duplicate or overlapping indexes.

## 6.19 Index Strategy Summary

The primary indexing strategy can be summarized as follows:

| Table / Area       | Indexed Columns                    | Index Purpose                  |
| ------------------ | ---------------------------------- | ------------------------------ |
| All tables         | `id`                               | Primary key lookup             |
| `users`            | `username`, `email`                | Unique identification          |
| `projects`         | `slug`                             | Unique URL lookup              |
| `languages`        | `code`                             | Unique language identification |
| Translation tables | Parent foreign key + `language_id` | Language-specific lookup       |
| `projects`         | `project_type_id`                  | Project type filtering         |
| `projects`         | `project_status_id`                | Project status filtering       |
| `project_images`   | `project_id`                       | Project image retrieval        |
| `skills`           | `skill_category_id`                | Skill category filtering       |
| `contact_messages` | `created_at`                       | Recent message retrieval       |
| `contact_messages` | Status/read field, if applicable   | Message filtering              |

The indexing strategy provides efficient access to the application's primary query patterns while avoiding unnecessary indexing of low-value columns.

The strategy should be reviewed as the application grows. Query performance should be monitored using database execution plans and actual application workloads, and additional indexes should be introduced only when they provide measurable benefits.

# 7. Constraints

Database constraints are rules enforced by the database to maintain data integrity, consistency, validity, and referential correctness.

The portfolio CMS uses several types of constraints to ensure that invalid or inconsistent data cannot be stored in the database.

The primary constraint types used by the system are:

* Primary key constraints.
* Foreign key constraints.
* Unique constraints.
* Not-null constraints.
* Nullable constraints.
* Default value constraints.
* Enum constraints.
* Referential action constraints.
* Composite unique constraints.

These constraints work together with Laravel's validation layer. Application-level validation provides user-friendly validation before data reaches the database, while database constraints provide the final layer of data integrity.

## 7.1 Constraint Objectives

The main objectives of the database constraint strategy are:

1. Guarantee that every record has a unique identifier.
2. Prevent duplicate values where uniqueness is required.
3. Prevent invalid foreign-key references.
4. Prevent required fields from containing `NULL`.
5. Define appropriate default values.
6. Restrict fields with a limited set of valid values.
7. Prevent duplicate translations for the same entity and language.
8. Maintain referential integrity between parent and child records.
9. Protect the database from invalid data even when application-level validation is bypassed.

Database constraints therefore act as a permanent integrity layer independent of the application interface.

## 7.2 Primary Key Constraints

Every main table contains a primary key that uniquely identifies each record.

The standard primary key is the `id` column.

Examples include:

```text id="wqv4jz"
users.id
abouts.id
about_translations.id
experiences.id
experience_translations.id
project_types.id
project_statuses.id
projects.id
project_images.id
education.id
education_translations.id
skill_categories.id
skill_category_translations.id
skills.id
certifications.id
certification_translations.id
social_links.id
testimonials.id
testimonial_translations.id
contacts.id
contact_translations.id
languages.id
contact_messages.id
```

A primary key provides two important guarantees:

* Each record has a unique identifier.
* A primary key cannot contain `NULL`.

The primary key is also used as the target of foreign-key relationships from dependent tables.

## 7.3 Foreign Key Constraints

Foreign key constraints establish valid relationships between related tables.

A foreign key ensures that a child record references an existing record in the parent table.

The main foreign-key relationships include:

```text id="8c9r6w"
about_translations.about_id
    → abouts.id

about_translations.language_id
    → languages.id

experience_translations.experience_id
    → experiences.id

experience_translations.language_id
    → languages.id

education_translations.education_id
    → education.id

education_translations.language_id
    → languages.id

skill_category_translations.skill_category_id
    → skill_categories.id

skill_category_translations.language_id
    → languages.id

skills.skill_category_id
    → skill_categories.id

certification_translations.certification_id
    → certifications.id

certification_translations.language_id
    → languages.id

testimonial_translations.testimonial_id
    → testimonials.id

testimonial_translations.language_id
    → languages.id

contact_translations.contact_id
    → contacts.id

contact_translations.language_id
    → languages.id

projects.project_type_id
    → project_types.id

projects.project_status_id
    → project_statuses.id

project_images.project_id
    → projects.id
```

These constraints prevent child records from referencing nonexistent parent records.

For example, a project cannot reference a project type with an ID that does not exist in `project_types`.

## 7.4 Foreign Key Integrity

Foreign key constraints protect the database from orphaned or invalid records.

For example, the following operation should not be allowed:

```sql id="0v3slc"
INSERT INTO project_images (project_id, ...)
VALUES (99999, ...);
```

if project `99999` does not exist.

The database should reject the operation because the referenced project does not exist.

This guarantees that every `project_images` record belongs to a valid project.

The same principle applies to all translation and relationship tables.

## 7.5 Unique Constraints

Unique constraints ensure that a value or combination of values cannot be duplicated.

The database uses unique constraints for attributes that must identify records uniquely within their respective scope.

Important examples include:

```text id="5r4x8a"
users.username
users.email
projects.slug
languages.code
```

These constraints protect the database against duplicate identifying values.

### 7.5.1 User Username

The `username` field in the `users` table must be unique.

This prevents multiple users from having the same username.

```text id="6f0v1q"
UNIQUE(username)
```

### 7.5.2 User Email

The `email` field in the `users` table must be unique.

```text id="w4dr1n"
UNIQUE(email)
```

This prevents multiple accounts from being registered using the same email address.

### 7.5.3 Project Slug

The `slug` field in the `projects` table must be unique.

```text id="e0e8d7"
UNIQUE(slug)
```

This is necessary because the slug is used as a URL-friendly identifier.

For example:

```text
/projects/my-project
```

must uniquely identify one project.

### 7.5.4 Language Code

The `code` field in the `languages` table must be unique.

```text id="1t9y6m"
UNIQUE(code)
```

This ensures that a language code cannot represent multiple language records.

## 7.6 Composite Unique Constraints

Composite unique constraints apply uniqueness rules to multiple columns together.

They are particularly important for the translation system.

A translation should be unique according to:

```text
Parent Entity + Language
```

Therefore, the following combinations should be unique:

```text id="b9j4az"
(about_id, language_id)

(experience_id, language_id)

(education_id, language_id)

(skill_category_id, language_id)

(certification_id, language_id)

(testimonial_id, language_id)

(contact_id, language_id)
```

For example:

```text id="w2y8i6"
about_id = 1
language_id = 1
```

can exist only once in `about_translations`.

The database must reject another record containing the same combination.

However, the following is valid:

```text id="7t1mce"
about_id = 1
language_id = 2
```

because it represents a different language.

This constraint guarantees that one entity cannot accidentally have multiple translations for the same language.

## 7.7 NOT NULL Constraints

A `NOT NULL` constraint requires a column to contain a value.

It prevents the database from storing `NULL` in fields that are mandatory.

The use of `NOT NULL` should reflect whether the application considers a field essential to the existence or validity of the record.

Typical required fields include:

```text id="r6g8yr"
name
email
title
message
language_id
foreign key identifiers
slug
```

The exact fields depend on the individual table definitions documented in Section 4.

For example, a translation record must normally reference both:

```text id="7c2u4k"
parent entity
language
```

Therefore, the corresponding foreign-key fields should not be nullable unless the application explicitly supports an unassociated translation.

## 7.8 Nullable Columns

Nullable columns are used when a value is legitimately optional.

A nullable column can contain either:

* A valid value.
* `NULL`.

Examples from the database include optional fields such as:

```text id="v8f0xk"
phone
subject
expiration_date
photo
last_login_at
last_login_ip
```

Nullable values should be used intentionally.

`NULL` should represent the absence of a value rather than being used as a replacement for an empty string or arbitrary placeholder.

For example, an education or certification record with no expiration date may use:

```text
expiration_date = NULL
```

when the associated item does not expire.

## 7.9 Default Value Constraints

Default values provide automatic values when an insert operation does not explicitly provide a value.

Defaults are useful for fields where there is a well-defined standard state.

For example, the `languages.direction` field has a default value:

```text id="8f9k2a"
ltr
```

This means that a language record is treated as left-to-right unless another supported direction is explicitly specified.

Default values reduce the amount of repetitive data that must be supplied by the application and provide predictable initial states.

## 7.10 Enum Constraints

The `languages.direction` field uses a controlled set of values representing text direction.

The supported values are:

```text id="w2f9ka"
ltr
rtl
```

The constraint ensures that a language cannot be assigned an unsupported direction value.

For example:

```text id="qv1s7m"
direction = 'ltr'
```

is valid.

```text id="0e8j4c"
direction = 'rtl'
```

is also valid.

An unsupported value should be rejected.

This is particularly important because the frontend uses the language direction when displaying multilingual content.

## 7.11 Referential Actions

Foreign keys may define actions that determine what happens to child records when their parent record is modified or deleted.

The main referential actions considered by the database are:

* `CASCADE`
* `SET NULL`
* `RESTRICT`
* `NO ACTION`

The appropriate action depends on the semantics of the relationship.

## 7.12 Cascade Delete Constraints

`CASCADE` is appropriate for dependent records that have no meaningful existence without their parent.

Translation records are an important example.

If an About record is permanently deleted, its translations should normally also be deleted:

```text id="q4zv5p"
abouts
   │
   └── CASCADE → about_translations
```

The same principle applies to:

```text id="j3m9hx"
experiences
    → experience_translations

education
    → education_translations

skill_categories
    → skill_category_translations

certifications
    → certification_translations

testimonials
    → testimonial_translations

contacts
    → contact_translations

projects
    → project_images
```

This prevents orphaned child records.

## 7.13 SET NULL Constraints

`SET NULL` should only be used when a child record can logically continue to exist after its parent relationship is removed.

When `SET NULL` is used, the corresponding foreign-key column must be nullable.

For example, if a future design allows a project to remain in the database after its project type is removed, the relationship could use:

```text id="pj5t3a"
project_type_id → SET NULL
```

The resulting project would have:

```text id="4ev7c2"
project_type_id = NULL
```

However, this behavior should only be used when the application explicitly supports an unassigned project type.

It should not be used simply to avoid foreign-key errors.

## 7.14 RESTRICT Constraints

`RESTRICT` prevents the deletion of a parent record when dependent records still reference it.

This behavior is appropriate when deleting the parent would create an invalid or semantically incorrect state.

For example, a project type that is currently referenced by projects may be protected from deletion:

```text id="y4r1vb"
project_types
      │
      └── projects
```

If deleting the project type would leave projects without a valid type, the database can reject the deletion.

The application can then require the administrator to reassign or remove the dependent projects before deleting the type.

## 7.15 Constraint Strategy for Reference Tables

Reference tables such as:

```text id="g1t5mf"
project_types
project_statuses
languages
skill_categories
```

require careful deletion behavior.

These tables are referenced by other records and therefore should not be deleted if doing so would invalidate existing relationships.

For example, deleting a language that is used by multiple translation records could cause substantial data loss.

The application should therefore either:

1. Prevent deletion while the language is in use.
2. Remove dependent translations intentionally.
3. Introduce a soft-delete or active/inactive mechanism.

The appropriate approach depends on the business rules of the application.

## 7.16 Constraints on Translation Records

Translation tables have several integrity requirements.

Each translation record should:

1. Reference an existing parent entity.
2. Reference an existing language.
3. Contain all required translated fields.
4. Exist only once for each entity-language combination.

The general constraint model is:

```text id="4r3p1e"
translation
    │
    ├── parent_id ──→ parent entity
    │
    ├── language_id ──→ languages
    │
    └── UNIQUE(parent_id, language_id)
```

This structure guarantees that translations remain correctly associated with both their entity and language.

## 7.17 Constraints on Project Data

Projects contain several relationships that require database constraints.

A project must reference valid values for its related reference entities.

The structure is:

```text id="1r0d5q"
projects
   │
   ├── project_type_id
   │       └──→ project_types.id
   │
   └── project_status_id
           └──→ project_statuses.id
```

The project slug must also remain unique.

Together, these constraints guarantee that every project has valid reference data and a unique URL identifier.

## 7.18 Constraints on Project Images

Each project image must belong to an existing project.

Therefore:

```text id="j9a8xv"
project_images.project_id
        ↓
projects.id
```

is protected by a foreign-key constraint.

Because an image has no independent meaning within the current application without its project, cascading deletion is appropriate.

When a project is permanently deleted, its associated project images should also be removed.

## 7.19 Constraints on Skills

Each skill belongs to a skill category.

Therefore:

```text id="k8m4tg"
skills.skill_category_id
        ↓
skill_categories.id
```

must reference an existing category.

This prevents a skill from being associated with a nonexistent category.

The database should therefore reject a skill record containing an invalid `skill_category_id`.

## 7.20 Constraints on Contact Messages

`contact_messages` represents visitor-submitted communication.

Unlike authenticated administrative data, a contact message does not require an authenticated user relationship.

Therefore, fields such as sender name and email belong to the message itself rather than referencing the `users` table.

The database should enforce required fields such as the sender's identity and message content according to the application's requirements.

Optional fields such as:

```text id="d9w0c1"
phone
subject
ip_address
user_agent
```

may remain nullable when the information is not available.

## 7.21 Application-Level Validation and Database Constraints

Database constraints and Laravel validation serve different purposes and should be used together.

### Application-Level Validation

Laravel Form Request classes validate incoming data before database operations occur.

Examples include:

```text
required
string
email
max
unique
exists
nullable
date
```

Application validation provides clear validation messages and prevents unnecessary database operations.

### Database-Level Constraints

Database constraints provide persistent protection regardless of how the database is accessed.

For example, even if an application-level `unique` validation is accidentally omitted, a database-level unique constraint on `projects.slug` can still prevent duplicate slugs.

The two layers should therefore complement each other.

```text id="4q9q0a"
User Input
    │
    ↓
Laravel Validation
    │
    ↓
Application Logic
    │
    ↓
Database Constraints
    │
    ↓
Stored Data
```

## 7.22 Constraint Redundancy

Some constraints may appear to duplicate application-level validation.

This is intentional.

For example:

```text
Laravel:
unique:projects,slug

Database:
UNIQUE(projects.slug)
```

The Laravel validation provides an appropriate response to the user, while the database constraint guarantees integrity at the storage level.

Application validation alone is insufficient because databases may be accessed through:

* Laravel jobs.
* Artisan commands.
* Database management tools.
* Future applications.
* Direct SQL operations.
* Other backend services.

The database must therefore enforce critical integrity rules independently.

## 7.23 Constraint Naming Convention

Constraints should follow a consistent naming strategy.

Recommended patterns include:

```text id="q1b7ez"
Foreign Key:
table_column_foreign

Unique:
table_column_unique

Composite Unique:
table_column1_column2_unique
```

Examples:

```text id="k5f8qv"
projects_project_type_id_foreign
projects_project_status_id_foreign
projects_slug_unique
about_translations_about_id_foreign
about_translations_language_id_foreign
about_translations_about_id_language_id_unique
```

Laravel migrations normally generate these names automatically based on the table and column names.

Explicit names may be used when a custom naming strategy is required.

## 7.24 Constraint Validation and Testing

Database constraints should be verified through automated tests and database-level testing.

Important test cases include:

### Primary Key Tests

Verify that:

* IDs are automatically generated.
* IDs are unique.
* IDs cannot be `NULL`.

### Foreign Key Tests

Verify that:

* Valid parent IDs are accepted.
* Invalid parent IDs are rejected.
* Parent deletion follows the configured referential action.

### Unique Constraint Tests

Verify that:

* Duplicate usernames are rejected.
* Duplicate emails are rejected.
* Duplicate project slugs are rejected.
* Duplicate language codes are rejected.

### Translation Constraint Tests

Verify that:

* A translation references an existing entity.
* A translation references an existing language.
* The same entity cannot have duplicate translations for the same language.
* Different languages can be associated with the same entity.

### Nullable Field Tests

Verify that:

* Optional fields can contain `NULL`.
* Required fields cannot contain `NULL`.

## 7.25 Constraint Summary

The database constraint strategy can be summarized as follows:

| Constraint       | Purpose                                        | Main Examples                              |
| ---------------- | ---------------------------------------------- | ------------------------------------------ |
| Primary Key      | Uniquely identify records                      | `id`                                       |
| Foreign Key      | Maintain valid relationships                   | `language_id`, `project_id`                |
| Unique           | Prevent duplicate values                       | `email`, `username`, `slug`, `code`        |
| Composite Unique | Prevent duplicate entity-language combinations | `entity_id + language_id`                  |
| NOT NULL         | Require mandatory data                         | Required names, identifiers, relationships |
| Nullable         | Allow optional data                            | `phone`, `subject`, `expiration_date`      |
| Default          | Provide a standard value                       | `languages.direction`                      |
| Enum             | Restrict values to an allowed set              | `ltr`, `rtl`                               |
| CASCADE          | Remove dependent records with parent           | Translations, project images               |
| SET NULL         | Preserve child while removing association      | Optional future relationships              |
| RESTRICT         | Prevent deletion of referenced records         | Reference entities                         |

## 7.26 Overall Constraint Strategy

The database uses constraints as the final layer of data integrity.

The strategy can be represented as:

```text id="v0d5mc"
                    Database Integrity
                           │
        ┌──────────────────┼──────────────────┐
        │                  │                  │
   Identification     Relationships       Valid Values
        │                  │                  │
   Primary Keys       Foreign Keys      NOT NULL / NULL
   Unique Keys        Referential       Defaults
   Composite Keys     Actions            ENUM
```

The combination of these constraints ensures that the database remains internally consistent and that records cannot easily enter an invalid state.

Application-level validation remains responsible for providing user-friendly validation and enforcing business rules, while database constraints guarantee fundamental structural integrity.

This layered approach provides a reliable foundation for the portfolio CMS and allows the database to remain consistent even as the application evolves.

# 8. Normalization

Database normalization is the process of organizing data into tables and relationships in order to reduce redundancy, prevent data anomalies, and improve data integrity.

The portfolio CMS database follows relational database normalization principles, primarily targeting **Third Normal Form (3NF)**.

The normalization strategy separates independent entities into dedicated tables and uses foreign-key relationships to connect related data.

The database is designed to minimize:

* Data duplication.
* Update anomalies.
* Insert anomalies.
* Delete anomalies.
* Repeated attributes.
* Unnecessary dependencies between unrelated entities.

At the same time, the database intentionally retains certain structures, such as the JSON-based `technologies` field in the `projects` table, where the application requirements do not justify introducing additional relational tables.

## 8.1 Normalization Objectives

The primary objectives of normalization are:

1. Reduce unnecessary data duplication.
2. Ensure that each piece of information has a clear ownership location.
3. Separate independent entities into appropriate tables.
4. Maintain data consistency through relationships.
5. Prevent update, insertion, and deletion anomalies.
6. Support the multilingual architecture without duplicating complete entities.
7. Improve maintainability and extensibility.
8. Maintain a clear relationship between database entities and application models.

The database primarily follows the principles of:

* First Normal Form (1NF).
* Second Normal Form (2NF).
* Third Normal Form (3NF).

Higher normal forms are not required for the current application because the schema does not contain complex dependency structures that justify their use.

## 8.2 First Normal Form (1NF)

A relational table satisfies First Normal Form when:

1. Each column contains atomic values.
2. Each column represents one type of information.
3. There are no repeating groups.
4. Each record can be uniquely identified.

The database follows these principles throughout the primary entity tables.

For example, instead of storing multiple phone numbers in separate repeated columns:

```text
phone_1
phone_2
phone_3
```

the database stores a single value for the corresponding attribute.

Similarly, multiple project images are not stored as:

```text
image_1
image_2
image_3
```

inside the `projects` table.

Instead, they are represented by separate records in `project_images`.

```text id="h5n3qz"
projects
   │
   └───< project_images
```

This allows an arbitrary number of images to be associated with a project without creating repeating columns.

## 8.3 Atomic Data

Atomicity means that each database field represents one logical value rather than an uncontrolled collection of independent values.

Examples of atomic attributes include:

```text
users.username
users.email
projects.slug
languages.code
languages.direction
skills.skill_category_id
projects.project_type_id
projects.project_status_id
```

Each field represents one specific attribute of its associated entity.

For example:

```text id="8hj1qk"
projects.project_type_id
```

contains one project type identifier rather than multiple project types in a single field.

## 8.4 Repeating Groups

The database avoids repeating groups by creating child tables where multiple records may exist.

For example, a project can contain multiple images.

Instead of:

```text id="7v2jz4"
projects
--------------------------------
image_1
image_2
image_3
image_4
```

the database uses:

```text id="g9m3fs"
projects
   │
   └───< project_images
```

This structure allows any number of images to be associated with a project.

The same principle is used for multilingual content.

Instead of:

```text id="1v8q3c"
about_title_en
about_title_pt
about_title_es
about_title_fa
about_title_tr
...
```

the database uses:

```text id="q8m2ka"
abouts
   │
   └───< about_translations
             │
             └───> languages
```

This avoids creating additional columns whenever a new language is introduced.

## 8.5 First Normal Form in Translation Tables

Translation tables also follow 1NF.

For example:

```text id="p6w4sa"
about_translations
--------------------------------
id
about_id
language_id
title
description
...
```

Each field contains one logical value, while each record represents one translation of one About entity in one language.

The same structure is applied to:

```text
experience_translations
education_translations
skill_category_translations
certification_translations
testimonial_translations
contact_translations
```

This provides a consistent relational representation of multilingual data.

## 8.6 Second Normal Form (2NF)

A table satisfies Second Normal Form when:

1. It is already in 1NF.
2. Every non-key attribute depends on the entire primary key.

The majority of the database tables use a single-column primary key, typically `id`.

Because the primary key consists of only one attribute, partial dependency is not applicable to those tables.

For example:

```text id="6s9b1p"
projects
--------------------------------
id
slug
project_type_id
project_status_id
...
```

All non-key attributes depend on the project `id`.

## 8.7 2NF in Translation Tables

Translation tables provide an important example of composite logical uniqueness.

A translation is logically identified by:

```text id="h7n2ke"
Entity + Language
```

For example:

```text
about_id + language_id
```

The database enforces this logical uniqueness through a composite unique constraint.

However, the translation tables use their own surrogate `id` primary key.

For example:

```text id="d8x4rt"
about_translations
--------------------------------
id
about_id
language_id
title
description
```

The `id` uniquely identifies the translation record, while:

```text
about_id + language_id
```

defines the business uniqueness of the translation.

This structure avoids partial dependency because the translated attributes belong to the complete translation record.

## 8.8 Third Normal Form (3NF)

Third Normal Form requires that:

1. The table is already in 2NF.
2. Non-key attributes do not depend on other non-key attributes.

In other words, non-key attributes should depend on the key, the whole key, and nothing but the key.

The database separates entities when their attributes represent independent concepts.

For example, project type information is stored in `project_types` rather than being repeated in every project:

```text id="4s1c8n"
project_types
      │
      └───< projects
```

A project stores:

```text id="m7r2qa"
project_type_id
```

rather than repeatedly storing the project type name.

This prevents transitive dependency and data duplication.

## 8.9 Reference Table Normalization

The `project_types` and `project_statuses` tables are examples of normalization through reference entities.

Instead of storing:

```text id="b1x7k3"
project_id | project_type
1          | Web Application
2          | Web Application
3          | API
```

the normalized structure is:

```text id="c4q8zn"
project_types
--------------------------
id
name

projects
--------------------------
id
project_type_id
```

The project type is stored once and referenced by its ID.

This provides a single source of truth for project type information.

The same principle applies to project statuses.

## 8.10 Language Normalization

The `languages` table provides a centralized source of language information.

Instead of repeating language metadata throughout translation tables, the database stores language information once:

```text id="s4h9mk"
languages
--------------------------
id
code
name
native_name
direction
```

Translation tables then reference the language:

```text id="j8q2wd"
language_id
```

This avoids duplication of values such as:

```text English
Portuguese
Spanish
Persian
Turkish
Arabic
German
```

and their associated language codes and direction information.

## 8.11 Translation Architecture and Normalization

The translation architecture is one of the most important normalization decisions in the database.

Without separate translation tables, the main entities could contain multiple language-specific columns.

For example:

```text id="f4x8zr"
title_en
title_pt
title_es
title_fa
title_tr
title_ar
title_de
```

This approach would introduce several problems:

* Repeating groups.
* Increased table width.
* Difficult language expansion.
* More complex queries.
* Schema changes whenever a new language is added.
* Greater risk of inconsistent data.

Instead, the database uses:

```text id="e3v7ms"
Entity
   │
   └───< Entity Translations
                │
                └───> Language
```

This design keeps language-independent information separate from language-dependent information.

## 8.12 Separation of Language-Independent Data

The main entity tables contain information that does not depend on the selected language.

For example, an entity may contain:

```text id="k6t2rp"
id
created_at
updated_at
```

while language-specific information is stored in its translation table.

This creates a clear separation:

```text id="w7q3nc"
Entity Table
├── Identity
├── Relationships
├── System Data
└── Language-independent Data

Translation Table
├── Entity Reference
├── Language Reference
└── Language-dependent Data
```

This structure improves both normalization and maintainability.

## 8.13 Project Images and Normalization

Project images are stored in a separate `project_images` table rather than directly inside the `projects` table.

This follows normalization principles because one project can have multiple images.

The normalized structure is:

```text id="r5c8vb"
projects
   │
   └───< project_images
```

Each image is represented by an independent record.

This avoids repeating image columns and allows additional image metadata to be introduced later without modifying the `projects` table.

Potential future attributes could include:

```text
alt_text
sort_order
caption
is_featured
```

without requiring multiple image columns in the project table.

## 8.14 Skill Category Normalization

Skills and their categories are represented as separate entities:

```text id="q2k6va"
skill_categories
   │
   └───< skills
```

A category is stored once and referenced by multiple skills.

For example:

```text id="v3f8mn"
skill_categories
-------------------------
1 | Frontend
2 | Backend
3 | Database
```

and:

```text id="j7c2sx"
skills
-------------------------
1 | Vue.js       | 1
2 | JavaScript   | 1
3 | Laravel      | 2
4 | MySQL        | 3
```

This prevents category names from being duplicated across every skill.

## 8.15 Certification Normalization

Certification data is separated from its translated content.

The normalized structure is:

```text id="n6w2qa"
certifications
   │
   └───< certification_translations
```

Certification-level attributes remain in the main table, while language-specific fields are stored in the translation table.

This prevents the certification's core identity from being duplicated for every language.

## 8.16 Testimonial Normalization

Testimonials use the same normalized translation architecture:

```text id="p3v9kx"
testimonials
   │
   └───< testimonial_translations
```

The testimonial entity remains independent from its localized textual content.

This allows one testimonial entity to have multiple translations while preserving a single canonical entity.

## 8.17 Contact Normalization

The contact section is separated into:

```text id="t5n7cy"
contacts
   │
   └───< contact_translations
```

This prevents language-specific content from being duplicated in the primary contact entity.

The visitor-submitted `contact_messages` table is also maintained separately from the website's contact information.

This distinction is important because:

* `contacts` represents portfolio contact information.
* `contact_messages` represents individual visitor submissions.

They represent different entities and therefore should not be merged into one table.

## 8.18 Users and Administrative Data

The `users` table is kept independent from portfolio content entities.

The current application has a centralized administrative user model, while portfolio records are not individually owned by users.

Therefore, tables such as:

```text
projects
experiences
education
skills
certifications
```

do not require a `user_id` merely because administrators manage them.

Adding unnecessary ownership relationships would introduce additional dependencies without providing a current business benefit.

If multi-user administration is introduced in the future, explicit ownership or audit relationships can be added.

## 8.19 JSON Data and Normalization

The `projects` table contains a JSON-based `technologies` field.

This represents a deliberate design decision that requires consideration from a strict relational normalization perspective.

For example, a project may contain:

```json
["Laravel", "Vue.js", "MySQL"]
```

From a strict relational database perspective, a list of technologies could instead be modeled using separate entities:

```text
projects
technologies
project_technology
```

This would represent a many-to-many relationship.

However, the current application stores technologies as JSON because the requirements treat the technology list primarily as project metadata rather than as an independently managed entity.

Therefore, the current implementation intentionally accepts a controlled form of denormalization.

## 8.20 Rationale for the JSON Technologies Field

The JSON `technologies` field is acceptable for the current application because:

1. Technologies are stored as project-specific metadata.
2. Technologies do not currently require independent CRUD operations.
3. Technologies do not currently have their own attributes.
4. Technologies are not independently referenced by other entities.
5. The application does not require complex filtering or joining by individual technology.
6. The number of technologies associated with each project is relatively small.
7. Keeping the data in the project record simplifies the current implementation.

Therefore, introducing a separate technology entity would add structural complexity without providing a significant current benefit.

## 8.21 Conditions for Future Normalization of Technologies

The `technologies` field should be normalized into separate tables if the application's requirements change.

For example, normalization would become appropriate if technologies require:

* Independent CRUD management.
* Technology descriptions.
* Technology icons.
* Technology categories.
* Technology translations.
* Technology-specific URLs.
* Global technology filtering.
* Technology statistics.
* Relationships with entities other than projects.

The future structure could then become:

```text id="c8y2rf"
projects
    │
    └───< project_technology >─── technologies
```

This would provide a normalized many-to-many relationship.

## 8.22 Avoiding Over-Normalization

Normalization should not be applied mechanically.

Over-normalization can introduce unnecessary tables and relationships that make the application more complex without providing meaningful benefits.

For example, creating separate tables for simple values that have no independent business meaning can result in:

* More database joins.
* More complex Eloquent relationships.
* More complicated queries.
* More complicated migrations.
* Increased development and maintenance effort.

The current database therefore balances normalization with practical application requirements.

## 8.23 Data Anomalies Prevention

Normalization helps prevent three major categories of database anomalies.

### 8.23.1 Update Anomalies

An update anomaly occurs when the same information is stored in multiple locations and changing it requires updating multiple records.

For example, storing a project type name directly in every project could result in:

```text
Project 1 → Web Application
Project 2 → Web Application
Project 3 → Web Application
```

Changing the type name would require updating multiple rows.

With normalization:

```text id="x5c7mv"
project_types
      │
      └───< projects
```

the type name exists in one location.

### 8.23.2 Insert Anomalies

An insert anomaly occurs when a new piece of information cannot be inserted without creating unrelated data.

The separation of reference tables prevents this problem.

For example, a new project type can be added independently:

```text id="v7r3pa"
INSERT INTO project_types ...
```

without requiring a project to exist first.

### 8.23.3 Delete Anomalies

A delete anomaly occurs when deleting one record unintentionally removes information that should remain available.

Separating entities prevents unrelated information from being tied to the lifecycle of another entity.

For example, project type definitions are stored independently from projects.

Appropriate foreign-key actions can then determine whether dependent data should be removed or protected.

## 8.24 Normalization Level of the Current Database

The current schema can generally be considered to follow **Third Normal Form (3NF)** for its relational structures.

The main characteristics supporting this conclusion are:

* Entities are separated into dedicated tables.
* Repeating groups are avoided.
* Child entities use foreign keys.
* Reference data is centralized.
* Multilingual data is separated into translation tables.
* Non-key attributes depend on their associated entity.
* Duplicate language-specific columns are avoided.
* Project images are represented as separate records.
* Skills are separated from skill categories.
* Project types and statuses are separated from projects.

The JSON `technologies` field is the primary deliberate deviation from strict relational normalization.

## 8.25 Normalization Trade-Offs

The database design balances theoretical normalization with practical application requirements.

The main trade-offs are:

| Design Decision              | Normalization Benefit | Practical Benefit                  |
| ---------------------------- | --------------------- | ---------------------------------- |
| Separate translation tables  | High                  | Scalable multilingual architecture |
| Separate project images      | High                  | Unlimited project images           |
| Separate project types       | High                  | Centralized reference data         |
| Separate project statuses    | High                  | Consistent project states          |
| Separate skill categories    | High                  | Reusable categories                |
| Separate languages table     | High                  | Centralized language metadata      |
| JSON technologies            | Lower                 | Simpler project management         |
| Independent contact messages | High                  | Clear separation of visitor data   |

This balance prevents the schema from becoming unnecessarily complex while maintaining strong relational integrity.

## 8.26 Normalization and Laravel Eloquent

The normalized database structure maps naturally to Laravel Eloquent relationships.

For example:

```text id="r4c7xz"
About
    hasMany(AboutTranslation)

AboutTranslation
    belongsTo(About)
    belongsTo(Language)
```

Similarly:

```text id="p8m2vk"
Project
    belongsTo(ProjectType)
    belongsTo(ProjectStatus)
    hasMany(ProjectImage)
```

and:

```text id="j6q9sw"
SkillCategory
    hasMany(Skill)
    hasMany(SkillCategoryTranslation)
```

This correspondence between the relational schema and Eloquent models makes the normalized structure practical to use within the application.

## 8.27 Normalization and Multilingual Scalability

The translation architecture provides an important scalability advantage.

Adding a new supported language does not require adding new columns to every translatable table.

For example, adding a new language only requires a new record in:

```text id="q4v8mn"
languages
```

and corresponding translation records where required.

The schema therefore remains structurally unchanged when the supported language list expands.

This is significantly more scalable than a column-per-language architecture.

## 8.28 Normalization Summary

The database is designed primarily according to Third Normal Form principles.

The normalization strategy provides:

* Reduced data duplication.
* Clear entity boundaries.
* Centralized reference data.
* Consistent multilingual relationships.
* Reduced update anomalies.
* Reduced insertion anomalies.
* Reduced deletion anomalies.
* Scalable translation management.
* Clear Eloquent relationships.

The database intentionally avoids unnecessary over-normalization.

The `projects.technologies` JSON field represents a deliberate practical compromise because technologies currently function as project-specific metadata rather than independent entities.

If future requirements make technologies independently manageable or queryable, the field can be migrated to a normalized many-to-many structure.

Overall, the schema provides an appropriate balance between **relational normalization, application simplicity, maintainability, and future scalability**.

# 9. Future Extensions

The database schema is designed to support the current requirements of the portfolio CMS while providing sufficient flexibility for future development.

Future extensions may become necessary as the application grows, additional administrative requirements are introduced, or new portfolio features are added.

Any future modification to the schema should preserve the existing principles of:

* Data integrity.
* Referential integrity.
* Normalization.
* Maintainability.
* Scalability.
* Backward compatibility where practical.
* Consistent naming conventions.
* Appropriate indexing and constraints.

Future database changes should be introduced through controlled Laravel migrations rather than direct production database modifications.

## 9.1 Future Extension Principles

Future schema changes should follow several principles.

### 9.1.1 Preserve Existing Data

Schema modifications should not unnecessarily invalidate or remove existing data.

When a structural change is required, a migration strategy should be prepared to:

1. Introduce the new structure.
2. Migrate existing data.
3. Update application logic.
4. Verify the migrated data.
5. Remove obsolete structures only when safe.

### 9.1.2 Maintain Backward Compatibility

Where practical, changes should be introduced incrementally.

For example, if a field is being replaced, the new field can initially coexist with the old field while existing data is migrated.

### 9.1.3 Maintain Referential Integrity

New relationships should use appropriate foreign-key constraints.

Future tables should not introduce uncontrolled references or duplicate existing reference data.

### 9.1.4 Avoid Unnecessary Denormalization

Future changes should not duplicate existing information unless there is a measurable performance or architectural reason to do so.

Any intentional denormalization should be documented.

## 9.2 Multi-User Administration

The current application uses the `users` table primarily for administrative authentication.

A future version may support multiple administrators with different responsibilities and permissions.

A possible extension could introduce:

```text id="4b2v7m"
users
   │
   └───< user_roles
              │
              └───> roles
```

Alternatively, a permission-based structure could be introduced:

```text id="8q5z1n"
users
   │
   └───< user_roles >─── roles
                            │
                            └───< role_permissions >─── permissions
```

This would allow different users to have different administrative capabilities.

Possible roles could include:

* Administrator.
* Editor.
* Content Manager.
* Viewer.

The exact authorization model should be determined by future application requirements.

## 9.3 Role and Permission Management

If multi-user administration is introduced, a dedicated authorization schema may be required.

Potential tables include:

```text id="v7k4qs"
roles
permissions
role_user
permission_role
```

or an equivalent permission architecture.

This would allow permissions such as:

```text id="n5x2dc"
projects.view
projects.create
projects.update
projects.delete

messages.view
messages.reply
messages.delete

users.view
users.create
users.update
users.delete
```

The database design should avoid introducing permissions until the application actually requires granular administrative access.

## 9.4 Audit Logging

A future version may require an audit trail for administrative operations.

An `audit_logs` table could record actions such as:

```text id="p8c6jw"
Created project
Updated project
Deleted project
Updated About content
Changed certification
Read contact message
Deleted contact message
```

A possible structure could include:

```text id="q3n7fv"
audit_logs
----------------------------
id
user_id
action
entity_type
entity_id
old_values
new_values
ip_address
user_agent
created_at
```

This would allow administrators to determine who performed a particular operation and when it occurred.

Audit logging would be particularly useful if the application evolves from a single administrator to multiple administrators.

## 9.5 Soft Delete Support

The current schema can be extended to support soft deletion for entities where permanent deletion may be undesirable.

Laravel's soft-delete mechanism can introduce a:

```text id="x9c2ma"
deleted_at
```

column.

Potential candidates include:

```text id="k7r4pf"
projects
experiences
education
certifications
testimonials
contact_messages
```

Soft deletion would allow records to be marked as deleted without immediately removing them from the database.

This can provide:

* Recovery of accidentally deleted records.
* Historical data preservation.
* Safer administrative operations.
* Easier auditing.

However, soft deletion should not be introduced indiscriminately.

For dependent data such as translations and project images, the deletion strategy should be explicitly defined.

## 9.6 Project Technology Normalization

The current `projects.technologies` field uses JSON to store a project's technology list.

If technologies become independently manageable entities, this field can be replaced with a normalized many-to-many relationship.

The future structure could be:

```text id="j5w8rz"
projects
    │
    └───< project_technology >─── technologies
```

Potential tables:

```text id="m3q7vn"
technologies
project_technology
```

The `technologies` table could contain:

```text id
name
slug
icon
description
```

The pivot table could contain:

```text id
project_id
technology_id
```

A composite unique constraint could prevent the same technology from being associated with the same project more than once.

## 9.7 Technology Translation Support

If technologies become globally managed entities, multilingual support may eventually be required.

The future structure could become:

```text id="r4v8cx"
technologies
    │
    └───< technology_translations
                  │
                  └───> languages
```

This would allow a technology to contain language-specific names or descriptions.

However, this should only be introduced if technologies require localized content independently from projects.

## 9.8 Project Categories and Tags

The current project structure uses project types and statuses.

A future version may introduce project categories or tags for more flexible classification.

For example:

```text id="x2f6qn"
projects
    │
    └───< project_tag >─── tags
```

A project could then be associated with multiple tags.

Examples might include:

```text id="a7n3kw"
E-commerce
SaaS
API
Open Source
Dashboard
Portfolio
```

This would allow more flexible filtering than a single project type.

## 9.9 Project Ordering

A future version may require explicit control over the order in which projects are displayed.

A `sort_order` column could be introduced:

```text id="j8v4ms"
projects
-------------------------
id
sort_order
...
```

The application could then retrieve projects using:

```sql id="b6r9cy"
ORDER BY sort_order ASC;
```

An equivalent ordering field could also be introduced for other content collections.

Potential candidates include:

```text id="w5m2vk"
experiences
education
skills
certifications
testimonials
social_links
```

The exact tables should only receive ordering fields where manual ordering is actually required.

## 9.10 Project Featured Status

A future version may allow administrators to mark selected projects as featured.

A Boolean field such as:

```text id="q3d7sx"
is_featured
```

could be added to the `projects` table.

The application could then retrieve featured projects efficiently.

If this becomes a frequent filtering operation, an appropriate index could be considered.

## 9.11 Content Publishing Workflow

The current system primarily manages portfolio content directly.

A future version could introduce content publishing states such as:

```text id="n4k8zr"
draft
published
archived
```

This could be implemented using:

* A status field.
* A dedicated publication status table.
* Publication timestamps.

For example:

```text id="t7m3pv"
published_at
```

could determine when content becomes publicly visible.

A more advanced implementation could introduce:

```text id="c6x9qw"
draft
review
approved
published
archived
```

This would be useful if multiple administrators or editors are introduced.

## 9.12 Scheduled Publishing

The publishing system could eventually support scheduled content.

Potential fields include:

```text id="f8m2dy"
published_at
scheduled_at
unpublished_at
```

This would allow content to become visible or invisible automatically at predefined times.

Such functionality would require corresponding application-level scheduling logic.

## 9.13 Versioning of Content

A future content management system may need to retain previous versions of portfolio content.

A versioning architecture could introduce tables such as:

```text id="s4q8hm"
project_versions
about_versions
experience_versions
```

Alternatively, a generalized content versioning table could be used.

For example:

```text id="v2m7ka"
content_versions
----------------------------
id
entity_type
entity_id
version
data
user_id
created_at
```

This would allow administrators to restore previous versions of content.

Versioning should be introduced only if the application requires historical content recovery or editorial workflows.

## 9.14 Enhanced Contact Message Management

The current `contact_messages` table stores visitor-submitted messages.

Future versions may introduce more advanced message management.

Potential fields could include:

```text id="h6x3nr"
status
priority
assigned_to
replied_at
archived_at
```

Possible statuses could include:

```text id="e8m4vz"
new
read
replied
archived
spam
```

If messages are assigned to administrators, `assigned_to` could reference:

```text id="k9q2cw"
users.id
```

This would create an explicit relationship between contact messages and administrative users.

## 9.15 Contact Message Replies

A future version may require multiple replies or communication history for a single contact message.

Instead of storing only one reply directly in `contact_messages`, a separate table could be introduced:

```text id="p4x7mz"
contact_messages
       │
       └───< contact_message_replies
```

A reply table could contain:

```text id
contact_message_id
user_id
message
created_at
```

This would allow a complete conversation history to be maintained.

## 9.16 Visitor Analytics Expansion

The application already uses its own visitor tracking system for dashboard statistics.

Future versions may require more detailed analytics.

Potential data structures could support:

```text id="z5q8vn"
visitor_sessions
page_views
visitor_events
```

A possible relationship could be:

```text id="n7m3rx"
visitor_sessions
      │
      └───< page_views
```

Additional information could include:

* Session identifier.
* Visit timestamp.
* Requested route.
* Referrer.
* IP address.
* User agent.
* Locale.
* Session duration.

However, additional analytics should be introduced carefully because visitor data can increase database size rapidly.

## 9.17 Analytics Aggregation

As visitor data grows, storing only raw events may become inefficient for dashboard reporting.

A future version could introduce aggregated statistics.

For example:

```text id="m8v4qa"
visitor_statistics
----------------------------
id
date
visitors
page_views
unique_visitors
```

Monthly or daily aggregates could then be used for dashboard charts.

This would reduce the amount of raw data that must be processed for every dashboard request.

The aggregation strategy should be introduced only when raw-event queries become a measurable performance concern.

## 9.18 Search Optimization

As the amount of portfolio content grows, more advanced search functionality may become necessary.

Potential search requirements could include:

* Projects by title.
* Projects by technology.
* Skills by name.
* Certifications by title.
* Experiences by company.
* Multilingual content search.

For relatively small datasets, standard MySQL indexes and `LIKE` queries may be sufficient.

For larger datasets, the application could consider:

* MySQL Full-Text Search.
* Dedicated search indexes.
* External search engines.

The choice should be based on actual dataset size and search requirements.

## 9.19 Additional Language Support

The current translation architecture allows additional languages to be introduced without restructuring the main content tables.

A new language can be added through the `languages` table.

The system can then create corresponding translation records for supported entities.

The existing structure therefore supports future language expansion without adding columns such as:

```text id="a8k4zv"
title_fr
title_it
title_ja
title_ko
```

Instead, new languages continue to use the existing translation architecture.

## 9.20 Language Activation and Availability

A future version may require languages to have an active/inactive state.

For example:

```text id="s2q7mp"
languages
-------------------------
id
code
name
native_name
direction
is_active
```

This would allow administrators to disable a language temporarily without deleting its translations.

This approach would be safer than deleting language records when a language should simply be unavailable to visitors.

## 9.21 SEO Metadata

A future version may require more advanced SEO management.

Potential fields could include:

```text id="x4n8bc"
meta_title
meta_description
canonical_url
robots
og_title
og_description
og_image
```

For multilingual pages, SEO metadata could be stored in the corresponding translation tables.

Alternatively, a dedicated SEO metadata table could be introduced if SEO configuration becomes sufficiently complex.

## 9.22 Media Management

The current schema primarily stores references to project images.

A future version could introduce a centralized media library.

Potential structure:

```text id="q7m3fz"
media
----------------------------
id
filename
path
mime_type
size
width
height
alt_text
created_at
```

Entities could then reference media records instead of storing image-specific information directly.

This would allow media to be reused across:

* Projects.
* Testimonials.
* Certifications.
* About content.
* Blog posts.
* Other future sections.

## 9.23 File Metadata

If media management is expanded, additional file metadata could be stored.

Potential attributes include:

```text id="v6k2ra"
filename
original_filename
mime_type
extension
size
width
height
alt_text
caption
```

This would provide better control over uploaded assets and improve accessibility and media administration.

## 9.24 Backup and Archival Strategy

As the database grows, a formal backup and archival strategy may become necessary.

Future infrastructure may include:

* Automated database backups.
* Backup retention policies.
* Point-in-time recovery.
* Archived records.
* Backup verification.
* Disaster recovery procedures.

These mechanisms are primarily infrastructure concerns but should be considered when defining the long-term database lifecycle.

## 9.25 Database Partitioning

Partitioning is not required for the current database size.

However, high-volume tables such as visitor analytics or contact messages could eventually become large enough to require additional storage strategies.

Potential candidates for partitioning could include:

```text id="g9q4tx"
visitor_events
page_views
contact_messages
```

Partitioning should only be considered after monitoring actual table growth and query performance.

Premature partitioning would unnecessarily increase database complexity.

## 9.26 Archival of Historical Data

High-volume historical data may eventually need to be moved to archival tables or storage.

For example:

```text id="m5v8cq"
visitor_events_archive
contact_messages_archive
```

could contain older records that are no longer required for regular application queries.

An archival strategy should define:

* Retention period.
* Archive criteria.
* Restoration process.
* Access requirements.
* Backup requirements.

## 9.27 Database Performance Scaling

As the application grows, performance improvements may require changes beyond individual indexes.

Potential future strategies include:

* Query optimization.
* Additional indexes.
* Query result caching.
* Database read replicas.
* Aggregated statistics.
* Table partitioning.
* Archival.
* Dedicated search infrastructure.

These strategies should be introduced based on measured performance requirements rather than anticipated problems.

## 9.28 Schema Migration Strategy

All future schema modifications should be implemented through Laravel migrations.

A typical migration process should be:

```text id="r8c5mw"
Requirement
    ↓
Schema Design
    ↓
Migration
    ↓
Data Migration
    ↓
Model / Relationship Updates
    ↓
Application Updates
    ↓
Testing
    ↓
Deployment
```

Existing production data should be considered before executing destructive migrations.

Destructive operations such as dropping columns or tables should require additional verification and backups.

## 9.29 Backward Compatibility and Data Migration

When an existing field or table is replaced, existing data should be migrated before the old structure is removed.

For example, if:

```text id="y4q8ps"
projects.technologies
```

is eventually replaced by:

```text id="j7n2vc"
technologies
project_technology
```

the migration process should:

1. Create the new tables.
2. Read existing JSON technology data.
3. Create corresponding technology records.
4. Create project-technology relationships.
5. Verify the migrated relationships.
6. Update application queries.
7. Remove the old JSON field only after successful migration.

This approach minimizes data loss and allows the migration to be tested safely.

## 9.30 Future Extension Prioritization

Not every potential extension should be implemented immediately.

Future database changes should be prioritized according to:

| Priority Factor      | Description                                            |
| -------------------- | ------------------------------------------------------ |
| Business Requirement | Required by actual application functionality           |
| Data Volume          | Required because current tables are becoming large     |
| Performance          | Required because measurable performance problems exist |
| Security             | Required to improve data protection                    |
| Maintainability      | Required to reduce growing technical complexity        |
| Scalability          | Required to support expected application growth        |
| Administrative Need  | Required to support new management workflows           |

This prevents unnecessary database complexity.

## 9.31 Future Extension Summary

The database is intentionally designed so that several future capabilities can be added without fundamentally redesigning the existing schema.

Potential future extensions include:

* Multi-user administration.
* Roles and permissions.
* Audit logging.
* Soft deletion.
* Project technology normalization.
* Project categories and tags.
* Manual content ordering.
* Featured projects.
* Publishing workflows.
* Scheduled publishing.
* Content versioning.
* Enhanced contact-message management.
* Contact-message replies.
* Expanded visitor analytics.
* Analytics aggregation.
* Advanced search.
* Additional languages.
* Language activation management.
* Advanced SEO metadata.
* Centralized media management.
* File metadata management.
* Database archival.
* Performance scaling.

The current schema should therefore be treated as a stable foundation rather than a rigid final structure.

Future extensions should be introduced only when justified by concrete application requirements, measurable performance needs, or changes in the system's business rules. Each extension should be implemented through controlled migrations and should preserve the database's existing principles of normalization, referential integrity, consistency, and maintainability.

# 10. Summary

The database schema for the portfolio CMS has been designed to provide a structured, consistent, maintainable, and scalable foundation for the application's backend.

The schema follows relational database principles and is implemented using MySQL in conjunction with Laravel's Eloquent ORM and migration system.

The database separates the application's major business entities into dedicated tables and uses relationships, foreign keys, indexes, and constraints to maintain data integrity and provide efficient access to stored information.

## 10.1 Database Architecture Summary

The database contains dedicated entities for the major portfolio sections and system functionality, including:

* Users and administrative authentication.
* About information.
* Professional experiences.
* Projects.
* Project types.
* Project statuses.
* Project images.
* Education.
* Skills.
* Skill categories.
* Certifications.
* Social links.
* Testimonials.
* Contact information.
* Contact messages.
* Languages.
* Translation records.

Each entity is represented by an appropriate table, with related information separated into child or reference tables where necessary.

This structure provides clear separation of responsibilities between database entities.

## 10.2 Relational Structure

The database uses relational relationships to connect dependent and independent entities.

The primary relationship types are:

* One-to-many.
* Many-to-one.
* Entity-to-translation.
* Entity-to-reference data.

Examples include:

```text id="n7w4cq"
projects
   ├── project_type_id
   ├── project_status_id
   └───< project_images
```

and:

```text id="j5m8rx"
abouts
   └───< about_translations >─── languages
```

This structure avoids unnecessary duplication while allowing related entities to be managed independently.

## 10.3 Multilingual Architecture

One of the most important characteristics of the database is its multilingual architecture.

The system supports multiple languages through the centralized `languages` table and dedicated translation tables.

The general structure is:

```text id="q3v9kx"
Entity
   │
   └───< Entity Translation
                 │
                 └───> Language
```

This approach allows the application to add additional languages without modifying the structure of every translatable entity.

It also prevents the use of language-specific columns such as:

```text id="a8f2mz"
title_en
title_pt
title_es
title_fa
title_tr
title_ar
title_de
```

Instead, translations are represented as independent records.

This design provides greater flexibility and long-term scalability.

## 10.4 Data Integrity

Data integrity is maintained through multiple layers.

The database uses:

* Primary keys.
* Foreign keys.
* Unique constraints.
* Composite unique constraints.
* `NOT NULL` constraints.
* Nullable fields.
* Default values.
* Enum restrictions.
* Referential actions.

These mechanisms ensure that invalid references, duplicate identifying values, and structurally invalid records are prevented at the database level.

Application-level validation in Laravel provides an additional layer for validating user input before database operations are performed.

## 10.5 Indexing Strategy

Indexes are used to improve the performance of frequently executed database operations.

Primary indexing areas include:

* Primary keys.
* Unique identifiers.
* Foreign keys.
* Translation lookup combinations.
* Project filtering.
* Project image retrieval.
* Skill category filtering.
* Contact message retrieval.

Translation tables particularly benefit from composite indexes involving:

```text id="f4q8sn"
entity_id + language_id
```

Where appropriate, these combinations are also protected by unique constraints to ensure that an entity cannot contain duplicate translations for the same language.

The indexing strategy intentionally avoids unnecessary indexes because indexes introduce additional storage and write overhead.

## 10.6 Normalization Strategy

The database is primarily designed according to Third Normal Form (3NF).

Normalization is achieved by:

* Separating independent entities.
* Eliminating repeating groups.
* Centralizing reference data.
* Separating multilingual content.
* Representing one-to-many data through child tables.
* Avoiding unnecessary duplication.
* Using foreign keys to establish relationships.

The structure minimizes update, insertion, and deletion anomalies.

The `projects.technologies` JSON field represents a deliberate practical exception to strict relational normalization because technologies currently function as project-specific metadata rather than independently managed entities.

If future requirements make technologies independently manageable, this field can be migrated to a normalized many-to-many structure.

## 10.7 Referential Integrity

Referential integrity is a fundamental part of the database design.

Child records reference valid parent records through foreign keys.

Examples include:

```text id="m6v3xz"
project_images.project_id
        → projects.id

skills.skill_category_id
        → skill_categories.id

projects.project_type_id
        → project_types.id

projects.project_status_id
        → project_statuses.id

translation.language_id
        → languages.id
```

This prevents orphaned or invalid relationships.

Appropriate referential actions such as `CASCADE`, `RESTRICT`, or `SET NULL` can be used depending on the lifecycle requirements of each relationship.

## 10.8 Maintainability

The database structure is designed to remain understandable and maintainable as the application evolves.

Maintainability is supported through:

* Consistent table naming.
* Consistent column naming.
* Dedicated translation tables.
* Clear foreign-key relationships.
* Centralized reference data.
* Laravel migrations.
* Eloquent model relationships.
* Explicit constraints.
* Documented indexing strategies.

The database structure therefore remains closely aligned with the application's domain model.

## 10.9 Laravel Integration

The schema is designed specifically for integration with Laravel.

Laravel migrations provide version-controlled database structure, while Eloquent models represent the relationships defined by the database.

For example:

```text id="x9q4mf"
Project
 ├── belongsTo(ProjectType)
 ├── belongsTo(ProjectStatus)
 └── hasMany(ProjectImage)
```

Translation entities follow the same relational approach:

```text id="r8c5vw"
About
 └── hasMany(AboutTranslation)

AboutTranslation
 ├── belongsTo(About)
 └── belongsTo(Language)
```

This alignment between database relationships and Eloquent relationships simplifies backend development and reduces inconsistencies between the application and database layers.

## 10.10 Security and Data Protection

Database-level constraints contribute to data security by preventing structurally invalid information from being stored.

However, database constraints are not a complete security mechanism.

The application must also implement:

* Authentication.
* Authorization.
* Input validation.
* CSRF protection.
* Secure database credentials.
* Proper escaping and parameterized queries.
* Appropriate access controls.
* Secure handling of sensitive visitor information.

Fields such as IP addresses and user-agent information stored in `contact_messages` should also be handled according to applicable privacy and data-protection requirements.

## 10.11 Scalability

The current schema is designed to support future expansion without requiring fundamental restructuring.

The translation architecture allows additional languages to be introduced.

The project-image structure allows projects to contain an arbitrary number of images.

Reference tables allow project types, statuses, and skill categories to grow independently.

Future features can introduce additional tables and relationships without unnecessarily modifying existing entities.

Potential future extensions include:

* Multi-user administration.
* Roles and permissions.
* Audit logs.
* Soft deletes.
* Content versioning.
* Project tags.
* Normalized technologies.
* Advanced analytics.
* Media management.
* Enhanced contact-message workflows.
* Additional SEO functionality.

These extensions should be introduced through controlled migrations and should preserve the database's existing integrity principles.

## 10.12 Database Evolution

The database should be treated as a version-controlled component of the application.

All schema changes should be implemented through Laravel migrations.

The recommended evolution process is:

```text id="c7m2va"
Requirement
    ↓
Database Design
    ↓
Migration
    ↓
Data Migration
    ↓
Model Updates
    ↓
Application Updates
    ↓
Testing
    ↓
Deployment
```

Destructive database operations should be performed carefully and should be preceded by appropriate backups and data verification.

This approach allows the database schema to evolve while maintaining a reliable history of structural changes.

## 10.13 Overall Database Design Assessment

The current database design provides an appropriate balance between normalization, simplicity, performance, and extensibility.

Its main strengths are:

| Area                 | Design Approach                               |
| -------------------- | --------------------------------------------- |
| Structure            | Entity-oriented relational tables             |
| Relationships        | Foreign-key based relationships               |
| Multilingual Support | Dedicated translation tables                  |
| Integrity            | Database constraints + application validation |
| Performance          | Targeted indexing strategy                    |
| Normalization        | Primarily 3NF                                 |
| Media                | Separate project-image records                |
| Reference Data       | Dedicated reference tables                    |
| ORM Integration      | Laravel Eloquent relationships                |
| Schema Management    | Laravel migrations                            |
| Extensibility        | Modular table and relationship architecture   |

The design avoids unnecessary complexity while providing a solid foundation for the current portfolio CMS requirements.

## 10.14 Final Summary

The portfolio CMS database provides a structured relational foundation for managing portfolio content, multilingual information, visitor communications, and administrative functionality.

The schema separates independent entities into dedicated tables, uses foreign keys to establish relationships, applies constraints to protect data integrity, and uses indexes to optimize common query patterns.

The multilingual architecture is based on dedicated translation tables connected to a centralized `languages` table, allowing the application to support multiple languages without modifying the structure of the primary entity tables.

The database primarily follows Third Normal Form principles while intentionally allowing limited denormalization where it provides a practical benefit, such as the JSON-based project technology list.

The combination of relational modeling, normalization, indexing, constraints, and controlled extensibility provides a database architecture that is appropriate for the current application while remaining capable of supporting future requirements.

Overall, the database schema establishes a reliable foundation for the Laravel portfolio CMS and provides the structural integrity, maintainability, performance, and scalability required for continued development.
