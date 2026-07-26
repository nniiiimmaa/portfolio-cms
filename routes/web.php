<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectStatusController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\SkillCategoryController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

Route::get('/welcome', [WelcomeController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/about', [AboutController::class, 'edit'])->name('about.edit');
    Route::patch('/about', [AboutController::class, 'update'])->name('about.update');

    Route::get('/experiences', [ExperienceController::class, 'index'])->name('experiences.index');
    Route::post('/experiences', [ExperienceController::class, 'store'])->name('experiences.store');
    Route::put('/experiences/{experience}', [ExperienceController::class, 'update'])->name('experiences.update');
    Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::post('/project-types', [ProjectTypeController::class, 'store'])->name('projecttypes.store');
    Route::put('/projecttypes/{projectType}', [ProjectTypeController::class, 'update'])->name('projecttypes.update');
    Route::delete('/projecttypes/{projectType}', [ProjectTypeController::class, 'destroy'])->name('projecttypes.destroy');
    Route::post('/projectstatuses', [ProjectStatusController::class, 'store'])->name('projectstatuses.store');
    Route::put('/projectstatuses/{projectStatus}', [ProjectStatusController::class, 'update'])->name('projectstatuses.update');
    Route::delete('/projectstatuses/{projectStatus}', [ProjectStatusController::class, 'destroy'])->name('projectstatuses.destroy');

    Route::get('/educations', [EducationController::class, 'index'])->name('educations.index');
    Route::post('/educations', [EducationController::class, 'store'])->name('educations.store');
    Route::put('/educations/{education}', [EducationController::class, 'update'])->name('educations.update');
    Route::delete('/educations/{education}', [EducationController::class, 'destroy'])->name('educations.destroy');

    Route::get('/certifications', [CertificationController::class, 'index'])->name('certifications.index');
    Route::post('/certifications', [CertificationController::class, 'store'])->name('certifications.store');
    Route::put('/certifications/{certification}', [CertificationController::class, 'update'])->name('certifications.update');
    Route::delete('/certifications/{certification}', [CertificationController::class, 'destroy'])->name('certifications.destroy');

    Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::put('/skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');
    Route::post('/skillcategory', [SkillCategoryController::class, 'store'])->name('skillcategories.store');
    Route::put('/skillcategory/{skillCategory}', [SkillCategoryController::class, 'update'])->name('skillcategories.update');
    Route::delete('/skillcategory/{skillCategory}', [SkillCategoryController::class, 'destroy'])->name('skillcategories.destroy');

    Route::get('/hobbies', [HobbyController::class, 'index'])->name('hobbies.index');
    Route::post('/hobbies', [HobbyController::class, 'store'])->name('hobbies.store');
    Route::put('/hobbies/{hobby}', [HobbyController::class, 'update'])->name('hobbies.update');
    Route::delete('/hobbies/{hobby}', [HobbyController::class, 'destroy'])->name('hobbies.destroy');

    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
    
    Route::get('/contact', [ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact', [ContactController::class, 'update'])->name('contact.update');

    Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::put('/messages/read/{message}', [ContactMessageController::class, 'updateRead'])->name('messages.read');
    Route::put('/messages/reply/{message}', [ContactMessageController::class, 'updateReply'])->name('messages.reply');

    Route::get('/medias', [SocialMediaController::class, 'index'])->name('medias.index');
    Route::post('/medias', [SocialMediaController::class, 'store'])->name('medias.store');
    Route::put('/medias/{socialLink}', [SocialMediaController::class, 'update'])->name('medias.update');
    Route::delete('/medias/{socialLink}', [SocialMediaController::class, 'destroy'])->name('medias.destroy');
});

require __DIR__.'/auth.php';
