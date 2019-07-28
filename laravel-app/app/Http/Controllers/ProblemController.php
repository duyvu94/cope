<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;
use DataTables;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){

            $data = Problem::latest()->get();
            return DataTables::of($data)->make(true);
            
        }
        return view('problems.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function show(Problem $problem, $problem_id)
    {
        $problem = Problem::where('id', $problem_id)->first();
        return View('problems.show')->with(compact('problem'))->render();

    }

    /**
     * Display the submission form.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function formSubmit(Problem $problem, $problem_id)
    {
        $problem = Problem::where('id', $problem_id)->first();
        return view('problems.submit')->with(compact('problem_id', 'problem'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function edit(Problem $problem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Problem $problem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Problem $problem)
    {
        //
    }
}
