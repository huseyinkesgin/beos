<?php

use App\Livewire\Finance\BillIndex;
use App\Livewire\Location\CityIndex;
use App\Livewire\Location\StateIndex;
use App\Livewire\Portfolio\TypeIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Finance\InvoiceIndex;
use App\Livewire\Finance\VehicleIndex;
use App\Livewire\People\CustomerIndex;
use App\Livewire\People\PersonnelShow;
use App\Livewire\Finance\InvoiceDetail;
use App\Livewire\People\PersonnelIndex;
use App\Livewire\Location\DistrictIndex;
use App\Livewire\Portfolio\CategoryIndex;
use App\Livewire\Portfolio\PortfolioShow;
use App\Livewire\Portfolio\PortfolioIndex;
use App\Livewire\Finance\PersonelExpenceIndex;
use App\Livewire\Finance\PersonnelBalanceIndex;
use App\Livewire\Finance\PersonnelExpenseIndex;
use App\Http\Controllers\PortfolioPDFController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/welcome', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('states', StateIndex::class)->name('states');
Route::get('cities', CityIndex::class)->name('cities');
Route::get('districts', DistrictIndex::class)->name('districts');



Route::get('categories', CategoryIndex::class)->name('categories');
Route::get('types', TypeIndex::class)->name('types');

Route::get('customers', CustomerIndex::class)->name('customers');
Route::get('personnels', PersonnelIndex::class)->name('personnels');

Route::get('portfolios', PortfolioIndex::class)->name('portfolios');

Route::get('/personnel/{id}', PersonnelShow::class)->name('personnel.show');

Route::get('bills',BillIndex::class)->name('bills');
Route::get('personel-expenses',PersonnelExpenseIndex::class)->name('personel.expense');

Route::get('balances', PersonnelBalanceIndex::class)->name('personel.balance');
Route::get('vehicles', VehicleIndex::class)->name('vehicles');


Route::get('/portfolio/{id}/pdf', [PortfolioPDFController::class, 'generate'])->name('portfolio.pdf');
Route::get('/portfolio/{portfolioId}', PortfolioShow::class)->name('portfolio.show');

Route::get('/invoices', InvoiceIndex::class)->name('invoices.index');
Route::get('/invoices/{id}', InvoiceDetail::class)->name('invoices.detail');
