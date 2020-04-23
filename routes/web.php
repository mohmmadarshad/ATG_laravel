<?php

use App\userModel;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
// use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
// */

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('home');
});



Route::get('viewData', 'ATGController@viewData');
Route::get('viewData', 'ATGController@viewData')->name('viewData');
Route::redirect('home', '/');


Route::post('submit', 'ATGController@save');
Route::post('update', 'ATGController@update');
// Route::get('delete/{id}','ATGController@delete')->name('delete');
Route::get('delete/{id}', function (Request $id) {
    $c = userModel::find($id->id);
    $c->delete();
    $data = userModel::all();
    return redirect()->route('viewData')->with(['data' => $data]);
})->name('delete');