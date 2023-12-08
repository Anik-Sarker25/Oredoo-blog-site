<?php
// use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontendAuthController;
use App\Http\Controllers\FrontendBlogPageController;
use App\Http\Controllers\FrontendBlogController;
use App\Http\Controllers\FrontendSinglePostController;
use App\Http\Controllers\SearchBlogController;
use App\Http\Controllers\ApproveRejectController;
use App\Http\Controllers\RoleManagement;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// frontend root
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('root');

// front page blogs
Route::get('/category/post/{id}', [App\Http\Controllers\FrontendBlogController::class, 'index'])->name('category.blog');
Route::get('/category/single_post/{id}', [App\Http\Controllers\FrontendBlogController::class, 'single_post'])->name('category.single.blog');
Route::get('/category/single_post/tag/post/{id}', [App\Http\Controllers\FrontendBlogController::class, 'tag_post'])->name('tag.post');

// blog page blogs
Route::get('/blogs', [App\Http\Controllers\FrontendBlogPageController::class, 'index'])->name('blog.post');
Route::get('/blogs/search', [App\Http\Controllers\SearchBlogController::class, 'search'])->name('blog.search');

// frontend single blog posts
Route::get('/single_post/{id}', [App\Http\Controllers\FrontendSinglePostController::class, 'index'])->name('single.blog');
Route::get('/single_post/tag_post/{id}', [App\Http\Controllers\FrontendSinglePostController::class, 'tag_post'])->name('single.tag_post');

// frontend comment controllers
Route::post('/single_post/comment', [\App\Http\Controllers\CommentController::class, 'index'])->name('comment');


// frontend auth controller
Route::get('/signup', [\App\Http\Controllers\FrontendAuthController::class, 'index'])->name('signup.view');
Route::post('/signup/success', [\App\Http\Controllers\FrontendAuthController::class, 'insert'])->name('signup');
Route::get('/signin', [App\Http\Controllers\FrontendAuthController::class, 'signin'])->name('signin.view');
Route::post('/signin/success', [App\Http\Controllers\FrontendAuthController::class, 'access'])->name('signin');

// frontend contact page controllers
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact/insert', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

//admin register page
Auth::routes(['register' => false]);


// backend
Route::middleware(['web', 'auth'])->group(function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'nn'])->middleware(['auth', 'verified'])->name('home');

Route::middleware(['role'])->group(function () {
// role management
Route::get('/users', [App\Http\Controllers\RoleManagement::class, 'user'])->name('user');
Route::get('/add_user', [App\Http\Controllers\RoleManagement::class, 'add_user'])->name('add.user');
Route::post('/add_user/insert', [App\Http\Controllers\RoleManagement::class, 'insert'])->name('add.user.insert');
Route::post('/user/delete/{id}', [App\Http\Controllers\RoleManagement::class, 'delete'])->name('user.delete');
Route::post('/user/edit/{id}', [App\Http\Controllers\RoleManagement::class, 'edit'])->name('user.edit');
});

// dashboard page
// User request approve, reject and block controller
Route::post('/request/approve/{id}', [App\Http\Controllers\ApproveRejectController::class, 'approve'])->name('request.approve');
Route::post('/request/reject/{id}', [App\Http\Controllers\ApproveRejectController::class, 'reject'])->name('request.reject');
Route::post('/status/{id}', [App\Http\Controllers\ApproveRejectController::class, 'block_status'])->name('block.status');

// profile controller
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::post('/profile/name/update/{id}', [App\Http\Controllers\ProfileController::class, 'name_update'])->name('profile.name');
Route::post('/profile/email/update/{id}', [App\Http\Controllers\ProfileController::class, 'email_update'])->name('profile.email');
Route::post('/profile/image/update/{id}', [App\Http\Controllers\ProfileController::class, 'image_update'])->name('profile.image');
Route::post('/profile/password/update/{id}', [App\Http\Controllers\ProfileController::class, 'password_update'])->name('profile.password');
// category controller
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
Route::post('/category/insert', [App\Http\Controllers\CategoryController::class, 'insert'])->name('category.insert');
Route::post('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete');
Route::post('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/status/{id}', [App\Http\Controllers\CategoryController::class, 'status'])->name('category.status');

// tag controller
Route::get('/tag', [App\Http\Controllers\TagController::class, 'index'])->name('tag');
Route::post('/tag/insert', [App\Http\Controllers\TagController::class, 'insert'])->name('tag.insert');
Route::post('/tag/delete/{id}', [App\Http\Controllers\TagController::class, 'delete'])->name('tag.delete');
Route::post('/tag/status/{id}', [App\Http\Controllers\TagController::class, 'status'])->name('tag.status');
Route::post('/tag/restore/{id}', [App\Http\Controllers\TagController::class, 'restore'])->name('tag.restore');
Route::post('/tag/deletion/{id}', [App\Http\Controllers\TagController::class, 'deletepermanent'])->name('tag.deletepermanent');
// blog controller
Route::get('/blog',[\App\Http\Controllers\BlogController::class,'index'])->name('blog');
Route::get('/blog/create',[\App\Http\Controllers\BlogController::class,'create'])->name('blog.create');
Route::post('/blog/insert',[\App\Http\Controllers\BlogController::class,'insert'])->name('blog.insert');
// Route::get('/blog/edit_view',[\App\Http\Controllers\BlogController::class,'view'])->name('blog.edit_view');
Route::post('/blog/edit/{id}',[\App\Http\Controllers\BlogController::class,'update'])->name('blog.edit');
Route::post('/blog/delete/{id}',[\App\Http\Controllers\BlogController::class,'delete'])->name('blog.delete');

});

Route::get('/email/verify', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// email verification
// Route::get('/email/verify', function () {
//     return view('auth.verify');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');


// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
