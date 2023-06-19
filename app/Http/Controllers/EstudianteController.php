<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Models\Curso;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    
    public function index()
    {
        $estudiantes = Estudiante::select('estudiantes.id', 'estudiantes.name','email','phone','curso_id','cursos.name as curso')
        ->join('cursos','cursos.id','=','estudiantes.curso_id')
        ->paginate(10);

        $cursos = Curso::all();
        return Inertia::render('Estudiantes/Index',['estudiantes'=>$estudiantes, 'cursos'=>$cursos]); 
    }

    
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        $request->validate(['name'=>'required | max:150']);
        $request->validate(['email'=>'required | max:80']);
        $request->validate(['phone'=>'required | max:15']);
        $request->validate(['curso_id'=>'required|numeric']);

        $estudiante=new Estudiante($request->input());
        $estudiante->save();
        return redirect('estudiantes');
    }

    
    public function show(Estudiante $estudiante)
    {
        
    }

    
    public function edit(Estudiante $estudiante)
    {
        
    }

    
    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate(['name'=>'required | max:150']);
        $request->validate(['email'=>'required | max:80']);
        $request->validate(['phone'=>'required | max:15']);
        $request->validate(['curso_id'=>'required|numeric']);

        $estudiante->update($request->input());
        return redirect('estudiantes');

    }

   
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect('estudiantes');
    }

    public function EstudianteByCurso(){

        $data = Estudiante::select(DB::raw('count(estudiantes.id) as count, cursos.name' ))
        ->join('cursos','cursos.id','=','estudiantes.curso_id')
        ->groupBy('cursos.name')->get();
        
        return Inertia::render('Estudiantes/Graphic',['data'=>$data]);

    }

    public function reportes(){
        
        $estudiantes = Estudiante::select('estudiantes.id', 'estudiantes.name','email','phone','curso_id','cursos.name as curso')
        ->join('cursos','cursos.id','=','estudiantes.curso_id')
        ->get();

        $cursos = Curso::all();
        return Inertia::render('Estudiantes/Reportes',['estudiantes'=>$estudiantes, 'cursos'=>$cursos]);
    }


}
