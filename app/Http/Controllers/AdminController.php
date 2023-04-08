<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Mailgun\Mailgun;

use App\Models\Admin;
use App\Models\Contact;
use App\Models\tempTable;
use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Mail\ConfirmRegistration;
use Illuminate\Routing\Controller;
use App\Notifications\NewEntreprise;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Mailgun\HttpClient\HttpClientConfigurator;
use Illuminate\Notifications\DatabaseNotification;

class AdminController extends Controller
{

    public function superPage()
    {
        return view('admin/superPage');
    }
    public function indexAd()
    {
        return view('index');
    }
    public function formEntrepriseAdmin()
    {
        return view('entreprise/formEntrepriseAdmin');
    }
    public function adminForm()
    {
        return view('admin/adminForm');
    }
    public function allEventsAdmin()
    {
        $evenements = Evenement::with('categorie','utilisateur','entreprise','sponsors', 'images', 'videos', 'niveaux')->get();
        return view('evenements/allEvents', compact('evenements'));
    }

    // Enregistrer l'administrateur
    public function adminRegister(Request $request)
    {
        $admin = new Admin([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'telephone' => $request->input('telephone'),
        ]);

        $adminExists = User::where('email',$request->input('email'))->exists();

        if ($adminExists) {
            // L'admin existe déjà, renvoyer une erreur
            return response()->json(['message' => 'Cet utilisateur existe déjà'], 409);
        } else {

            // L'admin n'existe pas, ajouter les autres champs de l'utilisateur
            $admin = Admin::create([
                'nom' => $admin['nom'],
                'prenom' =>$admin['prenom'],
                'telephone' => $admin['telephone'],
            ]);
            $identifiant = Admin::where('id', $admin->id)->first();
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
            Mail::to($user->email)->send(new ConfirmRegistration($user));
            return redirect('/admin');
            // Renvoyer une réponse avec les données de l'utilisateur
            //return response()->json($user, 201);
        }

        //Auth::login($admin);
    }


        // Afficher le formulaire de connexion
        public function adminLoginForm()
        {
            return view('admin/adminLogin');
        }


        // Authentifier l'administrateur
        public function adminLogin(Request $request)
        {

            $email = $request->input('email');
            $password = $request->input('password');
            //$credentials = $request->only('email', 'password');
            // Tenter d'authentifier l'administrateur
            if (Auth::attempt(['email' => $email, 'password' => $password, 'role_id' => '1'])) {
                // L'administrateur est authentifié avec succès
                $user = Auth::user();
                $superadmin= Admin::where('id', $user->identifiant)->first();
                session(['nom' => $superadmin->nom,
                        'prenom' => $superadmin->prenom,
                ]);
                Session::put('user_name', $superadmin->prenom.' '.$superadmin->nom);
                return view('admin/index');
            }else if (Auth::attempt(['email' => $email, 'password' => $password, 'role_id' => '3'])) {
                // L'administrateur est authentifié avec succès
                $user = Auth::user();
                $admin= Admin::where('id', $user->identifiant)->first();
                session(['nom' => $admin->nom,
                        'prenom' => $admin->prenom,
                ]);
                Session::put('user_name', $admin->prenom.' '.$admin->nom);
                return view('admin/index');
            } else {
                return redirect()->back()->withErrors('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
            }
        }

        public function adminLogout(Request $request)
        {
            Auth::logout();
            $request->session()->flush();
            return redirect()->route('adminLoginForm');
        }



    public function adminNotification(){

        // Récupérer toutes les notifications dans la base de données
        $notifications = DatabaseNotification::all();
        //['token' => $token]
        return view('admin/adminNotification', compact('notifications'));
    }

    public function markAsRead($id){
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();
        Mail::to($notification['data']['email'])->send(new ConfirmRegistration($notification['data']));
        $notification->delete();
        return redirect()->back();
    }

    public function markAllAsRead(){
        // Marquer toutes les notifications comme lues
        $notification = DatabaseNotification::all();
        if ($notification) {
            $notification->markAsRead();
            DatabaseNotification::truncate();
        }
        return redirect()->back();
    }
    public function markAsReject($id){
        // Marquer toutes les notifications comme lues
        $notification = DatabaseNotification::find($id);
        if ($notification) {
            $notification->delete();
        }
        return redirect()->back();
    }
}
