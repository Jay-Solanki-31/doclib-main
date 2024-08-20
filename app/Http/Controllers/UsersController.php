<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Titles;
use App\UserRoles;
use App\AuditTrail;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\OtherUser;

class UsersController extends Controller
{

    public function __construct() {
        // $this->middleware('admin');
        
        // $this->middleware('librarian');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users;
        if(Auth::user()->user_role->RoleName === "Librarian"){
            $users = User::orderby('id', 'desc')->with(['user_role','user_title'])->withTrashed()->where('UserRole', Auth::user()->UserRole)->get();
            $active_users = User::orderby('id', 'desc')->where('validity', '!=', 0)->where('UserRole', Auth::user()->UserRole)->count();
            $pending_deletion = User::onlyTrashed()->where('UserRole', Auth::user()->UserRole)->count();
            $block_users = User::where('validity', 0)->where('UserRole', Auth::user()->UserRole)->count();

        }else{
            $users = User::orderby('id', 'desc')->with(['user_role','user_title'])->withTrashed()->get();
            $active_users = User::orderby('id', 'desc')->where('validity', '!=', 0)->count();
            $pending_deletion = User::onlyTrashed()->count();
            $block_users = User::where('validity', 0)->count();
        }
        

        // print_r($block_users); exit;
        return view('users.index')->with(['users' => $users, 'pending_deletion' => $pending_deletion, 'blocked_users' => $block_users, 'active_users' => $active_users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect('#');
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
        return redirect('#');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($obfuscator)
    {
        //
        $user = User::where('Obfuscator', $obfuscator)->with(['user_role','user_title'])->withTrashed()->get();

        if(count($user) > 0){
            return view('users.show')->with('user', $user);
            exit;
        }

        return redirect('/staff');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($obfuscator)
    {
        //
        $titles = Titles::orderBy('id', 'asc')->get();
        $userRoles = UserRoles::orderBy('id', 'desc')->get();
        $user = User::where('Obfuscator', $obfuscator)->with(['user_role','user_title'])->withTrashed()->get();

        if(count($user) > 0){
            return view('users.edit')->with(['user' => $user, 'titles' => $titles, 'userRoles' => $userRoles]);
            exit;
        }

        return redirect('/staff');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $obfuscator)
    {
        //function for storing the updated results
        $this->validate($request, [
            'FirstName' => ['required', 'string', 'max:255'],
            'SecondName' => ['required', 'string', 'max:255'],
            'userrole' => ['required', 'integer'],
            'title' => ['required', 'integer'],
            'gender' => ['required', 'string'],
        ]);
            
        // print_r($request->input()); echo '<br><br>';
        $user = User::withTrashed()->where('Obfuscator', $obfuscator)->get();

        $user = User::withTrashed()->find($user[0]->id);
        // print_r($user); exit;

        if ($request->input('password') != '') {
            $this->validate($request, [
                'password' => ['string', 'min:8', 'confirmed']
            ]);
            $password = bcrypt($request->input('password'));
            $user->password = $password;
        }
        
        if ($request->input('email') != $user->email) {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            $user->email = $request->input('email');
        }

        $user->FirstName = $request->input('FirstName');
        $user->SecondName = $request->input('SecondName');
        $user->UserRole = $request->input('userrole');
        $user->title = $request->input('title');
        $user->gender = $request->input('gender');

        $user->save();

            return redirect('/staff/'.$user->Obfuscator)->with('success', 'User has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($obfuscator)
    {
        $user_to_delete = User::where('Obfuscator', $obfuscator)->get();
        $user_to_delete = User::find($user_to_delete[0]->id);
        //get the user that deleted this user's account
        $user_that_deleted = auth()->user()->Obfuscator;
        
        $user_to_delete->deleted_by = $user_that_deleted;
        $user_to_delete->validity = 0;
        $user_to_delete->save();
        
        $user_to_delete->delete();
        
        return redirect('/staff')->with('error', 'User has been deleted succefully');
    }

    public function restore($obfuscator)
    {
        $user_to_restore = User::where('Obfuscator', $obfuscator)->onlyTrashed()->get();
        // print_r($user_to_restore); exit;
        $user_restoring = auth()->user()->Obfuscator;
        
        if($user_restoring === $user_to_restore[0]->deleted_by){
            return redirect('/staff/'.$user_to_restore[0]->Obfuscator)->with('error', 'Please contact another administrator to restore this account');
            exit;
        }
        
        $user_to_restore = User::onlyTrashed()->find($user_to_restore[0]->id);

        $user_to_restore->deleted_by = 'NULL';
        $user_to_restore->validity = 1;
        $user_to_restore->save();

        $user_to_restore->restore();

        return redirect('/staff')->with('success', 'User has been restored successfully');
    }
    
    public function permanentely_delete($obfuscator)
    {
        $user_to_destroy = User::where('Obfuscator', $obfuscator)->onlyTrashed()->get();
        // print_r($user_to_destroy); exit;
        $user_destroying= auth()->user()->Obfuscator;
        
        if($user_destroying === $user_to_destroy[0]->deleted_by){
            return redirect('/staff/'.$user_to_destroy[0]->Obfuscator)->with('error', 'Please contact another administrator to remove this account');
            exit;
        }

        $user_to_destroy = User::onlyTrashed()->find($user_to_destroy[0]->id);

        $user_to_destroy->forceDelete();

        return redirect('/staff')->with('success', 'User has been removed successfully');
    }

    public function block_user($obfuscator,$firstname,$lastname)
    {
        $user = User::where(['Obfuscator' => $obfuscator, 'FirstName' => $firstname, 'SecondName' => $lastname])->get();

        $user_blocking = auth()->user()->Obfuscator;
        if (count($user) > 0) {
             $user= User::find($user[0]->id);
             $user->validity = 0;
             $user->deleted_by = $user_blocking;
             $user->save();
             
             return redirect('/staff/'.$obfuscator)->with('success', 'User has been blocked');
             exit;
        }

        return redirect('/staff');
        exit;

        return 0;
    }
    
    public function unblock_user($obfuscator,$firstname,$lastname)
    {
        $user = User::where(['Obfuscator' => $obfuscator, 'FirstName' => $firstname, 'SecondName' => $lastname])->get();

        $user_blocking = auth()->user()->Obfuscator;
        if (count($user) > 0) {
             $user= User::find($user[0]->id);
             $user->validity = 1;
             $user->deleted_by = $user_blocking;
             $user->save();

             return redirect('/staff/'.$obfuscator)->with('success', 'User has been unblocked');
             exit;
        }

        return redirect('/staff');
        exit;
    }

    public function getChangePassword()
    {
        return view('auth.change_password');
    }

    public function postChangePassword(Request $request)
    {
        $validatedData = $request->validate([
            'old-password' => 'required|string',
            'password' => 'required|string|min:8',
            'password-confirm' => 'required|string|min:8|same:password',
        ]);

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_action = 'Changed their password';
        $audit_user_id;
        $vendor;
        if (isset(auth()->user()->id)) {
            $audit_user_id = auth()->user()->id;
            
            if (!(Hash::check($request->get('old-password'), auth()->user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your old password is incorrect. Please try again.");

            //Change Password
            $vendor = Auth::user();
            echo 'here'; exit;
        }
        }else{
            $audit_user_id = Auth::guard('other_user')->user()->id;

            
            if (!(Hash::check($request->get('old-password'), Auth::guard('other_user')->user()->password))) {
            // The passwords matches
                return redirect()->back()->with("error", "Your old password is incorrect. Please try again.");
            }
            //Change Password
            $vendor = OtherUser::where('id', Auth::guard('other_user')->user()->id)->first();
            
        }

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        if (strcmp($request->get('old-password'), $request->get('password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
            // return redirect()->back()->withInput()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

        $vendor->password = bcrypt($request->get('password'));
        $vendor->save();

        $audit_trail->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }
}
