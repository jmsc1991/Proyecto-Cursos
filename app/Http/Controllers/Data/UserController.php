<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser()
    {
        $user = Auth::user();

        return $user;
    }

    public function puedeVer($id)
    {
        $user = Auth::user();

        if ($user->subscription) {
            return response()->json(true);
        }
    }
}
