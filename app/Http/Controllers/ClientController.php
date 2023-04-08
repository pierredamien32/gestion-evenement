<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmRegistrationClient;
use Illuminate\Support\Facades\Session;


class ClientController extends Controller
{

    public function formClient()
    {
        return view ('client/formClient');
    }
    public function loginPage()
    {
        return view('loginPage');
    }
    public function status()
    {
        return view('status');
    }
    public function addClient(Request $request)
    {
        $client = new Client([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'telephone' => $request->input('telephone'),
        ]);

        $userExists = User::where('email',$request->input('email'))->exists();

        if ($userExists) {
            // L'utilisateur existe déjà, renvoyer une erreur
            return response()->json(['message' => 'Cet utilisateur existe déjà'], 409);
        } else {

            // L'utilisateur n'existe pas, ajouter les autres champs de l'utilisateur
            $client = Client::create([
                'nom' => $client['nom'],
                'prenom' =>$client['prenom'],
                'telephone' => $client['telephone'],
            ]);
            $identifiant = Client::where('id', $client->id)->first();
            $user = new User([
                'email' => $request->input('email'),
                'role_id' => $request->input('role_id'),
                'identifiant' => $identifiant['id'],
                'password' =>Hash::make($request->input('password'))]
            );
            // Créer un nouvel utilisateur
            $user = User::create([
                'email' => $user['email'],
                'role_id' =>$user['role_id'],
                'identifiant' => $user['identifiant'],
                'password' => $user['password'],
            ]);
            // Envoyer un e-mail de confirmation à l'utilisateur
            Mail::to($user->email)->send(new ConfirmRegistrationClient($user));
            return redirect()->route('loginPage');
            // Renvoyer une réponse avec les données de l'utilisateur
            //return response()->json($user, 201);
        }
    }
    public function login(Request $request)
    {
    // Valider les données de la requête
        $donnees = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tenter de connecter l'utilisateur
        if (Auth::attempt($donnees)) {
            $user = Auth::user();

            if(auth()->user()['role_id']===4){
                $personne = Entreprise::where('id', $user->identifiant)->first();
                session([
                    'id' => $personne->id,
                    'role_id'=>auth()->user()['role_id'],
                    'nom' => $personne->nom,
                    'prenom' => $personne->prenom,
                ]);
                Session::put('user_name', $personne->prenom.' '.$personne->nom);
                Session::put('id', $personne->id);
                Session::put('role_id', auth()->user()['role_id']);

                return redirect()->route('index');
            }elseif (auth()->user()['role_id']===5) {
                $client= Client::where('id', $user->identifiant)->first();
                session(['nom' => $client->nom,
                        'prenom' => $client->prenom,
                        'id' => $client->id,
                        'role_id' =>auth()->user()['role_id'],
                ]);
                Session::put('user_name', $client->prenom.' '.$client->nom);
                Session::put('id', $client->id);
                Session::put('role_id',auth()->user()['role_id']);
                return redirect()->route('index');
            }elseif (auth()->user()['role_id']===2) {
                $entreprise= Entreprise::where('id', $user->identifiant)->first();
                session(['sigle' => $entreprise->sigle,
                        'id' => $entreprise->id,
                        'role_id' =>auth()->user()['role_id'],
                ]);
                Session::put('user_name', $entreprise->sigle);
                Session::put('id', $entreprise->id);
                Session::put('role_id',auth()->user()['role_id']);

                return redirect()->route('index');
            }elseif (auth()->user()['role_id']===1) {
                $superadmin= Admin::where('id', $user->identifiant)->first();
                session(['nom' => $superadmin->nom,
                        'prenom' => $superadmin->prenom,
                        'id' => $superadmin->id,
                        'role_id' =>auth()->user()['role_id'],
                ]);
                Session::put('user_name', $superadmin->prenom.' '.$superadmin->nom);
                Session::put('id', $superadmin->id);
                Session::put('role_id',auth()->user()['role_id']);

                return redirect()->route('index');
            }elseif (auth()->user()['role_id']===3) {
                $admin= Admin::where('id', $user->identifiant)->first();
                 session(['nom' => $admin->nom,
                        'prenom' => $admin->prenom,
                        'id' => $admin->id,
                        'role_id' =>auth()->user()['role_id'],
                ]);
                Session::put('user_name', $admin->prenom.' '.$admin->nom);
                Session::put('id', $admin->id);
                Session::put('role_id',auth()->user()['role_id']);

                return redirect()->route('index');
            }

            // Rediriger l'utilisateur vers la page de bienvenue
        } else {
            // Rediriger l'utilisateur vers la page de connexion avec une erreur
            return back()->withErrors([
                'email' => 'Les informations de connexion sont incorrectes.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('loginPage');
    }

}
