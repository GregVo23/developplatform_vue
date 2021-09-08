<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectUser;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Mail\EmailNotification;
use App\Mail\EmailProject;
use App\Mail\EmailConfirmation;
use App\Models\Subscription;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;



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
        foreach ($listOfProjects as $project) {

            $liked = ProjectUser::where('user_id', '=', $user_id)
                ->where('project_id', '=', $project->id)
                ->where('favorite', '=', 1)
                ->first();

            $nbLikes = DB::table('project_user')
                ->where('favorite', '=', 1)
                ->where('project_id', '=', $project->id)
                ->count();

            if (empty($liked)) {
                $like = ["like" => false, "nbLike" => $nbLikes];
            } else {
                $like = ["like" => true, "nbLike" => $nbLikes];
            }
            $project = json_decode(json_encode($project), true);
            array_push($projects, ($like + $project));
        }

        return json_encode([$projects, $categories,  $subCategories, $user_id]);
    }

    /**
     * Display a listing of my offers
     *
     * @return \Illuminate\Http\Response
     */
    public function showProposal()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $user_id = auth()->user()->id;
        $projects = DB::table('project_user')
            ->join('projects', 'project_user.project_id', '=', 'projects.id')
            ->where('project_user.user_id', '=', $user_id)
            ->where('project_user.proposal', '<>', NULL)
            ->get();

        return json_encode([$projects, $categories, $subCategories, $user_id]);
    }

    /**
     * Accept an offer for my project
     *
     * @return \Illuminate\Http\Response
     */
    public function acceptProposal($id)
    {
        $proposal = ProjectUser::find($id);
        $amount = $proposal->amount;
        $proposal->accepted = true;
        $proposal->save();
        $proposals = ProjectUser::where('project_id', '=', $proposal->project_id)->get();
        foreach ($proposals as $prop){
            if ($prop->id != $proposal->id){
                $prop->proposal = null;
                $prop->amount = null;
                if ($prop->favorite != 1){
                    $prop->delete();
                }
            }
        }
        $project = Project::find($proposal->project_id);
        if (empty($amount)){
            $amount = $project->price;
        }
        $deadline = $project->deadline;
        $user = User::find($proposal->user_id);
        $owner = User::find($project->user_id);
        if ($user->notification == true) {

            // Send notification email to the offer's owner
            $message = "Votre offre de prix a été accepté, le titre du projet est : '$project->name'. Nous vous remercions pour votre confiance et vous souhaitons beaucoup de succès sur Developplatform.";
            $title = "Félicitation, votre offre de prix a été accepté !";
            $name = $user->firstname;
            $email = $user->email;
            $author = $owner->firstname;

            $mailData = [
                'title' => $title,
                'name' => $name,
                'texte' => $email,
                'author' => $author,
                'project' => $project->name,
                'amount' => $amount,
                'email' => $owner->email,
                'phone' => $owner->phone,
                'deadline' => $deadline,
            ];
            Mail::to($email)->send(new EmailProject($mailData));
        }

        if ($project->notifications == true) {

            // Send notification email to the project's owner
            $message = "Vous avez accepté l'offre de prix : '$project->name'. Nous vous remercions pour votre confiance et vous souhaitons beaucoup de succès sur Developplatform.";
            $title = "Vous avez accepté l'offre de prix";
            $name = $owner->firstname;
            $email = $owner->email;
            $mailData = [
                'title' => $title,
                'name' => $name,
                'texte' => $message,
                'email' => $email,
                'author' => $user->lastname,
                'project' => $project->name,
                'deadline' => $deadline,
                'amount' => $amount,
            ];
            Mail::to($email)->send(new EmailConfirmation($mailData));
        }
    }

    /**
     * Refuse an offer for my project
     *
     * @return \Illuminate\Http\Response
     */
    public function refuseProposal($id)
    {
        $proposal = ProjectUser::find($id);
        $proposal->accepted = NULL;
        $proposal->proposal = NULL;
        if ($proposal->favorite == 1){
            $proposal->save();
        } else {
            $proposal->delete();
        }
    }

    /**
     * Display a listing of the user's projects + categories + subcategories, and user's id
     *
     * @return \Illuminate\Http\Response
     */
    public function myProjects()
    {
        $projects = [];
        $user_id = ['user_id' => auth()->user()->id];
        $listOfProjects = Project::where('user_id', $user_id)->get();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        foreach ($listOfProjects as $project) {

            $nbLikes = DB::table('project_user')
                ->where('favorite', '=', 1)
                ->where('project_id', '=', $project->id)
                ->count();

            $like = ["like" => false, "nbLike" => $nbLikes];

            $project = json_decode(json_encode($project), true);
            array_push($projects, ($like + $project));
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

        return json_encode([$categories,  $subCategories, $user]);
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
        $myOffer = ProjectUser::where('user_id', '=', $user->id)->where('project_id', '=', $id)->where('proposal', '<>', NULL)->first();
        if (!empty($myOffer->proposal)) {
            $offer = true;
        } else {
            $offer = false;
        }

        $offers = DB::table('project_user')
        ->join('users', 'users.id', '=', 'project_user.user_id')
        ->where('project_user.project_id', '=', $id)
        ->where('project_user.proposal', '<>', NULL)
        ->select('project_user.id', 'project_user.amount', 'project_user.information', 'project_user.user_id', 'users.rate')
        ->get();

        $category = $project->category->name;
        $categoryDescription = $project->category->description;
        $subCategory = $project->sub_category->name;
        $subCategoryDescription = $project->sub_category->description;

        $picture_path = 'storage/project/cover/' . $project->id . '/';
        $document_path = 'storage/project/doc/' . $project->id . '/';

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
            $subCategoryDescription,
            $offer,
            $offers
        ]);
    }

    /**
     * Accept a specific project for the given price.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $user = auth()->user();

        $subscription = Subscription::firstOrCreate(
            [
                'user_id' =>  $user->id,
            ],
            [
                'user_id' => $user->id,
                'nb_max_projet' =>  "3"
            ],
        );
        $subscription = Subscription::where('user_id', '=', $user->id)->first();
        if ($subscription->nb_max_projet - $subscription->nb_projet >= 1) {
            $subscription->nb_projet++;
            if ($subscription->save()) {

                $project = ProjectUser::firstOrCreate(
                    ['project_id' =>  $id, 'user_id' => $user->id],
                    ['created_at' => Carbon::now(), 'project_id' =>  $id, 'user_id' => $user->id],
                );
                if ($project->project->user_id != $user->id) {
                    $project->proposal = today();
                    $result = $project->save();
                    if ($result) {

                        $project = Project::find($id);
                        $owner = User::find($project->user_id);

                        if ($project->notifications == true) {

                            // Send notification email to the project's owner
                            $message = "Votre projet a été accepté : '$project->name'. Vous pouvez réagir à cette acceptation, la confirmer ou la refuser. Nous vous remercions pour votre confiance et vous souhaitons beaucoup de succès sur Developplatform.";
                            $title = "Vous avez reçu une offre pour votre projet.";
                            $name = $owner->firstname;
                            $email = $owner->email;
                            $mailData = [
                                'title' => $title,
                                'name' => $name,
                                'texte' => $message,
                                'email' => $email,
                            ];
                            Mail::to($email)->send(new EmailNotification($mailData));
                        }
                        Session::flash('success', 'Votre demande pour ce projet a été envoyée, attendez maintenant la confirmation');
                        return response()->json(['success' => 'Votre demande a été envoyée, attendez maintenant la confirmation'], 200);
                    } else {
                        Session::flash('message', 'Une erreur est survenue, veuillez réessayer plus tard !');
                        return response()->json(['error' => 'Vous ne pouvez pas accepter ce projet'], 500);
                    }
                } else {
                    Session::flash('message', 'Vous ne pouvez pas accepter ce projet car vous en ête l\'auteur');
                    return response()->json(['error' => 'Vous ne pouvez pas accepter ce projet car vous en ête l\'auteur'], 401);
                }
            } else {
                Session::flash('message', 'Vous ne disposer plus d\'action pour effectuer cette requete, modifiez votre abonnement !');
                return response()->json(['error' => "Un problème inatendu est survenu ! Désolé, revenez plus tard ..."], 500);
            }
        } else {
            Session::flash('message', 'Vous ne disposer plus d\'action pour effectuer cette requete, modifiez votre abonnement !');
            return response()->json(['error' => "Vous ne disposer plus d\'action pour effectuer cette requete, modifiez votre abonnement !"], 401);
        }
    }


    /**
     * Make an offer for a specific project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function offer(Request $request, $id)
    {
        $user = auth()->user();

        $subscription = Subscription::firstOrCreate(
            [
                'user_id' =>  $user->id,
            ],
            [
                'user_id' => $user->id,
                'nb_max_projet' =>  "3"
            ],
        );
        $subscription = Subscription::where('user_id', '=', $user->id)->first();
        if ($subscription->nb_max_projet - $subscription->nb_projet >= 1) {
            $subscription->nb_projet++;
            if ($subscription->save()) {

                // validate
                $rules = array(

                    'information' => 'required|min:20|max:1000',
                    'amount' => 'required|numeric',
                );
                $validator = Validator::make($request->all(), $rules);

                // process
                if ($validator->fails()) {
                    Session::flash('message', "Une erreur est survenue lors de l'enregistrement due a une validation de donnée incorrecte");
                    return response()->json(['error' => "Une erreur est survenue lors de l'enregistrement due a une validation de donnée incorrecte"], 401);
                } else {
                    $offer = ProjectUser::firstOrCreate(
                        [
                            'project_id' =>  $id,
                            'user_id' => $user->id,
                            'information' => htmlentities($request->input('information')),
                            'amount' => $request->input('amount'),
                        ],
                        [
                            'created_at' => Carbon::now(),
                            'project_id' =>  $id,
                            'user_id' => $user->id,
                            'information' => htmlentities($request->input('information')),
                            'amount' => $request->input('amount'),
                        ],
                    );

                    if ($offer->project->user_id != $user->id) {
                        $offer->proposal = today();
                        $result = $offer->save();
                        if ($result) {
                            $project = Project::find($id);
                            if ($project->notifications == true) {
                                $owner_id =  $project->user_id;
                                $owner = User::find($owner_id);
                                // Send notification email to the project's owner
                                $message2 = "Une proposition d'un montant de $request->amount € a été reçu pour votre projet : $project->name . Vous pouvez réagir à cette offre, l'accepter ou la refuser. Nous vous remercions pour votre confiance et vous souhaitons beaucoup de succès sur Developplatform.";
                                $title2 = "Vous avez reçu une offre pour votre projet.";
                                $name2 = $owner->firstname;
                                $email2 = $owner->email;
                                $mailData2 = [
                                    'title' => $title2,
                                    'name' => $name2,
                                    'texte' => $message2,
                                    'email' => $email2,
                                ];
                                Mail::to($email2)->send(new EmailNotification($mailData2));
                            } else {
                                // Notification to the project's owner -> you have an new offer 
                            }
                            $request->session()->regenerate();
                            Session::flash('success', "Votre proposition d'un montant de $request->amount € a été envoyée, attendez maintenant l'email de réponse");
                            return response()->json(['success' => "Votre proposition d'un montant de $request->amount € a été envoyée, attendez maintenant l'email de réponse"], 200);
                        }
                    } else {
                        $request->session()->regenerate();
                        Session::flash('message', 'Une erreur est survenue, veuillez réessayer plus tard !');
                        return response()->json(['errors' => "Une erreur est survenue, veuillez réessayer plus tard !"], 500);
                    }
                }
            }
        } else {
            $request->session()->regenerate();
            Session::flash('message', 'Vous ne disposer plus d\'action pour effectuer cette requete, modifiez votre abonnement !');
            return response()->json(['errors' => "Vous ne disposer plus d\'action pour effectuer cette requete, modifiez votre abonnement !"], 401);
        }
    }


    /**
     * Cancel my project's offer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, $id)
    {
        $user = Auth()->user();
        $offer = ProjectUser::where('user_id', '=', $user->id)->where('project_id', '=', $id);
        $result = $offer->delete();
        if ($result) {
            return true;
        } else {
            return response()->json(['errors' => 'Un problème est survenu, impossible de supprimer votre offre. Veuillez réessayer plus tard.'], 500);
        }
    }


    /**
     * Store a newly created project in storage.
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

        if ($validator->fails()) {
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

            if ($request->hasFile('picture')) {

                $file = $request->file('picture');
                // Get filename with the extension
                $filenameWithExt = $file->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $file->extension();
                // here is the current date time timestamp
                $time = date("d-m-Y") . "-" . time();
                // Filename to store
                $fileNameToStore = $filename . '_' . $time . '.' . $extension;
                // Upload Image

                // Save XL Project image
                $path = 'public/project/cover/' . $project->id;
                $file->storeAs($path, $fileNameToStore);

                $cover = Image::make($file);
                // resize image to fixed size
                $cover->resize(null, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // Save small project image
                $cover->save(public_path('/project/cover/' . $fileNameToStore));

                $project->picture = $fileNameToStore;
                $project->save();
            }

            //return response()->json($request->file('document'));

            if (!empty($request->file('document'))) {

                $documents = [];
                foreach ($request->file('document') as $file) {
                    if (is_object($file) && $file->isValid()) {


                        $filenameWithExt = $file->getClientOriginalName();
                        // Get just filename
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        // Get just ext
                        $extension = $file->extension();
                        // Filename to store
                        $fileNameToStore = $filename . '_' . $project->id . '.' . $extension;
                        // Save link
                        $path = $file->storeAs('public/project/doc/' . $project->id, $fileNameToStore);

                        array_push($documents, $fileNameToStore);
                    }
                }
                $project->document = json_encode($documents);
                $project->save();
            }

            if ($result) {
                return true;
            } else {
                return response()->json(['errors' => 'Un problème est survenu, veuillez réessayer plus tard.'], 500);
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (Auth::check()) {
            $user_id = auth()->user()->id;
            $project = Project::find($id);
            if ($user_id == $project->user_id) {
                $name = $project->name;
                $message = "Vous avez supprimer le projet : " . $name . " !";
                $picture_path = '/storage/project/cover/' . $project->id;
                $document_path = '/storage/project/doc/' . $project->id;

                if (File::exists(public_path($picture_path . '/' . $project->picture))) {
                    //Delete small project image
                    File::delete(public_path($picture_path . '/' . $project->picture));
                    //Delete XL project image
                    File::delete(public_path('/project/cover/' . $project->picture));
                    //Delete all directories
                    File::deleteDirectory(public_path($picture_path));
                    File::deleteDirectory(public_path('storage/project/cover/' . $project->user_id));
                }

                if (!empty($project->document)) {
                    $documents = json_decode($project->document);
                    foreach ($documents as $document) {
                        if (File::exists(public_path($document_path . '/' . $document))) {
                            File::delete(public_path($document_path . '/' . $document));
                            File::deleteDirectory(public_path($document_path));
                            File::deleteDirectory(public_path('storage/project/doc/' . $project->user_id));
                        }
                    }
                }
                //Projet supprimer avec succes
                $project->delete();
            } else {
                //Seul l'auteur peut supprimer son projet
            }
            //$request->session()->regenerate();
            //Session::flash('success', $message);
            //return Redirect::to('dashboard')->with('success', $message);
        } else {
            //return back();
        }
    }
}
