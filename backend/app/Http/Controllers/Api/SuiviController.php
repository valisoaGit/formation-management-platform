<?php

namespace App\Http\Controllers\Api;

use App\Models\Suivi;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SuiviController extends Controller
{
    /**
     * Lister le suivi
     */
    public function index(Request $request): JsonResponse
    {
        $query = Suivi::query();

        if ($request->get('inscription_id')) {
            $query->where('inscription_id', $request->get('inscription_id'));
        }

        if ($request->get('statut')) {
            $query->where('statut', $request->get('statut'));
        }

        $suivi = $query->with(['inscription', 'module'])
                       ->paginate($request->get('per_page', 15));

        return response()->json([
            'data' => $suivi->items(),
            'pagination' => [
                'current_page' => $suivi->currentPage(),
                'total' => $suivi->total(),
                'per_page' => $suivi->perPage(),
                'last_page' => $suivi->lastPage(),
            ],
        ]);
    }

    /**
     * Créer un suivi
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'inscription_id' => 'required|exists:inscriptions,id',
            'module_id' => 'nullable|exists:modules,id',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date',
            'statut' => 'required|in:non_commence,en_cours,termine,abandon',
            'note' => 'nullable|numeric|min:0|max:20',
            'observation' => 'nullable|string',
        ]);

        $suivi = Suivi::create($validated);

        return response()->json($suivi->load(['inscription', 'module']), 201);
    }

    /**
     * Afficher un suivi
     */
    public function show(Suivi $suivi): JsonResponse
    {
        return response()->json(
            $suivi->load(['inscription', 'module'])
        );
    }

    /**
     * Modifier un suivi
     */
    public function update(Request $request, Suivi $suivi): JsonResponse
    {
        $validated = $request->validate([
            'statut' => 'in:non_commence,en_cours,termine,abandon',
            'date_fin' => 'nullable|date',
            'note' => 'nullable|numeric|min:0|max:20',
            'observation' => 'nullable|string',
        ]);

        $suivi->update($validated);

        return response()->json($suivi);
    }

    /**
     * Supprimer un suivi
     */
    public function destroy(Suivi $suivi): JsonResponse
    {
        $suivi->delete();

        return response()->json(['message' => 'Suivi supprimé']);
    }
}
