<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    private $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $RS_Results = $this->categoryRepository->all();
        // dd($RS_Results);

        return view('categories.index', compact('RS_Results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // Retrieve the validated input data...
        $request->validated();

        $response = $this->categoryRepository->store($request);

        Session::flash('messageType', $response['messageType']);
        Session::flash('message', $response['message']);

        return Redirect::route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $RS_Row = $this->categoryRepository->getByID($id);

        return view('categories.create-edit', compact('RS_Row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        // Retrieve the validated input data...
        $request->validated();

        $response = $this->categoryRepository->update($request, $id);

        Session::flash('messageType', $response['messageType']);
        Session::flash('message', $response['message']);

        return Redirect::route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->categoryRepository->delete($id);

        Session::flash('messageType', $response['messageType']);
        Session::flash('message', $response['message']);

        return Redirect::back();
    }
}
