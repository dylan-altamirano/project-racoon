<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use Session;
use App\User;

class ClienteController extends Controller
{
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

        return response()->json($cliente);
    }

}
