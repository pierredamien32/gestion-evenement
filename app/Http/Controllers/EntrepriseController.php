<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Contact;
use App\Models\tempTable;
use App\Models\Entreprise;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Mail\ConfirmationEmail;
use Illuminate\Routing\Controller;
use App\Notifications\NewEntreprise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmRegistrationClient;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Notification;


class EntrepriseController extends Controller
{

    public function welcome(){
        return view('welcome');
    }
    public function attenteconfirm(){
        return view('entreprise/attente-confirm');
    }
    public function formEntreprise()
    {
        return view('entreprise/formEntreprise');
    }
    public function confirmer()
    {
        return view('entreprise/formEntreprise');
    }
    private $notifiable;

    public function addEntreprise(Request $request ){
        // Valider les données de la requête
        $data = $request->validate([
            'role_id' => 'required',
        ]);
        /* if ($request->password !== $request->password_confirmation) {
            return back()->withErrors(['password_confirmation' => 'Le mot de passe doit être confirmé']);
        } */
        $temp= new tempTable();
        $code= rand(100000, 999999);
        $temp->nom = $request->nom;
        $temp->prenom = $request->prenom;
        $temp->sigle = $request->sigle;
        $temp->ifu = $request->ifu;
        $temp->pays= $request->pays;
        $temp->adresse= $request->adresse;
        $temp->sociale= $request->sociale;
        $temp->description= $request->description;
        $temp->tel =$request->tel;
        $temp->fixe =$request->fixe;
        $temp->email=$request->email;
        $temp->code=$code;
        $temp->password=Hash::make($request->input('password'));
        if ($data['role_id'] === 'personne') {
            $temp->role_id='personne';
        }else if ($data['role_id'] === 'entreprise') {
            $temp->role_id='entreprise';
        }
        $temp->save();
        // Envoyer la notification
        $user = tempTable::find($temp->id);
        $user->notify(new NewEntreprise($temp));
        if( (Auth::check() && Auth::user()['role_id']==1) ||(Auth::check() && Auth::user()['role_id']==3)  ){
            return redirect()->route('adminNotification');
        }
            return view('entreprise/attente-confirm');
    }

    public function verifyCode (Request $request){
        $user = tempTable::where('code', $request->input('code'))->first();
        if ($user) {
            $user->confirmation_code = null;
            $roleId = Role::where('libelle', $user['role_id'])->first();
            if ($user['role_id'] === 'personne') {
                $entreprise =Entreprise::create([
                    'nom' => $user['nom'],
                    'prenom' =>$user['prenom'],
                    'adresse' => $user['adresse'],
                    'pays' => $user['pays'],
                    'ifu' => $user['ifu'],
                ]);
                $identifiant = Entreprise::where('id', $entreprise->id)->first();
                $utilisateur = User::create([
                    'email' => $user['email'],
                    'role_id' =>$roleId['id'],
                    'identifiant' => $identifiant['id'],
                    'password' => $user['password'],
                ]);
            }
            else if ($user['role'] === 'entreprise') {
                $entreprise = Entreprise::create([
                    'sigle' => $user['sigle'],
                    'sociale' => $user['sociale'],
                    'adresse' => $user['adresse'],
                    'ifu' => $user['ifu'],
                    'pays' => $user['pays'],
                    'description' => $user['description'],
                ]);
                $identifiant = Entreprise::where('id', $entreprise->id)->first();
                $utilisateur = User::create([
                    'email' => $user['email'],
                    'role_id' =>$roleId['id'],
                    'identifiant' => $identifiant['id'],
                    'password' => $user['password'],
                ]);
            }

            $ContactId = Entreprise::where('id', $entreprise->id)->first();

            Contact::create([
                'tel' => $user['tel'],
                'entreprise_id' => $ContactId['id'],
            ]);
            // dd($notification['data']);
            if($user['fixe']){
                Contact::create([
                    'tel' => $user['fixe'],
                    'entreprise_id' => $ContactId['id'],
                ]);
            }
            $user->save();
            $entreprise->save();
            //Auth::login($user);
            Mail::to($user['email'])->send(new ConfirmRegistrationClient($user));
            return redirect('/home');
        }else {
            return redirect()->back()->withErrors(['code' => 'Code de confirmation incorrect.']);
        }
    }

}
