<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BugsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\SetLocale;

Route::middleware([SetLocale::class])->group(function () {
    Route::get('/change-language/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'fr'])) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    })->name('change-language');

    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');

    Route::get('/dashboard', [ChartController::class, 'index'], function () {
        return view('dashboard.index');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware(['auth', 'can:view projects'])->group(function () {
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
        Route::get('/projects/{project}', [ProjectController::class, 'show'])->where('project', '[0-9]+')->name('projects.show');
    });
    
    Route::middleware(['auth', 'can:create projects'])->group(function () {
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    });
    
    Route::middleware(['auth', 'can:edit projects'])->group(function () {
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    });

    Route::middleware(['auth', 'can:edit projects'])->group(function () {
        Route::post('/projects/{project}/team/add', [ProjectController::class, 'addTeam'])->name('projects.addTeam');
        Route::post('/projects/{project}/team/remove', [ProjectController::class, 'removeTeam'])->name('projects.removeTeam');
    });
    
    Route::middleware(['auth', 'can:delete projects'])->group(function () {
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });

    // bugs CRUD
    Route::middleware(['auth', 'can:view bugs'])->group(function () {
        Route::get('/bugs', [BugsController::class, 'index'])->name('bugs');
        Route::get('/bugs/{bug}', [BugsController::class, 'show'])->where('bug', '[0-9]+')->name('bugs.show');
    });

    Route::middleware(['auth', 'can:view bugs'])->group(function () {
        Route::get('/bugs/count', [BugsController::class, 'countBugs'])->name('bugs.count');
        Route::get('/bugs/user/count', [BugsController::class, 'countUserBugs'])->name('bugs.user.count');
    });

    Route::middleware(['auth', 'can:view projects'])->group(function () {
        Route::get('/projects/count', [ProjectController::class, 'countProjects'])->name('projects.count');
        Route::get('/projects/user/count', [ProjectController::class, 'countProjectsByUser'])->name('projects.user.count');
    });

    Route::middleware(['auth', 'can:create bugs'])->group(function () {
        Route::get('/bugs/create', [BugsController::class, 'create'])->name('bugs.create');
        Route::post('/bugs', [BugsController::class, 'store'])->name('bugs.store');
    });

    Route::middleware(['auth', 'can:edit bugs'])->group(function () {
        Route::get('/bugs/{bug}/edit', [BugsController::class, 'edit'])->name('bugs.edit');
        Route::put('/bugs/{bug}', [BugsController::class, 'update'])->name('bugs.update');
    });

    Route::middleware(['auth', 'can:delete bugs'])->group(function () {
        Route::delete('/bugs/{bug}', [BugsController::class, 'destroy'])->name('bugs.destroy');
    });

    Route::middleware(['auth', 'can:edit bugs'])->group(function () {
        Route::post('/bugs/{bug}/assign', [BugsController::class, 'assign'])->name('bugs.assign');
        Route::post('/bugs/{bug}/solve', [BugsController::class, 'solve'])->name('bugs.solve');
        Route::post('/bugs/{bug}/close', [BugsController::class, 'close'])->name('bugs.close');
        Route::post('/bugs/{bug}/reopen', [BugsController::class, 'reopen'])->name('bugs.reopen');
    });
    Route::post('/ai-diagnostic', [BugsController::class, 'aiDiagnostic'])->name('ai.diagnostic');

    //Settings page
    Route::middleware(['auth', 'can:settings'])->group(function () {
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    });

    //destroy user settings
    Route::middleware(['auth', 'can:settings'])->group(function () {
        Route::delete('/settings/{user}', [SettingsController::class, 'destroy'])->name('settings.destroy');
    });

    //register user settings
    Route::middleware(['auth', 'can:settings'])->group(function () {
        Route::post('/settings', [SettingsController::class, 'register'])->name('settings.register');
    });
    

    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});



require __DIR__.'/auth.php';
