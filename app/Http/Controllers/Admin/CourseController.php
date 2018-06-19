<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CourseDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use App\Models\Admin\Category;
use App\Repositories\Admin\CourseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Response;
use File;

class CourseController extends AppBaseController
{
    /** @var  CourseRepository */
    private $courseRepository;

    public function __construct(CourseRepository $courseRepo)
    {
        $this->courseRepository = $courseRepo;
    }

    /**
     * Display a listing of the Course.
     *
     * @param CourseDataTable $courseDataTable
     * @return Response
     */
    public function index(CourseDataTable $courseDataTable)
    {
        return $courseDataTable->render('admin.courses.index');
    }

    /**
     * Show the form for creating a new Course.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        $categorias = ['0' => 'Ver Todas'];
        foreach ($categories as $category) {
            $categorias[$category->id] = $category->name;
        }

        return view('admin.courses.create', compact('categorias'));
    }

    /**
     * Store a newly created Course in storage.
     *
     * @param CreateCourseRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseRequest $request)
    {
        $input = $request->all();

        $path = '';

        $course = $this->courseRepository->create($input);

        $course->user_id = Auth::id();

        if($request->hasFile('photo')) {
            $extension = request()->file('photo')->getClientOriginalExtension();

            request()->file('photo')->storeAs('public/images', $course->id . "-" . str_slug($course->title) . "." . $extension);

            $path = "/storage/images/" . $course->id . "-" . str_slug($course->title) . "." . $extension;
        }

        $course->photo = $path;
        $course->save();

        Flash::success('Course saved successfully.');

        return redirect(route('admin.courses.index'));
    }

    /**
     * Display the specified Course.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $course = $this->courseRepository->findWithoutFail($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('admin.courses.index'));
        }

        return view('admin.courses.show')->with('course', $course);
    }

    /**
     * Show the form for editing the specified Course.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $course = $this->courseRepository->findWithoutFail($id);

        if (Auth::user()->hasRole('admin') || Auth::user()->id == $course->user_id) {

        } else {
            return redirect(route('admin.courses.index'));
        }

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('admin.courses.index'));
        }

        $categories = Category::all();
        $categorias = ['0' => 'Ver Todas'];
        foreach ($categories as $category) {
            $categorias[$category->id] = $category->name;
        }

        return view('admin.courses.edit', compact('course', 'categorias'));
    }

    /**
     * Update the specified Course in storage.
     *
     * @param  int              $id
     * @param UpdateCourseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseRequest $request)
    {
        $course = $this->courseRepository->findWithoutFail($id);

        $path = '';

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('admin.courses.index'));
        }

        if($request->hasFile('photo')){
            $extension = request()->file('photo')->getClientOriginalExtension();
            request()->file('photo')->storeAs('public/images',$course->id."-".str_slug($course->title).".".$extension);

            $path = "/storage/images/".$course->id."-".str_slug($course->title).".".$extension;
        }

        $course = $this->courseRepository->update($request->all(), $id);

        $course->update(['photo' => $path]);

        Flash::success('Course updated successfully.');

        return redirect(route('admin.courses.index'));
    }

    /**
     * Remove the specified Course from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $course = $this->courseRepository->findWithoutFail($id);

        if (Auth::user()->hasRole('admin') || Auth::user()->id == $course->user_id) {

        } else {
            return redirect(route('admin.courses.index'));
        }


        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('admin.courses.index'));
        }

        $this->courseRepository->delete($id);

        Flash::success('Course deleted successfully.');

        return redirect(route('admin.courses.index'));
    }
}
