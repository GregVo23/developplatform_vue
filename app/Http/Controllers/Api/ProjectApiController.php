<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectUser;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Hamcrest\Arrays\IsArray;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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


    /**
     * Show a project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth()->user();
        $project = Project::find($id);
        $owner = User::find($project->user_id);
        $category = $project->category->name;
        $categoryDescription = $project->category->description;
        $subCategory = $project->sub_category->name;
        $subCategoryDescription = $project->sub_category->description;

        $picture_path = 'storage/project/cover/'.$project->user_id.'/'.$project->id.'/';
        $document_path = 'storage/project/doc/'.$project->user_id.'/'.$project->id.'/';

        //$file = File::get(public_path($picture_path.'/'.$project->picture));
        $documents = Json_decode($project->document);
        //$file = Storage::get('file.jpg');

        return json_encode([
            $project,
            $user,
            $owner,
            $picture_path,
            $document_path,
            $documents,
            $category,
            $subCategory,
            $categoryDescription,
            $subCategoryDescription
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datas = $request;

        // $user_id = auth()->user()->id;
        // validate
        
        $rules = array(

            '*.titleName' => 'required|string|min:3',
            '*.about' => 'required|min:20|max:2000',
            '*.price' => 'numeric|nullable',
            '*.phone' => 'numeric|nullable',
            '*.email' => 'required|string|email',
            //'*.picture' => 'nullable|image|mimes:jpeg,jpg,png',
            //'*.document' => 'nullable|max:20000',
            '*.deadline' => 'nullable|date|after:tomorrow',
            '*.category_id' => 'required|numeric',
            '*.sub_category_id' => 'nullable|numeric',
            '*.country' => 'nullable|string',
            '*.city' => 'nullable|string',
            '*.street' => 'nullable|string',
            '*.number' => 'nullable|numeric',
            '*.zipcode' => 'nullable|numeric',
            '*.rules' => 'nullable',
            '*.notifications' => 'nullable',
        );
        $validator = Validator::make($request->all(), $rules);

        // process

            if($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                

                $project = new Project;
                $project->user_id = $datas['project']['user_id'];
                $project->category_id = $datas['project']['category_id'];
                $project->sub_category_id = $datas['project']['sub_category_id'];
                $project->name = ucfirst($datas['project']['titleName']);
                $project->about = ucfirst($datas['project']['about']);
                $project->price = $datas['project']['price'];
                //$project->document = $datas['project']['document'];
                //$project->picture = $datas['project']['picture'];
                $project->phone = $datas['project']['phone'];
                $project->deadline = $datas['project']['deadline'];
                $project->email = $datas['project']['email'];
                $project->country = ucfirst($datas['project']['country']);
                $project->city = ucfirst($datas['project']['city']);
                $project->zipcode = $datas['project']['zipcode'];
                $project->number = $datas['project']['number'];
                $project->street = $datas['project']['street'];
                $project->notifications = $datas['project']['notifications'] ? true : false;
                $project->rules = $datas['project']['rules'] ? true : false;

                $result = $project->save();



                //dd($request->all());
                //dd($datas['about']);
                return response()->json($datas['project']);

        }

        //return $request->all();


}
}
