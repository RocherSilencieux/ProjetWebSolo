<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Gemini;

class GeminiController extends Controller
{
    public function index()
    {
        $gemini = gemini::all();
        return view('pages.gemini.index', compact('gemini'));
    }

    public function generate(Request $request)
    {
        $language = $request->input('language');
        $numberOfQuestions = $request->input('numberOfQuestions');
        $numberOfChoices = $request->input('numberOfChoices');
        $prompt = "Génère un questionnaire pédagogique au format JSON.

Langage de programmation ciblé : ".$language."

Nombre de questions : ".$numberOfQuestions."

Nombre de choices : ".$numberOfChoices."

Structure du JSON attendue :

[
  {
    \"question\": \"Texte de la question ici\",
    \"choices\": [\"Choix A\", \"Choix B\", \"Choix C\", \"Choix D\"],
    \"answer\": \"Texte de la bonne réponse\",
    \"explanation\": \"Explication courte de la réponse correcte\"
  }
]

Contraintes :
- Les questions doivent être variées et représentatives du langage spécifié (".$language.").
- Le niveau est débutant(30% des questions), médium(40%), difficile(30%) — adapte la complexité des questions.
- Les \"choices\" doivent être crédibles, mais une seule est correcte.
- L'ensemble doit être 100% formaté en JSON valide, sans texte additionnel autour.
- Utilise uniquement des doubles guillemets pour le JSON.

Merci de ne renvoyer que le JSON final.";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post( 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . config('services.gemini.api_key'), [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt],
                    ],
                ],
            ],
        ]);

        $result = $response->json();
        $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Aucune réponse.';
        $cleanJson = preg_replace('/^```json\s*/', '', $text);
        $cleanJson = preg_replace('/\s*```$/', '', $cleanJson);
        $json = json_decode($cleanJson, true);
        $Gemini = Gemini::create([
                'language' => $language,
                'number_of_questions' => $numberOfQuestions,
                'number_of_choices' => $numberOfChoices,
                'qcm' => $cleanJson,
    ]);
        $Gemini->save();
        $gemini = gemini::all();
        return view('pages.gemini.index', compact ('gemini'));
    }
}

