<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    //
    public function process(Request $req):String {

        dd($req->allFiles(), $req->hasFile('docs'));
    }
}
