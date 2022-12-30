<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CategoryRequest;
use App\Traits\CategoryTypeTrait;

class CategoryController extends Controller
{
    private $categoryRepository;
    use CategoryTypeTrait;

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
        // $RS_Results = $this->categoryRepository->all();
        // dd($RS_Results);
        // dd($RS_Results[5]->parents->pluck('name')->toArray());
        
        if ($request->ajax()) {
            $RS_Results = $this->categoryRepository->all();

            return response()
                ->json([
                    'RS_Results' => view('admin.categories.list', compact('RS_Results'))->render()
                ]);
        } else {
            return view('admin.categories.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $RS_Categoires = $this->categoryRepository->all();
        $RS_CategoryTypes = $this->categoryTypes();

        return view('admin.categories.create-edit', compact('RS_Categoires', 'RS_CategoryTypes'));
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

        return Redirect::route('admin.categories.index');
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
        $RS_Categoires = $this->categoryRepository->all();
        $RS_CategoryTypes = $this->categoryTypes();

        return view('admin.categories.create-edit', compact('RS_Row', 'RS_Categoires', 'RS_CategoryTypes'));
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

        return Redirect::route('admin.categories.index');
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

        return response()->json([
            'messageType' => $response['messageType'],
            'message' => $response['message']
        ]);
    }
}
