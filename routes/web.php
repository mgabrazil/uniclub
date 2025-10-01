<?php

use App\Http\Controllers\DashboardController;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Orders as AdminOrders;
use App\Livewire\Admin\PointConfigurations;
use App\Livewire\Admin\Users\ListUsers;
use App\Livewire\Client\Dashboard as ClientDashboard;
use App\Livewire\Vendor\CreateClient;
use App\Livewire\Vendor\CreateVendor;
use App\Livewire\Vendor\Dashboard as VendorDashboard;
use App\Livewire\Vendor\ListClients;
use App\Livewire\Vendor\ListVendors;
use App\Livewire\Vendor\RegisterNewSale;
use App\Livewire\Vendor\SalesList;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('auth', 'role:admin')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'render'])->name('dashboard');
    Route::get('/list-users', ListClients::class)->name('list-users');
    Route::get('/orders', [AdminOrders::class, 'render'])->name('orders');
    Route::get('/point-configuration', PointConfigurations::class)->name('point-configurations');
});

Route::middleware('auth', 'role:vendor')->prefix('/vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', [VendorDashboard::class, 'render'])->name('dashboard');
    Route::get('/create-vendor', CreateVendor::class)->name('create');
    Route::get('/create-client', CreateClient::class)->name('create-client');
    Route::get('/list-vendors', ListVendors::class)->name('list');
    Route::get('/list-clients', ListClients::class)->name('list-clients');
    Route::get('/register-new-sale', RegisterNewSale::class)->name('register-new-sale');
    Route::get('/sales', SalesList::class)->name('sales.index');
});

Route::middleware('auth', 'role:client')->prefix('/client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboard::class, 'render'])->name('dashboard');
});

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/', [DashboardController::class, 'redirectDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/policies', function () {
    return view('policies');
})->name('policies');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    // Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
