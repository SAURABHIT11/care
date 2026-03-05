<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AssetGeneratorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\AgeGroupController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ContentController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\PublicContentController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\BlogController;




Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // General Access
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User/Role Listing (Accessible to anyone with 'user.view' or 'role.view' permissions)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/my-activity-logs', [AnalyticsController::class, 'userLogs'])->name('logs.self');
    
    // Self Logs (Assuming you have a LogController)
});

// Admin-Only Actions (Creating, Editing, Deleting)
Route::middleware(['auth', 'admin'])->group(function () {
    // We use 'except' because 'index' is already handled above
    Route::resource('users', UserController::class)->except(['index']);
    Route::resource('roles', RoleController::class)->except(['index']);
    Route::resource('permissions', PermissionController::class);
    Route::resource('posts', PostController::class);

    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/admin/analytics/export', [AnalyticsController::class, 'export'])->name('analytics.export');
    
    Route::prefix('assets')->name('assets.')->group(function () {
    
    // 1. AI Generation Flow
    // The "Start" page where user enters the query
    Route::get('/create', [AssetGeneratorController::class, 'create'])->name('create');
    
    // The "Consulting Gemini" action that returns the 3 variations
    Route::post('/generate', [AssetGeneratorController::class, 'generate'])->name('generate');
Route::get('/verify', function () {
    return view('assets.verify');
})->name('verify');
    // 2. Standard CRUD Operations
    // List all saved assets
    Route::get('/', [AssetGeneratorController::class, 'index'])->name('index');
    
    // Save a verified AI suggestion to the database
    Route::post('/', [AssetGeneratorController::class, 'store'])->name('store');
    
    // Show the edit form (to upload the final image)
    Route::get('/{asset}/edit', [AssetGeneratorController::class, 'edit'])->name('edit');
    
    // Update metadata or upload the image
    Route::put('/{asset}', [AssetGeneratorController::class, 'update'])->name('update');
    
    // Remove an asset and its file from storage
    Route::delete('/{asset}', [AssetGeneratorController::class, 'destroy'])->name('destroy');
});
Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('age-groups', AgeGroupController::class);
    Route::resource('tags', TagController::class);
    Route::resource('contents', ContentController::class);

});
});


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (No Login Required)
|--------------------------------------------------------------------------
*/
Route::get('/worksheets', [PublicContentController::class, 'worksheets'])->name('worksheets.index');

Route::get('/coloring-pages', [PublicContentController::class, 'coloring'])->name('coloring.index');

Route::get('/books', [PublicContentController::class, 'books'])->name('books.index');

Route::get('/games', [PublicContentController::class, 'games'])->name('games.index');


/*
|--------------------------------------------------------------------------
| Category Wise Listing
|--------------------------------------------------------------------------
*/
Route::get('/category/{slug}', [PublicContentController::class, 'category'])->name('category.show');


/*
|--------------------------------------------------------------------------
| Single Content Page
|--------------------------------------------------------------------------
*/
Route::get('/content/{slug}', [PublicContentController::class, 'show'])->name('content.show');


Route::get('/worksheets/{slug}', [PublicContentController::class, 'showWorksheet'])->name('worksheets.show');
Route::get('/coloring-pages/{slug}', [PublicContentController::class, 'showColoringPage'])->name('coloring-pages.show');

Route::get('/coloring-pages/fill/{slug}', [PublicContentController::class, 'fill'])->name('coloring-pages.fill');
Route::get('/books/{slug}', [PublicContentController::class, 'showBook'])->name('books.show');
Route::get('/download/{content}', [DownloadController::class, 'download'])
    ->name('download.content');
Route::post('/admin/blogs/generate-prompt', [BlogController::class, 'generatePrompt'])
    ->name('admin.blogs.generatePrompt');

Route::post('/admin/blogs/generate-blog', [BlogController::class, 'generateBlogFromPrompt'])
    ->name('admin.blogs.generateBlog');
    
Route::get('/admin/blogs/create', [BlogController::class, 'create'])
    ->name('admin.blogs.create');
    Route::post('/admin/blogs/generate-ai', [BlogController::class, 'generateBlog'])
    ->name('admin.blogs.generate');

require __DIR__.'/auth.php';
