<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CommentsDataTable;
use App\Repositories\Admin\CommentsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CommentController extends AppBaseController
{
    private $commentsRepository;

    public function __construct(CommentsRepository $commentsRepo)
    {
        $this->commentsRepository = $commentsRepo;
    }

    public function index(CommentsDataTable $commentsDataTable)
    {
        return $commentsDataTable->render('admin.comments.index');
    }


    public function destroy($id)
    {
        $comments = $this->commentsRepository->findWithoutFail($id);

        if (empty($comments)) {
            Flash::error('Comments not found');

            return redirect(route('admin.comments.index'));
        }

        $this->commentsRepository->delete($id);

        Flash::success('Comments deleted successfully.');

        return redirect(route('admin.comments.index'));
    }
}
