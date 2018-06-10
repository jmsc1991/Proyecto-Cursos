<?php

namespace App\Http\Controllers\Data;

use App\Models\Admin\Course;
use App\Models\Admin\User;
use App\Models\Admin\UserCourse;
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
        $user = User::find(Auth::user()->id);

        if ($user->subscription) {
            return response()->json(true);
        } else {
            $cursos = UserCourse::where('user_id', $user->id)->get();
            foreach ($cursos as $curso) {
                if ($curso->course_id == $id) {
                    return response()->json(true);
                }
            }
        }
    }
}
