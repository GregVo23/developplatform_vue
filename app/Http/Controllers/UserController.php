<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserController extends Controller
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

        return view('dashboard',[
            'user' => $user,
            'personalUserPage' => true,
        ]);
    }

    /**
     * Upload user avatar.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveAvatar(Request $request)
    {
        $request->validate([
           'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
        ]);

        $fileUpload = Auth()->user;


        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

            $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
            $fileUpload->avatar = '/storage/' . $file_path;
            $fileUpload->save();

            return response()->json(['success'=>'File uploaded successfully.']);
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
    public function show($id)
    {
        $user = Auth()->user();
        $myProjects = Project::where('user_id', '=', $user->id)->where('done', '=', NULL)->get();
        $myProjectsDone = Project::where('user_id', '=', $user->id)->where('done', '!=', NULL)->get();

        return view("user.show",[
            "user" => $user,
            "myProjects" => $myProjects,
            "myProjectsDone" => $myProjectsDone,
        ]);
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

        return view("user.show",[
            "user" => $user,
            "myProjects" => $myProjects,
            "myProjectsDone" => $myProjectsDone,
        ]);
    }
}
