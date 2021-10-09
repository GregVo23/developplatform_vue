<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
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
     * @return \Illuminate\View
     */
    public function welcome()
    {
        // 3 examples of project
        $projects = Project::take(3)->get();

        $nbProjects = Project::where('done', '=', NULL)->get()->count();
        $nbOffer = ProjectUser::where('proposal', '!=', NULL)->get()->count();
        if (!empty($nbProjects) && !empty($nbOffer)) {
            $pourcentage = $nbOffer / $nbProjects * 100;
        } else {
            $pourcentage = 85;
        }
        $ratings = Rating::where('rate', '!=', NULL)->get();
        $nbRate = $ratings->count();
        $avgRate = [];
        $satisfaction = "";

        foreach($ratings as $rate){
            array_push($avgRate, $rate->rate);
        }
        if (array_sum($avgRate) != 0 && $nbRate != 0){
            $satisfaction = array_sum($avgRate) / $nbRate;
        } else {
            $satisfaction = 91;
        }

        return view('welcome', [
            'projects' => $projects,
            'withoutOffer' => $nbProjects,
            'pourcentage' => $pourcentage,
            'satisfaction' => $satisfaction,
        ]);
    }

    /**
     * Display 3 project on the maker's page.
     *
     * @return \Illuminate\View
     */
    public function maker()
    {
        // 3 examples of project
        $projects = Project::take(3)->get();

        return view('maker', [
            'projects' => $projects,
        ]);
    }

    /**
     * Display 3 project on the maker's page.
     *
     * @return \Illuminate\View
     */
    public function customer()
    {
        // 3 examples of project
        $projects = Project::take(3)->get();

        return view('customer', [
            'projects' => $projects,
        ]);
    }
}
