<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Project;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserApiController extends Controller
{
    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return view('dashboard', [
            'user' => $user,
            'personalUserPage' => true,
        ]);
    }

    /**
     * Upload user avatar.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveAvatar(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:8000'
        ]);

        $user_id = Auth()->user()->id;

        if ($user_id == $id){
            $user = User::find($id);

            if ($request->file()) {
                $file_name = time() . '_' . $request->file->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('avatar/' . $user->id, $file_name, 'public');

                $user->avatar = '/storage/' . $file_path;
                $result = $user->save();
                if ( $result){
                    return response()->json($request->all());
                } else {
                    return response()->json(['error' => 'Un problème est survenu !'], 500);
                }
            } else {
                return response()->json(['error' => 'Un problème est survenu, absence de fichiers !'], 500);
            }
        } else {
            return response()->json(['error' => 'Seul le propriétaire peut changer son avatar !'], 422);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth()->user();
        $myProjects = Project::where('user_id', '=', $user->id)->where('done', '=', NULL)->get();
        $myProjectsDone = Project::where('user_id', '=', $user->id)->where('done', '!=', NULL)->get();
        $sinds = $user->created_at->diffForHumans();
        $subscribtion = DB::table('subscriptions')->where('user_id', '=', $user->id)->first();

        return json_encode([$myProjectsDone, $myProjects, $user, $sinds, $subscribtion]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMe()
    {
        $user = Auth()->user();
        $myProjects = Project::where('user_id', '=', $user->id)->where('done', '=', NULL)->get();
        $myProjectsDone = Project::where('user_id', '=', $user->id)->where('done', '!=', NULL)->get();

        return view("user.show", [
            "user" => $user,
            "myProjects" => $myProjects,
            "myProjectsDone" => $myProjectsDone,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth()->user()->id;
        if ($userId == $id){
            $user = User::findOrFail($id);

            $projects = $user->projects;
            foreach ($projects as $project){

                //Delete all user data
                $picture_path = '/storage/project/cover/'. $project->id;
                $document_path = '/storage/project/doc/'. $project->id;

                //Pictures
                if (File::exists(public_path($picture_path . '/' . $project->picture))) {
                    //Delete small project image
                    File::delete(public_path($picture_path . '/' . $project->picture));
                    //Delete XL project image
                    File::delete(public_path('/project/cover/' . $project->picture));
                    //Delete all directories
                    File::deleteDirectory(public_path($picture_path));
                    File::deleteDirectory(public_path('storage/project/cover/' . $project->user_id));
                }

                //Documents
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
                $project->delete();

                //Avatar
                if (File::exists(public_path($user->avatar))) {
                    //Delete small project image
                    File::delete(public_path($user->avatar));
                    //Delete all directories
                    File::deleteDirectory(public_path($user->avatar. '/' . $user->id));
                }
            }
            
            $result = $user->delete();
            if ($result){
                Session::flash('success', "L'utilisateur est désormais supprimé avec succés.");
                return response()->json(['success' => "L'utilisateur est désormais supprimé avec succés."], 200);
            } else {
                return response()->json(['errors' => 'Un problème est survenu lors de la suppression de l\'utilisateur.'], 500);
            }
        } else {
            return response()->json(['errors' => 'Impossible de supprimer un compte hors que le sien.'], 422);
        }
    }
}
