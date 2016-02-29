<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use GrahamCampbell\GitHub\Facades\GitHub;

class MeController extends Controller
{
    public function repos() {
      return response()->json(Github::api('user')->repositories(Auth::user()->github_username));
    }
}
