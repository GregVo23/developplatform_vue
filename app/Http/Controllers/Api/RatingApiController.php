<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use App\Models\Rating;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class RatingApiController extends Controller
{
    /**
     * Give a rating to a project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  project_id  $id
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request, $id)
    {
      if(Auth::check()){
        $user_id = Auth()->user()->id;
        $project = Project::find($id);
        $maker_id = $project->maker();
        $user = User::find($maker_id);
        $rate = Rating::create([
          'user_id' => $user_id,
          'project_id' => $project->id,
        ]);
        $rate->about = $request->input('about');
        $rate->rate = $request->input('rate');
        $ratings = $user->ratings;
        $test = ""; /////////////////////////
        if ($ratings){
          $test = "111";
          $avgRating = [];
          foreach($ratings as $rating){
            array_push($avgRating, $rating->rate);
          }
          if (array_sum($avgRating) != 0 && count($avgRating) != 0){
            $test = "222";
            $avgRating = array_sum($avgRating) / count($avgRating) + 1;
            $user->rate = $avgRating;
            $user->save();
          } else {
            $test = "333";
            $user->rate = $request->input('rate');
            $user->save();
          }
        } else {
          $test = "444";
          $user->rate = $request->input('rate');
          $user->save();
        }
        $result = $rate->save();

        if ($result){
          return response()->json([
            'message' => 'Vous avez noté la réalisation du projet.'.$test,
            'type' => 'success',
          ], 200);
        } else {
          return response()->json([
              'message' => 'Un problème est survenu, veuillez réessayer plus tard.',
              'type' => 'errors',
          ], 500);
        }
      } else {
        return response()->json([
            'message' => 'Vous n\êtes pas connecté',
            'type' => 'errors',
        ], 422);
      }
    }
}
