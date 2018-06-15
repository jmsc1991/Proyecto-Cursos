<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\VideoDataTable;
use App\Models\Admin\Video;
use App\Repositories\Admin\VideoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\Course;
use Illuminate\Support\Facades\Auth;


class VideoController extends AppBaseController
{
    private $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }


    public function index(VideoDataTable $videoDataTable)
    {
        return $videoDataTable->render('admin.videos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('teacher')){
            $teacher = Auth::user()->id;
            $cursos = Course::where('id = '.$teacher);
        }
        $cursos = Course::all();

        $courses = ['0' => 'Ver Cursos'];
        foreach ($cursos as $curso) {
            $courses[$curso->id] = $curso->title;
        }
        return view('admin.videos.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
