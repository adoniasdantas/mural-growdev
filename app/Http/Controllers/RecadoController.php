<?php

namespace App\Http\Controllers;

use App\Models\Recado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RecadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome', [
            'recados' => Recado::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Recado::create($request->validate([
            'texto' => ['required', 'string', 'min:20']
        ], [
            'required' => 'Este campo é obrigatório',
            'min' => 'Este campo deve ter, no mínimo, :min caracteres'
        ]));

        return redirect()->route('index')->with('success', 'Seu recado foi salvo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recado  $recado
     * @return \Illuminate\Http\Response
     */
    public function show(Recado $recado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recado  $recado
     * @return \Illuminate\Http\Response
     */
    public function edit(Recado $recado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recado  $recado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recado $recado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recado  $recado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recado $recado)
    {
        $recado->delete();
        return redirect()->route('index')->with('success', 'Seu recado foi excluído!');
    }
}
