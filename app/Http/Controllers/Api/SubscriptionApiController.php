<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Auth;
use App\Models\Project;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Http\Controllers\Controller;

class SubscriptionApiController extends Controller
{
    /**
     * Display a listing of the projects + categories + subcategories, and user's id
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user();

        return json_encode([$user]);
    }

}
