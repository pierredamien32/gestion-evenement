<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ConfirmIdentity;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class GeneralController extends Controller
{   public $code;
    public $email;

    public function index()
    {
        $categories =Categories::all();
        //dd($categories[0]->id);
        return view ('index', compact('categories'));
    }

    public function pwdForm()
    {
        return view ('pwdForm');
    }

    public function sendCode(Request $request){
        // Valider l'email
       // $this->validateEmail($request);

        // Obtenir l'utilisateur correspondant à l'email
        $user = User::where('email', $request->email)->first();

        // Si l'utilisateur n'existe pas, rediriger vers la page de connexion avec un message d'erreur
        if (!$user) {
            return redirect()->back()->with('error', "L'adresse email n'existe pas dans notre système.");
        }
        $this->code = rand (1000, 9999);
        $code =$this->code;
        Session::put('code', $code);
        Session::put('email', $user['email']);
        // Envoyer l'email de réinitialisation de mot de passe
        $this->email=$user['email'];
        Mail::to($user['email'])->send(new ConfirmIdentity($user, $code));
        return view ('enterCode');
    }

    public function sendResetLink(Request $request)
    {
        // Valider l'email
        $code = Session::get('code');
        $email = Session::get('email');

        if($code==$request->input('code')){

            // Créer un nouveau jeton de réinitialisation de mot de passe pour l'utilisateur
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => now()
            ]);
            return view('pwdReset', ['token' => $token]);
        };
        return view('enterCode');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
            event(new PasswordReset($user));
        });

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('loginPage')->with('success', 'Le mot de passe a été réinitialisé avec succès.');
        } else {
            return back()->withErrors(['email' => [trans($response)]]);
        }
    }


}
