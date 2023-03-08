<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends AppBaseController
{

    public function route(Request $request, $first, $second = NULL) 
    {
        $route = $first;
        if(isset($second)) $route .= "/" . $second;

        return view('route')->with(["route" => $route, "title" => $request->title]);
    }
}
