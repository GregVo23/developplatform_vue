<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectUser;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FavoriteApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = [];
        $user_id = [ 'user_id' => auth()->user()->id];
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

            if(!empty($liked)){
                $like = ["like" => true, "nbLike" => $nbLikes];
                $project = json_decode(json_encode($project), true);
                array_push($projects, ($like+$project));
            }
        }

        return json_encode([$projects, $categories,  $subCategories, $user_id]);
    }

    /**
     * Add a project to my favorite.
     *
     * @return \Illuminate\Http\Response
     * @param $id must be the chosen project's id
     */
    public function add($id){

        $user = auth()->user();
        $favorite = ProjectUser::firstOrCreate(
            ['project_id' =>  $id, 'user_id' => $user->id],
            ['created_at' => Carbon::now(), 'project_id' =>  $id, 'user_id' => $user->id],
        );

        $favorite->favorite = !$favorite->favorite;
        if($favorite->save()){
            return response()->json(true, 200);
        }else{
            return response()->json(false, 200);
        }
    }

    /**
     * Remove a project from my favorite.
     *
     * @return \Illuminate\Http\Response
     * @param $id must be the chosen project's id
     */
    public function delete($id){

        $favorite = ProjectUser::where(
            ['project_id' =>  $id],
        )->first();

        $favorite->favorite = !$favorite->favorite;
        if($favorite->delete()){
            return response()->json(true, 200);
        }else{
            return response()->json(false, 200);
        }
    }

    /**
     * Return true if project is liked by connected user.
     *
     * @return \Illuminate\Http\Response
     * @param $id must be the chosen project's id
     */
    public function isLike($id)
    {
        $user_id = auth()->user()->id;
        $like = ProjectUser::where('user_id', '=', $user_id)->where('project_id', '=', $id)->first();
        if($like->favorite == 1){
            return response()->json(true, 200);
        }else{
            return response()->json(false, 200);
        }
    }
}
