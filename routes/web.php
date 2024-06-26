<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\EntrantsController;
use App\Http\Controllers\Admin\TeathersController;
use App\Http\Controllers\Admin\LessonsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\CertificationController;
use App\Http\Controllers\Front\CertupdatedController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\VisitController;
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
Route::get('/', [PageController::class, 'index'])->name('frontpage');
Route::get('/empty', [PageController::class, 'empty'])->name('empty');
Route::group(['prefix' => 'certification'], function(){
    Route::get('/', [CertificationController::class, 'index'])->name('front.certification.index');
    Route::get('/create', [CertificationController::class, 'create'])->name('front.certification.create');
    Route::get('/{teacher}', [CertificationController::class, 'show'])->name('front.certification.show');
    Route::post('/', [CertificationController::class, 'store'])->name('front.certification.store');
    Route::get('/{teacher}/update', [CertificationController::class, 'update'])->name('front.certification.update');
    Route::patch('/{teacher}/store', [CertificationController::class, 'stor'])->name('front.certification.stor');
});
Route::group(['prefix' => 'news'], function(){
    Route::get('/', [App\Http\Controllers\Front\NewsController::class, 'index'])->name('front.news.index');
    Route::get('/{new}', [App\Http\Controllers\Front\NewsController::class, 'show'])->name('front.news.new');
});
Route::group(['prefix' => 'entrant'], function(){
    Route::get('/{user}/edit', [App\Http\Controllers\Front\EntrantsController::class, 'edit'])->middleware('auth', 'Entrant')->name('front.entrant.edit');
    Route::patch('/{user}/update', [App\Http\Controllers\Front\EntrantsController::class, 'update'])->middleware('auth', 'Entrant')->name('front.entrant.update');
});

Route::middleware(['auth', 'Adminpanel'])->group(function(){
    Route::group(['prefix' => 'admin'], function(){
        Route::get('/', [AdminController::class, 'index'])->name('main');
        Route::get('/{student}/visit', [VisitController::class, 'index']);
        Route::get('/visit', [VisitController::class, 'show'])->name('show.visit');;
        Route::group(['prefix' => 'groups'], function(){
            Route::get('/', [GroupsController::class, 'index'])->name('group.index');
            Route::get('/create', [GroupsController::class, 'create'])->name('group.create');
            Route::get('/{group}', [GroupsController::class, 'show'])->name('group.show');
            Route::get('/{group}/edit', [GroupsController::class, 'edit'])->name('group.edit');
            route::post('/', [GroupsController::class, 'store'])->name('group.store');
            route::patch('/{group}', [GroupsController::class, 'update'])->name('group.update');
            route::delete('/{group}', [GroupsController::class, 'destroy'])->name('group.destroy');
        }); 
        Route::group(['prefix' => 'entrants'], function(){
            Route::get('/', [EntrantsController::class, 'index'])->name('entrant.index');
            Route::get('/create', [EntrantsController::class, 'create'])->name('entrant.create');
            Route::post('/', [EntrantsController::class, 'store'])->name('entrant.store');
            Route::get('/{entrant}', [EntrantsController::class, 'show'])->name('entrant.show');
            Route::patch('/{entrant}', [EntrantsController::class, 'update'])->name('entrant.update');
            Route::get('/{entrant}/edit', [EntrantsController::class, 'edit'])->name('entrant.edit');           
            Route::delete('/{entrant}', [EntrantsController::class, 'destroy'])->name('entrant.destroy');
        });
        Route::group(['prefix' => 'teathers'], function(){
            Route::get('/', [TeathersController::class, 'index'])->name('teather.index');
            Route::get('/create', [TeathersController::class, 'create'])->name('teather.create');
            Route::get('/{teather}', [TeathersController::class, 'show'])->name('teather.show');
            Route::get('/{teather}/edit', [TeathersController::class, 'edit'])->name('teather.edit'); 
            route::post('/', [TeathersController::class, 'store'])->name('teather.store'); 
            route::patch('/{teather}', [TeathersController::class, 'update'])->name('teather.update');
            route::delete('/{teather}', [TeathersController::class, 'destroy'])->name('teather.destroy');
        });
        Route::group(['prefix' => 'lessons'], function(){
            route::get('/', [LessonsController::class,'index'])->name('lesson.index');
            route::get('/create', [LessonsController::class,'create'])->name('lesson.create');
            route::get('/{lesson}/edit', [LessonsController::class,'edit'])->name('lesson.edit');       
            route::get('/{lesson}',[LessonsController::class,'show'])->name('lesson.show');
            route::post('/', [LessonsController::class, 'store'])->name('lesson.store');
            route::patch('/{group}', [LessonsController::class, 'update'])->name('lesson.update');
            route::delete('/{group}', [LessonsController::class, 'destroy'])->name('lesson.destroy');   
        });
        Route::group(['prefix' => 'categories'], function(){
            Route::get('/', [CategoriesController::class, 'index'])->name('category.index');
            Route::get('/create', [CategoriesController::class, 'create'])->name('category.create');
            route::post('/', [CategoriesController::class, 'store'])->name('category.store'); 
            Route::get('/{category}', [CategoriesController::class, 'show'])->name('category.show');
            Route::get('/{category}/edit', [CategoriesController::class, 'edit'])->name('category.edit');
            route::patch('/{category}', [CategoriesController::class, 'update'])->name('category.update');
            route::delete('/{category}', [CategoriesController::class, 'destroy'])->name('category.destroy');
        });
        Route::group(['prefix' => 'news'], function(){
            route::get('/',  [NewsController::class, 'index'])->name('new.index');
            route::get('/create', [NewsController::class, 'create'])->name('new.create');
            route::post('/', [NewsController::class, 'store'])->name('new.store');
            route::get('/{new}', [NewsController::class, 'show'])->name('new.show');
            route::get('/{new}/edit', [NewsController::class, 'edit'])->name('new.edit');
            route::patch('/{new}', [NewsController::class, 'update'])->name('new.update');
            route::delete('/{new}', [NewsController::class, 'destroy'])->name('new.destroy');
        });
        Route::group(['prefix' => 'roles'], function(){
            route::get('/',  [RolesController::class, 'index'])->name('role.index');
            route::get('/create', [RolesController::class, 'create'])->name('role.create');
            route::post('/', [RolesController::class, 'store'])->name('role.store');
            route::get('/{slug}', [RolesController::class, 'show'])->name('role.show');
            route::get('/{slug}/edit', [RolesController::class, 'edit'])->name('role.edit');
            route::patch('/{slug}', [RolesController::class, 'update'])->name('role.update');
            route::delete('/{slug}', [RolesController::class, 'destroy'])->name('role.destroy');
        });
        Route::group(['prefix' => 'students'], function(){
            Route::get('/', [StudentsController::class, 'index'])->name('student.index');
            Route::get('/create', [StudentsController::class, 'create'])->name('student.create');
            Route::get('/{student}', [StudentsController::class, 'show'])->name('student.show');
            Route::get('/{student}/edit', [StudentsController::class, 'edit'])->name('student.edit'); 
            Route::get('/{student}/link', [StudentsController::class, 'link'])->name('student.link'); 
            route::post('/', [StudentsController::class, 'store'])->name('student.store'); 
            route::patch('/{student}', [StudentsController::class, 'update'])->name('student.update');
            route::delete('/{student}', [StudentsController::class, 'destroy'])->name('student.destroy');
        });
        Route::group(['prefix' => 'register'], function(){
            route::get('/',  [RegisterController::class, 'index'])->name('register.index');
            Route::post('/{entrant}/approve', [RegisterController::class, 'approve'])->name('register.approve');
            Route::post('/{entrant}/deleterequest', [RegisterController::class, 'deleterequest'])->name('register.deleterequest');        
        });
    });
    Route::group(['prefix' => 'roles'], function(){
        route::get('/',  [RolesController::class, 'index'])->name('role.index');
        route::get('/create', [RolesController::class, 'create'])->name('role.create');
        route::post('/', [RolesController::class, 'store'])->name('role.store');
        route::get('/{slug}', [RolesController::class, 'show'])->name('role.show');
        route::get('/{slug}/edit', [RolesController::class, 'edit'])->name('role.edit');
        route::patch('/{slug}', [RolesController::class, 'update'])->name('role.update');
        route::delete('/{slug}', [RolesController::class, 'destroy'])->name('role.destroy');
    });
    Route::group(['prefix' => 'register'], function(){
        route::get('/',  [RegisterController::class, 'index'])->name('register.index');        
    });
});

//Auth::routes();
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
