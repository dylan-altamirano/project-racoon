<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function edit($id)
    {

        $user = User::find($id);

        return view('password.reset',['users'=>$user]);
    }

    public function update(Request $request)
    {
        //Validacion
        $user = new User([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        
          //  'name', 'email', 'password', 'direccion','telefono','activo','balance_ecomonedas'
        ]);
        $user = Auth::user()::find($request->input('id'));  
        
       
        $user->email = $request->input('email');
        $user->password = $request->input('password');
      
       

        $user->save();

        return redirect()->route('principal.index')->with('info','La contrasena para el usuario'.$request->input('nombre').' has sido actualizada con éxito.');

    }
}
