<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectUser;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display 3 project on the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        // 3 examples of project
        $projects = Project::take(3)->get();   //TODO only project with a picture

        // offers/projects
        $nbProjects = Project::where('done','=',NULL)->get()->count();
        $nbOffer = ProjectUser::where('proposal','!=',NULL)->get()->count();
        if(!empty($nbProjects) && !empty($nbOffer)){
            $pourcentage = $nbOffer/$nbProjects*100;
        }else{
            $pourcentage = 85;
        }

        return view('welcome', [
            'projects' => $projects,
            'withoutOffer' => $nbProjects,
            'pourcentage' => $pourcentage,
        ]);
    }

}
