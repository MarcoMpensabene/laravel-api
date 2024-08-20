<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::with("user", "type", "technologies")->paginate(5); // lazy loading 5 elementi per pagina , nel with aggiungiamo le relazioni con le altre risorse
        // $project = Project::all(); // ? Tutti i progetti quindi eager loading
        return response()->json(
            [
                'success' => true,
                'results' => $project,
            ]
        ); // ! Ritrona un json
    }

    public function show(string $id)
    {
        $project = Project::with("user", "type", "technologies")->findOrfail($id);
        // $project = Project::all(); // ? Tutti i progetti quindi eager loading
        return response()->json(
            [
                'success' => true,
                'results' => $project,
            ]
        );
    }
}
