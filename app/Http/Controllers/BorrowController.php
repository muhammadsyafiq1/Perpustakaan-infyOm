<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBorrowRequest;
use App\Http\Requests\UpdateBorrowRequest;
use App\Repositories\BorrowRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Flash;
use Response;

class BorrowController extends AppBaseController
{
    /** @var  BorrowRepository */
    private $borrowRepository;

    public function __construct(BorrowRepository $borrowRepo)
    {
        $this->borrowRepository = $borrowRepo;
    }

    /**
     * Display a listing of the Borrow.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $borrows = Borrow::wherein('status',['approve','inapprove'])->get();

        return view('borrows.index')
            ->with('borrows', $borrows);
    }

    public function status(Request $request,$id)
    {
        $data = Borrow::findOrFail($id);
        $data->status = $request->status;
        $data->save();

        return redirect(route('borrows.index'));
    }

    /**
     * Show the form for creating a new Borrow.
     *
     * @return Response
     */
    public function create()
    {
        return view('borrows.create');
    }

    /**
     * Store a newly created Borrow in storage.
     *
     * @param CreateBorrowRequest $request
     *
     * @return Response
     */
    public function store(CreateBorrowRequest $request)
    {
        $input = $request->all();

        $borrow = $this->borrowRepository->create($input);

        Flash::success('Borrow saved successfully.');

        return redirect(route('borrows.index'));
    }

    /**
     * Display the specified Borrow.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $borrow = $this->borrowRepository->find($id);

        if (empty($borrow)) {
            Flash::error('Borrow not found');

            return redirect(route('borrows.index'));
        }

        return view('borrows.show')->with('borrow', $borrow);
    }

    /**
     * Show the form for editing the specified Borrow.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $borrow = $this->borrowRepository->find($id);

        if (empty($borrow)) {
            Flash::error('Borrow not found');

            return redirect(route('borrows.index'));
        }

        return view('borrows.edit')->with('borrow', $borrow);
    }

    /**
     * Update the specified Borrow in storage.
     *
     * @param int $id
     * @param UpdateBorrowRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBorrowRequest $request)
    {
        $borrow = $this->borrowRepository->find($id);

        if (empty($borrow)) {
            Flash::error('Borrow not found');

            return redirect(route('borrows.index'));
        }

        $borrow = $this->borrowRepository->update($request->all(), $id);

        Flash::success('Borrow updated successfully.');

        return redirect(route('borrows.index'));
    }

    /**
     * Remove the specified Borrow from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $borrow = $this->borrowRepository->find($id);

        if (empty($borrow)) {
            Flash::error('Borrow not found');

            return redirect(route('borrows.index'));
        }

        $this->borrowRepository->delete($id);

        Flash::success('Borrow deleted successfully.');

        return redirect(route('borrows.index'));
    }
}
