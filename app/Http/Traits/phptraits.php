<?php

namespace App\Http\Traits;

use App\userModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;






trait phptraits
{
    public function traitsfun()
    {
        # code...
        $data = userModel::all();
        return $data;
    }
    public function verificationForm(Request $req)
    {
        # code...
        $rules = [
            'name' => 'required|unique:data',
            'email' => 'required|email|email:strict,dns',
            'pincode' => 'required|unique:data,name|min:6|max:6'
        ];
        $valid = Validator::make($req->all(), $rules);
        return $valid;
    }
    public function savDataToDatabase(Request $req)
    {
        # code...
        $model = new userModel();
        $model->name = $req->name;
        $model->email = $req->email;
        $model->pincode = $req->pincode;
        return $model->save();
    }
    public function mailToUser(Request $req)
    {
        # code...
        $to_name = $req->name;
        $to_email = $req->email;
        $emailData = array(
            "name" => $req->name,
        );
        $mail = new Mail();
        $mail::send('mail', $emailData, function ($message) use ($to_name, $to_email) {
            $message->from('infortech7500@gmail.com', 'Mohmmad Arshad');
            $message->sender('infotech7500@gmail.com', 'Mohmmad Arshad');
            $message->to($to_email, $to_name);
            // $message->cc('infotech@gmail.com', 'Mohmmad Arshad');
            // $message->bcc('infotech@gmail.com', 'Mohmmad Arshad');
            // $message->replyTo('infotech@gmail.com', 'Mohmmad Arshad');
            $message->subject('Across the Globe (ATG) mail verification mail.');
            // $message->priority(3);
            // $message->attach('pathToFile');
        });
        if(count(Mail::failures()) > 0){
            return 'Email not send';
        }else{
            return 'Email send';
        }
    } 

    public function updateFunction(Request $re)
    {
        $cmd = userModel::find($re->id);
        $cmd->name = $re->name;
        $cmd->email = $re->email;
        $cmd->mobile = $re->mobile;
        $cmd->dob = $re->dob;
        $cmd->pincode = $re->pincode;

        $cmd->save();
        $data = userModel::all();
        return redirect()->route('viewData')->with(['data' => $data]);
    }


    public function deleteFuntion(Request $id)
    {
        $c = userModel::find($id->id);
        // echo $c;
        echo $c->delete();

        $data = userModel::all();
        return redirect()->route('viewData')->with(['data' => $data]);
    }

}
