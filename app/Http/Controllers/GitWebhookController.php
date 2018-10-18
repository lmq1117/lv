<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GitWebhookController extends Controller
{
    //
    public function pull(Request $request){
        $secret = 'laravelvuegit';
        //dd($request->all());
        Log::info(json_encode($request->all()));
    }
}
