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

    Route::get('/educations', [EducationController::class, 'index'])->name('educations.index');

    Route::get('/certifications', [CertificationController::class, 'index'])->name('certifications.index');

    Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');

    Route::get('/hobbies', [HobbyController::class, 'index'])->name('hobbies.index');

    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    
    Route::get('/contact', [ContactController::class, 'edit'])->name('contact.edit');

    Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');

    Route::get('/medias', [SocialMediaController::class, 'index'])->name('medias.index');
});

require __DIR__.'/auth.php';
