<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libreria;
use Illuminate\Support\Facade\Validator;

class librarycontroller extends Controller
{
    public function index(){

        $libreria = Libreria::all();

        if($libreria->isEmpty()){
            return response()->json(['menssage'=>'no hay libros registrados'],404);        
        }
        return response()->json($libreria,200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|max:255',
            'genero' => 'required|max:155',
            'autor' => 'required|max:300',
            'lenguaje' => 'required|in:English,Spanish,French'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status'=> 400
            ];
            return response()->json($data,400);
        }

        $libreria = Libreria::create([
            'nombre' => $request->nombre,
            'genero' => $request->genero,
            'autor' => $request->autor,
            'lenguaje' => $request->lenguaje
        ]);

        if(!$libreria){
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data,500);
        }

        $data = [
            'library' => $libreria,
            'status' => 201
        ];
        return response()->json($data,201);
    }

    public function show(){
        
    }

}
