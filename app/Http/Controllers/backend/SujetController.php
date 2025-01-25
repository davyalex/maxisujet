<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Sujet;
use App\Models\Niveau;
use App\Models\Categorie;
use App\Models\SujetNews;
use App\Mail\NewSujetEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SujetController extends Controller
{
    //index
    public function index()
    {
        $sujets = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($sujets->toArray());
        return view('admin.pages.sujet.index', compact('sujets'));
    }


    public function store(Request $request)
    {
        // dd($request->toArray());

        $uuid1 = Str::uuid()->toString(); // sujet file
        $uuid2 = Str::uuid()->toString(); // corrige file

        // save sujet file
        if ($request->hasFile('sujet_file')) {
            $fileNameSujet =  $uuid1 . '.' . $request->sujet_file->extension();
            $request->sujet_file->storeAs('public/sujets', $fileNameSujet);
        }


        // save corrige file
        if ($request->hasFile('corrige_file')) {
            $fileNameCorrige =  $uuid2 . '.' . $request->corrige_file->extension();
            $request->corrige_file->storeAs('public/corriges', $fileNameCorrige);
        } else {
            $fileNameCorrige = '';
        }

        //get category name from category_id
        $category_name = Categorie::whereId($request['category_id'])->first();
        $category_name =  $category_name->title;

        $sujet = Sujet::firstOrCreate([
            'sujet_title' =>  $category_name . mt_rand(),
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'annee' => $request['annee'],
            'etablissement_id' => $request['etablissement_id'],
            'sujet_file' => $fileNameSujet,
            'corrige_file' => $fileNameCorrige,
            'user_id' => Auth::user()->id,
        ]);


        //insert data in pivot table
        if ($request->has('niveaux')) {

            $sujet->niveaux()->attach($request['niveaux']);
        }

        if ($request->has('matieres')) {

            $sujet->matieres()->attach($request['matieres']);
        }


        //send email to all user admin
        $admin = User::whereHas('roles', fn($q) => $q->where('name', 'administrateur'))->get();

        foreach ($admin as $user) {
            Mail::to($user->email)->send(new NewSujetEmail($user));
        }

        return back()->with('success', 'Nouveau sujet crée avec success');
    }


    // public function store(Request $request)
    // {
    //     // dd($request->toArray());

    //     $uuid1 = Str::uuid()->toString(); // sujet file
    //     $uuid2 = Str::uuid()->toString(); // corrige file

    //     // save sujet file
    //     if ($request->hasFile('sujet_file')) {
    //         $fileNameSujet =  $uuid1 . '.' . $request->sujet_file->extension();
    //         $request->sujet_file->storeAs('public/sujets', $fileNameSujet);
    //     }


    //     // save corrige file
    //     if ($request->hasFile('corrige_file')) {
    //         $fileNameCorrige =  $uuid2 . '.' . $request->corrige_file->extension();
    //         $request->corrige_file->storeAs('public/corriges', $fileNameCorrige);
    //     } else {
    //         $fileNameCorrige = '';
    //     }

    //     //get category name from category_id
    //     $category_name = Categorie::whereId($request['category_id'])->first();
    //     $category_name =  $category_name->title;

    //     $sujet = SujetNews::firstOrCreate([
    //         'code' =>  $category_name . mt_rand(),
    //         'categorie' => $request['categorie'],
    //         'niveau' => $request['niveaux'],

    //         'annee' => $request['annee'],
    //         'etablissement_id' => $request['etablissement_id'],
    //         'sujet_file' => $fileNameSujet,
    //         'corrige_file' => $fileNameCorrige,
    //         'user_id' => Auth::user()->id,
    //     ]);


    //     //insert data in pivot table
    //     if ($request->has('niveaux')) {

    //         $sujet->niveaux()->attach($request['niveaux']);
    //     }

    //     if ($request->has('matieres')) {

    //         $sujet->matieres()->attach($request['matieres']);
    //     }


    //     //send email to all user admin
    //     $admin = User::whereHas('roles', fn($q) => $q->where('name', 'administrateur'))->get();

    //     foreach ($admin as $user) {
    //         Mail::to($user->email)->send(new NewSujetEmail($user));
    //     }

    //     return back()->with('success', 'Nouveau sujet crée avec success');
    // }




    //edit
    public function edit(Request $request, $id)
    {
        $sujet = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'user'])
            ->whereId($id)
            ->first();
        // dd($sujet->toArray());
        return view('admin.pages.sujet.edit', compact('sujet'));
    }




    //update sujet

    public function update(Request $request, string $id)
    {

        $uuid1 = Str::uuid()->toString();
        $uuid2 = Str::uuid()->toString();


        if ($request->hasFile('sujet_file')) {
            $fileNameSujet =  $uuid1 . '.' . $request->sujet_file->extension();
            $request->sujet_file->storeAs('public/', $fileNameSujet);
            if ($request['sujet_file_exist']) {
                Storage::delete('public/' . $request['sujet_file_exist']);
            }
        } else {
            $fileNameSujet = $request['sujet_file_exist'];
        }

        if ($request->hasFile('corrige_file')) {
            $fileNameCorrige =  $uuid2 . '.' . $request->corrige_file->extension();
            $request->corrige_file->storeAs('public/', $fileNameCorrige);
            if ($request['corrige_file_exist']) {
                Storage::delete('public/' . $request['corrige_file_exist']);
            }
        } else {
            $fileNameCorrige = $request['corrige_file_exist'];
        }

        // dd($fileNameSujet,$fileNameCorrige);


        $sujet = tap(Sujet::find($id))->update([
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'annee' => $request['annee'],
            'etablissement_id' => $request['etablissement_id'],
            'sujet_file' => $fileNameSujet,
            'corrige_file' => $fileNameCorrige,
            'user_id' => Auth::user()->id,

        ]);

        //update pivot table
        if ($request->has('niveaux')) {
            $sujet->niveaux()->detach();
            $sujet->niveaux()->attach($request['niveaux']);
        }

        if ($request->has('matieres')) {
            $sujet->matieres()->detach();
            $sujet->matieres()->attach($request['matieres']);
        }

        return back()->with('success',  'Sujet modifié avec success');
    }


    //delete sujet
    public function destroy(string  $id)
    {
        //

        //  if($sujet->sujet_file){
        //     Storage::delete('public/' . $sujet->sujet_file);
        // }

        Sujet::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }


    //approved sujet
    public function approved($id)
    {

        //change state approuved to 1

        Sujet::find($id)->update([
            'approved' => 1
        ]);

        //send mail after approuved sujet
        $sujet = Sujet::whereId($id)
            ->with('user')->first();
        $user = $sujet->user;

        Mail::send('admin.pages.email.email_approved_sujet', ['user' => $user, 'sujet' => $sujet], function ($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Votre sujet à été approuvé !');
        });




        return back()->with('success', 'Le sujet a été validé !');
    }



    // function for insert matiere and niveaux from file
    public function insertDataFromFile()
    {
        // Liste des niveaux définie directement dans le contrôleur
        $data = <<<EOT
        
    LM1 BOUAFLÉ
    LYCÉE MAMIE ADJOUA DE YAMOUSSOUKRO
    PIGIER
    COLLÈGE MITTERRAND
    PENSIONNAT MÉTHODISTE DES FILLES D'ANYAMA
    LYCEE SAINTE MARIE
    COLLÈGE SAINT FRANÇOIS 2 YOPOUGON
    COLLÈGE SAINT FRANÇOIS
    GROUPE SCOLAIRE LES PINGOUINS
    COLLEGE LE CLASSIQUE
    LYCÉE MAMIE ADJOUA
    COLLEGE SONA DE YOPOUGON
    COLLEGE LES GRACES
    COLLÈGE SAINT EMMANUEL
    LYCÉE MODERNE BAD DE YAMOUSSOUKRO
    COLLÈGE SAINT EMMANUEL YOPOUGON NIANGON
    ESMA ODIENNE
    GROUPE LOKO
    INSTITUT LKM
    EPCC
    MARIE BLANCHE
    CHAMBRE DE COMMERCE
    LYCEE CLASSIQUE D'ABIDJAN
    YCEE MUNICIPAL DE KOROGHO
    LYCEE CLASSIQUE
    COLLEGE MARIE BLANCHE
    COLLEGE  MARIE BLANCHE
    GROUPE SCOLAIRE
    COLLEGE LES GRACES_MATHEMATIQUE
    LYCEE MODERNE 1 D'ABOBO
    ISSEA
    LKM
    CHAMBRE COMMERCE
    PIGER
    LYCEE GARÇON BINGERVILLE
    NATIONAL
    CBCG COCODY

    EOT;

        // Diviser chaque ligne
        $lines = explode("\n", $data);

        foreach ($lines as $line) {
            // Diviser chaque élément dans la ligne par une virgule
            $elements = array_map('trim', explode(',', $line));

            foreach ($elements as $element) {
                if (!empty($element)) {
                    // Vérifier si l'élément existe 
                    $exists = DB::table('etablissements')->where('title', $element)->exists();

                    if (!$exists) {
                        // Insérer l'élément dans la table
                        DB::table('etablissements')->insert([
                            'title' => $element,
                            // 'parent_id' => null,
                            'created_at' => now(),
                            'updated_at' => now(),

                        ]);
                    }
                }
            }
        }

        // Retourner une réponse (ou redirection)
        return response()->json(['message' => 'Les données ont été ajoutés avec succès.']);
    }


    // public function importFromCsv()
    // {
    //     // Chemin du fichier CSV
    //     $filePath = storage_path('app/sujets.csv');

    //     if (!file_exists($filePath)) {
    //         return response()->json(['error' => 'Fichier CSV introuvable !'], 404);
    //     }

    //     // Lecture du fichier CSV avec un séparateur de point-virgule
    //     $csvData = array_map(function ($line) {
    //         return str_getcsv($line, ';'); // Spécifier le séparateur de point-virgule
    //     }, file($filePath));

    //     $header = array_map('trim', $csvData[0]); // Première ligne (en-têtes) et suppression des espaces
    //     unset($csvData[0]); // Supprimer l'en-tête des données

    //     // Vérifier les en-têtes
    //     // dd($header); // Affiche les en-têtes du fichier CSV

    //     $data = [];
    //     foreach ($csvData as $row) {
    //         $rowData = array_combine($header, $row);

    //         // Vérifier que la clé existe avant d'y accéder
    //         if (!isset($rowData['sujet_title'])) {
    //             return response()->json(['error' => 'Clé "sujet_title" manquante dans une ligne du fichier CSV'], 400);
    //         }

    //         $data[] = [
    //             'sujet_title' => $rowData['sujet_title'],
    //             'description' => $rowData['description'],
    //             'user_id' => (int) $rowData['user_id'],
    //             'category_id' => (int) $rowData['category_id'],
    //             'etablissement_id' => null,
    //             'sujet_file' => $rowData['sujet_file'],
    //             'corrige_file' => $rowData['corrige_file'],
    //             'annee' => (int) $rowData['annee'],
    //             'created_at' => Carbon::createFromFormat('d/m/Y - H:i', $rowData['created_at'])->toDateTimeString(),
    //             'updated_at' => Carbon::createFromFormat('d/m/Y - H:i', $rowData['updated_at'])->toDateTimeString(),
    //             'approved' => (int) $rowData['approved'],
    //         ];
    //     }

    //     // Insertion par lots pour éviter les problèmes de mémoire
    //     foreach (array_chunk($data, 100) as $chunk) {
    //         DB::table('sujets')->insert($chunk);
    //     }

    //     return response()->json(['success' => 'Les sujets ont été importés avec succès !'], 200);
    // }

    public function importFromCsv()
    {
        // Chemin du fichier CSV
        $filePath = storage_path('app/sujets.csv');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'Fichier CSV introuvable !'], 404);
        }

        // Lecture du fichier CSV avec un séparateur de point-virgule
        $csvData = array_map(function ($line) {
            return str_getcsv($line, ';'); // Spécifier le séparateur de point-virgule
        }, file($filePath));

        $header = array_map('trim', $csvData[0]); // Première ligne (en-têtes) et suppression des espaces
        unset($csvData[0]); // Supprimer l'en-tête des données

        $data = [];
        foreach ($csvData as $row) {
            $rowData = array_combine($header, $row);

            // Vérifier la validité de l'etablissement_id
            $etablissementId = (int) $rowData['etablissement_id'];
            if (!$this->isValidEtablissementId($etablissementId)) {
                $etablissementId = null; // Si non valide, assigner NULL
            }

            $data[] = [
                'sujet_title' => $rowData['sujet_title'],
                'description' => $rowData['description'],
                'user_id' => (int) $rowData['user_id'],
                'category_id' => (int) $rowData['category_id'],
                'etablissement_id' => $etablissementId,
                'sujet_file' => $rowData['sujet_file'],
                'corrige_file' => $rowData['corrige_file'],
                'annee' => (int) $rowData['annee'],
                'created_at' => Carbon::createFromFormat('d/m/Y - H:i', $rowData['created_at'])->toDateTimeString(),
                'updated_at' => Carbon::createFromFormat('d/m/Y - H:i', $rowData['updated_at'])->toDateTimeString(),
                'approved' => (int) $rowData['approved'],
            ];
        }

        try {
            // Démarrer une transaction pour l'insertion par lots
            DB::beginTransaction();

            // Insertion par lots pour éviter les problèmes de mémoire
            foreach (array_chunk($data, 100) as $chunk) {
                // Vérifier la structure de chaque chunk avant l'insertion
                // Si vous obtenez un tableau de tableau associatif, vous pouvez faire l'insertion
                DB::table('sujets')->insert($chunk);
            }

            // Commit de la transaction si tout se passe bien
            DB::commit();

            return response()->json(['success' => 'Les sujets ont été importés avec succès !'], 200);
        } catch (\Exception $e) {
            // En cas d'erreur, annuler la transaction
            DB::rollBack();

            // Retourner l'erreur
            return response()->json(['error' => 'Erreur lors de l\'importation : ' . $e->getMessage()], 500);
        }
    }

    // Fonction de validation de l'existence de l'id dans la table etablissements
    private function isValidEtablissementId($etablissementId)
    {
        return DB::table('etablissements')->where('id', $etablissementId)->exists();
    }




    // public function importNiveauxSujetsFromFile()
    // {
    //     // Spécifier le chemin du fichier CSV
    //     $filePath = storage_path('app/sujet_niveaux.csv');

    //     // Vérifier si le fichier existe
    //     if (!file_exists($filePath)) {
    //         Log::error('Le fichier CSV n\'existe pas à cet emplacement: ' . $filePath);
    //         return response()->json(['message' => 'Le fichier CSV n\'existe pas.'], 404);
    //     }

    //     // Lire le contenu du fichier CSV
    //     $csvContent = file_get_contents($filePath);

    //     // Convertir le contenu du CSV en tableau, en utilisant ';' comme séparateur
    //     $rows = explode(PHP_EOL, $csvContent);

    //     // Supprimer la première ligne (les entêtes)
    //     array_shift($rows);

    //     // Traiter chaque ligne du CSV
    //     foreach ($rows as $row) {
    //         if (empty($row)) continue;  // Ignorer les lignes vides

    //         // Séparer la ligne en sujets et niveaux en utilisant ';' comme séparateur
    //         $columns = str_getcsv($row, ';');

    //         // Vérifier que la ligne contient bien deux colonnes
    //         if (count($columns) < 2) {
    //             Log::warning("La ligne ne contient pas les deux colonnes attendues: {$row}");
    //             continue;
    //         }

    //         $sujetTitle = $columns[0]; // Titre du sujet dans la colonne 'sujets'
    //         $niveauxString = $columns[1]; // Les niveaux dans la colonne 'niveaux'

    //         // Séparer les niveaux par des virgules
    //         $niveaux = explode(' ', $niveauxString);

    //         // Traiter chaque niveau et associer au sujet
    //         foreach ($niveaux as $niveauTitle) {
    //             $niveauTitle = trim(strtolower($niveauTitle)); // Nettoyer et mettre en minuscule

    //             // Recherche l'ID du niveau dans la table 'niveaux'
    //             $niveau = Niveau::whereRaw('LOWER(title) = ?', [$niveauTitle])->first();

    //             if ($niveau) {
    //                 // Recherche du sujet par le titre dans la table 'sujets'
    //                 $sujet = Sujet::whereRaw('LOWER(sujet_title) = ?', [strtolower($sujetTitle)])->first();

    //                 if ($sujet) {
    //                     // Insérer directement dans la table pivot 'niveau_sujet' sans modèle dédié
    //                     DB::table('niveau_sujet')->insert([
    //                         'sujet_id' => $sujet->id,
    //                         'niveau_id' => $niveau->id,
    //                         'created_at' => now(),
    //                         'updated_at' => now()
    //                     ]);
    //                 } else {
    //                     // Loguer si le sujet n'existe pas dans la table 'sujets'
    //                     Log::warning("Le sujet '{$sujetTitle}' n'existe pas dans la table des sujets.");
    //                 }
    //             } else {
    //                 // Loguer si le niveau n'existe pas dans la table 'niveaux'
    //                 Log::warning("Le niveau '{$niveauTitle}' n'existe pas dans la table des niveaux pour le sujet: {$sujetTitle}");
    //             }
    //         }
    //     }

    //     return response()->json(['message' => 'Les données ont été importées avec succès.']);
    // }


    public function importNiveauxSujetsFromFile(){
        // recuperer les user
        User::chunk(100, function ($users) {
            foreach ($users as $user) {
               // affecter le role client
               $user->assignRole('client');// 2 est le role client
            }
        });
    }
}
