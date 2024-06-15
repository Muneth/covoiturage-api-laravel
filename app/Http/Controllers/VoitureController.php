<?php

namespace App\Http\Controllers;

use App\Models\Voiture;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Marque;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Voiture::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'modele' => 'required|string',
            'immatriculation' => 'required|string|unique:voitures,immatriculation',
            'places' => 'required|integer',
            'marque_id' => 'required|integer',
            'couleur' => 'required|string'
        ]);

        // Check if marque_id exists
        $marque = Marque::find($request->marque_id);
        if (!$marque) {
            return response()->json([
                'message' => 'Marque not found'
            ], 404);
        }

        return Voiture::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Check if voiture exists
        $voiture = Voiture::find($id);
        if (!$voiture) {
            return response()->json([
                'message' => 'Voiture not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Voiture details',
            'data' => Voiture::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $voiture = Voiture::find($id);
        $voiture->update($request->all());
        return $voiture;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // Check if voiture exists
        $voiture = Voiture::find($id);
        if (!$voiture) {
            return response()->json([
                'message' => 'Voiture not found'
            ], 404);
        }

        Voiture::destroy($id);

        return response()->json([
            'message' => 'Voiture deleted'
        ]);
    }
}
