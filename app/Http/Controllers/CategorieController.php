<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\Categories;
use App\Models\NiveauAcces;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function addCategorie(Request $request)
    {
        $request->validate(['libelle' => 'required|unique:categories,libelle']);

        $categorie = new Categories(['libelle' => $request->libelle]);
        $categorie->save();
        return redirect()->route('formEvent');
    }

    public function addNivAcces(Request $request)
    {
        $request->validate(['libelle' => 'required|unique:niveau_acces,libelle']);

        $nivacces = new NiveauAcces(['libelle' => $request->libelle]);
        $nivacces->save();
        return redirect()->route('formCoutEvent');
    }
    public function addSponsor(Request $request)
    {
        $request->validate(['nom' => 'required|unique:sponsors,nom']);

        $sponsor = new Sponsor(['nom' => $request->nom]);
        $sponsor->save();
        return redirect()->route('formImage');
    }

    
}
