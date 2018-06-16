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

    public function show($id)
    {
        $comment = $this->commentsRepository->findWithoutFail($id);

        if (empty($comment)) {
            Flash::error('Comment not found');

            return redirect(route('admin.comments.index'));
        }

        return view('admin.comments.show')->with('comment', $comment);
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
