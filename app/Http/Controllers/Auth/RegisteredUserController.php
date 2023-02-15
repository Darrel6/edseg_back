<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use App\Models\User;
use App\Mail\UserConnect;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Mail\UserConnectMarkdown;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usr()
    {
        $users = User::all();
        return response()->json([
            "status" => "success",
            "data" => $users
        ]);
    }


    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'prenom' => 'required',
                'annee' => 'required',
                'npi' => 'required',
                'identifiant' => 'required',
                'matricule' => 'required',
                'date_naiss' => 'required',
                'lieu_naiss' => 'required',
                'nationality' => 'required',
                'entite' => 'required',
                'specialite' => 'required',
                'status' => 'required',
                'mention' => 'required',
                'fiche_preinscri' => 'required',
                'paiement_status' => 'required',
                'piece_identite' => 'required',
                'phone' => 'required',
                'wphone' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => Rules\Password::defaults(),
            ],
            [
                'email.unique' => "L'email inscrit existe déjà",
                'email.max' => "L'email est tros long",
                'name.max' => "Le nom est tros long",
                'email.email' => "L'email n'est pas valide",
            ]
        );


        $random = Str::random(8);
        if ($request->fiche_preinscri) {
            $ficheName = time() . '.' . $request->fiche_preinscri->getClientOriginalExtension();
            $fichepath = $request->file('fiche_preinscri')->storeAs(
                'public/fiche',
                $ficheName

            );
        };
        if ($request->recu_paiement) {
            $recuName = time() . '.' . $request->recu_paiement->getClientOriginalExtension();
            $recupath = $request->file('recu_paiement')->storeAs(
                'public/reçu',
                $recuName

            );
        }
        if ($request->piece_identite) {
            $pieceName = time() . '.' . $request->piece_identite->getClientOriginalExtension();
            $piecepath = $request->file('piece_identite')->storeAs(
                'public/piece',
                $pieceName

            );
        };


        if ($request->reference != "" && $request->num_transaction != "" && $request->date_paiement != "" && $request->recu_paiement != "" && $request->montant != "") {

            $user = User::create([

                'name' => $request->name,
                'email' => $request->email,
                'prenom' => $request->prenom,
                'annee' => $request->annee,
                'npi' => $request->npi,
                'identifiant' => $request->identifiant,
                'matricule' => $request->matricule,
                'date_naiss' => $request->date_naiss,
                'lieu_naiss' => $request->lieu_naiss,
                'nationality' => $request->nationality,
                'entite' => $request->entite,
                'specialite' => $request->specialite,
                'status' => $request->status,
                'mention' => $request->mention,
                'reference' => $request->reference,
                'num_transaction' => $request->num_transaction,
                'date_paiement' => $request->date_paiement,
                'montant' => $request->montant,
                'fiche_preinscri' => Storage::url($fichepath),
                'recu_paiement' => Storage::url($recupath),
                'piece_identite' => Storage::url($piecepath),
                'phone' => $request->phone,
                'wphone' => $request->wphone,
                'paiement_status' => $request->paiement_status = "oui",
                'password' => Crypt::encrypt($random),

            ]);
        } else {
            $user = User::create([

                'name' => $request->name,
                'email' => $request->email,
                'prenom' => $request->prenom,
                'annee' => $request->annee,
                'npi' => $request->npi,
                'identifiant' => $request->identifiant,
                'matricule' => $request->matricule,
                'date_naiss' => $request->date_naiss,
                'lieu_naiss' => $request->lieu_naiss,
                'nationality' => $request->nationality,
                'entite' => $request->entite,
                'specialite' => $request->specialite,
                'status' => $request->status,
                'mention' => $request->mention,
                'reference' => "null",
                'num_transaction' => "",
                'date_paiement' => null,
                'montant' => "",
                'fiche_preinscri' => Storage::url($fichepath),
                'recu_paiement' => "",
                'piece_identite' => Storage::url($piecepath),
                'phone' => $request->phone,
                'wphone' => $request->wphone,
                'paiement_status' =>  $request->paiement_status = 'non',
                'password' => Crypt::encrypt($random),

            ]);
        }


        /* 
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ]; */

        event(new Registered($user));
        Mail::to($user['email'])->send(new UserConnectMarkdown($user));


        return response()->json([
            "status" => "success",
            "message" => "inscription réussie"
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required'],
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user || !Crypt::encrypt($request->password, $user->password)) {
            return response(
                [
                    'message' => 'Email ou Mot de passe incorrect'
                ],
                401
            );
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout(Request $request)
    {

        Auth::user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate(
            [
                "reference" => 'required',
                "num_transaction" => 'required',
                "montant" => 'required',
                "date_paiement" => 'required',
                'name' => ['required', 'string', 'max:255'],
                'prenom' => 'required',
                'annee' => 'required',
                'npi' => 'required',
                'identifiant' => 'required',
                'matricule' => 'required',
                'date_naiss' => 'required',
                'lieu_naiss' => 'required',
                'nationality' => 'required',
                'entite' => 'required',
                'specialite' => 'required',
                'status' => 'required',
                'mention' => 'required',
                'fiche_preinscri' => 'required',
                'paiement_status' => 'required',
                'piece_identite' => 'required',
                'phone' => 'required',
                'wphone' => 'required',
                'email' => ['required', 'string', 'email', 'max:255'],
            ]
        );


        if ($request->recu_paiement) {
            $recuName = time() . '.' . $request->recu_paiement->getClientOriginalExtension();
            $recupath = $request->file('recu_paiement')->storeAs(
                'public/reçu',
                $recuName

            );
        }

        $user = User::where("id", $id)->update([
            "reference" => $request->reference,
            "num_transaction" => $request->num_transaction,
            "montant" => $request->montant,
            "date_paiement" => $request->date_paiement,
            "recu_paiement" => Storage::url($recupath),
            "paiement_status" => $request->paiement_status,
            'name' => $request->name,
            'email' => $request->email,
            'prenom' => $request->prenom,
            'annee' => $request->annee,
            'npi' => $request->npi,
            'identifiant' => $request->identifiant,
            'matricule' => $request->matricule,
            'date_naiss' => $request->date_naiss,
            'lieu_naiss' => $request->lieu_naiss,
            'nationality' => $request->nationality,
            'entite' => $request->entite,
            'specialite' => $request->specialite,
            'status' => $request->status,
            'mention' => $request->mention,
            'reference' => $request->reference,
            'num_transaction' => $request->num_transaction,
            'date_paiement' => $request->date_paiement,
            'montant' => $request->montant,
            'fiche_preinscri' => $request->fiche_preinscri,
            'piece_identite' => $request->piece_identite,
            'phone' => $request->phone,
            'wphone' => $request->wphone,

        ]);

        return response()->json([
            "status" => "success",
            "message" => "inscription terminée",
            "code" => $user,
            "user" => json_encode(User::where("id", $id)->get())
        ]);
    }

    public function show($id)
    {
        $user = User::where("id", $id)->get()->first();
        return response()->json([
            "status" => "success",
            "data" => $user,
        ]);
    }
    public function perform(Request $request)
    {
        /* Auth::user()->token()->revoke(); */
        return response()->json([
            "status" => "success",
            "message" => 'Déconnexion reussie',
        ]);
    }
}