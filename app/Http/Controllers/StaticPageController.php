<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function rules() {
      return view('static.rules');
    }

    public function works() {
      return view('static.works');
    }
}
