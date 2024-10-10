<?php

use App\Livewire\Location\CityIndex;
use App\Livewire\Location\StateIndex;
use App\Livewire\Portfolio\TypeIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\People\CustomerIndex;
use App\Livewire\Location\DistrictIndex;
use App\Livewire\Portfolio\CategoryIndex;

Route::get('/', function () {
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
