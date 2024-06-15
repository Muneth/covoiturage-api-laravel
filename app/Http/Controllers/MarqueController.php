<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Marque::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|unique:marques,nom',
            'pays' => 'required|string'
        ]);

        Marque::create($request->all());

        return response()->json([
            'message' => 'Marque created',
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Check if marque exists
        $marque = Marque::find($id);
        if (!$marque) {
            return response()->json([
                'message' => 'Marque not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Marque details',
            'data' => Marque::find($id)
        ]);

        // return Marque::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // Check if marque exists
        $marque = Marque::find($id);
        if (!$marque) {
            return response()->json([
                'message' => 'Marque not found'
            ], 404);
        }

        $marque = Marque::find($id);
        $marque->update($request->all());
        return $marque;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Check if marque exists
        $marque = Marque::find($id);
        if (!$marque) {
            return response()->json([
                'message' => 'Marque not found'
            ], 404);
        }
        return Marque::destroy($id);
    }
}
