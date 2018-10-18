<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GitWebhookController extends Controller
{
    //
    public function pull(Request $request){
        $secret = 'laravelvuegit';
        dd($request->all());
    }
}
