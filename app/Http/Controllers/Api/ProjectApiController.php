<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectUser;
use App\Models\SubCategory;
use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        // validate
        
        $rules = array(

            'name' => 'required|string|min:3',
            'about' => 'required|min:20|max:2000',
            'user_id' => 'required|numeric',
            'price' => 'numeric|nullable',
            'phone' => 'numeric|nullable',
            'email' => 'required|string|email',
            'picture' => 'nullable|image|mimes:jpeg,jpg,png',
            'document' => 'nullable|max:20000',
            'deadline' => 'nullable|date|after:tomorrow',
            'category_id' => 'required|numeric',
            'sub_category_id' => 'nullable|numeric',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'street' => 'nullable|string',
            'number' => 'nullable|numeric',
            'zipcode' => 'nullable|numeric',
            'rules' => 'nullable',
            'notifications' => 'nullable',
        );
        $validator = Validator::make($request->all(), $rules);

        // process

            if($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                $user_id = $request->user_id;               

                $project = new Project;
                $project->user_id = $request->user_id;
                $project->category_id = $request->category_id;
                $project->sub_category_id = $request->sub_category_id;
                $project->name = ucfirst($request->name);
                $project->about = ucfirst($request->about);
                $project->price = $request->price;
                $project->phone = $request->phone;
                $project->deadline = $request->deadline;
                $project->email = $request->email;
                $project->country = ucfirst($request->country);
                $project->city = ucfirst($request->city);
                $project->zipcode = $request->zipcode;
                $project->number = $request->number;
                $project->street = $request->street;
                $project->notifications = $request->notifications ? true : false;
                $project->rules = $request->rules ? true : false;

                $result = $project->save();

                $project = Project::find($project->id);

                if($request->hasFile('picture')){

                    $file = $request->file('picture');
                    // Get filename with the extension
                    $filenameWithExt = $file->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $file->extension();
                    // here is the current date time timestamp
		            $time = date("d-m-Y")."-".time();
                    // Filename to store
                    $fileNameToStore = $filename.'_'.$time.'.'.$extension;
                    // Upload Image

                    // Save XL Project image
                    $path = 'public/project/cover/'.$project->id;
                    $file->storeAs($path ,$fileNameToStore);

                     $cover = Image::make($file);
                    // resize image to fixed size
                    $cover->resize(null, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // Save small project image
                    $cover->save(public_path('/project/cover/'.$fileNameToStore));

                    $project->picture = $fileNameToStore;
                    $project->save();
                }

                //return response()->json($request->file('document'));
                
                if(!empty($request->file('document'))){
                    
                    $documents = [];
                    foreach ($request->file('document') as $file){
                        if(is_object($file) && $file->isValid()){
                            

                            $filenameWithExt = $file->getClientOriginalName();
                            // Get just filename
                            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                            // Get just ext
                            $extension = $file->extension();
                            // Filename to store
                            $fileNameToStore = $filename.'_'.$user_id.'.'.$extension;
                            // Save link
                            $path = $file->storeAs('public/project/doc/'.$user_id.'/'.$project->id,$fileNameToStore);

                            array_push($documents, $fileNameToStore);
                        }
                    }
                    $project->document = json_encode($documents);
                    $project->save();
                }

                if ($result){
                    return true;
                } else {
                    return response()->json(['errors' => 'Un problème est survenu, veuillez réessayer plus tard.'], 500);
                }
        }

    }
}
