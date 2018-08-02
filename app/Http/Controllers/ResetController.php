<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;


class ResetController extends Controller
{
    public function reset($id)
    {
        $user = User::find($id);

        return view('auth.resetpassword',['user'=>$user]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password-old' => 'required|string',
        ]);
    }

    public function update(Request $request)
    {
        
        

        $user2 = User::find($request->input('id'));
     
        if(Hash::check($request->input('password-old'), $user2->password)){

            
        //Validacion
         $user = new User([
        'email' => $request->input('email'),
        'password' => $request->input('password'),

         //  'name', 'email', 'password', 'direccion','telefono','activo','balance_ecomonedas'
        ]);


            $user = Auth::user();
        
            $password2 = bcrypt($request->input('password'));
            $user->email = $request->input('email');
            $user->password = $password2;

            $user->save();
        }
        else{
            
        
        }
        

        return redirect()->route('principal.index');

    }
}
