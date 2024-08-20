<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::paginate(5); // lazy loading 5 elementi per pagina
        // $project = Project::all(); // ? Tutti i progetti quindi eager loading
        return response()->json($project); // ! Ritrona un json
    }

    public function show(Project $project) {}
}
