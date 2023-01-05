<?php

namespace App\Http\Controllers;

use App\Models\ProjectIssue;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProjectIssueRepositoryInterface;

class ProjectIssueController extends Controller
{
    private $projectIssueRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectIssueRepositoryInterface $projectIssueRepository)
    {
        $this->projectIssueRepository = $projectIssueRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->projectIssueRepository->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectIssue  $projectIssue
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectIssue $projectIssue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectIssue  $projectIssue
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectIssue $projectIssue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectIssue  $projectIssue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectIssue $projectIssue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectIssue  $projectIssue
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectIssue $projectIssue)
    {
        //
    }

    /**
     * change status
     */
    public function changeStatus(Request $request)
    {
        $response = $this->projectIssueRepository->changeStatus($request);

        return response()->json([
            'messageType' => $response['messageType'],
            'message' => $response['message']
        ]);
    }

    /**
     * change menu order
     */
    public function changeMenuOrder(Request $request)
    {
        $response = $this->projectIssueRepository->changeMenuOrder($request);
        
        return response()->json([
            'messageType' => $response['messageType'],
            'message' => $response['message']
        ]);
    }
}
