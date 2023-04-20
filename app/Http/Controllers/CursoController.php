<?php

namespace App\Http\Controllers;

use App\Http\Resources\CursoResource;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curso = Curso::latest()->paginate(10);
        return CursoResource::collection($curso);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fechaInicioCurso' => 'required|date',
            'fechaFinCurso' => 'required|date',
        ]);

        $curso = Curso::create([
            'nombre' => $request->nombre,
            'fecha_inicio_curso' => $request->fechaInicioCurso,
            'fecha_fin_curso' => $request->fechaFinCurso,
        ]);
        return response()->json(['status'=>'Course successfully created.',201]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        return new CursoResource($curso);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $curso = Curso::findOrfail($id);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fechaInicioCurso' => 'required|date',
            'fechaFinCurso' => 'required|date',
        ]);

        $curso->nombre = $request->nombre;
        $curso->fecha_inicio_curso = $request->fechaInicioCurso;
        $curso->fecha_fin_curso = $request->fechaFinCurso;

        $curso->save();
        sleep(1);
        return response()->json(['status'=>'Course successfully edited.',201]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $curso = Curso::findOrfail($id);
        $curso->delete();
        return response()->json(['status'=>'Course successfully delete.',201]);
    }
}
