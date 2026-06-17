<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ConsultationController extends Controller
{
    public function consultation(string $id, Request $request)
    {
        // 1. Récupération et vérification d'existence
        $book = Book::findOrFail($id);
        // The admin upload stores files on the 'public' disk (storage/app/public)
        $disk = Storage::disk('public');
        $path = $book->pdf_path; // relative to the 'public' disk (e.g. 'books/xxx.pdf')

        if (! $disk->exists($path)) {
            return response()->json(['error' => 'Fichier introuvable'], 404);
        }

        // 2. Logique métier (Timer, Stats, etc.)
        $request->session()->put("consultation_start_{$id}", now());

        if (auth()->check()) {
            \Illuminate\Support\Facades\DB::table('book_user')->insert([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Récupération des infos du fichier
    $file = $disk->get($path);
    $type = $disk->mimeType($path);

        // 4. Retour de la réponse pour PDF.js
        return response($file, 200)
            ->header('Content-Type', $type)
            // 'inline' est crucial pour que PDF.js puisse le lire sans forcer le téléchargement
            ->header('Content-Disposition', 'inline; filename="' . $book->title . '.pdf"')
            // CORS : Autoriser votre front-end si c'est une API séparée
            ->header('Access-Control-Allow-Origin', '*') 
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
    public function endConsultation(string $id, Request $request)
    {
        $startTime = $request->session()->get("consultation_start_{$id}");

        if ($startTime && auth()->check()) {
            // Calcul de la durée en minutes (peut être adapté en secondes si besoin)
            $durationInMinutes = now()->diffInMinutes($startTime);

            // Récupère l'enregistrement le plus récent pour pouvoir le mettre à jour
            $record = \Illuminate\Support\Facades\DB::table('book_user')
                ->where('user_id', auth()->id())
                ->where('book_id', $id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($record) {
                \Illuminate\Support\Facades\DB::table('book_user')
                    ->where('id', $record->id)
                    ->update([
                        'duration' => ($record->duration ?? 0) + $durationInMinutes,
                        'updated_at' => now()
                    ]);
            }

            // Supprime la session pour cette consultation
            $request->session()->forget("consultation_start_{$id}");

            return response()->json([
                'message' => 'Consultation sauvegardée avec succès.',
                'duration_added' => $durationInMinutes
            ], 200);
        }

        return response()->json(['message' => 'Aucune consultation en cours ou utilisateur non connecté.'], 400);
    }
}
