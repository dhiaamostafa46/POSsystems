<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizaionsController;
use App\Http\Controllers\API\OrgsController;
use App\Http\Controllers\API\SubsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/paylinkhook',  [App\Http\Controllers\OrganizaionsController::class, 'reciveActivehook'])->name('partners.webhook');
Route::post('/paymenthook',  [App\Http\Controllers\OrganizaionsController::class, 'paymenthook'])->name('payemnts.webhook');
Route::get('/orgnizations',  [App\Http\Controllers\API\OrgsController::class, 'getall'])->name('org.getall');
Route::get('/getOrg/{id}',  [App\Http\Controllers\API\OrgsController::class, 'getOrg'])->name('org.getOrg');

Route::get('/users',  [App\Http\Controllers\API\UserController::class, 'getall'])->name('user.getall');
Route::get('/getUser/{id}',  [App\Http\Controllers\API\UserController::class, 'getUser'])->name('user.getUser');

Route::get('/subs',  [App\Http\Controllers\API\SubsController::class, 'index'])->name('subs.getall');
Route::get('/getSub/{id}',  [App\Http\Controllers\API\SubsController::class, 'getSub'])->name('subs.getSub');
Route::post('/renewSub',  [App\Http\Controllers\API\SubsController::class, 'renew'])->name('subs.renew');


Route::get('/getProducts/{id}',  [App\Http\Controllers\API\ProdsController::class, 'index'])->name('prods.getAll');
Route::get('/getCats/{id}',  [App\Http\Controllers\API\ProdsController::class, 'getCats'])->name('prods.getCats');
Route::get('/getExtras/{id}',  [App\Http\Controllers\API\ProdsController::class, 'getExtras'])->name('prods.getExtras');

Route::post('/login',  [App\Http\Controllers\API\UserController::class, 'login'])->name('users.login');

Route::get('/getActivity/{id}',  [App\Http\Controllers\API\OrgsController::class, 'getActivity'])->name('org.getActivity');


