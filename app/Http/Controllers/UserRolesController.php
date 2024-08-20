<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRoles;
use App\AuditTrail;

class UserRolesController extends Controller
{
    public function __construct() {

        $this->middleware('admin');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $audit_action = 'View List of User Roles';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $user_roles = UserRoles::orderBy('RoleName', 'ASC')->with('user')->get();

        return view('user_roles.index')->with(['user_roles' => $user_roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user_roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $audit_action = 'Added a User Role';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        //
        $this->validate($request, [
            'RoleName' => 'required|string|min:2|max:30',
            'Description' => 'nullable|string',
        ]);

        $user_id = auth()->user()->id;

        $user_role = new UserRoles;
        $user_role->RoleName = $request->input('RoleName');
        $user_role->Description = $request->input('Description');
        $user_role->created_by = $user_id;
        $user_role->save();

        return redirect('user-roles')->with('success', 'User Role has beed added scuccessfuly');
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
        $audit_action = 'Deleted a User Role';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();
        $user_role = UserRoles::find($id);

        $user_role->delete();

        return redirect()->back()->with('error', 'User Role has been deleted');
    }
}
