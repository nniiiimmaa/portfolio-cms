# Portfolio CMS — Low-Level Design (LLD)

**Document Version:** 1.0  
**Status:** Draft  
**Application:** Portfolio CMS  
**Backend:** Laravel 13  
**Frontend:** Vue 3 + Inertia.js  
**Database:** MySQL  
**Build Tool:** Vite  
**UI Framework:** PrimeVue  
**CSS:** Tailwind CSS  
**State Management:** Pinia  
**Internationalization:** vue-i18n  
**Routing:** Laravel Routing + Ziggy  
**Authentication:** Laravel Breeze

---

## 1. Purpose

This document defines the Low-Level Design (LLD) of the Portfolio CMS. It translates the requirements and high-level architecture into implementation-level details covering:

- frontend component structure;
- backend controllers and requests;
- models and relationships;
- database access;
- Inertia endpoints;
- validation;
- authorization;
- localization;
- state management;
- image handling;
- notifications;
- visitor tracking;
- dashboard statistics;
- error handling;
- security;
- logging;
- testing;
- coding conventions.

The LLD is intended to be detailed enough for implementation, code review, maintenance, and future extension.

---

# 2. System Scope

The application consists of two main areas:

1. **Public Portfolio**
2. **Authenticated Admin CMS**

The public portfolio presents portfolio information to visitors.

The admin CMS allows the authenticated administrator to manage portfolio content.

## 2.1 Public Sections

- Hero
- About
- Experiences
- Projects
- Education
- Certifications
- Skills
- Hobbies
- Testimonials
- Contact
- Footer

Additional public functionality:

- language switching;
- light/dark theme switching;
- CV access;
- contact form;
- visitor tracking;
- SEO metadata.

## 2.2 Admin Sections

The admin CMS provides CRUD functionality for:

- About
- Experiences
- Projects
- Project Types
- Project Statuses
- Education
- Certifications
- Skill Categories
- Skills
- Social Links
- Testimonials
- Contact information
- Contact messages
- Languages

The dashboard provides:

- KPI/statistics cards;
- messages per month;
- visitors per month;
- recent activity.

---

# 3. Technology Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 13 |
| Frontend | Vue 3 |
| SPA Adapter | Inertia.js |
| Database | MySQL |
| Authentication | Laravel Breeze |
| State Management | Pinia |
| UI Components | PrimeVue |
| Styling | Tailwind CSS |
| Build Tool | Vite |
| Localization | vue-i18n |
| Route Generation | Ziggy |
| Icons | Google Icons CDN |
| Notifications | PrimeVue Toast |
| Confirmation | PrimeVue ConfirmationService |
| Theme | PrimeVue custom preset |
| HTTP/Application Flow | Inertia requests |

---

# 4. Architectural Principles

## 4.1 Separation of Concerns

Each layer should have one primary responsibility.

```text
Route
  ↓
Controller
  ↓
Form Request
  ↓
Service / Domain Logic
  ↓
Model / Database
  ↓
Inertia Response
  ↓
Vue Page
```

## 4.2 Thin Controllers

Controllers should coordinate requests and responses rather than contain large business rules.

## 4.3 Form Requests for Validation

Validation rules should be centralized in dedicated Laravel Form Request classes.

## 4.4 Eloquent for Persistence

Eloquent models should define:

- relationships;
- casts;
- fillable attributes;
- query scopes;
- model-specific behavior.

## 4.5 Reusable Vue Components

Repeated UI functionality should be implemented as reusable components.

## 4.6 Server-Side Authorization

Admin access must be protected on the server. Hiding UI elements is not considered authorization.

## 4.7 Localization-Aware Content

Translatable portfolio content should use translation tables rather than duplicated columns.

## 4.8 Progressive Enhancement

The public website should remain usable even when JavaScript functionality is limited where practical.

---

# 5. Backend Directory Structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── AboutController.php
│   │   │   ├── ExperienceController.php
│   │   │   ├── ProjectController.php
│   │   │   ├── ProjectTypeController.php
│   │   │   ├── ProjectStatusController.php
│   │   │   ├── EducationController.php
│   │   │   ├── CertificationController.php
│   │   │   ├── SkillController.php
│   │   │   ├── SkillCategoryController.php
│   │   │   ├── SocialLinkController.php
│   │   │   ├── TestimonialController.php
│   │   │   ├── ContactController.php
│   │   │   ├── ContactMessageController.php
│   │   │   └── LanguageController.php
│   │   ├── PortfolioController.php
│   │   ├── ContactMessageController.php
│   │   └── VisitorController.php
│   └── Requests/
│       ├── Admin/
│       │   ├── AboutRequest.php
│       │   ├── ExperienceRequest.php
│       │   ├── ProjectRequest.php
│       │   ├── EducationRequest.php
│       │   ├── CertificationRequest.php
│       │   ├── SkillRequest.php
│       │   ├── SkillCategoryRequest.php
│       │   ├── SocialLinkRequest.php
│       │   ├── TestimonialRequest.php
│       │   ├── ContactRequest.php
│       │   └── LanguageRequest.php
│       └── ContactMessageRequest.php
│
├── Models/
│   ├── User.php
│   ├── About.php
│   ├── AboutTranslation.php
│   ├── Experience.php
│   ├── ExperienceTranslation.php
│   ├── Project.php
│   ├── ProjectImage.php
│   ├── ProjectType.php
│   ├── ProjectStatus.php
│   ├── Education.php
│   ├── EducationTranslation.php
│   ├── Skill.php
│   ├── SkillCategory.php
│   ├── SkillCategoryTranslation.php
│   ├── Certification.php
│   ├── CertificationTranslation.php
│   ├── SocialLink.php
│   ├── Testimonial.php
│   ├── TestimonialTranslation.php
│   ├── Contact.php
│   ├── ContactTranslation.php
│   ├── ContactMessage.php
│   ├── Language.php
│   ├── Visitor.php
│   └── ActivityLog.php
│
├── Services/
│   ├── PortfolioService.php
│   ├── VisitorTrackingService.php
│   ├── DashboardStatisticsService.php
│   ├── TranslationService.php
│   └── ImageService.php
│
├── Policies/
│   ├── AboutPolicy.php
│   ├── ExperiencePolicy.php
│   ├── ProjectPolicy.php
│   ├── EducationPolicy.php
│   ├── CertificationPolicy.php
│   ├── SkillPolicy.php
│   ├── SocialLinkPolicy.php
│   ├── TestimonialPolicy.php
│   └── ContactPolicy.php
│
└── Providers/
```

---

# 6. Frontend Directory Structure

```text
resources/js/
├── Components/
│   ├── Common/
│   │   ├── BaseButton.vue
│   │   ├── BaseInput.vue
│   │   ├── BaseSelect.vue
│   │   ├── BaseDialog.vue
│   │   ├── LoadingState.vue
│   │   ├── EmptyState.vue
│   │   └── ErrorState.vue
│   │
│   ├── Public/
│   │   ├── Hero.vue
│   │   ├── About.vue
│   │   ├── Experiences.vue
│   │   ├── Projects.vue
│   │   ├── Education.vue
│   │   ├── Certifications.vue
│   │   ├── Skills.vue
│   │   ├── Hobbies.vue
│   │   ├── Testimonials.vue
│   │   └── Contact.vue
│   │
│   └── Admin/
│       ├── Dashboard/
│       │   ├── StatisticsCards.vue
│       │   ├── MessagesChart.vue
│       │   ├── VisitorsChart.vue
│       │   └── RecentActivity.vue
│       ├── About/
│       ├── Experiences/
│       ├── Projects/
│       ├── Education/
│       ├── Certifications/
│       ├── Skills/
│       ├── SocialLinks/
│       ├── Testimonials/
│       ├── Contact/
│       └── Messages/
│
├── Layout/
│   ├── Public/
│   │   ├── _Nav.vue
│   │   ├── Layout.vue
│   │   └── Footer.vue
│   │
│   └── Admin/
│       ├── _Sidebar.vue
│       ├── Layout.vue
│       └── Footer.vue
│
├── Pages/
│   ├── Public/
│   │   └── Home.vue
│   │
│   ├── Admin/
│   │   ├── Dashboard.vue
│   │   ├── About.vue
│   │   ├── Experiences.vue
│   │   ├── Projects.vue
│   │   ├── Education.vue
│   │   ├── Certifications.vue
│   │   ├── Skills.vue
│   │   ├── SocialLinks.vue
│   │   ├── Testimonials.vue
│   │   ├── Contact.vue
│   │   └── Messages.vue
│   │
│   └── Auth/
│
├── Stores/
│   ├── auth.js
│   ├── language.js
│   ├── theme.js
│   └── portfolio.js
│
├── Plugins/
│   ├── i18n.js
│   ├── pinia.js
│   └── primevue.js
│
├── Constants/
│   └── storage.js
│
├── Lang/
│   ├── en.json
│   ├── es.json
│   ├── pt.json
│   ├── fa.json
│   ├── tr.json
│   ├── ar.json
│   └── de.json
│
├── Composables/
│   ├── useToast.js
│   ├── useConfirm.js
│   ├── useTheme.js
│   └── useLocale.js
│
└── app.js
```

---

# 7. Database Design

## 7.1 Core Tables

```text
users

languages

abouts
about_translations

experiences
experience_translations

project_types
project_statuses
projects
project_images

education
education_translations

skill_categories
skill_category_translations
skills

certifications
certification_translations

social_links

testimonials
testimonial_translations

contacts
contact_translations

contact_messages

visitors

activity_logs
```

---

# 8. Entity Relationships

## 8.1 User

```text
User
 └── hasMany ActivityLog
```

Main attributes:

- id
- username
- email
- password
- photo
- last_login_at
- last_login_ip
- timestamps

Constraints:

- username: unique
- email: unique

## 8.2 Language

```text
Language
 ├── hasMany AboutTranslation
 ├── hasMany ExperienceTranslation
 ├── hasMany EducationTranslation
 ├── hasMany SkillCategoryTranslation
 ├── hasMany CertificationTranslation
 ├── hasMany TestimonialTranslation
 └── hasMany ContactTranslation
```

Attributes:

```text
id
code
name
native_name
direction
timestamps
```

Constraints:

- code: unique
- direction: `ltr | rtl`

Supported application locales:

```text
en
es
pt
fa
tr
ar
de
```

Arabic should use the intended UAE-oriented locale configuration where required.

---

# 9. Translation Pattern

Translatable entities use a parent table and translation table.

Example:

```text
abouts
-------
id
timestamps

about_translations
------------------
id
about_id
language_id
title
description
...
timestamps
```

Relationships:

```text
About
 └── hasMany AboutTranslation

AboutTranslation
 ├── belongsTo About
 └── belongsTo Language
```

The same pattern applies to:

- experiences;
- education;
- skill categories;
- certifications;
- testimonials;
- contact information.

## 9.1 Translation Uniqueness

Each entity should have one translation per language.

Recommended database constraint:

```text
UNIQUE(entity_id, language_id)
```

For each concrete table, use the corresponding foreign key, for example:

```text
UNIQUE(about_id, language_id)
```

---

# 10. Project Data Model

Projects are composed of:

```text
Project
 ├── ProjectType
 ├── ProjectStatus
 └── ProjectImages
```

Main project fields:

```text
id
project_type_id
project_status_id
slug
technologies
timestamps
```

`technologies` is stored as JSON.

Example:

```json
[
  "Laravel",
  "Vue",
  "Inertia",
  "MySQL"
]
```

Project images:

```text
project_images
--------------
id
project_id
path
alt
sort_order
timestamps
```

Relationship:

```text
Project
 ├── belongsTo ProjectType
 ├── belongsTo ProjectStatus
 └── hasMany ProjectImage
```

---

# 11. Skill Data Model

```text
SkillCategory
 ├── hasMany SkillCategoryTranslation
 └── hasMany Skill

Skill
 └── belongsTo SkillCategory
```

Skill category translations contain localized category names.

Skills may contain:

```text
id
skill_category_id
name
icon
level
sort_order
timestamps
```

---

# 12. Certification Data Model

```text
Certification
 └── hasMany CertificationTranslation
```

Certification contains non-translatable data such as:

```text
id
issue_date
expiration_date
credential_id
credential_url
no_expiration
timestamps
```

Localized fields are stored in:

```text
certification_translations
```

The expiration date should be nullable when the certification has no expiration.

---

# 13. Social Links

Social links do not require translation.

```text
social_links
------------
id
platform
url
icon
sort_order
is_active
timestamps
```

Recommended constraints:

- URL must be valid.
- Platform should be controlled through validation.
- `sort_order` should be numeric.
- `is_active` should be boolean.

---

# 14. Testimonials

```text
Testimonial
 └── hasMany TestimonialTranslation
```

Non-translatable fields may include:

```text
id
name
role
company
photo
sort_order
is_active
timestamps
```

Localized testimonial content belongs to the translation table.

---

# 15. Contact Information

The portfolio contact section uses:

```text
contacts
contact_translations
```

The parent entity stores non-translatable configuration.

The translation table stores localized labels and descriptive content.

---

# 16. Contact Messages

Visitor-submitted messages are stored separately.

```text
contact_messages
----------------
id
name
email
subject
message
status
read_at
replied_at
timestamps
```

Suggested status values:

```text
unread
read
replied
archived
```

The message itself should not be translated because it is user-generated content.

---

# 17. Visitor Tracking

The application uses its own visitor tracking system instead of an external analytics service.

A visitor record should contain only the information required for aggregate statistics and operational analysis.

Recommended fields:

```text
visitors
--------
id
session_hash
visited_at
path
created_at
updated_at
```

Optional non-identifying aggregation fields may be added later if required.

The system should avoid storing unnecessary personal information.

---

# 18. Activity Logs

Admin activity can be recorded using:

```text
activity_logs
-------------
id
user_id
action
subject_type
subject_id
description
created_at
updated_at
```

Examples:

```text
created project
updated certification
deleted skill
read contact message
replied to contact message
```

This supports the dashboard's recent activity section.

---

# 19. Model Relationships

A simplified Eloquent relationship map:

```text
User
 └── hasMany ActivityLog

Language
 ├── hasMany AboutTranslation
 ├── hasMany ExperienceTranslation
 ├── hasMany EducationTranslation
 ├── hasMany SkillCategoryTranslation
 ├── hasMany CertificationTranslation
 ├── hasMany TestimonialTranslation
 └── hasMany ContactTranslation

About
 └── hasMany AboutTranslation

Experience
 └── hasMany ExperienceTranslation

ProjectType
 └── hasMany Project

ProjectStatus
 └── hasMany Project

Project
 ├── belongsTo ProjectType
 ├── belongsTo ProjectStatus
 └── hasMany ProjectImage

Education
 └── hasMany EducationTranslation

SkillCategory
 ├── hasMany SkillCategoryTranslation
 └── hasMany Skill

Skill
 └── belongsTo SkillCategory

Certification
 └── hasMany CertificationTranslation

Testimonial
 └── hasMany TestimonialTranslation

Contact
 └── hasMany ContactTranslation
```

---

# 20. Controller Design

Controllers should use standard Laravel resource conventions.

For a typical CMS resource:

```text
index()
store()
update()
destroy()
```

If a separate detail page is needed:

```text
show()
```

Example:

```php
class SkillController extends Controller
{
    public function store(SkillRequest $request)
    {
        // create skill
    }

    public function update(SkillRequest $request, Skill $skill)
    {
        // update skill
    }

    public function destroy(Skill $skill)
    {
        // delete skill
    }
}
```

---

# 21. Form Request Design

Each resource should have a dedicated request class.

Examples:

```text
AboutRequest
ExperienceRequest
ProjectRequest
EducationRequest
CertificationRequest
SkillRequest
SkillCategoryRequest
SocialLinkRequest
TestimonialRequest
ContactRequest
LanguageRequest
```

Responsibilities:

- authorize request;
- validate fields;
- normalize input when appropriate.

Example:

```php
public function rules(): array
{
    return [
        'name' => ['required', 'string', 'max:255'],
        'url' => ['required', 'url', 'max:2048'],
        'is_active' => ['boolean'],
    ];
}
```

---

# 22. Validation Strategy

Validation must occur on the server even when frontend validation exists.

## 22.1 Common Validation Rules

### Strings

```text
required|string|max:255
```

### URLs

```text
required|url|max:2048
```

### Dates

```text
nullable|date
```

### Boolean Values

```text
boolean
```

### JSON / Array Data

```text
array
```

### Email

```text
required|email
```

### Images

Where images are accepted:

```text
nullable|image|max:<configured-limit>
```

Additional MIME restrictions should be applied where necessary.

---

# 23. Conditional Certification Validation

Certification expiration logic:

```text
no_expiration = true
    → expiration_date must be null

no_expiration = false
    → expiration_date may be required
```

The backend must not rely solely on the frontend to enforce this rule.

---

# 24. Database Transactions

Operations affecting multiple tables should use database transactions.

Example:

```text
Project update
 ├── update project
 ├── update translations
 └── synchronize images
```

All operations should succeed or fail as one unit.

Laravel pattern:

```php
DB::transaction(function () {
    // related operations
});
```

Transactions should be used for:

- translated resource creation;
- translated resource updates;
- project + image operations;
- message reply state changes when multiple writes occur;
- other multi-table mutations.

---

# 25. Service Layer

A service layer should be introduced when controller logic becomes complex.

Recommended services:

```text
PortfolioService
VisitorTrackingService
DashboardStatisticsService
TranslationService
ImageService
```

## 25.1 PortfolioService

Responsibilities:

- assemble public portfolio data;
- load translations;
- prepare related entities;
- return optimized public data.

## 25.2 VisitorTrackingService

Responsibilities:

- detect visitor/session;
- prevent duplicate counting according to the selected tracking policy;
- store visit;
- aggregate visitor statistics.

## 25.3 DashboardStatisticsService

Responsibilities:

- calculate KPI values;
- aggregate monthly messages;
- aggregate monthly visitors;
- retrieve recent activity.

## 25.4 TranslationService

Responsibilities:

- synchronize translation records;
- detect missing translations;
- update localized attributes.

## 25.5 ImageService

Responsibilities:

- validate image handling;
- process image paths;
- delete replaced images;
- delete orphaned project images.

---

# 26. Routing Design

Routes should be separated into public and authenticated admin groups.

Example structure:

```php
Route::get('/', [PortfolioController::class, 'index'])
    ->name('portfolio');

Route::post('/contact/messages', [ContactMessageController::class, 'store'])
    ->name('contact.messages.store');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CMS routes
});
```

---

# 27. Admin Route Structure

Recommended naming:

```text
admin.dashboard

admin.about.update

admin.experiences.store
admin.experiences.update
admin.experiences.destroy

admin.projects.store
admin.projects.update
admin.projects.destroy

admin.education.store
admin.education.update
admin.education.destroy

admin.certifications.store
admin.certifications.update
admin.certifications.destroy

admin.skill-categories.store
admin.skill-categories.update
admin.skill-categories.destroy

admin.skills.store
admin.skills.update
admin.skills.destroy

admin.social-links.store
admin.social-links.update
admin.social-links.destroy

admin.testimonials.store
admin.testimonials.update
admin.testimonials.destroy

admin.contact.update

admin.messages.index
admin.messages.read
admin.messages.reply
admin.messages.destroy
```

Ziggy exposes these route names to Vue.

---

# 28. Inertia Data Flow

Public request:

```text
Browser
  ↓
GET /
  ↓
PortfolioController@index
  ↓
PortfolioService
  ↓
Eloquent
  ↓
Localized portfolio data
  ↓
Inertia::render('Public/Home', props)
  ↓
Home.vue
```

Admin request:

```text
Browser
  ↓
GET /admin/dashboard
  ↓
auth middleware
  ↓
DashboardController@index
  ↓
DashboardStatisticsService
  ↓
Inertia::render('Admin/Dashboard', props)
  ↓
Dashboard.vue
```

---

# 29. Inertia Props

Props should contain only the data required by the current page.

Example dashboard props:

```php
[
    'statistics' => [
        'projects' => ...,
        'messages' => ...,
        'unread_messages' => ...,
    ],
    'messagesPerMonth' => [...],
    'visitorsPerMonth' => [...],
    'recentActivity' => [...],
]
```

Avoid returning entire Eloquent models when only a subset of fields is needed.

---

# 30. Resource Serialization

When data becomes complex or exposed across multiple endpoints, use Laravel API Resources or dedicated transformation classes.

Example:

```text
ProjectResource
ExperienceResource
CertificationResource
MessageResource
DashboardStatisticsResource
```

The objective is to avoid coupling the frontend directly to database structure.

---

# 31. Vue Page Design

Pages should coordinate page-level state and child components.

Example:

```text
Admin/Projects.vue
 ├── ProjectTable.vue
 ├── ProjectDialog.vue
 │    ├── ProjectForm.vue
 │    └── TranslationForm.vue
 └── ConfirmationDialog
```

The page owns:

- collection state;
- selected record;
- dialog visibility;
- submit/delete actions.

Reusable child components own:

- presentation;
- local form interaction;
- field-level UI.

---

# 32. PrimeVue Usage

PrimeVue should be used for administrative UI components such as:

- Dialog;
- DataTable;
- InputText;
- Textarea;
- Select;
- DatePicker;
- Checkbox;
- Button;
- Toast;
- ConfirmDialog;
- Tabs where useful;
- FileUpload where appropriate.

Tailwind CSS should handle layout and custom styling.

PrimeVue should remain responsible for component behavior and interaction.

---

# 33. Admin Dialog Pattern

CRUD editing should use PrimeVue dialogs.

Typical flow:

```text
Click "Add"
  ↓
set selected item = null
  ↓
open dialog

Click "Edit"
  ↓
set selected item
  ↓
open dialog

Submit
  ↓
Inertia request
  ↓
server validation
  ↓
success → close dialog + toast
error → display validation errors
```

---

# 34. Inertia Form Pattern

Use Inertia forms for server-backed CMS forms.

Example conceptual flow:

```js
const form = useForm({
    name: '',
    url: '',
    is_active: true,
});

form.post(route('admin.social-links.store'), {
    onSuccess: () => {
        // close dialog
        // show success toast
    },
});
```

This keeps validation errors and server state integrated with the Inertia lifecycle.

---

# 35. Pinia Store Responsibilities

Pinia should be used for application-level state, not as a replacement for server-side persistence.

Recommended stores:

### language.js

Stores:

- active locale;
- supported languages;
- direction information.

### theme.js

Stores:

- light/dark state;
- persisted theme preference.

### auth.js

Stores:

- authenticated user;
- authentication-related client state.

### portfolio.js

Optional store for cached public portfolio data if needed.

Avoid duplicating large server datasets in Pinia unless there is a clear reason.

---

# 36. Theme Management

Theme state is persisted in local storage.

Recommended flow:

```text
Application starts
  ↓
read theme from localStorage
  ↓
apply theme
  ↓
user toggles theme
  ↓
update DOM
  ↓
save preference
```

PrimeVue should use:

```text
darkModeSelector: '.dark'
```

The application must ensure that the `.dark` class is synchronized with the selected theme.

---

# 37. Language Management

The language selector should be located in the navigation area.

The hero section should not contain a language selector or theme selector.

Supported locales:

```text
en
es
pt
fa
tr
ar
de
```

Language state should be synchronized between:

```text
vue-i18n
+
Pinia
+
localStorage
```

RTL should be applied for RTL languages such as:

```text
fa
ar
```

The application should update:

```html
<html dir="rtl">
```

when the active locale requires RTL.

---

# 38. Localization File Structure

```text
Lang/
├── en.json
├── es.json
├── pt.json
├── fa.json
├── tr.json
├── ar.json
└── de.json
```

UI strings should be grouped by domain:

```json
{
    "common": {},
    "navigation": {},
    "auth": {},
    "dashboard": {},
    "about": {},
    "projects": {},
    "skills": {},
    "certifications": {},
    "messages": {},
    "validation": {},
    "notifications": {}
}
```

---

# 39. Public Portfolio Data Loading

The public homepage should ideally receive a single prepared portfolio payload rather than making many independent requests.

Example:

```text
GET /
    ↓
PortfolioService
    ↓
about
experiences
projects
education
certifications
skills
hobbies
social links
testimonials
contact
    ↓
Home.vue
```

This reduces unnecessary client-side requests.

---

# 40. Dashboard Design

The dashboard initially contains three primary widgets.

## 40.1 KPI Cards

Required statistics:

```text
Total Projects
Total Messages
Unread Messages
```

Recent activity may be displayed as a separate dashboard section.

Additional KPI cards should only be introduced when they provide meaningful operational value.

## 40.2 Messages Per Month

Data source:

```text
contact_messages.created_at
```

Aggregation:

```text
month → message count
```

Example:

```json
[
    {
        "month": "2026-01",
        "count": 5
    },
    {
        "month": "2026-02",
        "count": 8
    }
]
```

## 40.3 Visitors Per Month

Data source:

```text
visitors.visited_at
```

Aggregation:

```text
month → visitor count
```

The system must use its internal visitor tracking mechanism rather than Google Analytics or another external analytics provider.

---

# 41. Dashboard Query Strategy

Monthly statistics should be aggregated by the database rather than loading all records into PHP.

Conceptually:

```sql
SELECT
    YEAR(created_at) AS year,
    MONTH(created_at) AS month,
    COUNT(*) AS total
FROM contact_messages
GROUP BY YEAR(created_at), MONTH(created_at);
```

Equivalent query logic should be implemented using Laravel's query builder/Eloquent.

Indexes should support the aggregation fields.

---

# 42. Visitor Tracking Algorithm

Recommended high-level algorithm:

```text
Request arrives
    ↓
Determine whether request should be tracked
    ↓
Exclude admin/authenticated/internal requests
    ↓
Identify visitor/session using a privacy-conscious hash
    ↓
Check duplicate tracking policy
    ↓
Create visitor record if applicable
    ↓
Continue request
```

Visitor tracking should not interfere with page rendering.

If tracking fails, the public request should normally continue.

---

# 43. Contact Message Flow

```text
Visitor
  ↓
Contact form
  ↓
POST /contact/messages
  ↓
ContactMessageRequest
  ↓
validation
  ↓
ContactMessageController
  ↓
database
  ↓
success response
  ↓
toast notification
```

Recommended status after creation:

```text
unread
```

---

# 44. Message Read Flow

```text
Admin opens message
  ↓
POST/PATCH read endpoint
  ↓
set status = read
  ↓
set read_at = current timestamp
  ↓
return success
```

The operation should be idempotent.

---

# 45. Message Reply Flow

```text
Admin opens message
  ↓
writes reply
  ↓
server validates reply
  ↓
send email
  ↓
if successful:
    status = replied
    replied_at = now
  ↓
toast success
```

Email delivery should be implemented through Laravel's mail system.

For production, email sending should preferably be queued.

---

# 46. Notification Design

Use PrimeVue Toast for user-facing notifications.

Examples:

```text
success
error
warn
info
```

Messages should be localized.

Example:

```text
Project created successfully.
Project updated successfully.
Project deleted successfully.
Message marked as read.
Reply sent successfully.
```

Avoid exposing raw backend exceptions to users.

---

# 47. Confirmation Design

Destructive actions should require confirmation.

Examples:

```text
Delete project?
Delete certification?
Delete skill?
Delete message?
```

PrimeVue ConfirmationService should be used.

The confirmation should clearly identify the affected record.

---

# 48. Error Handling

## 48.1 Validation Error

Server returns validation errors.

Vue displays the error next to the relevant field.

## 48.2 Authorization Error

Unauthorized admin operation should return:

```text
403 Forbidden
```

## 48.3 Not Found

Missing resource:

```text
404 Not Found
```

## 48.4 Server Error

Unexpected exceptions:

```text
500 Internal Server Error
```

Production responses should not expose stack traces.

---

# 49. Authentication and Authorization

Laravel Breeze provides authentication.

Admin routes must use:

```text
auth
```

middleware.

Authorization should be enforced using policies or gates.

Recommended pattern:

```text
Authentication
    ↓
Authorization
    ↓
Controller
```

Never rely on frontend checks such as `v-if="user.isAdmin"` as the security mechanism.

---

# 50. Security Requirements

The application should implement:

- CSRF protection;
- authentication;
- authorization;
- server-side validation;
- SQL injection protection through Eloquent/query builder;
- output escaping;
- secure password hashing;
- rate limiting for public contact endpoints;
- secure cookie configuration;
- HTTPS in production;
- controlled file validation;
- mass-assignment protection;
- secure environment configuration.

---

# 51. Contact Form Abuse Protection

The public contact endpoint is exposed to the internet and should be rate limited.

Recommended controls:

```text
rate limiting
+
validation
+
spam detection where necessary
+
maximum message size
```

Do not trust client-side validation.

---

# 52. Image Handling

The CMS currently avoids Laravel's storage abstraction where possible according to the project design.

Image handling should therefore use a dedicated `ImageService` if images are stored through another mechanism.

The implementation must define:

```text
upload location
file naming strategy
allowed extensions
allowed MIME types
maximum file size
replacement behavior
deletion behavior
```

Project images must not become orphaned when their parent project is deleted.

---

# 53. SEO

The public portfolio should provide:

- page title;
- meta description;
- canonical URL;
- Open Graph metadata;
- Twitter/X card metadata where applicable;
- semantic HTML;
- descriptive image `alt` attributes;
- appropriate heading hierarchy;
- sitemap where appropriate;
- robots configuration.

Dynamic project pages should generate metadata from project content.

---

# 54. CV Delivery

The CV should be accessed through application/API routes rather than hard-coded frontend logic.

Conceptual flow:

```text
User clicks CV
  ↓
route/API
  ↓
server determines current CV
  ↓
download/view response
```

The implementation should avoid exposing internal filesystem paths.

---

# 55. Public Navigation

Navigation should be fixed/sticky at the top of the public page.

The navigation contains:

- section links;
- language selector;
- theme selector;
- responsive navigation controls.

The hero does not contain the language or theme selectors.

---

# 56. Admin Layout

The admin interface uses a separate layout.

```text
Admin Layout
├── Sidebar
├── Header/content area
└── Footer
```

The public layout is independent:

```text
Public Layout
├── Navigation
├── Page content
└── Footer
```

The admin should not reuse the public navigation/footer structure as its primary layout.

---

# 57. Component Communication

Use Vue's standard communication mechanisms.

```text
Parent
  ↓ props
Child

Child
  ↑ emits
Parent
```

For global state:

```text
Component
  ↓
Pinia Store
```

For server state:

```text
Component
  ↓
Inertia
  ↓
Laravel
```

Avoid excessive global state.

---

# 58. Frontend Form State

Forms should maintain:

```text
form fields
processing state
validation errors
success state
```

Dialog forms should reset appropriately after:

- successful creation;
- successful update;
- cancellation.

Editing one record must not leak values into the next record.

---

# 59. CRUD Lifecycle

```text
CREATE
  ↓
Open dialog
  ↓
Initialize empty form
  ↓
Validate
  ↓
POST
  ↓
Persist
  ↓
Refresh Inertia state
  ↓
Close dialog
  ↓
Toast

UPDATE
  ↓
Open dialog with selected record
  ↓
Modify
  ↓
Validate
  ↓
PATCH/PUT
  ↓
Persist
  ↓
Refresh state
  ↓
Close dialog
  ↓
Toast

DELETE
  ↓
Confirmation
  ↓
DELETE
  ↓
Persist
  ↓
Refresh state
  ↓
Toast
```

---

# 60. Database Indexing

Recommended indexes include:

```text
users.username
users.email

languages.code

projects.slug
projects.project_type_id
projects.project_status_id

project_images.project_id

*_translations.language_id
*_translations.<parent_id>

contact_messages.status
contact_messages.created_at

visitors.visited_at
visitors.session_hash

activity_logs.user_id
activity_logs.created_at
```

Composite unique indexes should be used for translation tables.

---

# 61. Query Optimization

Avoid N+1 queries.

Use eager loading where relationships are required:

```php
Project::with([
    'images',
    'type',
    'status',
    'translations.language',
])->get();
```

Only select required fields where appropriate.

Use pagination for admin tables that may grow significantly.

---

# 62. Pagination

Admin lists should support pagination when the dataset can grow.

Potential candidates:

- projects;
- messages;
- testimonials;
- experiences;
- certifications;
- skills;
- activity logs.

Public portfolio content can normally be loaded as a prepared collection because the expected dataset is small.

---

# 63. Sorting

Sortable entities should use an explicit field:

```text
sort_order
```

Recommended ordering:

```text
ORDER BY sort_order ASC
```

If `sort_order` is equal, use a stable secondary order such as:

```text
ORDER BY sort_order ASC, id ASC
```

---

# 64. Soft Deletes

Soft deletes should only be introduced when historical recovery is useful.

Recommended candidates:

```text
projects
contact_messages
```

However, if permanent deletion is explicitly required by the CMS, hard deletion may remain the chosen behavior.

The decision should be consistent across controllers and database relationships.

---

# 65. Activity Logging

Admin mutations should optionally create activity records.

Examples:

```text
CREATE
UPDATE
DELETE
READ
REPLY
LOGIN
LOGOUT
```

Activity logging should never prevent the main operation from succeeding unless auditing is a strict business requirement.

---

# 66. Logging and Monitoring

Laravel application logs should capture:

- unexpected exceptions;
- failed email delivery;
- failed visitor tracking;
- authentication failures where appropriate;
- important administrative errors.

Sensitive information must not be written to logs.

Do not log:

- passwords;
- authentication tokens;
- full private message contents unless strictly necessary;
- sensitive personal data.

---

# 67. Testing Strategy

Testing should exist at multiple levels.

## 67.1 Unit Tests

Test isolated services and business rules:

```text
VisitorTrackingService
DashboardStatisticsService
TranslationService
```

## 67.2 Feature Tests

Test:

- authentication;
- authorization;
- CRUD endpoints;
- validation;
- contact submission;
- message status changes;
- dashboard access.

## 67.3 Database Tests

Verify:

- relationships;
- unique constraints;
- cascade behavior;
- translation uniqueness;
- required fields.

## 67.4 Frontend Tests

Where frontend testing is introduced, test:

- form interaction;
- dialog behavior;
- validation display;
- theme switching;
- language switching;
- important reusable components.

---

# 68. Example Feature Test Scenarios

## Project Creation

```text
Authenticated user
  ↓
POST project
  ↓
valid data
  ↓
redirect success
  ↓
project exists in database
```

## Unauthorized Project Creation

```text
Unauthenticated user
  ↓
POST admin project
  ↓
redirect to login / 401
```

## Invalid Certification

```text
no_expiration = true
expiration_date supplied
  ↓
validation failure
```

## Contact Message

```text
Visitor
  ↓
valid contact data
  ↓
message created
  ↓
status = unread
```

---

# 69. Deployment Configuration

Production environment should include:

```text
APP_ENV=production
APP_DEBUG=false
APP_URL=<production-url>

DB_CONNECTION=mysql
DB_HOST=<host>
DB_DATABASE=<database>
DB_USERNAME=<username>
DB_PASSWORD=<secret>
```

Secrets must be stored in environment variables or the hosting provider's secret manager.

Never commit `.env` credentials.

---

# 70. Production Build

Frontend:

```bash
npm run build
```

Laravel optimization:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Database:

```bash
php artisan migrate --force
```

The exact deployment commands depend on the hosting environment.

---

# 71. Queue and Email Processing

If email notifications are enabled, use Laravel queues for production workloads.

Recommended flow:

```text
Contact/message action
  ↓
Dispatch job
  ↓
Queue
  ↓
Mail delivery
```

The user-facing request should not wait unnecessarily for external mail delivery.

---

# 72. Cache Strategy

Caching can be introduced for relatively static public data.

Good candidates:

```text
languages
portfolio configuration
public portfolio content
project types
project statuses
```

Cache invalidation should occur after admin mutations.

Example:

```text
Admin updates project
  ↓
save project
  ↓
clear portfolio cache
```

Avoid caching mutable admin state without an invalidation strategy.

---

# 73. API Design

Although the application primarily uses Inertia, API endpoints may be used for operations that need independent consumption.

Suggested API namespace:

```text
/api/v1/
```

Potential resources:

```text
GET    /api/v1/portfolio
GET    /api/v1/projects
GET    /api/v1/projects/{project}
POST   /api/v1/contact/messages
GET    /api/v1/cv
```

Admin operations can remain Inertia-based unless an external client requires API access.

---

# 74. HTTP Status Code Guidelines

| Situation | Status |
|---|---:|
| Successful GET | 200 |
| Successful form submission/redirect | 302/303 |
| Created API resource | 201 |
| Validation error | 422 |
| Unauthenticated | 401 |
| Unauthorized | 403 |
| Not found | 404 |
| Rate limited | 429 |
| Server error | 500 |

For standard Inertia mutations, Laravel redirects are acceptable and preferred.

---

# 75. Data Integrity Rules

The following rules must always hold:

1. A translation belongs to exactly one language.
2. An entity cannot have duplicate translations for the same language.
3. A project image belongs to a valid project.
4. A skill belongs to a valid skill category.
5. A project type/status reference must point to an existing record.
6. A certification with no expiration must not have an expiration date.
7. Contact messages must have valid sender information.
8. Visitor aggregation must not count excluded/internal requests.
9. Admin CMS mutations require authentication and authorization.

---

# 76. Transaction Boundaries

Transactions should cover operations where partial state would be invalid.

## Translation Update

```text
BEGIN
  update parent
  update translation EN
  update translation PT
  update translation FA
  ...
COMMIT
```

## Project Update

```text
BEGIN
  update project
  synchronize project images
  update related translations if applicable
COMMIT
```

If any operation fails:

```text
ROLLBACK
```

---

# 77. Frontend Error Display

Field errors should map directly to server validation keys.

Example:

```text
form.errors.name
form.errors.url
form.errors.issue_date
form.errors.expiration_date
```

General errors should be displayed through Toast when they are not associated with a specific field.

---

# 78. Loading States

Every asynchronous admin operation should provide a visible processing state.

Examples:

```text
Save button
  → disabled while processing
  → loading indicator

Delete action
  → confirmation
  → processing
  → disabled until complete
```

This prevents duplicate submissions.

---

# 79. Empty States

Admin lists should provide an explicit empty state.

Example:

```text
No projects have been created yet.
```

The empty state should include an action when appropriate:

```text
Add Project
```

---

# 80. Responsive Design

The public and admin interfaces must support:

```text
mobile
tablet
desktop
```

Admin sidebar behavior should adapt to smaller screens.

Tables should avoid overflowing the viewport and should provide responsive scrolling or alternative layouts.

---

# 81. Accessibility

The application should follow WCAG-oriented practices.

Required practices include:

- semantic HTML;
- keyboard navigation;
- visible focus states;
- accessible labels;
- appropriate ARIA attributes;
- sufficient contrast;
- alt text for meaningful images;
- no color-only status indicators;
- dialog focus management;
- keyboard-accessible navigation.

---

# 82. Internationalization Requirements

All UI text must come from localization resources.

Avoid:

```vue
<span>Delete Project</span>
```

Prefer:

```vue
<span>{{ $t('projects.delete') }}</span>
```

Localized content from the database should be separate from UI translation files.

Therefore:

```text
UI translations
    → Lang/*.json

Portfolio content translations
    → *_translations database tables
```

These are separate concerns.

---

# 83. Code Style

## 83.1 Vue Component Sections

Use a consistent component organization:

```js
// -----------------------------
// Imports
// -----------------------------

// -----------------------------
// Props & Emits
// -----------------------------

// -----------------------------
// State
// -----------------------------

// -----------------------------
// Computed
// -----------------------------

// -----------------------------
// Methods
// -----------------------------

// -----------------------------
// Lifecycle
// -----------------------------
```

Only include sections that are relevant to the component.

## 83.2 JavaScript

Prefer:

- `const` by default;
- descriptive variable names;
- small functions;
- early returns;
- reusable composables;
- no unnecessary global state.

## 83.3 Laravel

Prefer:

- Form Requests;
- route model binding;
- policies;
- Eloquent relationships;
- transactions for multi-write operations;
- services for complex domain logic.

---

# 84. Example Project Update Sequence

```text
Vue Project Dialog
      │
      │ form.put(...)
      ▼
ProjectController@update
      │
      ▼
ProjectRequest
      │
      ├── validation
      ▼
ProjectPolicy
      │
      ├── authorization
      ▼
DB::transaction()
      │
      ├── Project::update()
      ├── TranslationService
      └── ImageService
      │
      ▼
commit
      │
      ▼
redirect / Inertia response
      │
      ▼
Project Page
      │
      ├── close dialog
      └── show toast
```

---

# 85. Example Contact Message Sequence

```text
Visitor
   │
   ▼
Contact.vue
   │
   ▼
POST /contact/messages
   │
   ▼
ContactMessageRequest
   │
   ▼
ContactMessageController
   │
   ├── save message
   ├── dispatch email notification
   └── activity/logging if configured
   │
   ▼
Redirect / response
   │
   ▼
Toast
```

---

# 86. Example Visitor Tracking Sequence

```text
Browser Request
      │
      ▼
VisitorTrackingService
      │
      ├── Is public request?
      │       └── no → ignore
      │
      ├── Already tracked?
      │       └── yes → ignore
      │
      ▼
Create visitor record
      │
      ▼
Continue request
```

Visitor tracking must be designed so that a tracking failure does not unnecessarily break the portfolio.

---

# 87. Dependency Boundaries

The following boundaries should be maintained:

```text
Vue Components
    ↓
Inertia / Pinia

Controllers
    ↓
Requests / Services

Services
    ↓
Models / Repositories where justified

Models
    ↓
Database
```

Avoid:

```text
Vue → Database
Vue → Laravel Model
Controller → large business logic
Component → unrelated global store
```

---

# 88. Performance Requirements

The application should aim for:

- minimal database queries;
- eager loading;
- indexed frequently queried columns;
- pagination for large admin collections;
- optimized images;
- Vite production bundling;
- minimized JavaScript payload;
- cache for stable public content;
- asynchronous email delivery;
- efficient monthly aggregation queries.

---

# 89. Maintainability Requirements

The codebase should make it easy to add another portfolio section.

Adding a new content type should generally involve:

```text
1. Migration
2. Model
3. Translation model if needed
4. Relationships
5. Form Request
6. Policy if required
7. Controller
8. Routes
9. Admin page
10. Admin components
11. Localization strings
12. Public component
13. Tests
```

This provides a repeatable development pattern.

---

# 90. Extension Points

The architecture should allow future additions such as:

- multiple admin users;
- role-based access control;
- additional languages;
- project categories;
- blog;
- downloadable documents;
- advanced analytics;
- email templates;
- audit log UI;
- API authentication;
- media library;
- scheduled content publishing.

These should be introduced without coupling them to existing components unnecessarily.

---

# 91. Non-Functional Requirements

| Category | Requirement |
|---|---|
| Security | Authentication, authorization, validation, CSRF protection |
| Performance | Avoid N+1 queries and unnecessary requests |
| Scalability | Paginate growing datasets |
| Maintainability | Separate frontend/backend responsibilities |
| Accessibility | Keyboard and semantic accessibility |
| Localization | Seven supported locales |
| Reliability | Transactions for multi-table operations |
| Privacy | Minimize visitor data collection |
| Usability | Toasts, dialogs, loading and empty states |
| SEO | Metadata and semantic structure |
| Observability | Application and admin activity logging |

---

# 92. Definition of Done for CMS Features

A CMS feature is considered complete when:

- [ ] migration exists;
- [ ] model exists;
- [ ] relationships are defined;
- [ ] validation exists;
- [ ] authorization exists;
- [ ] controller actions exist;
- [ ] routes exist;
- [ ] database transaction is used where required;
- [ ] admin UI exists;
- [ ] PrimeVue components are used consistently;
- [ ] loading state exists;
- [ ] validation errors are displayed;
- [ ] success/error toast exists;
- [ ] destructive actions require confirmation;
- [ ] localization strings exist;
- [ ] responsive behavior is implemented;
- [ ] accessibility is considered;
- [ ] feature tests exist;
- [ ] relevant cache is invalidated;
- [ ] activity logging is added where appropriate.

---

# 93. Recommended Implementation Order

A practical implementation sequence is:

```text
1. Authentication
2. Database migrations
3. Models and relationships
4. Policies
5. Form Requests
6. Admin routes
7. CRUD controllers
8. Admin layouts
9. Reusable admin components
10. CRUD dialogs/forms
11. Public portfolio loading
12. Localization
13. Theme management
14. Contact messages
15. Visitor tracking
16. Dashboard statistics
17. Notifications
18. Email notifications
19. SEO
20. Testing
21. Performance optimization
22. Production deployment
```

---

# 94. Final Architecture Summary

```text
                           ┌───────────────────────┐
                           │       Browser         │
                           └───────────┬───────────┘
                                       │
                    ┌──────────────────┴──────────────────┐
                    │                                     │
                    ▼                                     ▼
             Public Portfolio                       Admin CMS
                    │                                     │
                    ▼                                     ▼
              Vue 3 / Inertia                       Vue 3 / Inertia
                    │                                     │
                    └──────────────────┬──────────────────┘
                                       │
                                       ▼
                              Laravel Application
                                       │
                    ┌──────────────────┼──────────────────┐
                    │                  │                  │
                    ▼                  ▼                  ▼
               Controllers        Form Requests        Services
                    │                  │                  │
                    └──────────────────┼──────────────────┘
                                       │
                                       ▼
                                  Eloquent Models
                                       │
                                       ▼
                                     MySQL
                                       │
             ┌─────────────────────────┼───────────────────────┐
             │                         │                       │
             ▼                         ▼                       ▼
       Portfolio Data            Contact Messages          Visitors
             │                         │                       │
             └─────────────────────────┼───────────────────────┘
                                       ▼
                              Dashboard Statistics
```

The resulting design keeps the application modular while preserving Laravel conventions, Vue/Inertia's server-driven navigation model, PrimeVue's component system, and MySQL relational integrity.

---

# 95. Document Maintenance

This LLD should be updated whenever a structural implementation decision changes.

Examples requiring an update:

- new database entity;
- changed relationship;
- new authentication/authorization rule;
- new application-wide service;
- new localization architecture;
- changed visitor tracking strategy;
- changed dashboard metrics;
- new external integration;
- significant frontend architecture change.

**Document Version:** 1.0
