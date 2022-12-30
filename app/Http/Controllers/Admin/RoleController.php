<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    private $roleRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $RS_Results = $this->roleRepository->all();

            return response()
                ->json([
                    'RS_Results' => view('admin.roles.list', compact('RS_Results'))->render()
                ]);
        } else {
            return view('admin.roles.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        // Retrieve the validated input data...
        $request->validated();

        $response = $this->roleRepository->store($request);

        Session::flash('messageType', $response['messageType']);
        Session::flash('message', $response['message']);

        return Redirect::route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Redirect::route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $RS_Row = $this->roleRepository->getByID($id);

        return view('admin.roles.create-edit', compact('RS_Row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        // Retrieve the validated input data...
        $request->validated();

        $response = $this->roleRepository->update($request, $id);

        Session::flash('messageType', $response['messageType']);
        Session::flash('message', $response['message']);

        return Redirect::route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->roleRepository->delete($id);

        return response()->json([
            'messageType' => $response['messageType'],
            'message' => $response['message']
        ]);
    }
}
