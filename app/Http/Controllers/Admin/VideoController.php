<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\VideoDataTable;
use App\Repositories\Admin\VideoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\Course;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\CreateVideoRequest;
use App\Http\Requests\Admin\UpdateVideoRequest;


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
        $cursos = Course::all();
        if (Auth::user()->hasRole('teacher')){
            $teacher = Auth::user()->id;

            $cursos = Course::where('user_id','=',$teacher)->get();
        }

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
    public function store(CreateVideoRequest $request)
    {
        $request['url'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube-nocookie.com/embed/$1",$request['url']);

        $input = $request->all();

        $video = $this->videoRepository->create($input);

        $video->save();

        Flash::success('Video saved successfully.');

        return redirect(route('admin.videos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = $this->videoRepository->findWithoutFail($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('admin.videos.index'));
        }

        return view('admin.videos.show')->with('video',$video);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $video = $this->videoRepository->findWithoutFail($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('admin.videos.index'));
        }

        $video['url'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube-nocookie.com\/embed\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/watch\?v=$1",$video['url']);

        $cursos = Course::all();

        if (Auth::user()->hasRole('teacher')){
            $teacher = Auth::user()->id;

            $cursos = Course::where('user_id','=',$teacher)->get();
        }


        $courses = ['0' => 'Ver Cursos'];
        foreach ($cursos as $curso) {
            $courses[$curso->id] = $curso->title;
        }

        return view('admin.videos.edit',compact('video','courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateVideoRequest $request)
    {
        $request['url'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube-nocookie.com/embed/$1",$request['url']);

        $video = $this->videoRepository->findWithoutFail($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('admin.videos.index'));
        }

        $video = $this->videoRepository->update($request->all(),$id);

        Flash::success('Video updated successfully.');

        return redirect(route('admin.videos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = $this->videoRepository->findWithoutFail($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('admin.videos.index'));
        }

        $this->videoRepository->delete($id);

        Flash::success('Video deleted successfully.');

        return redirect(route('admin.videos.index'));
    }
}
