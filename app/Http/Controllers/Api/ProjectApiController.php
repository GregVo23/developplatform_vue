<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;

class ProjectApiController extends Controller
{
    /**
     * Display a listing of the projects + categories + subcategories, and user's id
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = [];
        $user_id = ['user_id' => auth()->user()->id];
        $listOfProjects = Project::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        foreach($listOfProjects as $project){

            $liked = ProjectUser::where('user_id', '=', $user_id)
            ->where('project_id', '=', $project->id)
            ->where('favorite', '=', 1)
            ->first();

            $nbLikes = DB::table('project_user')
            ->where('favorite', '=', 1)
            ->where('project_id', '=', $project->id)
            ->count();

            if(empty($liked)){
                $like = ["like" => false, "nbLike" => $nbLikes];
            }else{
                $like = ["like" => true, "nbLike" => $nbLikes];
            }
            $project = json_decode(json_encode($project), true);
            array_push($projects, ($like+$project));
        }

        return json_encode([$projects, $categories,  $subCategories, $user_id]);
    }


    /**
     * Show the form for creating a new project.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return json_encode([ $categories,  $subCategories, $user]);
    }
}
