<?php

namespace App\Http\Controllers\Api;


use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ReportApiController extends Controller
{
    /**
     * Make a report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request, $id)
    {
      // TODO
      return $request()->all();
    }
}
