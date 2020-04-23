<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('/', 'WebServicesController@save');
Route::get('/', 'WebServicesController@index');
Route::post('/save', 'WebServicesController@save');
// Route::post('/checkName', 'WebServicesController@checkName');
Route::post('/checkName', function (Request $req) {
    $rules = [
        'name' => 'required|unique:data,name',
    ];
    $valid = Validator::make($req->all(), $rules);
    if ($valid->fails()) {
        return response()->json([
            'message' => [
                'status' => '0',
                'name' => $valid->errors()
            ]
        ]);
    } else {
        return response()->json([
            'message' => [
                'status' => '1',
                'name' => [
                    0 => 'The Name is Unique.'
                ]
            ]
        ]);
    }
});
Route::post('/checkEmail', function (Request $req) {
    $rules = [
        'email' => 'required|unique:data,email|email|email:strict,dns',
    ];
    $valid = Validator::make($req->all(), $rules);
    if ($valid->fails()) {
        return response()->json([
            'message' => [
                'status' => '0',
                'name' => $valid->errors()
            ]
        ]);
    } else {
        return response()->json([
            'message' => [
                'status' => '1',
                'name' => [
                    0 => 'The email is Unique.'
                ]
            ]
        ]);
    }
});
Route::post('/checkPincode', function (Request $req) {
    $rules = [
        'pincode' => 'required|unique:data,pincode|min:6|max:6'
    ];
    $valid = Validator::make($req->all(), $rules);
    if ($valid->fails()) {
        return response()->json([
            'message' => [
                'status' => '0',
                'name' => $valid->errors()
            ]
        ]);
    } else {
        return response()->json([
            'message' => [
                'status' => '1',
                'name' => [
                    0 => 'The pincode is Unique.'
                ]
            ]
        ]);
    }
});
