<?php

namespace App\Http\Controllers;

use App\Http\Traits\phptraits;
use App\userModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;


class WebServicesController extends Controller
{
    use phptraits;
    #Api controller
    public function save(Request $req)
    {
        # code...
        $valid = $this->verificationForm($req);

        if ($valid->fails()) {
            Log::alert('Email Not Send to' . $req->name);
            return response()->json([
                'message' => [
                    'Status' => '0',
                    'Error' => [
                        "ValidError" => $valid->errors(),
                        "dataBaseError" => "Data not Save",
                        "emailError" => "Faile to Send Email."
                    ],
                ],
            ]);
        } else {
            $save = $this->savDataToDatabase($req);
            // 
            if (is_null($save)|| is_null($this->mailToUser($req))) {
                Log::alert('Email Not Send To' . $req->name);
                return response()->json([
                    'message' => [
                        'Status' => '0',
                        'Error' => [
                            "1" => "Data not Save",
                            // "2" => $this->mailToUser($req)
                        ],
                    ],
                ]);
            } else {
                Log::info('Email Send Successfully To: ' . $req->name . ' on Email :' . $req->email);
                return response()->json([
                    'message' => [
                        'Status' => '1',
                        'message' => [
                            "0" => "Data Send and Save to Database",
                            "1" => "Email Send Successfully"
                        ]
                    ]
                ]);
            }
        }
    }
    public function checkName(Request $req)
    {
        // # code...
        // $rules = [
        //     'name' => 'unique:data'
        // ];
        // $valid = Validator::make($req->name, $rules);
        // if ($valid->fails()) {
        //     return response()->json([
        //         'message' => [
        //             'name' => $valid->errors()
        //         ]
        //     ]);
        // } else {
        //     return response()->json([
        //         'message' => [
        //             'name' => 'the name is unique'
        //         ]
        //     ]);
        // }

        # code...
        $rules = [
            'name' => 'required|unique:data'
        ];
        // $valid = Validator::make($req->all(), $rules);
        // if ($valid->fails()) {
        //     return response()->json([
        //         'message' => [
        //             'name' => $valid->errors()
        //         ]
        //     ]);
        // } else {
        //     return response()->json([
        //         'message' => [
        //             'name' => 'The Name is Unique'
        //         ]
        //     ]);
        // }
        return response()->json([
            'message' => $req->all()
        ]);
    }
}
