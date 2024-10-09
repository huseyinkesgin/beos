<?php

use App\Livewire\Location\CityIndex;
use App\Livewire\Location\StateIndex;
use App\Livewire\Portfolio\TypeIndex;
use Illuminate\Support\Facades\Route;
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

Route::get('states', StateIndex::class);
Route::get('cities', CityIndex::class);
Route::get('districts', DistrictIndex::class);



Route::get('categories', CategoryIndex::class);
Route::get('types', TypeIndex::class);
