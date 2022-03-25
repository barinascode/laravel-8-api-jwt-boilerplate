<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    

    function recovery(Request $request){


        /*
            TODO

            Limitar la cantidad de veces que se pueden enviar solicitudes por dia
            Eliminar tokens creados 
        */


        $email = $request->email;
        $user = User::where('email', '=', $email)->first();
       

        function generateRandomString($length = 10) {
            return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        }
        
        $token = generateRandomString(10);
        
     

        if(!$user)
            return response()->json(['error' => 'Email not found'], 401);

            PasswordReset::create([
                "email"=> $user->email,
                "token" => $token
             ]);

             $email_data = [
                "name"=>$user->name,
                "email"=>$user->email,
                "token"=> $token
                
             ];

            // send email with the template
            Mail::send('emails/recovery-request', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Restablecer cuenta')
                    ->from('info@mynotepaper.com', 'CAPITAL BILLIONS');
            });

            return response()->json(['message' => 'Hemos enviado un codigo a tu correo electronico'], 200);
    }


    function password(Request $request){


        /*
            TODO

            Limitar la cantidad de veces que se pueden enviar solicitudes por dia
            Eliminar tokens creados 
        */

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'token' => 'required|string|min:10',
        ]);
        

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $email = $request->email;
        $passwprd = $request->password;
        $user = User::where('email', '=', $email)->first();

        if(!$user)
            return response()->json(['error' => 'Email not found'], 401);


        $token = $request->token;
        $result = PasswordReset::where("email", '=', $user->email)->where('token','=',$token)->first();
          


        if(!$result)
            return response()->json(['error' => 'Unauthorized'], 401);


        $user->password = Hash::make($request->password);
        $user->save();

        $email_data = [
            "name"=>$user->name,
            "email"=>$user->email
        ];

            // send email with the template
            Mail::send('emails/change-password-notification', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Cambio de clave')
                    ->from('info@mynotepaper.com', 'CAPITAL BILLIONS');
            });

            return response()->json(['message' => 'Hemos enviado un codigo a tu correo electronico'], 200);
    }


}
