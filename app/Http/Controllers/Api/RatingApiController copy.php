<?php

namespace App\Http\Controllers\Api;


use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class RatingApiController extends Controller
{
    /**
     * Make a rating.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request, $id)
    {
      // TODO
      return $request()->all();
    }
}
