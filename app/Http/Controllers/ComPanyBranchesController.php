<?php

namespace App\Http\Controllers;


use App\Models\Company_branch;
use App\Models\Contact;
use Illuminate\Http\Request;

class ComPanyBranchesController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Company_branch $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.companyBranch.';
        $this->routeName = 'companyBranch.';
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token','company_id']);

        Company_branch::findOrFail($request->get('company_id'))->update($input);

        return redirect()->route($this->routeName. 'show',$request->get('company_id'))->with('flash_success', 'Successfully Saved!');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companyBranch = Company_branch::find($id);

        return view($this->viewName . 'show', compact('companyBranch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companyBranch = Company_branch::find($id);

        return view($this->viewName . 'edit', compact('companyBranch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token']);
        $companyBranch = Company_branch::find($id);

        $companyBranch->update($input);
        if($id ==1){
            return redirect()->route($this->routeName. 'edit',$companyBranch->id)->with('flash_success', 'Successfully Saved!');
        }else{
            return redirect()->route($this->routeName. 'show',$companyBranch->id)->with('flash_success', 'Successfully Saved!');
         }

        }


    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company_branch $company)
    {
        //
    }




}
