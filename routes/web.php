<?php

use App\Http\Controllers\PeopleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


////Route::resource('people', PeopleController::class);
//Route::get('people/{people}', [PeopleController::class, 'show']);
//
//Route::group(PeopleController::class)->group(function () {
//    Route::get('/people/{id}', 'show');
//    Route::post('/orders', 'store');
//});



Route::controller(PeopleController::class)->group(function () {
    Route::get('/people', 'index')->name('people.index');
    Route::get('/people/create', 'create')->name('people.create');
    Route::post('/people', 'store')->name('people.store');
    Route::get('/people/{people}/edit', 'edit')->name('people.edit');
    Route::get('/people/{people}', 'show')->name('people.show');
    Route::put('/people/{people}', 'update')->name('people.update');
    Route::delete('/people/{people}', 'destroy')->name('people.destroy');
});
