<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Rol;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $users = User::orderBy('name','desc')->get();
        $roles = Rol::all();
        return view('auth.index',['users'=>$users,'roles'=>$roles]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'direccion' => 'required',
            'telefono' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'activo' => 1,
            'balance_ecomonedas' => 0,
            'password' => Hash::make($data['password']),
        ]);
      
        $user->roles()->attach($data['role']);
        return $user;
    }

    public function edit($id)
    {

        $user = user::find($id);

        return view('auth.edit',['user'=>$user]);
    }

    public function update(Request $request)
    {
        //Validacion
        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|min:10',
            'direccion' => 'required',
            'telefono' => 'required',
            'activo' => 'required',
            'balance_ecomonedas' => 0
        ]);

        $user= User::find($request->input('id'));
        

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->direccion = $request->input('direccion');
        $user->telefono = $request->input('telefono');
        $user->activo = (!$request->has('activo')?0:1);
        $user->balance_ecomonedas = 0;

        $user->save();
        
        $user->roles()->attach($data['role']);

        return redirect()->route('principal.index')->with('info','El usuario '.$request->input('name').' has sido actualizado con éxito.');

    }


    protected function createAdministrador(Request $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'activo' => 1,
            'balance_ecomonedas' => 0,
            'password' => Hash::make($data['password']),
        ]);
      
        $user->roles()->attach($data['role']);
        return $user;
    }

    public function getAdminCreate(){
        $roles=Rol::all();
        return view('auth.registeradmin',
        ['roles'=>$roles]);
      }

    public function showRegistrationForm(){
        //Pluck:extraccion que recupera todos los valores de una
        //clave determinada
          $roles=\App\Rol::orderBy('nombre')->pluck('nombre','id');
          //Compact: Crear un array que contiene las variables y su valores
          return view('auth.register',compact('roles'));
      }
}
