<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CursoController extends Controller
{
    
    public function index()
    {
        $cursos= Curso::all();
        return Inertia::render('Cursos/Index',['cursos'=>$cursos]);
    }

    
    public function create()
    {
        return Inertia::render('Cursos/Create');
    }

   
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|max:100']);
        $request->validate(['description'=>'required|max:100']);
        $request->validate(['duration'=>'required|max:100']);
        $curso= new Curso($request->input());
        $curso->save();
        return redirect('cursos');
    }

   
    public function show(Curso $curso)
    {
        
    }

    
    public function edit(Curso $curso)
    {
      return Inertia::render('Cursos/Edit',['curso'=>$curso]);
    }

    
    public function update(Request $request, Curso $curso)
    {
        $request->validate(['name'=> 'required | max:100']);
        $request->validate(['description'=> 'required | max:100']);
        $request->validate(['duration'=> 'required | max:100']);
        $curso->update($request->all());
        return redirect('cursos');
    }

    
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect('cursos');
    }
}
