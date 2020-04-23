<?php

namespace App\Http\Controllers;

// use App\userModel;

use App\Http\Traits\phptraits;
use App\userModel;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Contracts\Validation;



class ATGController extends Controller
{
    use phptraits;
    public function viewData()
    {
        $data = $this->traitsfun();
        return view('viewData', ['data' => $data]);
    }
    public function save(Request $req)
    {

        $data = userModel::all();
        $model = new userModel();
        $verificationVar = $this->verificationForm($req);
        $verificationVar->validate();
        if ($verificationVar->fails()) {
            return $verificationVar;
        } else {
            $verificationVar = $this->mailToUser($req);
            if (is_null($verificationVar)) {
                Log::alert('Email Not Send To: ' . $req->name);
                return redirect()->back()->with('success', $req->name . ',  Erro in Sneding Mail');
            } else {
                $saveVar = $this->savDataToDatabase($req);
                Log::info('Email Send To: ' . $req->name);
                return redirect()->back()->with('success', $req->name . ', You Recive a mail to: ' . $req->email . ' from Across the Global (ATG).');
            }
        }
    }


}
