<?php

namespace App\Http\Controllers\Data;

use App\Http\Resources\VideoDetalleResource;
use App\Models\Admin\Comment;
use App\Models\Admin\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function verVideo($id)
    {
        $video = Video::where('id', $id)->first();

        if ($video) {
            return new VideoDetalleResource($video);
        }
    }

    public function comentar(Request $request, $id)
    {
        $comentario = new Comment();
        $comentario->content = $request->comentario;
        $comentario->video_id = $id;
        $comentario->user_id = Auth::user()->id;
        $comentario->save();
    }
}
