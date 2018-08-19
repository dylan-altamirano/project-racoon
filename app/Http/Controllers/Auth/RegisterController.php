<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Rol;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Response;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use DateTime;
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
    protected $redirectTo = '/dashboard';

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

        $cliente = User::where('email', $data['email'])->first(); 
        if($cliente == null){

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
    }
        return $user;
    }
  public function edit()
    {
        $users = User::all();
        return view('auth.edit', ['users'=>$users]);
    }

    public function update(Request $request)
    {
        //Validacion
        $user = new User([
            'name' => $request->input('name'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email')
        ]);


        $cliente = User::where('email', $request['email'])->first(); 

        if($cliente == null || $user->email == $request->input('emailCliente')){
        $user->telefono = $request->input('telefono');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->direccion = $request->input('direccion');
        
        $updated_at=new DateTime();

        DB::table('users')->where('id', $cliente->id)->update(['name' => $user->name, 'telefono' => $user->telefono, 
            'email' => $user->email,'direccion' => $user->direccion, 'updated_at' => $updated_at]);
    

        }
        else{
            return redirect()->route('auth.edit')->with('info','El usuario '.$request->input('name').' no has sido actualizado con éxito.');

        }
        return redirect()->route('auth.edit')->with('info','El usuario '.$request->input('name').' has sido actualizado con éxito.');

    }
    public function getCliente(Request $request)
    {

        $rules = array(
            'emailCliente' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return reponse()->json(['errors' => $validator->errors()->all()]);
        }

        $cliente = User::where('email', $request->emailCliente)->first();

        foreach($cliente->roles as $rol){
              if ($rol->nombre != 'Administrador Centro Acopio') {
                  $cliente = null;
              }  
        }

        return response()->json($cliente);
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
        return redirect()->route('principal.index')->with('info','El usuario has sido creado con éxito.');

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
