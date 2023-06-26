<?php

use App\Http\Controllers\ListingController;
use App\Models\Listing;
use Illuminate\Http\Request;
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

// Common Resource Routes:

// index - Show all listings
// show - Show single listing
// create - Show Form to create new listing
// store - Store new listing
// edit - Show Form to edit listing
// update - Update listing
// destroy - Delete listing

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Form
Route::get('listings/create', [ListingController::class, 'create']);

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);
