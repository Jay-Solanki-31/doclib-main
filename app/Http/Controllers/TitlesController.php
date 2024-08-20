<?php

namespace App\Http\Controllers;
use App\Titles;
use App\AuditTrail;

use Illuminate\Http\Request;

class TitlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $audit_action = 'View List of all Titles';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $titles = Titles::orderBy('TitleName', 'ASC')->get();

        return view('titles.index')->with('titles', $titles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('titles.create');
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
        $audit_action = 'Added a new Title';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $this->validate($request, [
            'TitleName' => ['required', 'string', 'min:2'],
            'Acrynom' => ['required', 'string'],
        ]);

        $title = new Titles;
        $title->TitleName = $request->input('TitleName');
        $title->Acrynom = $request->input('Acrynom');
        $title->save();

        return redirect()->back()->with('success', 'Title has been added successfully');
    
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $audit_action = 'Deleted a Title';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $title = Titles::find($id);

        $title->delete();

        return redirect()->back()->with('error', 'Title has been deleted');
    }
}
