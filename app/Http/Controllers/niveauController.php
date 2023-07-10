<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Niveau;
use Illuminate\Http\Request;
use App\Traits\JoinQueryParams;
use App\Http\Resources\niveauRessource;
use Illuminate\Support\Facades\View;

class niveauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use JoinQueryParams;
 

    // public function index()
    // {
    //     $htmlContent = View::file(resource_path('html/niveau.html'))->render();
    //      return response($htmlContent)->header('Content-Type', 'text/html');
    // }
    public function index(){
        return niveauRessource::collection(niveau::all());
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
