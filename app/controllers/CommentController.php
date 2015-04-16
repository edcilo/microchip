<?php

use microchip\comment\CommentRepo;
use microchip\company\CompanyRepo;
use microchip\sale\SaleRepo;
use microchip\user\UserRepo;

use microchip\comment\CommentRegManager;

class CommentController extends \BaseController {

    protected $commentRepo;
    protected $companyRepo;

    public function __construct(
        CommentRepo $commentRepo,
        CompanyRepo $companyRepo
    )
    {
        $this->commentRepo  = $commentRepo;
        $this->companyRepo  = $companyRepo;
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /comment
	 *
	 * @return Response
	 */
	public function store($sale_id)
	{
        $data = Input::all() + ['sale_id' => $sale_id, 'user_id' => Auth::user()->id];

        $comment = $this->commentRepo->newComment();
        $manager = new CommentRegManager($comment, $data);
        $manager->save();

        if($comment->sale->classification == 'Servicio')
        {
            $status = $comment->sale->data->status;

            if($status == 'Pendiente')
            {
                $comment->sale->data->status = 'Proceso';
                $comment->sale->data->save();
            }
        }

        if ( Request::ajax() ) {
            $response = $this->msg200 + [ 'data' => $comment ];

            return Response::json($response);
        }

        return Redirect::back();
	}



    public function noPrint($id)
    {
        $comment = $this->commentRepo->find($id);
        $this->notFoundUnless($comment);

        $comment->print = 0;
        $comment->save();

        if(Request::ajax())
            return Response::json($this->msg200 + [ 'data' => $comment ]);

        return Redirect::back();
    }

    public function yesPrint($id)
    {
        $comment = $this->commentRepo->find($id);
        $this->notFoundUnless($comment);

        $comment->print = 1;
        $comment->save();

        if(Request::ajax())
            return Response::json($this->msg200 + [ 'data' => $comment ]);

        return Redirect::back();
    }

    public function commentPrint($id)
    {
        $comment	= $this->commentRepo->find($id);
        $this->notFoundUnless($comment);

        $company	= $this->companyRepo->find(1);

        $pdf = PDF::loadView('service/layoutPrintComment', compact('comment', 'company'))->setPaper('letter');
        return $pdf->stream();
    }

}