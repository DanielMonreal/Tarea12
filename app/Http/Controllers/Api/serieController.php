<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class serieController extends Controller
{
    public function index()
    {
        $serie = Serie::all();




        $data = [
            'Series' => $serie,
            'status' => 200
        ];

        return response()->json($data, 200);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required', 
            'descripcion' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos', 
                'errors'=> $validator->errors(), 
                'status'=> 400
            ];
            return response()->json($data, 400);

        }

        $serie = Serie::create([
            'name' => $request->name,
            'descripcion' => $request->descripcion,
            'image'=> $request->image
        
        ]);

        if (!$serie) {
            $data = [
                'message' => 'Error al crear la serie', 
                'status'=> 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'serie' => $serie,
            'status'=> 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $serie = Serie::find($id);

        if (!$serie) {
            $data = [
            'message' => 'Estudiante no encontrado',
            'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'serie' => $serie,
            'status'=> 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $serie = Serie::find($id);
        
        if (!$serie) {
            $data = [
                'message' => 'Serie no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $serie->delete();

        $data = [
            'message' > 'Serie eliminado',
            'status'=> 200
        ];
        
        return response()->json($data, 200);
    }

    public function update (Request $request, $id)
    {
        $serie = Serie::find($id);
        if (!$serie) {
            $data = [
                'message' => 'Serie no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required', 
            'descripcion' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos', 
                'errors'=> $validator->errors(), 
                'status'=> 400
            ];
            return response()->json($data, 400);
        }

        $serie->name = $request->name;
        $serie->descripcion = $request->descripcion;
        $serie->image = $request->image;

        $serie->save();

        $data = [

            'message'=> 'Serie actualizada',

            'serie'=> $serie,

            'status' => 200

        ];

        return response()->json($data, 200);

    }

    public function updatePartial(Request $request, $id)
    {
        $serie = Serie::find($id);

        if (!$serie) {
            $data = [
                'message' => 'Serie no encontrado',
                'status'=> 404
            ];
            return response()->json($data, 404);
        }


        $validator = Validator::make($request->all(), [
            'name' => 'required', 
            'descripcion' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos', 
                'errors'=> $validator->errors(), 
                'status'=> 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('name')) {
            $serie->name = $request->name;
        }
        
        if ($request->has('descripcion')) {
            $serie->descripcion = $request->descripcion;
        }
            
        if ($request->has('image')) {
            $serie->image = $request->image;
        }

        $serie->save();

        $data = [

            'message' => 'Serie actualizado',
            'serie'=> $serie,
            'status'=> 200
        ];

        return response()->json($data, 200);
    }
}
