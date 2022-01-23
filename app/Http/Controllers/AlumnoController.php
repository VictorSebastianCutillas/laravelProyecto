<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    //TO Cuestion
    //Deberia crear un metodo que me permitiera ver si los parametros apsados son correctos en vez de ir duplicando codigo

    //Deberia en vez de hacer un select nuevo, usar el metodo getAlumno para intentar devolver los datos
    //si lo hago de eso modo siempre verificare el error en un solo lugar en vez de ir un error por cada vez que haga select

    private function validateRequest(Request $request)
    {
        $data = $request->only(['nombre', 'telefono', 'edad', 'password', 'email', 'sexo']);
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'edad' => 'required|numeric|digits_between:1,3',
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'sexo' => 'required'
        ]);
        return $data;
    }

    public function getAll(Request $request)
    {
        $users = DB::table('alumno')->get();

        return response()->json([
            'success' => true,
            'message' => "Lista de alumnos obtenida",
            'data' => $users
        ]);
    }

    public function getAlumno(Request $request, $id)
    {
        $user = DB::table('alumno')->where('id', $id)->first();
        if ($user === null) {
            return response()->json([
                'success' => true,
                'message' => "El alumno con id $id no existe",
                'data' => null
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => "Alumno encontrado",
            'data' => $user
        ], 200);
    }

    public function deleteAlumno(Request $request, $id)
    {
        $user = DB::table('alumno')->where('id', $id)->first();
        if ($user === null) {
            return response()->json([
                'success' => true,
                'message' => "El alumno con id $id no existe",
                'data' => null
            ], 404);
        }
        DB::table('alumno')->where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => "El alumno con id $id ha sido borrado",
            'data' => $user
        ], 200);
    }

    public function insert(Request $request)
    {

        $data = $this->validateRequest($request);
        try {
            DB::table('alumno')->insert($data);
            return response()->json([
                'success' => true,
                'message' => "Alumno insertado",
                'data' => null
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se ha podido insertar al alumno",
                'data' => null
            ], 500);
        }

    }

    public function updateAlumno(Request $request, $id)
    {
        $data = $this->validateRequest($request);
        // unique de email va mal \__º_º__/
        $user = DB::table('alumno')->where('id', $id)->first();
        if ($user === null) {
            return response()->json([
                'success' => true,
                'message' => "El alumno con id $id no existe",
                'data' => null
            ], 404);
        }

        try {
            //Podria ser updateOrInsert, pero no se porque solo me insertaba, y en realidad no tiene mucho sentido
            //que en una función de actualizar o inserte, si te asegura que el alumno no existe, bien,
            // pero no veo logico que siempre inserte ante la duda uno en caso de no haber, y a lo mejor no actualiza
            // un alumno que si existe por X motivo
            DB::table('alumno')->where('id', $id)->update($data);
            return response()->json([
                'success' => true,
                'message' => "Alumno actulizado",
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se ha podido actualizar al alumno",
                'data' => null
            ], 500);
        }

    }
}
