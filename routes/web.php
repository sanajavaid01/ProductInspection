<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InspectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SubStepsController;
use App\Http\Controllers\ProductsInspectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [InspectionsController::class,'index'] );
Route::post('/addInspection', [InspectionsController::class,'store']);
Route::get('/datatable/inspection', [InspectionsController::class,'datatable']);
Route::post('/updateInspection', [InspectionsController::class,'update']);
Route::delete('/deleteInspection', [InspectionsController::class,'destroy']);
Route::post('/getInspectionSubsteps', [InspectionsController::class,'getInspectionSubsteps']);


Route::post('/addProduct', [ProductsController::class,'store']);
Route::get('/datatable/product', [ProductsController::class,'datatable']);
Route::post('/updateProduct', [ProductsController::class,'update']);
Route::delete('/deleteProduct', [ProductsController::class,'destroy']);
Route::post('/assignStepsToProduct', [ProductsInspectionController::class,'assignStepsToProduct']);
Route::post('/getProductDetail', [ProductsController::class,'edit']);

Route::post('/addSubStep', [SubStepsController::class,'store']);
Route::get('/datatable/substep', [SubStepsController::class,'datatable']);
Route::post('/updateSubStep', [SubStepsController::class,'update']);
Route::delete('/deleteSubStep', [SubStepsController::class,'destroy']);



