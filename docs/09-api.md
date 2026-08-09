# Portfolio CMS API Documentation

**Version:** 1.0  
**Application:** Portfolio CMS  
**Backend:** Laravel 13  
**Authentication:** Laravel session authentication  
**API style:** HTTP endpoints using Laravel web/session middleware

---

## 1. Overview

This document describes the HTTP endpoints currently defined for the Portfolio CMS.

The application provides:

- Public portfolio access
- Public contact-message submission
- CV generation
- Authenticated CMS management
- Dashboard access
- Profile management
- Portfolio content CRUD operations
- Contact-message management
- Social-media management
- Login, logout, password reset, password confirmation, and email verification

> **Important:** The supplied routes are currently defined as Laravel web routes, not as a conventional stateless `routes/api.php` API. Therefore, this documentation does not assume an `/api` prefix or bearer-token authentication.

---

## 2. Base URL

The base URL depends on the deployment environment.

```text
http://localhost
```

Production example:

```text
https://example.com
```

No `/api` prefix is currently defined by the supplied routes.

---

## 3. Authentication

Authenticated CMS endpoints use Laravel's `auth` middleware.

The application uses **session-based authentication**, not JWT, OAuth bearer tokens, or API keys.

A successful login establishes an authenticated Laravel session. Subsequent browser requests send the session cookie to authenticated endpoints.

### 3.1 Dashboard Authentication

The dashboard additionally requires verified email ownership:

```text
auth
verified
```

### 3.2 CSRF Protection

Because these are session-authenticated web routes, state-changing requests are protected by Laravel's CSRF mechanism when using the standard web middleware stack.

State-changing requests include:

```text
POST
PUT
DELETE
```

For JavaScript requests, send the CSRF token using the appropriate Laravel header, for example:

```http
X-CSRF-TOKEN: <csrf-token>
```

---

## 4. Request Conventions

For JSON requests, clients should use:

```http
Accept: application/json
Content-Type: application/json
```

For file uploads:

```http
Content-Type: multipart/form-data
```

The exact fields, validation rules, and file requirements are defined by the corresponding controllers and Form Request classes.

---

# 5. Public Endpoints

## 5.1 Get Portfolio Home

```http
GET /
```

**Route name:** `home.index`  
**Authentication:** Public

Returns the public portfolio home page and its associated content.

**Controller:** `HomeController@index`

---

## 5.2 Submit Contact Message

```http
POST /contact
```

**Route name:** `contact.store`  
**Authentication:** Public

Creates a message submitted through the public contact form.

**Controller:** `ContactMessageController@store`

### Request

The exact request fields and validation rules are defined by the controller/Form Request.

Illustrative example:

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "subject": "Project inquiry",
  "message": "I would like to discuss a project."
}
```

> The example fields must be verified against the actual validation class before being treated as the contractual request schema.

### Possible responses

| Status | Meaning |
|---|---|
| `200` | Request processed successfully |
| `201` | Message created successfully, if returned by the controller |
| `422` | Validation failed |
| `419` | CSRF/session failure |
| `500` | Server error |

---

## 5.3 Generate CV

```http
GET /cv/generate
```

**Route name:** `cv.generate`  
**Authentication:** Public  
**Controller:** `CvController@generate`

Generates the portfolio owner's CV. The exact response type depends on the controller implementation and may be a generated file/download.

---

## 5.4 Welcome Page

```http
GET /welcome
```

**Route name:** `welcome`  
**Authentication:** Public  
**Controller:** `WelcomeController@welcome`

Displays the application's welcome page.

---

# 6. Dashboard

## 6.1 Get Dashboard

```http
GET /dashboard
```

**Route name:** `dashboard`  
**Middleware:** `auth`, `verified`  
**Controller:** `DashboardController@dashboard`

Provides access to the authenticated CMS dashboard.

---

# 7. Profile

## 7.1 Get Profile

```http
GET /profile
```

**Route name:** `profile.edit`  
**Authentication:** Required  
**Controller:** `ProfileController@edit`

Returns the authenticated user's profile-management view/data.

## 7.2 Update Profile

```http
PUT /profile
```

**Route name:** `profile.update`  
**Authentication:** Required  
**Controller:** `ProfileController@update`

Updates the authenticated user's profile.

The exact request fields and validation rules are defined by `ProfileController` and its Form Request, if applicable.

## 7.3 Delete Profile

```http
DELETE /profile
```

**Route name:** `profile.destroy`  
**Authentication:** Required  
**Controller:** `ProfileController@destroy`

Deletes the authenticated user's account/profile.

---

# 8. About

## 8.1 Get About

```http
GET /about
```

**Route name:** `about.edit`  
**Authentication:** Required  
**Controller:** `AboutController@edit`

Retrieves the About section for CMS management.

## 8.2 Update About

```http
PUT /about
```

**Route name:** `about.update`  
**Authentication:** Required  
**Controller:** `AboutController@update`

Updates the About section and its multilingual content where applicable.

---

# 9. Experiences

## 9.1 List Experiences

```http
GET /experiences
```

**Route name:** `experiences.index`  
**Authentication:** Required

## 9.2 Create Experience

```http
POST /experiences
```

**Route name:** `experiences.store`  
**Authentication:** Required

## 9.3 Update Experience

```http
PUT /experiences/{experience}
```

**Route name:** `experiences.update`  
**Authentication:** Required

### Path parameters

| Parameter | Description |
|---|---|
| `experience` | Experience identifier used by Laravel route model binding |

## 9.4 Delete Experience

```http
DELETE /experiences/{experience}
```

**Route name:** `experiences.destroy`  
**Authentication:** Required

---

# 10. Projects

## 10.1 List Projects

```http
GET /projects
```

**Route name:** `projects.index`  
**Authentication:** Required

## 10.2 Create Project

```http
POST /projects
```

**Route name:** `projects.store`  
**Authentication:** Required

## 10.3 Update Project

```http
PUT /projects/{project}
```

**Route name:** `projects.update`  
**Authentication:** Required

### Path parameters

| Parameter | Description |
|---|---|
| `project` | Project identifier |

## 10.4 Delete Project

```http
DELETE /projects/{project}
```

**Route name:** `projects.destroy`  
**Authentication:** Required

### Path parameters

| Parameter | Description |
|---|---|
| `project` | Project identifier |

---

## 10.5 Project Types

### Create Project Type

```http
POST /project-types
```

**Route name:** `projecttypes.store`

### Update Project Type

```http
PUT /projecttypes/{projectType}
```

**Route name:** `projecttypes.update`

### Delete Project Type

```http
DELETE /projecttypes/{projectType}
```

**Route name:** `projecttypes.destroy`

All three endpoints require authentication.

---

## 10.6 Project Statuses

### Create Project Status

```http
POST /projectstatuses
```

**Route name:** `projectstatuses.store`

### Update Project Status

```http
PUT /projectstatuses/{projectStatus}
```

**Route name:** `projectstatuses.update`

### Delete Project Status

```http
DELETE /projectstatuses/{projectStatus}
```

**Route name:** `projectstatuses.destroy`

All three endpoints require authentication.

---

# 11. Education

## 11.1 List Education

```http
GET /educations
```

**Route name:** `educations.index`

## 11.2 Create Education

```http
POST /educations
```

**Route name:** `educations.store`

## 11.3 Update Education

```http
PUT /educations/{education}
```

**Route name:** `educations.update`

## 11.4 Delete Education

```http
DELETE /educations/{education}
```

**Route name:** `educations.destroy`

All education management endpoints require authentication.

---

# 12. Certifications

## 12.1 List Certifications

```http
GET /certifications
```

**Route name:** `certifications.index`

## 12.2 Create Certification

```http
POST /certifications
```

**Route name:** `certifications.store`

## 12.3 Update Certification

```http
PUT /certifications/{certification}
```

**Route name:** `certifications.update`

## 12.4 Delete Certification

```http
DELETE /certifications/{certification}
```

**Route name:** `certifications.destroy`

All certification management endpoints require authentication.

---

# 13. Skills

## 13.1 List Skills

```http
GET /skills
```

**Route name:** `skills.index`

## 13.2 Create Skill

```http
POST /skills
```

**Route name:** `skills.store`

## 13.3 Update Skill

```http
PUT /skills/{skill}
```

**Route name:** `skills.update`

## 13.4 Delete Skill

```http
DELETE /skills/{skill}
```

**Route name:** `skills.destroy`

All skill endpoints require authentication.

---

# 14. Skill Categories

## 14.1 Create Skill Category

```http
POST /skillcategory
```

**Route name:** `skillcategories.store`  
**Authentication:** Required

## 14.2 Update Skill Category

```http
PUT /skillcategory/{skillCategory}
```

**Route name:** `skillcategories.update`  
**Authentication:** Required

## 14.3 Delete Skill Category

```http
DELETE /skillcategory/{skillCategory}
```

**Route name:** `skillcategories.destroy`  
**Authentication:** Required

> There is currently no `GET /skillcategory` route in the supplied route definitions.

---

# 15. Hobbies

## 15.1 List Hobbies

```http
GET /hobbies
```

**Route name:** `hobbies.index`

## 15.2 Create Hobby

```http
POST /hobbies
```

**Route name:** `hobbies.store`

## 15.3 Update Hobby

```http
PUT /hobbies/{hobby}
```

**Route name:** `hobbies.update`

## 15.4 Delete Hobby

```http
DELETE /hobbies/{hobby}
```

**Route name:** `hobbies.destroy`

All hobby endpoints require authentication.

---

# 16. Testimonials

## 16.1 List Testimonials

```http
GET /testimonials
```

**Route name:** `testimonials.index`

## 16.2 Create Testimonial

```http
POST /testimonials
```

**Route name:** `testimonials.store`

## 16.3 Update Testimonial

```http
PUT /testimonials/{testimonial}
```

**Route name:** `testimonials.update`

## 16.4 Delete Testimonial

```http
DELETE /testimonials/{testimonial}
```

**Route name:** `testimonials.destroy`

All testimonial endpoints require authentication.

---

# 17. Contact Information

## 17.1 Get Contact Information

```http
GET /contact
```

**Route name:** `contact.edit`  
**Authentication:** Required  
**Controller:** `ContactController@edit`

Retrieves the portfolio contact information for CMS management.

## 17.2 Update Contact Information

```http
PUT /contact
```

**Route name:** `contact.update`  
**Authentication:** Required  
**Controller:** `ContactController@update`

Updates the portfolio contact information.

> `POST /contact` is a separate public operation used to submit a contact message. HTTP methods distinguish the two operations.

---

# 18. Contact Messages

## 18.1 List Messages

```http
GET /messages
```

**Route name:** `messages.index`  
**Authentication:** Required  
**Controller:** `ContactMessageController@index`

Returns messages submitted through the public contact form.

## 18.2 Update Read Status

```http
PUT /messages/read/{message}
```

**Route name:** `messages.read`  
**Authentication:** Required  
**Controller:** `ContactMessageController@updateRead`

### Path parameters

| Parameter | Description |
|---|---|
| `message` | Contact-message identifier |

Updates the read/unread state of a message.

## 18.3 Reply to Message

```http
PUT /messages/reply/{message}
```

**Route name:** `messages.reply`  
**Authentication:** Required  
**Controller:** `ContactMessageController@updateReply`

### Path parameters

| Parameter | Description |
|---|---|
| `message` | Contact-message identifier |

Updates the reply information/state for a message.

---

# 19. Social Media

## 19.1 List Social Media Links

```http
GET /medias
```

**Route name:** `medias.index`

## 19.2 Create Social Media Link

```http
POST /medias
```

**Route name:** `medias.store`

## 19.3 Update Social Media Link

```http
PUT /medias/{socialLink}
```

**Route name:** `medias.update`

### Path parameters

| Parameter | Description |
|---|---|
| `socialLink` | Social-link identifier |

## 19.4 Delete Social Media Link

```http
DELETE /medias/{socialLink}
```

**Route name:** `medias.destroy`

All social-media management endpoints require authentication.

---

# 20. Authentication Endpoints

Authentication routes are loaded through:

```php
require __DIR__.'/auth.php';
```

## 20.1 Login Page

```http
GET /login
```

**Route name:** `login`  
**Middleware:** `guest`

Displays the login form.

## 20.2 Login

```http
POST /login
```

**Middleware:** `guest`  
**Controller:** `AuthenticatedSessionController@store`

Authenticates a user and establishes a Laravel session.

A typical Laravel Breeze request contains credentials such as:

```json
{
  "email": "admin@example.com",
  "password": "password"
}
```

The exact validation rules are defined by the installed authentication implementation.

## 20.3 Logout

```http
POST /logout
```

**Route name:** `logout`  
**Middleware:** `auth`

Terminates the authenticated session.

---

# 21. Password Reset

## 21.1 Password Reset Page

```http
GET /forgot-password
```

**Route name:** `password.request`  
**Middleware:** `guest`

## 21.2 Request Password Reset Link

```http
POST /forgot-password
```

**Route name:** `password.email`  
**Middleware:** `guest`

Typical request:

```json
{
  "email": "admin@example.com"
}
```

## 21.3 Password Reset Page

```http
GET /reset-password/{token}
```

**Route name:** `password.reset`  
**Middleware:** `guest`

### Path parameters

| Parameter | Description |
|---|---|
| `token` | Password reset token |

## 21.4 Reset Password

```http
POST /reset-password
```

**Route name:** `password.store`  
**Middleware:** `guest`

Sets a new password using a valid reset token.

---

# 22. Email Verification

## 22.1 Verification Notice

```http
GET /verify-email
```

**Route name:** `verification.notice`  
**Middleware:** `auth`

## 22.2 Verify Email

```http
GET /verify-email/{id}/{hash}
```

**Route name:** `verification.verify`  
**Middleware:** `auth`, `signed`, `throttle:6,1`

### Path parameters

| Parameter | Description |
|---|---|
| `id` | User identifier |
| `hash` | Signed email verification hash |

## 22.3 Send Verification Notification

```http
POST /email/verification-notification
```

**Middleware:** `auth`, `throttle:6,1`

Requests another email verification notification.

---

# 23. Password Management

## 23.1 Confirm Password Page

```http
GET /confirm-password
```

**Route name:** `password.confirm`  
**Middleware:** `auth`

## 23.2 Confirm Password

```http
POST /confirm-password
```

**Middleware:** `auth`

Confirms the authenticated user's password before a protected operation.

## 23.3 Update Password

```http
PUT /password
```

**Route name:** `password.update`  
**Middleware:** `auth`

Changes the authenticated user's password.

---

# 24. Route Model Binding

The following routes use Laravel route-model binding parameters:

```text
/experiences/{experience}
/projects/{project}
/projecttypes/{projectType}
/projectstatuses/{projectStatus}
/educations/{education}
/certifications/{certification}
/skills/{skill}
/skillcategory/{skillCategory}
/hobbies/{hobby}
/testimonials/{testimonial}
/messages/read/{message}
/messages/reply/{message}
/medias/{socialLink}
```

If Laravel cannot resolve the requested resource, the endpoint normally returns:

```http
404 Not Found
```

---

# 25. HTTP Status Codes

| Status | Meaning |
|---|---|
| `200` | Request succeeded |
| `201` | Resource created |
| `204` | Request succeeded without response content |
| `302` | Redirect, commonly used by web authentication flows |
| `401` | Authentication required/failed |
| `403` | Authenticated but not authorized |
| `404` | Resource or route not found |
| `419` | CSRF token/session expired |
| `422` | Validation failed |
| `429` | Rate limit exceeded |
| `500` | Internal server error |

The actual status code returned by each controller must be verified against its implementation.

---

# 26. Validation Errors

Laravel validation failures for JSON requests normally use HTTP `422`.

A typical structure is:

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": [
      "The email field is required."
    ]
  }
}
```

The exact error messages and fields depend on the application's Form Request classes and localization configuration.

---

# 27. Authentication Failure Behavior

Unauthenticated requests to routes protected by `auth` are handled by Laravel's authentication middleware.

Because the application uses web/session authentication, an unauthenticated browser request may be redirected to:

```text
/login
```

rather than returning a JSON `401` response.

Clients expecting JSON should send:

```http
Accept: application/json
```

and the application's authentication/exception handling should be configured accordingly.

---

# 28. Multilingual Content

The Portfolio CMS supports multilingual portfolio content.

Known translated domains include:

- About
- Experiences
- Education
- Skills and skill categories
- Certifications
- Testimonials
- Contact information
- Project-related content where applicable

The routes do not contain a locale parameter such as:

```text
/{locale}/...
```

Therefore, localization is handled by the application rather than by explicit route parameters.

The exact translation request structure must be documented from the relevant controllers and Form Requests.

---

# 29. File and Media Handling

The application contains functionality that may involve files or media, including:

- Profile photo
- Project images
- CV generation
- Social-media links

The route definitions alone do not establish:

- Accepted MIME types
- Maximum file size
- Image dimensions
- Storage location
- Replacement rules
- Delete behavior

These values should be documented from the corresponding validation and controller implementations.

---

# 30. Current Route Naming Notes

The current route definitions contain some naming inconsistencies.

### Project types

Create:

```text
POST /project-types
```

Update/delete:

```text
PUT /projecttypes/{projectType}
DELETE /projecttypes/{projectType}
```

### Skill categories

Current routes use:

```text
/skillcategory
```

rather than a plural REST-style resource such as:

```text
/skillcategories
```

### Social media

Social links are exposed through:

```text
/medias
```

while the controller/model naming uses `SocialMedia` and `SocialLink` terminology.

These are documentation/design observations only; they do not change the current routes.

---

# 31. REST Design Assessment

Most portfolio resources follow conventional CRUD semantics:

```text
GET    /resources
POST   /resources
PUT    /resources/{resource}
DELETE /resources/{resource}
```

The message operations use domain-specific action endpoints:

```text
PUT /messages/read/{message}
PUT /messages/reply/{message}
```

This is valid for explicit business operations, although these endpoints could be normalized in a future API version if desired.

---

# 32. Security Requirements

The API should maintain the following security requirements:

1. Keep CMS management routes behind Laravel `auth` middleware.
2. Keep dashboard access behind both `auth` and `verified` middleware.
3. Maintain CSRF protection for session-authenticated state-changing requests.
4. Never return passwords or password-reset secrets in responses.
5. Do not log credentials or sensitive authentication data.
6. Perform server-side validation even when frontend validation exists.
7. Validate uploaded files by MIME type, size, and other applicable constraints.
8. Use route model binding and authorization checks for managed resources.
9. Add policies/roles if multiple administrative roles are introduced.
10. Rate-limit authentication and other abuse-sensitive endpoints.

---

# 33. API Scope

The current API is organized into these domains:

```text
Authentication
├── Login
├── Logout
├── Password reset
├── Password confirmation
├── Password update
└── Email verification

Dashboard
└── Dashboard

Portfolio Content
├── About
├── Experiences
├── Projects
├── Project types
├── Project statuses
├── Education
├── Certifications
├── Skills
├── Skill categories
├── Hobbies
├── Testimonials
├── Contact information
└── Social media

Communication
├── Public contact submission
└── Contact message management

Utilities
└── CV generation
```

---

# 34. Complete Route Index

| # | Method | URI | Route Name | Controller / Action | Auth |
|---:|---|---|---|---|---|
| 1 | GET | `/` | `home.index` | `HomeController@index` | Public |
| 2 | POST | `/contact` | `contact.store` | `ContactMessageController@store` | Public |
| 3 | GET | `/cv/generate` | `cv.generate` | `CvController@generate` | Public |
| 4 | GET | `/welcome` | `welcome` | `WelcomeController@welcome` | Public |
| 5 | GET | `/dashboard` | `dashboard` | `DashboardController@dashboard` | Auth + Verified |
| 6 | GET | `/profile` | `profile.edit` | `ProfileController@edit` | Auth |
| 7 | PUT | `/profile` | `profile.update` | `ProfileController@update` | Auth |
| 8 | DELETE | `/profile` | `profile.destroy` | `ProfileController@destroy` | Auth |
| 9 | GET | `/about` | `about.edit` | `AboutController@edit` | Auth |
| 10 | PUT | `/about` | `about.update` | `AboutController@update` | Auth |
| 11 | GET | `/experiences` | `experiences.index` | `ExperienceController@index` | Auth |
| 12 | POST | `/experiences` | `experiences.store` | `ExperienceController@store` | Auth |
| 13 | PUT | `/experiences/{experience}` | `experiences.update` | `ExperienceController@update` | Auth |
| 14 | DELETE | `/experiences/{experience}` | `experiences.destroy` | `ExperienceController@destroy` | Auth |
| 15 | GET | `/projects` | `projects.index` | `ProjectController@index` | Auth |
| 16 | POST | `/projects` | `projects.store` | `ProjectController@store` | Auth |
| 17 | PUT | `/projects/{project}` | `projects.update` | `ProjectController@update` | Auth |
| 18 | DELETE | `/projects/{project}` | `projects.destroy` | `ProjectController@destroy` | Auth |
| 19 | POST | `/project-types` | `projecttypes.store` | `ProjectTypeController@store` | Auth |
| 20 | PUT | `/projecttypes/{projectType}` | `projecttypes.update` | `ProjectTypeController@update` | Auth |
| 21 | DELETE | `/projecttypes/{projectType}` | `projecttypes.destroy` | `ProjectTypeController@destroy` | Auth |
| 22 | POST | `/projectstatuses` | `projectstatuses.store` | `ProjectStatusController@store` | Auth |
| 23 | PUT | `/projectstatuses/{projectStatus}` | `projectstatuses.update` | `ProjectStatusController@update` | Auth |
| 24 | DELETE | `/projectstatuses/{projectStatus}` | `projectstatuses.destroy` | `ProjectStatusController@destroy` | Auth |
| 25 | GET | `/educations` | `educations.index` | `EducationController@index` | Auth |
| 26 | POST | `/educations` | `educations.store` | `EducationController@store` | Auth |
| 27 | PUT | `/educations/{education}` | `educations.update` | `EducationController@update` | Auth |
| 28 | DELETE | `/educations/{education}` | `educations.destroy` | `EducationController@destroy` | Auth |
| 29 | GET | `/certifications` | `certifications.index` | `CertificationController@index` | Auth |
| 30 | POST | `/certifications` | `certifications.store` | `CertificationController@store` | Auth |
| 31 | PUT | `/certifications/{certification}` | `certifications.update` | `CertificationController@update` | Auth |
| 32 | DELETE | `/certifications/{certification}` | `certifications.destroy` | `CertificationController@destroy` | Auth |
| 33 | GET | `/skills` | `skills.index` | `SkillController@index` | Auth |
| 34 | POST | `/skills` | `skills.store` | `SkillController@store` | Auth |
| 35 | PUT | `/skills/{skill}` | `skills.update` | `SkillController@update` | Auth |
| 36 | DELETE | `/skills/{skill}` | `skills.destroy` | `SkillController@destroy` | Auth |
| 37 | POST | `/skillcategory` | `skillcategories.store` | `SkillCategoryController@store` | Auth |
| 38 | PUT | `/skillcategory/{skillCategory}` | `skillcategories.update` | `SkillCategoryController@update` | Auth |
| 39 | DELETE | `/skillcategory/{skillCategory}` | `skillcategories.destroy` | `SkillCategoryController@destroy` | Auth |
| 40 | GET | `/hobbies` | `hobbies.index` | `HobbyController@index` | Auth |
| 41 | POST | `/hobbies` | `hobbies.store` | `HobbyController@store` | Auth |
| 42 | PUT | `/hobbies/{hobby}` | `hobbies.update` | `HobbyController@update` | Auth |
| 43 | DELETE | `/hobbies/{hobby}` | `hobbies.destroy` | `HobbyController@destroy` | Auth |
| 44 | GET | `/testimonials` | `testimonials.index` | `TestimonialController@index` | Auth |
| 45 | POST | `/testimonials` | `testimonials.store` | `TestimonialController@store` | Auth |
| 46 | PUT | `/testimonials/{testimonial}` | `testimonials.update` | `TestimonialController@update` | Auth |
| 47 | DELETE | `/testimonials/{testimonial}` | `testimonials.destroy` | `TestimonialController@destroy` | Auth |
| 48 | GET | `/contact` | `contact.edit` | `ContactController@edit` | Auth |
| 49 | PUT | `/contact` | `contact.update` | `ContactController@update` | Auth |
| 50 | GET | `/messages` | `messages.index` | `ContactMessageController@index` | Auth |
| 51 | PUT | `/messages/read/{message}` | `messages.read` | `ContactMessageController@updateRead` | Auth |
| 52 | PUT | `/messages/reply/{message}` | `messages.reply` | `ContactMessageController@updateReply` | Auth |
| 53 | GET | `/medias` | `medias.index` | `SocialMediaController@index` | Auth |
| 54 | POST | `/medias` | `medias.store` | `SocialMediaController@store` | Auth |
| 55 | PUT | `/medias/{socialLink}` | `medias.update` | `SocialMediaController@update` | Auth |
| 56 | DELETE | `/medias/{socialLink}` | `medias.destroy` | `SocialMediaController@destroy` | Auth |
| 57 | GET | `/login` | `login` | `AuthenticatedSessionController@create` | Guest |
| 58 | POST | `/login` | — | `AuthenticatedSessionController@store` | Guest |
| 59 | GET | `/forgot-password` | `password.request` | `PasswordResetLinkController@create` | Guest |
| 60 | POST | `/forgot-password` | `password.email` | `PasswordResetLinkController@store` | Guest |
| 61 | GET | `/reset-password/{token}` | `password.reset` | `NewPasswordController@create` | Guest |
| 62 | POST | `/reset-password` | `password.store` | `NewPasswordController@store` | Guest |
| 63 | GET | `/verify-email` | `verification.notice` | `EmailVerificationPromptController` | Auth |
| 64 | GET | `/verify-email/{id}/{hash}` | `verification.verify` | `VerifyEmailController` | Auth + Signed + Throttle |
| 65 | POST | `/email/verification-notification` | `verification.send` | `EmailVerificationNotificationController@store` | Auth + Throttle |
| 66 | GET | `/confirm-password` | `password.confirm` | `ConfirmablePasswordController@show` | Auth |
| 67 | POST | `/confirm-password` | — | `ConfirmablePasswordController@store` | Auth |
| 68 | PUT | `/password` | `password.update` | `PasswordController@update` | Auth |
| 69 | POST | `/logout` | `logout` | `AuthenticatedSessionController@destroy` | Auth |

---

# 35. Documentation Source and Limitations

This document is based on the supplied Laravel route definitions from:

```text
routes/web.php
routes/auth.php
```

The routes establish:

- HTTP methods
- URI patterns
- Route names
- Middleware
- Controller/action mappings

The route file alone does **not** establish the exact:

- Request fields
- Validation rules
- Response JSON structures
- Controller response status codes
- File upload constraints
- Database serialization
- Business rules
- Authorization policies
- Translation payload structures

For a contractual endpoint specification, those details should be added by inspecting each controller, Form Request, API Resource, model, policy, and middleware implementation.

---

# 36. Recommended Endpoint Documentation Pattern

For future endpoint additions, document each endpoint using this structure:

```text
### Endpoint name

METHOD /uri

Authentication:
Middleware:
Controller:
Route name:

Description:

Path parameters:

Query parameters:

Request headers:

Request body:

Validation rules:

Successful response:

Error responses:

Example request:

Example response:
```

This keeps the API documentation consistent and makes it easier to maintain as the application evolves.

---

# 37. API Versioning

The current routes do not use explicit API versioning.

Current style:

```text
/projects
```

If the application later exposes a separately versioned API, a structure such as the following can be introduced:

```text
/api/v1/projects
```

Versioning is recommended before introducing breaking changes to a public API contract.

---

**End of Portfolio CMS API Documentation**
