<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CandidateSearch;
use App\Http\Requests\Search\CreateSearchAPIRequest;
use App\Http\Requests\Search\UpdateSearchAPIRequest;
use App\Models\CandidateInformation;
use App\Repositories\SearchRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Search\CreateSearchAPIRequest as APICreateSearchAPIRequest;
use Response;
use App\Services\SearchService;

/**
 * Class SearchController
 * @package App\Http\Controllers\API
 */

class SearchAPIController extends AppBaseController
{
    /** @var  SearchRepository */
    private $searchRepository;
  /** @var  SearchService */
    private $searchService;

    public function __construct(SearchRepository $searchRepository,SearchService $searchService)
    {
        $this->searchRepository = $searchRepository;
        $this->searchService = $searchService;
    }

    /**
     * @param CreateSearchAPIRequest $request
     * @param User $user
     */
    public function filter(CreateSearchAPIRequest $request)
    {
        return  $this->searchService->filter($request);
    }

    /**
     * Display a listing of the Search.
     * GET|HEAD /searches
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $searches = $this->searchRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($searches->toArray(), 'Searches retrieved successfully');
    }

    public function candidateSearch(CandidateSearch $request)
    {
        return $this->searchService->searchCandidates($request);
    }
}
