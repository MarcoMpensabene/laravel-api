<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with("user", "type", "technologies")->paginate(5); // lazy loading 5 elementi per pagina , nel with aggiungiamo le relazioni con le altre risorse
        // $project = Project::all(); // ? Tutti i progetti quindi eager loading
        return response()->json(
            [
                'success' => true,
                'results' => $projects,
            ]
        ); // ! Ritrona un json
    }

    public function show(string $id)
    {
        $projects = Project::with("user", "type", "technologies")->findOrfail($id); //Senza
        // $project = Project::all(); // ? Tutti i progetti quindi eager loading
        //  ! (Project $project)|argomento funzione| $projects->loadMissing("user", "type" , "technologies"); se voglio usare la  dependency
        return response()->json(
            [
                'success' => true,
                'results' => $projects,
            ]
        );
    }
    public function projectSearch(Request $request)
    {

        $data = $request->all();
        $projects = Project::where("title", "LIKE", "%" . $data["title"] . "%")->get(); // con questa stringa stiamo chiedendo di ritornare solo gli elementi hanno un corrispondenza con il title in questo caso
        return response()->json(
            [
                'success' => true,
                'results' => $projects,
            ]
        );
    }
}
