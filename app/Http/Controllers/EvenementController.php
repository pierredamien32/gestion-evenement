<?php

namespace App\Http\Controllers;
use UploadTrait;
use App\Models\User;
use App\Models\Image;
use App\Models\Video;
use App\Models\Sponsor;
use App\Models\CoutEvent;
use App\Models\Evenement;
use App\Models\Categories;
use App\Models\ImageEvent;
use App\Models\VideoEvent;
use App\Models\NiveauAcces;
use App\Models\Reservation;
use App\Models\SponsorEvent;
use Illuminate\Http\Request;
use App\Models\ReservationEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class EvenementController extends Controller
{

    public function formEvent()
    {
        $categories = Categories::all();
        return view('evenements/formEvent', compact('categories'));
    }
    public function formCoutEvent()
    {
        $nivacces = NiveauAcces::all();
        return view('evenements/formCoutEvent', compact('nivacces'));
    }
    public function formImage()
    {
        $sponsors = Sponsor::all();
        return view('evenements/formImage',compact('sponsors'));
    }
    public function reserver()
    {
        return view('reservations/reserver');
    }
    public function reservation(Request $request)
    {
        $evenement = $_GET['evenement_id'];
        $user = $_GET['user_id'];
        $reservation = Reservation::create([
            'evenement_id' => $evenement,
            'user_id' => $user,// $request->input('libelle'),
            'dateRes' => $request->input('dateRes'),
         ]);
        $identifiant = Reservation::where('id', $reservation->id)->first();
        Session::put('resId', $identifiant->id);
        $nivacces = NiveauAcces::all();
        return view('reservations/reservationEvent',compact('nivacces'));
    }
    public function createEvent(Request $request)
    {
        $event = Evenement::create([
            'intitule'=> $request->input('intitule'),
            'entreprise_id' => $request->input('entreprise_id'),
            'role_id' => $request->input('role_id'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'lieu' => $request->input('lieu'),
            'statut' => $request->input('statut'),
            'dateDebut' => $request->input('dateDebut'),
            'dateFin' => $request->input('dateFin'),
            'heure' => $request->input('heure')]);
        $identifiant = Evenement::where('id', $event->id)->first();
        Session::put('evenement', $identifiant->id);

        return redirect()->route('formCoutEvent');
    }

    public function createCoutEvent(Request $request)
    {
        $evenement = Session::get('evenement');
        $niveau_accesses = $_GET['libelle'];
        $couts = $_GET['cout'];

        // Loop through the selected values of the "libelle" array
        foreach ($niveau_accesses as $index => $niveau_acces) {
            $cout = $couts[$index];

            // Insert the data into the database using the appropriate query
            $coutEvent = CoutEvent::create([
                'evenement_id' => $evenement,
                'niveau_acces_id' => $niveau_acces,// $request->input('libelle'),
                'cout' =>  $cout, //$request->input('cout'),
             ]);
        }
        //$identifiant = Evenement::where('id', $coutEvent->id)->first();
        return redirect()->route('formImage');
    }
    public function createReservationEvent(Request $request)
    {
        $reservation = Session::get('resId');
        $niveau_accesses = $_GET['libelle'];
        $places = $_GET['nbPlaces'];

        // Loop through the selected values of the "libelle" array
        foreach ($niveau_accesses as $index => $niveau_acces) {
            $place = $places[$index];

            // Insert the data into the database using the appropriate query
            $resEvent = ReservationEvents::create([
                'reservation_id' => $reservation,
                'niveau_acces_id' => $niveau_acces,// $request->input('libelle'),
                'nbPlaces' =>  $place, //$request->input('cout'),
             ]);
        }
        //$identifiant = Evenement::where('id', $coutEvent->id)->first();
        return redirect()->route('index');
    }

    public function createImageEvent(Request $request)
    {
        $evenement = Session::get('evenement');
       // $titres = $_FILES['titre'];
        $sponsors = $_POST['nom'];

        // Loop through the selected values of the "libelle" array
        foreach ($sponsors as $sponsor) {
            // Insert the data into the database using the appropriate query
            $sponsorEvent = SponsorEvent::create([
                'evenement_id' => $evenement,
                'sponsor_id' => $sponsor,// $request->input('libelle'),
             ]);
        }
        if ($request->hasFile('titre')) {
            $titres = $request->file('titre');
            foreach ($titres as $titre) {
                // Récupération du fichier image
                $file =$titre;
                $imageName= time().'.'.$file->extension();
                $file->move(public_path('image'),$imageName);
                // Insert the data into the database using the appropriate query
                $image = Image::create([
                    'titre' => $imageName,// $request->input('libelle'),
                 ]);
                 $identifiant = Image::where('id', $image->id)->first();
                $imageEvent = ImageEvent::create([
                    'evenement_id' => $evenement,
                    'image_id' => $identifiant['id'],// $request->input('libelle'),
                 ]);
            }
        }
        if ($request->hasFile('titr')) {
            $titrs = $request->file('titr');
            foreach ($titrs as $titr) {
                $file =$titr;
                // Génération d'un nom de fichier unique pour éviter les doublons
                $videoName= time().'.'.$file->extension();
                $file->move(public_path('videos'),$imageName);

                // Insert the data into the database using the appropriate query
                $video = Video::create([
                    'titre' => $videoName,// $request->input('libelle'),
                 ]);
                 $identifiant = Video::where('id', $image->id)->first();
                $VideoEvent = VideoEvent::create([
                    'evenement_id' => $evenement,
                    'video_id' => $identifiant['id'],// $request->input('libelle'),
                 ]);
            }
        }
        $role = Session::get('role_id');

        if ($role==1 || $role==3) {
            return redirect()->route('index');
        }
        return redirect()->route('index');
    }

    public function allEvents(){
        $evenements = Evenement::with('categorie','utilisateur','entreprise','sponsors', 'images', 'videos', 'niveaux')->get();
        return view('evenements/allEvents', compact('evenements'));
        //dd($evenements[5]->sponsors[0]->nom);
    }

    public function oneEvent($id)
    {
        $evenements = Evenement::with('categorie','utilisateur','entreprise','sponsors', 'images', 'videos', 'niveaux')->get();
        $evenement = $evenements->find($id);
        //dd($evenement->);
            return view('evenements/oneEvent', compact('evenement'));
    }


    public function eventCategory(Categories $category)
    {
        $evenements = $category->evenement()->paginate(10);

        return view('evenements/eventCategory', compact('evenements','category'));
    }

    public function searchEvents(Request $request)
    {
        $search = $request->input('value');

        $evenements = Evenement::where('intitule', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->get();
        //dd($evenements);
        return view('evenements/allEvents', compact('evenements'));
    }

    public function myEvents(User $user)
    {
        $evenements = $user->evenement()->get();
        return view('evenements/eventCategory', compact('evenements','user'));
    }


}
