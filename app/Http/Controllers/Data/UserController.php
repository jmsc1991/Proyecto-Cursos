<?php

namespace App\Http\Controllers\Data;

use App\Models\Admin\Course;
use App\Models\Admin\User;
use App\Models\Admin\UserCourse;
use App\Models\Admin\Video;
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

    public function puedeVerVideo($id)
    {
        $user = Auth::user();

        if ($user) {
            $user = User::find($user->id);
        }

        $video = Video::find($id);


        if ($video->free) {
            return response()->json(true);
        } else if ($user) {
            $cursos = UserCourse::where('user_id', $user->id)->get();
            foreach ($cursos as $curso) {
                if ($curso->course_id == $video->course_id) {
                    return response()->json(true);
                }
            }
        }
    }
}
