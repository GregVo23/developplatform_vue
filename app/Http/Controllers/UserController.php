<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserController extends Controller
{
    /**
     * Logout the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Redirection
     * @return Flash message
     */
    public function logout(Request $request)
    {
        $request->session()->regenerate();
        $request->session()->flush();
        Session::flash('success', "Vous êtes déconnecté du site.");
        return redirect('/');
    }


    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View
     */
    public function show($id)
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
}
