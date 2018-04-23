<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CategoriesDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use App\Repositories\Admin\CategoriesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class categoriesController extends AppBaseController
{
    /** @var  categoriesRepository */
    private $categoriesRepository;

    public function __construct(categoriesRepository $categoriesRepo)
    {
        $this->categoriesRepository = $categoriesRepo;
    }

    /**
     * Display a listing of the categories.
     *
     * @param categoriesDataTable $categoriesDataTable
     * @return Response
     */
    public function index(categoriesDataTable $categoriesDataTable)
    {
        return $categoriesDataTable->render('admin.categories.index');
    }

    /**
     * Show the form for creating a new categories.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created categories in storage.
     *
     * @param CreateCategoriesRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoriesRequest $request)
    {
        $input = $request->all();

        $categories = $this->categoriesRepository->create($input);

        Flash::success('Categories saved successfully.');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified categories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categories = $this->categoriesRepository->findWithoutFail($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('admin.categories.index'));
        }

        return view('admin.categories.show')->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified categories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categories = $this->categoriesRepository->findWithoutFail($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('admin.categories.index'));
        }

        return view('admin.categories.edit')->with('categories', $categories);
    }

    /**
     * Update the specified categories in storage.
     *
     * @param  int              $id
     * @param UpdateCategoriesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoriesRequest $request)
    {
        $categories = $this->categoriesRepository->findWithoutFail($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('admin.categories.index'));
        }

        $categories = $this->categoriesRepository->update($request->all(), $id);

        Flash::success('Categories updated successfully.');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified categories from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categories = $this->categoriesRepository->findWithoutFail($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('admin.categories.index'));
        }

        $this->categoriesRepository->delete($id);

        Flash::success('Categories deleted successfully.');

        return redirect(route('admin.categories.index'));
    }
}
