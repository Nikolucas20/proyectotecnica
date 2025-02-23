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

    public function show($id){
        $libreria = Libreria::find($id);

        if(!$libreria){
            $data = [
                'message' => 'libro no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $data = [
            'library' => $libreria,
            'status' => 201
        ];
        return response()->json($data,201);
    }

    public function destroy($id){
        $libreria = Libreria::find($id);

        if(!$libreria){
            $data = [
                'message' => 'libro no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $libreria->delete();

        $data = [
            'message' => 'Libro eliminado',
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function update(Request $request, $id){
        $libreria = Libreria::find($id);

        if(!$libreria){
            $data = [
                'message' => 'libro no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

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

        $libreria->nombre = $request->nombre;
        $libreria->genero = $request->genero;
        $libreria->autor = $request->autor;
        $libreria->lenguaje = $request->lenguaje;

        $libreria->save();

        $data = [
            'message' => 'Libro actualizado',
            'library' => $libreria,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function updatePartial(Request $request, $id){
        $libreria = Libreria::find($id);

        if(!$libreria){
            $data = [
                'message' => 'libro no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request->all(),[
            'nombre' => 'max:255',
            'genero' => 'max:155',
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

        if($request->has('nombre')){
            $libreria->nombre = $request->nombre;
        }

        if($request->has('genero')){
            $libreria->genero = $request->genero;
        }

        if($request->has('autor')){
            $libreria->autor = $request->autor;
        }
        
        if($request->has('lenguaje')){
            $libreria->lenguaje = $request->lenguaje;
        }
        
        $libreria->save();

        $data = [
            'message' => 'Libro actualizado',
            'library' => $libreria,
            'status' => 200
        ];
        return response()->json($data,200);
    }



}
