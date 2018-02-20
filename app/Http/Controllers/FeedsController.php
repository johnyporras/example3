<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeedsRequest;
use App\Http\Requests\UpdateFeedsRequest;
use App\Repositories\FeedsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FeedsController extends AppBaseController
{
    /** @var  FeedsRepository */
    private $feedsRepository;

    public function __construct(FeedsRepository $feedsRepo)
    {
        $this->feedsRepository = $feedsRepo;
    }

    /**
     * Display a listing of the Feeds.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->feedsRepository->pushCriteria(new RequestCriteria($request));
        $feeds = $this->feedsRepository->all();

        return view('feeds.index')
            ->with('feeds', $feeds);
    }

    /**
     * Show the form for creating a new Feeds.
     *
     * @return Response
     */
    public function create()
    {
        return view('feeds.create');
    }

    /**
     * Store a newly created Feeds in storage.
     *
     * @param CreateFeedsRequest $request
     *
     * @return Response
     */
    public function store(CreateFeedsRequest $request)
    {
        $input = $request->all();

        $feeds = $this->feedsRepository->create($input);

        Flash::success('Feeds saved successfully.');

        return redirect(route('feeds.index'));
    }

    /**
     * Display the specified Feeds.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $feeds = $this->feedsRepository->findWithoutFail($id);

        if (empty($feeds)) {
            Flash::error('Feeds not found');

            return redirect(route('feeds.index'));
        }

        return view('feeds.show')->with('feeds', $feeds);
    }

    /**
     * Show the form for editing the specified Feeds.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $feeds = $this->feedsRepository->findWithoutFail($id);

        if (empty($feeds)) {
            Flash::error('Feeds not found');

            return redirect(route('feeds.index'));
        }

        return view('feeds.edit')->with('feeds', $feeds);
    }

    /**
     * Update the specified Feeds in storage.
     *
     * @param  int              $id
     * @param UpdateFeedsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeedsRequest $request)
    {
        $feeds = $this->feedsRepository->findWithoutFail($id);

        if (empty($feeds)) {
            Flash::error('Feeds not found');

            return redirect(route('feeds.index'));
        }

        $feeds = $this->feedsRepository->update($request->all(), $id);

        Flash::success('Feeds updated successfully.');

        return redirect(route('feeds.index'));
    }

    /**
     * Remove the specified Feeds from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $feeds = $this->feedsRepository->findWithoutFail($id);

        if (empty($feeds)) {
            Flash::error('Feeds not found');

            return redirect(route('feeds.index'));
        }

        $this->feedsRepository->delete($id);

        Flash::success('Feeds deleted successfully.');

        return redirect(route('feeds.index'));
    }
}
