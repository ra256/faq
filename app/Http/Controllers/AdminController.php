<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //Check if the current user is admin OR superadmin
        $currentUser = Auth::user();
        if($currentUser->permission!=1 && $currentUser->permission!=2){ // It is not admin OR superadmin and redirect to home
            return redirect()->route('home')->withErrors(["Sorry, you're not the Administrator"]);
        }

        $users = User::all();
        return view('admin')->with('users', $users);
    }

    public function deleteUser($userId){
        //Check if the current user is admin OR superadmin
        $currentUser = Auth::user();
        if($currentUser->permission!=1 && $currentUser->permission!=2){ // It is not admin OR superadmin and redirect to home
            return redirect()->route('home')->withErrors(["Sorry, you're not the Administrator"]);
        }

        $user = User::find($userId);
        if($user->permission==1) { //Trying to delete the super admin
            return redirect()->route('home')->withErrors(["Sorry, you're not allowed to perform this action."]);
        }else{
            $user->delete();
            return redirect()->route('admin')->with('message', 'User has been deleted!');
        }
    }

    public function lockUser($userId){
        //Check if the current user is admin OR superadmin
        $currentUser = Auth::user();
        if($currentUser->permission!=1 && $currentUser->permission!=2){ // It is not admin OR superadmin and redirect to home
            return redirect()->route('home')->withErrors(["Sorry, you're not the Administrator"]);
        }

        $user = User::find($userId);
        $user->locked = 1;
        $user->save();
        return redirect()->route('admin')->with('message', 'User has been locked!');
    }

    public function unlockUser($userId){
        //Check if the current user is admin OR superadmin
        $currentUser = Auth::user();
        if($currentUser->permission!=1 && $currentUser->permission!=2){ // It is not admin OR superadmin and redirect to home
            return redirect()->route('home')->withErrors(["Sorry, you're not the Administrator"]);
        }

        $user = User::find($userId);
        $user->locked = 0;
        $user->save();
        return redirect()->route('admin')->with('message', 'User has been unlocked!');
    }

    public function promoteUser($userId){
        //Check if the current user is super-admin
        $currentUser = Auth::user();
        if($currentUser->permission!=1){ // It is not super-admin and redirect to home
            return redirect()->route('home')->withErrors(["Sorry, you're not the Super Administrator"]);
        }

        $user = User::find($userId);
        $user->permission = 2;//Set the permission to 2 which is admin
        $user->save();
        return redirect()->route('admin')->with('message', 'User has been promoted!');
    }

    public function demoteUser($userId){
        //Check if the current user is super-admin
        $currentUser = Auth::user();
        if($currentUser->permission!=1){ // It is not super-admin and redirect to home
            return redirect()->route('home')->withErrors(["Sorry, you're not the Super Administrator"]);
        }

        $user = User::find($userId);
        $user->permission = 0; //Set the permission to 0 which is simple user
        $user->save();
        return redirect()->route('admin')->with('message', 'User has been demoted!');
    }

}