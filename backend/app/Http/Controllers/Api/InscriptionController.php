<?php

namespace App\Http\Controllers\Api;

use App\Models\Inscription;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InscriptionController extends Controller
{
    /**
     * Lister les inscriptions avec pagination
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 15);
        $search = $request->get('search', '');
        $statut = $request->get('statut', '');

        $query = Inscription::query();

        if ($search) {
            $query->where('nom_complet', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telephone', 'like', "%{$search}%");
        }

        if ($statut) {
            $query->where('statut', $statut);
        }

        $inscriptions = $query->with(['formation', 'options', 'modules', 'paiements'])
                              ->paginate($perPage);

        return response()->json([
            'data' => $inscriptions->items(),
            'pagination' => [
                'current_page' => $inscriptions->currentPage(),
                'total' => $inscriptions->total(),
                'per_page' => $inscriptions->perPage(),
                'last_page' => $inscriptions->lastPage(),
            ],
        ]);
    }

    /**
     * Créer une nouvelle inscription
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'nullable|string',
            'raison_sociale' => 'nullable|string',
            'numero_commercial' => 'nullable|string',
            'age' => 'nullable|integer',
            'categorie' => 'required|in:Etudiant(e),Travailleur',
            'comment_connu' => 'nullable|string',
            'ordinateur' => 'required|in:oui,non',
            'ecole_universite' => 'nullable|string',
            'niveau_etude' => 'required|in:BACC,Licence,Master,Professionnel',
            'options' => 'array',
            'modules' => 'array',
            'prix_total' => 'required|numeric|min:0',
        ]);

        $inscription = Inscription::create([
            ...$validated,
            'date_inscription' => now()->toDateString(),
            'user_id' => auth()->id(),
        ]);

        if (!empty($validated['options'])) {
            $inscription->options()->sync($validated['options']);
        }

        if (!empty($validated['modules'])) {
            $inscription->modules()->sync($validated['modules']);
        }

        // Gérer les fichiers uploadés
        if ($request->hasFile('cni')) {
            $path = $request->file('cni')->store('documents/cni', 'public');
            $inscription->update(['cni_path' => $path]);
        }

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('documents/photos', 'public');
            $inscription->update(['photo_path' => $path]);
        }

        return response()->json($inscription->load(['formation', 'options', 'modules']), 201);
    }

    /**
     * Afficher une inscription
     */
    public function show(Inscription $inscription): JsonResponse
    {
        return response()->json(
            $inscription->load(['formation', 'options', 'modules', 'paiements', 'suivi'])
        );
    }

    /**
     * Modifier une inscription
     */
    public function update(Request $request, Inscription $inscription): JsonResponse
    {
        $validated = $request->validate([
            'nom_complet' => 'string|max:255',
            'email' => 'email',
            'telephone' => 'string|max:20',
            'statut' => 'in:en_attente,confirmee,en_cours,terminnee,annulee',
            'prix_paye' => 'numeric|min:0',
        ]);

        $inscription->update($validated);

        return response()->json($inscription);
    }

    /**
     * Exporter les inscriptions en CSV
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        $query = Inscription::query();

        if ($request->get('statut')) {
            $query->where('statut', $request->get('statut'));
        }

        $inscriptions = $query->with('formation')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename=inscriptions_' . now()->format('Y-m-d_H-i-s') . '.csv',
        ];

        return response()->stream(function () use ($inscriptions) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM

            // En-têtes
            fputcsv($handle, [
                'ID',
                'Formation',
                'Nom Complet',
                'Email',
                'Téléphone',
                'Adresse',
                'Catégorie',
                'Prix Total',
                'Prix Payé',
                'Solde',
                'Statut',
                'Date Inscription',
            ]);

            // Données
            foreach ($inscriptions as $inscription) {
                fputcsv($handle, [
                    $inscription->id,
                    $inscription->formation->titre,
                    $inscription->nom_complet,
                    $inscription->email,
                    $inscription->telephone,
                    $inscription->adresse,
                    $inscription->categorie,
                    $inscription->prix_total,
                    $inscription->prix_paye,
                    $inscription->soldeRestant(),
                    $inscription->statut,
                    $inscription->date_inscription,
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}
