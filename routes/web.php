
<?php
use App\Http\Controllers\DataListController;
Route::get('/users', [DataListController::class, 'users'])->name('users.index');
Route::get('/categories', [DataListController::class, 'categories'])->name('categories.index');
Route::get('/products', [DataListController::class, 'products'])->name('products.index');

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DemoDataController;
Route::get('/category/{id}', [CategoryProductController::class, 'showCategory'])->name('category.show');
Route::get('/', [CategoryProductController::class, 'index']);
Route::get('/danh-muc-san-pham', [CategoryProductController::class, 'index'])->name('category.products');
Route::get('/dashboard-demo', [DemoDataController::class, 'dashboard']);
Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
Route::get('/login-demo', [DemoDataController::class, 'showLogin']);
Route::post('/login-demo', [DemoDataController::class, 'doLogin']);