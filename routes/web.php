<?php

use App\Http\Controllers\FrontengPageController;
use App\Http\Controllers\MainPagesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\Auth\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\userLoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\EveryUserController;
use App\Http\Controllers\PortfolioPostController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\VisitorController;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Http\Middleware\LogVisitor;




Route::middleware([LogVisitor::class])->group(function(){

    Route::get('/', [FrontengPageController::class, 'homepage'])->name('home.front');
    Route::get('/single-portfolio-details/{di}/details', [FrontengPageController::class, 'portfolio_details'])->name('portfolio-details.front');
    Route::get('/single-page-service', [FrontengPageController::class, 'allServices'])->name('allService.front');
    Route::get('/single-view-service/{id}', [FrontengPageController::class, 'OpensinglePageService'])->name('OpensinglePageService.front');
    //contactFrom
    Route::post('/contact',[ContactFormController::class,'store'])->name('contact.store');

    // Admin login routes
    Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::get('/admin-login', [AdminAuthController::class, 'if_Not_Login'])->name('login'); // With out any login redirect to login

    // Customer access

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.user');
    Route::post('/processRegister', [RegisterController::class, 'processRegister'])->name('processRegister.user');
    Route::get('/user-login', [userLoginController::class, 'showLoginForm'])->name('login.user');
    Route::post('/user-login',[userLoginController::class,'processLogin'])->name('processLogin.user');

    Route::middleware(['auth.user'])->group(function() {
    Route::get('/user-dashboad',[userLoginController::class,'userDashboard'])->name('dashboard.user');
    Route::post('logout', [userLoginController::class, 'logout'])->name('logout.user');
    Route::get('/change-user-password',[userLoginController::class,'showChangePasswordForm'])->name('changePassword.user');

    Route::post('/save-rating/{serviceId}',[RatingsController::class,'saveRating'])->name('saveRating.user');

    Route::put('/update-user-dashboard/{id}', [EveryUserController::class, 'updateUserDashboard'])->name('updateUserDashboard.front');
    Route::post('/customer-order/store',[CustomerOrderController::class,'store'])->name('customerOrder.store');

    Route::post('/customer-payment/store',[CustomerPaymentController::class,'store'])->name('customerPayment.store');
    });
});

// Middleware-protected admin routes
Route::middleware('auth:admin')->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
    Route::get('/dashboard', [MainPagesController::class, 'dashboard'])->name('admin.dashboard');
    //Route for main
    Route::get('/main', [MainPagesController::class, 'main'])->name('main.dashboard');
    Route::put('/main/update', [MainPagesController::class, 'update'])->name('main.update');
    //Route for service
    Route::get('/service-list', [ServicesController::class, 'index'])->name('list.services');
    Route::get('/service-create', [ServicesController::class, 'create'])->name('create.services');
    Route::post('/services/store', [ServicesController::class, 'store'])->name('store.services');
    Route::get('/service-edit/{service}/edit', [ServicesController::class, 'edit'])->name('edit.service');
    Route::put('/service/{id}/update', [ServicesController::class, 'update'])->name('service.update');
    Route::delete('/service/delete/{id}', [ServicesController::class, 'destroy'])->name('delete.service');
    
    //Category 
    Route::get('/category',[CategoryController::class,'list'])->name('categories.index');
    Route::get('/category/create',[CategoryController::class,'create'])->name('categories.create');
    Route::post('/category/store',[CategoryController::class,'store'])->name('categories.store');
    Route::delete('/category/{delete}',[CategoryController::class,'destroy'])->name('categories.delete');
    Route::get('/category/{id}/category',[CategoryController::class,'edit'])->name('categories.edit');
    Route::put('/category/{id}/update',[CategoryController::class,'update'])->name('categories.update');
    Route::get('/getSlug', function(Request $request){
        $slug='';

        if(! empty($request->title) ){
        $slug  =  Str::slug($request->title);
        } 
        return response()->json([
                'status'    => true,
                'slug'      => $slug
            ]);
      })->name('getSlug');
//Route for portfolio
Route::get('/portfolio-list', [PortfolioPostController::class, 'index'])->name('list.portfolio');
Route::get('/portfolio-create', [PortfolioPostController::class, 'create'])->name('create.portfolio');
Route::post('/portfolio/store', [PortfolioPostController::class, 'store'])->name('store.portfolio');
Route::get('/portfolio-edit/{portfolio}/edit', [PortfolioPostController::class, 'edit'])->name('edit.portfolio');
Route::put('/portfolio/{id}/update', [PortfolioPostController::class, 'update'])->name('portfolio.update');
Route::delete('/portfolio/{id}/delete', [PortfolioPostController::class, 'destroy'])->name('delete.portfolio');  
Route::get('/related_post', [PortfolioPostController::class, 'getPost'])->name('post.getPost');
Route::post('/portfolio/remove-tag', [PortfolioPostController::class, 'removeTag'])->name('portfolio.remove-tag');

Route::get('/show-user-list',[EveryUserController::class,'index'])->name('list.user');
Route::get('/create-user',[EveryUserController::class,'create'])->name('create.user');
Route::post('/store-user',[EveryUserController::class,'store'])->name('store.user');
Route::get('/users/{user}/edit',[EveryUserController::class,'edit'])->name('edit.user');
Route::put('/update/{user}',[EveryUserController::class,'update'])->name('update.user');
Route::delete('/users/{delete}',[EveryUserController::class,'destroy'])->name('delete.user');
//Admin 
Route::get('/show-admin-list',[AdminSettingController::class,'index'])->name('list.admin');
Route::get('/create-admin',[AdminSettingController::class,'create'])->name('create.admin');
Route::post('/store-admin',[AdminSettingController::class,'storeAdmin'])->name('store.admin');
Route::get('/admin/{adminId}/edit',[AdminSettingController::class,'editAdmin'])->name('edit.admin');
Route::put('/update-admin/{adminId}',[AdminSettingController::class,'updateAdmin'])->name('updateAmin.admin');
Route::delete('/admin/{delete}',[AdminSettingController::class,'destroyAdmin'])->name('delete.admin');
//Order manage

Route::get('/order-list', [CustomerOrderController::class, 'OrderList'])->name('order.list');
Route::get('/order-create', [CustomerOrderController::class, 'OrderCreate'])->name('order.create');
Route::delete('/order-delete/{order}',[CustomerOrderController::class,'deleteOrder'])->name('delete.order');
Route::get('/edit-order/{edit}',[CustomerOrderController::class,'editOrder'])->name('edit.order');
Route::put('/order-update/{order}',[CustomerOrderController::class,'updateOrder'])->name('update.order');

Route::get('/show-payment-list',[CustomerPaymentController::class,'showPaymentList'])->name('showPaymentList.index');
Route::get('/visitors',[VisitorController::class,'index'])->name('visitor.info');
Route::get('/ratings-list',[RatingsController::class,'indexRatings'])->name('rating.list');
Route::post('/update-status/{id}', [RatingsController::class, 'updateStatus'])->name('updateStatus');

});

