# Portfolio CMS — Features

## 1. Overview

The Portfolio CMS is a full-stack content management system designed to manage and present a professional developer portfolio.

The system consists of two primary areas:

* **Public Portfolio** — the publicly accessible portfolio website.
* **Admin Portal** — an authenticated management interface for managing portfolio content and monitoring website activity.

The application supports multilingual content, responsive design, theme switching, content management, contact messaging, visitor tracking, and portfolio administration.

---

# 2. Public Portfolio Features

## 2.1 Hero Section

The hero section provides the primary introduction to the portfolio.

### Features

* Display professional name.
* Display professional title or role.
* Display introductory content.
* Display primary call-to-action buttons.
* Support responsive layouts.
* Support light and dark themes.
* Support all configured application languages.

### Restrictions

* The hero section does not contain the language selector.
* The hero section does not contain the theme selector.

---

## 2.2 About Section

The About section presents professional and personal information.

### Features

* Display professional biography.
* Display profile information.
* Support multilingual content.
* Support responsive layouts.
* Content is managed through the Admin Portal.

---

## 2.3 Experience Section

The Experience section displays professional work history.

### Features

* Display multiple professional experiences.
* Display company or organization.
* Display position/title.
* Display employment period.
* Display description.
* Support current positions.
* Support multilingual descriptions.
* Display experiences in a defined order.
* Manage experience records through the Admin Portal.

---

## 2.4 Projects Section

The Projects section displays completed or ongoing projects.

### Features

* Display project title.
* Display project description.
* Display project type.
* Display project status.
* Display technologies used.
* Display project images.
* Display project links where applicable.
* Use SEO-friendly project slugs.
* Support multilingual project content.
* Support project ordering.
* Manage projects through the Admin Portal.

### Project Technology Support

Technologies used by a project are stored as structured project data and can be displayed as technology tags or badges.

---

## 2.5 Education Section

The Education section displays academic and educational history.

### Features

* Display institution.
* Display degree or qualification.
* Display field of study.
* Display start date.
* Display end date.
* Support ongoing education.
* Display descriptions.
* Support multilingual content.
* Manage education records through the Admin Portal.

---

## 2.6 Skills Section

The Skills section displays technical and professional skills.

### Features

* Organize skills into categories.
* Display skill name.
* Display skill icon where applicable.
* Display skill level or proficiency where configured.
* Support multiple skill categories.
* Support multilingual category names.
* Control skill ordering.
* Manage skills and categories through the Admin Portal.

### Example Categories

* Frontend Development
* Backend Development
* Databases
* DevOps
* Design
* Development Tools
* Adobe Products

---

## 2.7 Certifications Section

The Certifications section displays professional certifications and credentials.

### Features

* Display certification name.
* Display issuing organization.
* Display issue date.
* Display expiration date.
* Support certifications without expiration.
* Display credential ID.
* Display credential URL where applicable.
* Support multilingual certification content.
* Manage certifications through the Admin Portal.

---

## 2.8 Hobbies Section

The Hobbies section presents personal interests.

### Features

* Display hobby name.
* Display hobby description where applicable.
* Display Google Material icons.
* Support multilingual content.
* Control display order.
* Manage hobbies through the Admin Portal.

### Media

Hobbies use icons rather than uploaded images.

---

## 2.9 Social Media Section

The Social Media section provides links to professional and social profiles.

### Features

* Add social media profiles.
* Configure platform name.
* Configure profile URL.
* Display platform icon.
* Control display order.
* Enable or disable social links.
* Manage social links through the Admin Portal.

---

## 2.10 Testimonials Section

The Testimonials section displays recommendations or feedback from other people.

### Features

* Display testimonial content.
* Display author name.
* Display author position or organization where applicable.
* Display author information where configured.
* Support multilingual testimonial content.
* Control testimonial ordering.
* Manage testimonials through the Admin Portal.

---

## 2.11 Contact Section

The Contact section allows visitors to contact the portfolio owner.

### Features

* Display contact information.
* Display contact details in multiple languages.
* Provide a contact form.
* Validate visitor input.
* Submit contact messages to the backend.
* Display success notifications.
* Display validation and error notifications.
* Protect the form against invalid submissions.

---

## 2.12 Footer

The public website includes a footer containing relevant portfolio information.

### Features

* Display copyright information.
* Display social links where applicable.
* Display relevant navigation links.
* Support multilingual content.
* Support light and dark themes.

The Admin Portal uses a separate layout and does not use the public website footer.

---

# 3. Multilingual Features

The application supports multilingual portfolio content.

## 3.1 Supported Languages

The initial supported languages are:

| Language   | Locale  | Direction |
| ---------- | ------- | --------- |
| English    | `en`    | LTR       |
| Spanish    | `es`    | LTR       |
| Portuguese | `pt`    | LTR       |
| Persian    | `fa`    | RTL       |
| Turkish    | `tr`    | LTR       |
| Arabic     | `ar-AE` | RTL       |
| German     | `de`    | LTR       |

---

## 3.2 Language Selector

The application provides a language selector for changing the active application language.

### Features

* Change language without manually modifying URLs.
* Persist the selected language.
* Support language flags or visual indicators.
* Automatically update translated interface text.
* Support RTL languages.
* Maintain language selection across navigation.

The language selector is located in the navigation area and is not displayed inside the hero section.

---

## 3.3 Translation Management

Translatable entities use dedicated translation records.

Examples include:

* About
* Experience
* Education
* Skills
* Certifications
* Testimonials
* Contact information
* Hobbies
* Project content where applicable

Each translation is associated with a language record.

---

# 4. Theme Features

## 4.1 Light Theme

The application provides a light visual theme.

## 4.2 Dark Theme

The application provides a dark visual theme.

## 4.3 Theme Switching

Users can switch between light and dark themes.

### Features

* Theme toggle in the navigation.
* Persist theme preference using local storage.
* Apply the selected theme across the application.
* Support PrimeVue dark-mode configuration.
* Support Tailwind dark-mode styling.

---

# 5. Responsive Design

The application is designed to work across different screen sizes.

### Supported Environments

* Desktop
* Laptop
* Tablet
* Mobile

### Responsive Features

* Responsive navigation.
* Responsive content sections.
* Responsive project layouts.
* Responsive administrative interface.
* Mobile-friendly dialogs.
* Responsive tables and forms.
* Responsive dashboard widgets.

---

# 6. Admin Portal

The Admin Portal provides authenticated access to portfolio management functionality.

## 6.1 Authentication

The application uses Laravel Breeze for authentication.

### Features

* Login.
* Logout.
* Authenticated administration.
* Session-based authentication.
* Protected admin routes.

Only authenticated users can access administrative functionality.

---

## 6.2 Admin Layout

The Admin Portal uses a dedicated layout separate from the public website.

### Components

* Admin Sidebar.
* Admin navigation.
* Main content area.
* Dashboard.
* Management pages.
* Dialog-based CRUD interfaces.

The public website navigation and footer are not used as the primary Admin Portal layout.

---

# 7. Dashboard

The Admin Dashboard provides a high-level overview of portfolio activity.

## 7.1 Statistics Cards

The dashboard initially provides KPI cards containing important portfolio statistics.

### Statistics

* Total Projects.
* Messages Received.
* Recent Activity.

The statistics are retrieved from the application's backend.

---

## 7.2 Messages per Month

The dashboard provides a chart displaying the number of contact messages received per month.

### Features

* Monthly message aggregation.
* Visual chart representation.
* Backend-generated statistics.
* Useful overview of communication activity.

---

## 7.3 Visitors per Month

The dashboard provides a chart displaying visitor activity per month.

### Features

* Monthly visitor aggregation.
* Visual chart representation.
* Uses the application's own visitor tracking system.
* Does not depend on an external analytics service.

---

# 8. Visitor Tracking

The system includes an internal visitor tracking mechanism.

### Features

* Record website visits.
* Aggregate visitor activity.
* Provide monthly visitor statistics.
* Provide dashboard statistics.
* Store visitor information required by the application's analytics implementation.

The visitor statistics system is implemented internally rather than relying on Google Analytics or another external analytics platform.

---

# 9. Contact Message Management

The Admin Portal provides management functionality for messages submitted through the public contact form.

## 9.1 Message Listing

Administrators can view received contact messages.

### Features

* Display message list.
* Display sender information.
* Display message subject.
* Display message content.
* Display message creation date.
* Display message status.

---

## 9.2 Message Read Status

Messages can be marked as read or unread.

### Features

* Track unread messages.
* Mark messages as read.
* Mark messages as unread where supported.
* Display unread message indicators.
* Use message status in dashboard statistics.

---

## 9.3 Message Reply

Administrators can reply to received messages.

### Features

* Open a message.
* Review sender information.
* Compose a response.
* Send a reply.
* Provide success/error notifications.
* Support localized interface messages.

---

# 10. Content Management

The Admin Portal provides CRUD functionality for portfolio content.

## 10.1 About Management

Administrators can:

* Create About content.
* View About content.
* Update About content.
* Manage translations.

---

## 10.2 Experience Management

Administrators can:

* Create experiences.
* View experiences.
* Update experiences.
* Delete experiences.
* Manage translations.
* Define employment dates.
* Identify current positions.

---

## 10.3 Project Management

Administrators can:

* Create projects.
* View projects.
* Update projects.
* Delete projects.
* Manage project types.
* Manage project statuses.
* Manage project images.
* Manage project technologies.
* Configure project slugs.
* Manage translations.

---

## 10.4 Education Management

Administrators can:

* Create education records.
* View education records.
* Update education records.
* Delete education records.
* Manage translations.
* Configure education dates.

---

## 10.5 Certification Management

Administrators can:

* Create certifications.
* View certifications.
* Update certifications.
* Delete certifications.
* Manage certification translations.
* Configure issue dates.
* Configure expiration dates.
* Configure credentials.
* Mark certifications as having no expiration.

---

## 10.6 Skill Category Management

Administrators can:

* Create skill categories.
* View skill categories.
* Update skill categories.
* Delete skill categories.
* Manage category translations.
* Control category ordering.

---

## 10.7 Skill Management

Administrators can:

* Create skills.
* View skills.
* Update skills.
* Delete skills.
* Assign skills to categories.
* Manage skill ordering.

---

## 10.8 Hobby Management

Administrators can:

* Create hobbies.
* View hobbies.
* Update hobbies.
* Delete hobbies.
* Manage translations.
* Configure icons.
* Control ordering.

---

## 10.9 Social Media Management

Administrators can:

* Create social links.
* View social links.
* Update social links.
* Delete social links.
* Configure URLs.
* Configure platform information.
* Control ordering.

---

## 10.10 Testimonial Management

Administrators can:

* Create testimonials.
* View testimonials.
* Update testimonials.
* Delete testimonials.
* Manage translations.
* Control ordering.

---

## 10.11 Contact Information Management

Administrators can:

* View contact information.
* Update contact information.
* Manage translated contact information.
* Configure public contact details.

---

# 11. Dialog-Based CRUD

The Admin Portal uses PrimeVue dialogs for content editing.

### Features

* Open create forms in dialogs.
* Open edit forms in dialogs.
* Display validation errors.
* Confirm destructive operations.
* Display success notifications.
* Display error notifications.
* Close dialogs after successful operations.
* Refresh relevant content after mutations.

---

# 12. Notifications

The application uses toast notifications for user feedback.

### Notification Types

* Success.
* Error.
* Warning.
* Information.

### Use Cases

Notifications are used for:

* Successful creation.
* Successful updates.
* Successful deletion.
* Failed requests.
* Validation failures.
* Contact form submission.
* Message replies.
* Authentication-related feedback.

---

# 13. Confirmation Dialogs

Destructive operations use confirmation dialogs.

### Examples

* Delete project.
* Delete experience.
* Delete education record.
* Delete certification.
* Delete skill.
* Delete skill category.
* Delete hobby.
* Delete social link.
* Delete testimonial.

The administrator must confirm destructive actions before they are executed.

---

# 14. Validation

The application provides validation on both the frontend and backend where appropriate.

## 14.1 Backend Validation

Laravel Form Request classes are used to validate incoming data.

Examples include:

* Contact requests.
* Experience requests.
* Project requests.
* Education requests.
* Certification requests.
* Skill requests.
* Skill category requests.
* Social media requests.
* Other content-management requests.

## 14.2 Frontend Validation

The frontend displays validation feedback returned by the backend.

### Features

* Field-level validation messages.
* Form submission validation.
* Invalid input feedback.
* Localized validation messages where applicable.

---

# 15. API Features

The Laravel backend exposes application functionality through API endpoints.

### API Responsibilities

* Authentication-related operations.
* Portfolio content management.
* Public portfolio data.
* Contact form submission.
* Contact message management.
* Visitor tracking.
* Dashboard statistics.
* CV-related operations.

API endpoints are organized according to the application's resource structure.

---

# 16. CV Management

The application supports CV-related functionality through API-based operations.

### Features

* Retrieve CV-related data through the backend.
* Provide CV functionality to the public portfolio.
* Integrate CV actions with the portfolio interface.

---

# 17. SEO Features

The public portfolio is designed with SEO considerations.

### Features

* Semantic page structure.
* SEO-friendly project slugs.
* Appropriate page metadata.
* Descriptive content.
* Search-engine-friendly URLs.
* Multilingual content support.

---

# 18. Accessibility

The application should follow modern accessibility practices.

### Features

* Semantic HTML.
* Keyboard-accessible controls.
* Accessible form labels.
* Accessible buttons.
* Appropriate focus states.
* Meaningful icon usage.
* Sufficient color contrast.
* Accessible dialog interactions.
* RTL support for applicable languages.

---

# 19. Security Features

Security is implemented primarily through Laravel's built-in security mechanisms.

### Features

* Authentication.
* Protected administrative routes.
* Authorization checks.
* CSRF protection.
* Server-side validation.
* Database transactions for multi-step operations.
* Secure password handling.
* Input sanitization and validation.
* Protection of administrative resources.

---

# 20. Localization

The application interface supports localized messages.

Localization applies to:

* Navigation.
* Buttons.
* Form labels.
* Validation messages.
* Toast notifications.
* Confirmation messages.
* Dashboard labels.
* Admin interface.
* Public portfolio content.

The frontend uses `vue-i18n` for interface localization.

---

# 21. UI Component System

The frontend uses PrimeVue as its primary component library.

### Components Used

* Dialogs.
* Toast notifications.
* Confirmation dialogs.
* Form controls.
* Buttons.
* Inputs.
* Select components.
* Tables.
* Charts and dashboard components where applicable.

Tailwind CSS is used for layout and utility styling.

---

# 22. State Management

The frontend uses Pinia for centralized application state management.

### State Management Responsibilities

* Application preferences.
* Language state.
* Theme state.
* Shared frontend state.
* Other global application state where required.

---

# 23. Frontend Routing and Navigation

The application uses Laravel, Inertia.js, and Ziggy for application navigation.

### Features

* Server-side route definitions.
* Inertia page navigation.
* Named Laravel routes.
* JavaScript route access through Ziggy.
* Protected administrative routes.
* Public portfolio routes.

---

# 24. Data Persistence

The application uses MySQL as its relational database.

### Main Data Domains

* Users.
* About.
* Experiences.
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
* Languages.
* Contact messages.
* Visitor tracking data.

---

# 25. Transactional Operations

Database transactions are used for operations that require multiple related database changes.

### Examples

* Updating translated content.
* Creating or updating resources with translations.
* Managing related project data.
* Updating content with multiple dependent records.
* Deleting resources with dependent records.

Transactions help maintain database consistency when an operation involves multiple related records.

---

# 26. Error Handling

The application provides structured error handling across the frontend and backend.

### Features

* Backend exception handling.
* Validation error responses.
* Frontend error notifications.
* Form validation feedback.
* Transaction rollback on failed operations.
* Appropriate HTTP status codes for API responses.

---

# 27. Responsive Admin Interface

The Admin Portal is designed for different screen sizes.

### Features

* Responsive sidebar.
* Responsive content area.
* Responsive tables.
* Responsive dialogs.
* Mobile-friendly forms.
* Responsive dashboard widgets.

---

# 28. Feature Summary

| Area               | Features                                                                                                     |
| ------------------ | ------------------------------------------------------------------------------------------------------------ |
| Public Portfolio   | Hero, About, Experience, Projects, Education, Skills, Certifications, Hobbies, Testimonials, Contact, Footer |
| Admin Portal       | Dashboard, Sidebar, Content Management                                                                       |
| Authentication     | Login, Logout, Protected Routes                                                                              |
| Content Management | CRUD for portfolio resources                                                                                 |
| Projects           | Types, Statuses, Technologies, Images, Slugs                                                                 |
| Skills             | Categories, Skills, Ordering                                                                                 |
| Certifications     | Dates, Credentials, Expiration                                                                               |
| Localization       | 7 Languages, LTR/RTL                                                                                         |
| Themes             | Light Mode, Dark Mode                                                                                        |
| Messaging          | Contact Form, Message Management, Read Status, Replies                                                       |
| Analytics          | Internal Visitor Tracking                                                                                    |
| Dashboard          | KPI Cards, Messages per Month, Visitors per Month                                                            |
| Notifications      | Toast Messages                                                                                               |
| Confirmations      | Destructive Action Confirmation                                                                              |
| Validation         | Frontend and Backend Validation                                                                              |
| API                | Portfolio, CMS, Messaging, Statistics, CV                                                                    |
| SEO                | Metadata, Semantic Structure, SEO-friendly URLs                                                              |
| Accessibility      | Keyboard Support, Semantic HTML, RTL                                                                         |
| Security           | Authentication, Authorization, CSRF, Validation                                                              |
| State Management   | Pinia                                                                                                        |
| UI                 | PrimeVue + Tailwind CSS                                                                                      |
| Database           | MySQL                                                                                                        |
| Navigation         | Laravel Routes, Inertia.js, Ziggy                                                                            |

---

# 29. Future Features

The following features may be considered for future versions:

* Advanced visitor analytics.
* Visitor filtering and date-range analysis.
* Content scheduling.
* Draft and published states.
* Activity/audit logs.
* Role-based administration.
* Media library.
* Automated backups.
* Email templates.
* Email notification configuration.
* Advanced SEO management.
* Sitemap generation.
* Search functionality within the Admin Portal.
* Bulk content operations.
* Import/export functionality.
* API authentication for external consumers.

These features are not part of the initial feature scope unless explicitly implemented.
