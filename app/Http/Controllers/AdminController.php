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
        //Check if the current user is admin
        $currentUser = Auth::user();
        if($currentUser->permission!=1){ // It is not admin and redirect to home
            return redirect()->route('home')->withErrors(["Sorry, you're not the Administrator"]);
        }

        $users = User::all();
        return view('admin')->with('users', $users);
    }

    public function deleteUser($userId){
        //Check if the current user is admin
        $currentUser = Auth::user();
        if($currentUser->permission!=1){ // It is not admin and redirect to home
            return redirect()->route('home')->withErrors(["Sorry, you're not the Administrator"]);
        }

        $user = User::find($userId);
        $user->delete();
        return redirect()->route('admin')->with('message', 'User has been deleted!');
    }

    public function lockUser($userId){
        //Check if the current user is admin
        $currentUser = Auth::user();
        if($currentUser->permission!=1){ // It is not admin and redirect to home
            return redirect()->route('home')->withErrors(["Sorry, you're not the Administrator"]);
        }

        $user = User::find($userId);
        $user->locked = 1;
        $user->save();
        return redirect()->route('admin')->with('message', 'User has been locked!');
    }

    public function unlockUser($userId){
        //Check if the current user is admin
        $currentUser = Auth::user();
        if($currentUser->permission!=1){ // It is not admin and redirect to home
            return redirect()->route('home')->withErrors(["Sorry, you're not the Administrator"]);
        }

        $user = User::find($userId);
        $user->locked = 0;
        $user->save();
        return redirect()->route('admin')->with('message', 'User has been unlocked!');
    }

}