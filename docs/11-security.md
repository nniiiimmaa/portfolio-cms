# Security

**Project:** Portfolio CMS
**Document:** Security Policy and Guidelines
**Version:** 1.0
**Last Updated:** August 9, 2026

---

## 1. Purpose

This document defines the security requirements, controls, and development practices for the Portfolio CMS.

The objective is to protect:

* Administrator accounts and authentication credentials.
* Portfolio content managed through the CMS.
* Contact messages submitted by visitors.
* Database records and application configuration.
* Application secrets and environment variables.
* Administrative functionality from unauthorized access.
* The application and its users from common web application vulnerabilities.

The security design follows established web application security practices and is aligned with the principles of the **OWASP Top 10**, **OWASP Application Security Verification Standard (ASVS)**, and Laravel security recommendations.

---

## 2. Security Scope

Security controls apply to the following application areas:

| Area             | Security Concern                                  |
| ---------------- | ------------------------------------------------- |
| Public Website   | Input handling, XSS, abuse prevention             |
| Admin Portal     | Authentication and authorization                  |
| Authentication   | Login protection, sessions, passwords             |
| Contact Forms    | Validation, spam, abuse, injection                |
| Contact Messages | Confidentiality and access control                |
| Database         | Injection prevention and data protection          |
| APIs             | Authentication, authorization, validation         |
| File Handling    | Upload validation and storage security            |
| Frontend         | XSS, unsafe rendering, exposed data               |
| Configuration    | Secrets and environment variables                 |
| Dependencies     | Vulnerable packages                               |
| Deployment       | HTTPS, server configuration, production hardening |
| Logging          | Security events and incident investigation        |

---

# 3. Security Principles

The application follows these core security principles:

### 3.1 Least Privilege

Users and application components should receive only the permissions required to perform their intended operations.

Administrative operations must not be accessible to unauthenticated users.

### 3.2 Defense in Depth

Security must not depend on a single mechanism.

For example, administrative protection should combine:

* Authentication.
* Authorization.
* Server-side validation.
* CSRF protection.
* Secure sessions.
* Database query protection.
* Production configuration hardening.

### 3.3 Secure by Default

Security-sensitive functionality should use secure defaults whenever possible.

### 3.4 Server-Side Enforcement

Security controls must be enforced on the backend.

Frontend validation is useful for user experience but must never be considered a security boundary.

### 3.5 Fail Securely

Unexpected errors should not expose:

* Stack traces.
* Database credentials.
* Environment variables.
* Internal application paths.
* SQL queries.
* Sensitive application information.

---

# 4. Security Standards

The application should follow the following standards and guidelines:

| Standard / Guideline        | Purpose                                           |
| --------------------------- | ------------------------------------------------- |
| OWASP Top 10                | Identify and mitigate major web application risks |
| OWASP ASVS                  | Application security verification requirements    |
| OWASP Cheat Sheet Series    | Practical secure-development guidance             |
| Laravel Security Guidelines | Framework-specific security practices             |
| PHP Security Best Practices | Secure PHP development                            |
| HTTP Security Standards     | Secure communication and browser behavior         |
| MySQL Security Guidelines   | Database security and access control              |

The OWASP Top 10 should be used as the primary baseline for identifying common application security risks.

---

# 5. Authentication Security

The administrative CMS requires authentication.

Laravel Breeze is responsible for the initial authentication functionality.

## 5.1 Authentication Requirements

The system must:

* Require authentication for administrative functionality.
* Store passwords using secure password hashing.
* Never store plaintext passwords.
* Never expose password hashes through API responses.
* Validate authentication credentials server-side.
* Invalidate authentication sessions appropriately during logout.
* Protect authentication endpoints against abuse.

## 5.2 Password Storage

Passwords must be hashed using Laravel's supported password hashing mechanisms.

Passwords must never be:

* Stored as plaintext.
* Stored using reversible encryption.
* Logged.
* Returned in API responses.
* Included in debugging output.

## 5.3 Password Requirements

The application should use strong password requirements appropriate for administrator accounts.

Recommended requirements include:

* Minimum password length.
* Protection against commonly compromised passwords.
* Password confirmation for sensitive operations.

Password policies should prioritize password length and resistance to credential stuffing rather than unnecessarily complex composition rules.

---

# 6. Authorization

Authentication determines **who the user is**.

Authorization determines **what the user is allowed to do**.

All administrative operations must be protected by authorization checks.

Examples include:

* Creating projects.
* Updating projects.
* Deleting projects.
* Managing skills.
* Managing certifications.
* Managing education records.
* Managing experiences.
* Managing testimonials.
* Managing social links.
* Managing contact information.
* Reading contact messages.
* Marking messages as read.
* Replying to messages.

Authorization must be enforced on the backend and must not depend exclusively on frontend route visibility or UI controls.

---

# 7. Admin Portal Security

The admin portal is a protected application area.

The following principles apply:

```text
Unauthenticated User
        |
        v
Authentication
        |
        v
Authorization
        |
        v
Admin Portal
        |
        v
Administrative Operations
```

Hiding an admin link from the public interface is not sufficient protection.

Every protected endpoint must independently verify authorization.

---

# 8. Input Validation

All user-controlled input must be validated on the server.

Laravel Form Request classes should be used where appropriate.

Examples include:

* `SkillRequest`
* `SkillCategoryRequest`
* `CertificationRequest`
* `ContactRequest`
* Other resource-specific validation classes.

Validation should verify:

* Required fields.
* Data types.
* Maximum lengths.
* Allowed values.
* Valid dates.
* Valid identifiers.
* Valid URLs.
* Valid email addresses.
* File types and sizes where applicable.

Example principle:

```text
Client Input
     |
     v
Request Validation
     |
     v
Authorization
     |
     v
Business Logic
     |
     v
Database
```

The application must never assume that data is safe merely because it originated from its own Vue frontend.

---

# 9. SQL Injection Protection

The application must protect all database operations against SQL injection.

Laravel's Eloquent ORM and query builder should be preferred over manually constructed SQL queries.

Unsafe:

```php
DB::select("SELECT * FROM projects WHERE slug = '$slug'");
```

Preferred:

```php
Project::where('slug', $slug)->first();
```

If raw SQL is necessary, parameter binding must be used.

User-controlled values must never be directly concatenated into SQL statements.

---

# 10. Cross-Site Scripting (XSS)

The application must prevent reflected, stored, and DOM-based XSS.

Vue automatically escapes interpolated values in normal templates. This behavior should not be bypassed unnecessarily.

The use of raw HTML rendering such as:

```vue
v-html
```

should be avoided unless the content is trusted or has been properly sanitized.

User-provided content must not be treated as trusted HTML.

This is particularly important for:

* Contact messages.
* Portfolio descriptions.
* Project information.
* Testimonials.
* Translated content.

---

# 11. Cross-Site Request Forgery (CSRF)

State-changing requests must be protected against CSRF.

Laravel's built-in CSRF protection should be used for applicable web requests.

CSRF protection applies particularly to operations such as:

* Create.
* Update.
* Delete.
* Login-related operations.
* Message state changes.

The application must not disable CSRF protection globally as a workaround for request-related problems.

---

# 12. Session Security

Administrative sessions must be securely managed.

Production configuration should ensure:

* Secure cookies over HTTPS.
* HttpOnly cookies where appropriate.
* Appropriate SameSite configuration.
* Session expiration.
* Session invalidation on logout.
* Session regeneration after authentication.

The application should use Laravel's supported session mechanisms rather than implementing custom authentication sessions unnecessarily.

---

# 13. Authentication Session Fixation

After successful authentication, the application should regenerate the user's session identifier.

This prevents session fixation attacks.

Laravel authentication mechanisms should be used according to Laravel's recommended practices.

---

# 14. Contact Form Security

The public contact form is an untrusted input boundary.

Contact form submissions must be:

* Validated.
* Length-limited.
* Sanitized where necessary.
* Protected against injection.
* Protected against automated abuse.
* Stored using parameterized database operations.

The system should consider rate limiting for contact submissions.

Recommended protection:

```text
Visitor
  |
  v
Contact Form
  |
  v
Rate Limiting
  |
  v
Validation
  |
  v
Business Rules
  |
  v
Database
```

---

# 15. Contact Message Privacy

Contact messages may contain personal information provided by website visitors.

Administrative access must therefore be restricted.

Contact messages must not be publicly accessible.

The application should avoid exposing message data through:

* Public API endpoints.
* Public URLs.
* Frontend source code.
* Client-side configuration.
* Debug responses.

Sensitive message content should only be returned to authorized administrators.

---

# 16. API Security

All API endpoints must be classified according to their access requirements.

### Public endpoints

Only information intended for public consumption should be exposed.

### Protected endpoints

Administrative APIs must require authentication and authorization.

### Sensitive endpoints

Operations involving private information or destructive actions require additional authorization controls where appropriate.

Every endpoint should verify:

1. Authentication.
2. Authorization.
3. Input validation.
4. Business rules.

---

# 17. Mass Assignment Protection

Models must protect against unintended mass assignment.

Laravel `$fillable` or `$guarded` configuration should be used appropriately.

Only fields intentionally exposed for mass assignment should be accepted.

The application must not blindly assign the complete request payload to a model.

Preferred:

```php
$project->update([
    'title' => $request->title,
    'slug' => $request->slug,
]);
```

rather than blindly trusting arbitrary request fields.

---

# 18. File Upload Security

If the application accepts uploaded files, uploads must be validated.

Validation should include:

* MIME type.
* File extension.
* Maximum file size.
* Expected file format.
* Filename handling.

User-provided filenames should not be trusted.

Executable files must not be accepted where they are not required.

Uploaded content must not be executable by the web server.

The application should avoid exposing sensitive filesystem paths.

---

# 19. Image Security

For portfolio images and other media:

* Validate file types.
* Validate file size.
* Generate safe filenames.
* Avoid trusting the original filename.
* Prevent executable content from being uploaded.
* Consider image processing where appropriate.
* Do not expose internal filesystem paths.

The application should only allow image formats required by the project.

---

# 20. Environment Variables and Secrets

Sensitive configuration must be stored outside source code.

Examples include:

* Database passwords.
* Application encryption keys.
* Mail credentials.
* API credentials.
* Third-party service credentials.

Sensitive values belong in the environment configuration.

The `.env` file must never be committed to the public repository.

The repository should contain an appropriate `.env.example` without real secrets.

Example:

```env
APP_KEY=
DB_PASSWORD=
MAIL_PASSWORD=
```

Real production credentials must never be placed in `.env.example`.

---

# 21. Laravel Application Key

`APP_KEY` is security-sensitive.

It must:

* Be generated securely.
* Be kept secret.
* Not be committed to source control.
* Not be shared publicly.
* Not be reused unnecessarily across unrelated environments.

Changing the application key can invalidate encrypted application data and should therefore be treated as a controlled security operation.

---

# 22. Production Configuration

Production environments must not run with development configuration.

The following should be reviewed before deployment:

```env
APP_ENV=production
APP_DEBUG=false
```

Debug mode must be disabled in production.

Production error responses must not expose internal application details.

---

# 23. Error Handling

Application errors should be handled without exposing sensitive information.

Production users should not receive:

* Stack traces.
* SQL queries.
* Environment variables.
* Server filesystem paths.
* Framework internals.
* Database credentials.

Detailed errors should be available only through appropriately secured server-side logs.

---

# 24. Logging and Monitoring

Security-relevant events should be logged where appropriate.

Potential events include:

* Successful authentication.
* Failed authentication attempts.
* Logout.
* Password changes.
* Administrative modifications.
* Destructive operations.
* Unexpected authorization failures.
* Application exceptions.

Logs must not contain:

* Passwords.
* Session tokens.
* API secrets.
* Encryption keys.
* Unnecessary personal information.

Logs should be protected against unauthorized access.

---

# 25. Rate Limiting

Rate limiting should be applied to endpoints that can be abused.

Priority areas include:

* Login.
* Contact form submission.
* Password reset.
* Public API endpoints where applicable.
* Other resource-intensive operations.

Laravel's rate-limiting facilities should be preferred over custom implementations when possible.

---

# 26. Database Security

The database must not be directly exposed to the public Internet unless required by the infrastructure architecture.

Database credentials must use the principle of least privilege.

The application's database account should only have the permissions necessary for application operation.

Recommended practices:

* Use strong database credentials.
* Restrict database network access.
* Do not expose MySQL directly to public users.
* Keep production credentials outside source control.
* Perform regular backups.
* Protect database backups.
* Test backup restoration procedures.

---

# 27. Database Backups

Production database backups should be performed regularly.

Backups should be:

* Protected from unauthorized access.
* Stored separately from the production database.
* Encrypted where appropriate.
* Retained according to operational requirements.
* Tested through restoration procedures.

A backup that cannot be restored successfully should not be considered a reliable backup.

---

# 28. Frontend Security

The Vue frontend must not be considered a trusted environment.

The frontend must not contain:

* Database credentials.
* Private API keys.
* Application secrets.
* Administrative authorization logic that is relied upon for security.

Frontend route guards and UI restrictions are usability features.

Backend authorization remains the security boundary.

---

# 29. Sensitive Data Exposure

The application should return only the information required by each frontend view.

API and Inertia responses should not expose unnecessary model attributes.

Sensitive database fields should be hidden from serialization where appropriate.

Examples include:

* Password hashes.
* Authentication tokens.
* Internal security metadata.
* Private administrative information.

---

# 30. HTTP Security

The production application should be served exclusively over HTTPS.

The deployment environment should consider appropriate HTTP security headers, including:

* `Content-Security-Policy`
* `X-Content-Type-Options`
* `Referrer-Policy`
* `Permissions-Policy`
* `Strict-Transport-Security`

The exact policy should be tested against the application's frontend requirements before enforcement.

---

# 31. Content Security Policy

A Content Security Policy (CSP) should be considered to reduce the impact of XSS and unauthorized resource loading.

The policy must account for legitimate resources used by the application, including:

* Vue/Inertia assets.
* Vite-generated assets.
* Google Fonts or icons if used.
* Required external resources.

The CSP should be progressively tightened rather than allowing unrestricted sources such as:

```text
*
```

or unnecessarily broad:

```text
unsafe-inline
unsafe-eval
```

---

# 32. Third-Party Resources

External resources should be minimized and reviewed.

The application currently uses external resources such as Google-hosted icons.

Third-party resources should be evaluated for:

* Trustworthiness.
* Availability.
* Privacy implications.
* Supply-chain risk.
* Required permissions.
* Content integrity.

Only resources required by the application should be loaded.

---

# 33. Dependency Security

Backend and frontend dependencies must be kept reasonably up to date.

The project should periodically review:

```text
composer.json
composer.lock
package.json
package-lock.json
```

Security updates should be prioritized.

Recommended checks include:

```bash
composer audit
npm audit
```

Dependency updates should be tested before deployment.

Major dependency upgrades should be treated as controlled changes because they can introduce breaking changes.

---

# 34. Supply Chain Security

Third-party packages represent part of the application's attack surface.

The project should:

* Use established packages where possible.
* Avoid unnecessary dependencies.
* Review package maintainership and reputation.
* Keep lock files committed.
* Review significant dependency changes.
* Remove unused dependencies.
* Monitor known vulnerabilities.

---

# 35. Git and Source Control Security

The following files must not contain production secrets:

```text
.env
```

Sensitive files should be excluded using `.gitignore`.

Before pushing code to a public repository, verify that the repository does not contain:

* Passwords.
* API keys.
* Tokens.
* Private certificates.
* Database credentials.
* `.env` files containing secrets.

If a secret is accidentally committed, deleting it from the latest commit is not sufficient. The secret must be considered compromised and rotated.

---

# 36. Authorization for Destructive Operations

Destructive operations such as deletion should require explicit administrative authorization.

Examples:

* Delete project.
* Delete skill.
* Delete certification.
* Delete testimonial.
* Delete social link.

The frontend may use confirmation dialogs, such as PrimeVue confirmation dialogs, to reduce accidental deletion.

However, the backend must still enforce authorization.

---

# 37. Transactional Integrity

Operations that modify multiple related database records should use database transactions when atomicity is required.

For example:

```text
Update Certification
       |
       +---- Update Certification
       |
       +---- Update Translation
       |
       +---- Update Related Data
```

If one operation fails, the transaction should roll back the related changes.

This prevents partially updated application state.

---

# 38. Internationalization Security

Because the CMS supports multiple languages, translated content must be treated as untrusted input.

Translations must follow the same:

* Validation.
* Authorization.
* XSS protection.
* Database security.
* Output encoding

requirements as primary content.

Supported languages must not bypass security controls.

---

# 39. Privacy Considerations

The application may process information submitted through the contact system.

The project should follow applicable privacy and data-protection requirements.

For deployments involving Brazilian users, the **Lei Geral de Proteção de Dados (LGPD)** should be considered where applicable.

Personal data should be:

* Collected only when necessary.
* Used for defined purposes.
* Accessible only to authorized parties.
* Protected against unauthorized disclosure.
* Retained only as long as necessary.
* Deleted when appropriate under the application's retention requirements.

The exact legal obligations should be reviewed with an appropriate legal professional when required.

---

# 40. Security Testing

Before production deployment, the application should undergo security testing.

Recommended checks include:

### Authentication

* Test invalid login attempts.
* Test logout behavior.
* Test session invalidation.
* Test password reset.
* Test session fixation protections.

### Authorization

* Access admin pages while unauthenticated.
* Access administrative endpoints while unauthenticated.
* Attempt to modify another user's resources where applicable.
* Test destructive operations.

### Input Validation

* Submit missing fields.
* Submit unexpected data types.
* Submit oversized values.
* Submit malicious HTML.
* Submit SQL-like input.
* Submit invalid IDs.

### API

* Test unauthorized requests.
* Test malformed requests.
* Test excessive request rates.
* Verify sensitive fields are not returned.

### File Uploads

* Test invalid extensions.
* Test oversized files.
* Test invalid MIME types.
* Test executable files.
* Test malicious filenames.

---

# 41. Security Checklist Before Production

The following checklist should be completed before deploying the CMS:

* [ ] `APP_DEBUG=false`
* [ ] Production `APP_ENV` configured correctly.
* [ ] HTTPS enabled.
* [ ] Production `APP_KEY` securely configured.
* [ ] `.env` excluded from Git.
* [ ] Database credentials secured.
* [ ] Database not publicly exposed.
* [ ] Authentication tested.
* [ ] Authorization tested.
* [ ] CSRF protection enabled.
* [ ] Session configuration reviewed.
* [ ] Password hashing enabled.
* [ ] Input validation implemented.
* [ ] SQL injection protections verified.
* [ ] XSS protections verified.
* [ ] Contact form rate limiting considered.
* [ ] Administrative endpoints protected.
* [ ] Sensitive model fields hidden.
* [ ] File uploads validated if enabled.
* [ ] Security headers configured.
* [ ] Dependencies audited.
* [ ] Database backups configured.
* [ ] Backup restoration tested.
* [ ] Production error handling verified.
* [ ] Logs reviewed for sensitive information.
* [ ] No secrets committed to Git.
* [ ] Public API responses reviewed.
* [ ] Destructive operations protected.
* [ ] Security testing completed.

---

# 42. Security Incident Response

If a security vulnerability is discovered:

1. Determine the affected component.
2. Assess the severity and potential impact.
3. Restrict or disable the affected functionality if necessary.
4. Rotate compromised credentials or secrets.
5. Apply and test the security fix.
6. Review application and server logs.
7. Determine whether data was accessed or compromised.
8. Deploy the fix.
9. Verify that the vulnerability is resolved.
10. Document the incident and corrective actions.

Compromised credentials must be rotated rather than simply removed from the source code.

---

# 43. Vulnerability Reporting

Security vulnerabilities should be reported privately rather than publicly disclosed before a fix is available.

A security report should include:

* Vulnerability description.
* Affected functionality.
* Steps to reproduce.
* Expected behavior.
* Actual behavior.
* Potential security impact.
* Suggested remediation, if known.
* Relevant screenshots or logs where appropriate.

Do not include real credentials, passwords, tokens, or other secrets in a vulnerability report.

---

# 44. Security Severity Classification

Security issues may be classified using the following general levels:

| Severity      | Description                                                                        |
| ------------- | ---------------------------------------------------------------------------------- |
| Critical      | Vulnerability can result in severe compromise of the application or sensitive data |
| High          | Significant unauthorized access, data exposure, or application compromise          |
| Medium        | Limited security impact or exploitation requiring additional conditions            |
| Low           | Minor security weakness with limited practical impact                              |
| Informational | Security improvement or hardening recommendation                                   |

Critical and high-severity vulnerabilities should receive priority remediation.

---

# 45. Secure Development Lifecycle

Security should be incorporated throughout the development lifecycle.

```text
Requirements
     |
     v
Security Requirements
     |
     v
Architecture
     |
     v
Implementation
     |
     v
Code Review
     |
     v
Security Testing
     |
     v
Deployment
     |
     v
Monitoring
     |
     v
Maintenance
```

Security should not be treated as a final deployment-only activity.

---

# 46. Security Maintenance

Security requirements should be reviewed when:

* New authentication functionality is introduced.
* New API endpoints are added.
* New user input is introduced.
* New file uploads are introduced.
* New third-party dependencies are added.
* Database structure changes.
* Administrative permissions change.
* Deployment infrastructure changes.
* A security vulnerability is discovered.

---

# 47. Final Security Objective

The Portfolio CMS should maintain the following security properties:

```text
Confidentiality
      +
Integrity
      +
Availability
      +
Authentication
      +
Authorization
      +
Accountability
```

The application must ensure that:

* Only authorized administrators can manage CMS content.
* Public users can access only public information.
* User input is treated as untrusted.
* Sensitive information is protected.
* Database operations are secure.
* Application secrets remain confidential.
* Security failures do not expose internal application information.
* Dependencies and infrastructure are maintained securely.

Security is considered an ongoing requirement of the application rather than a one-time implementation task.
