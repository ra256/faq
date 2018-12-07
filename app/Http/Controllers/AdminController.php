<?php
namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
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
    public function index()
    {
        $users = User::all();
        return view('admin')->with('users', $users);
    }

    public function deleteUser($userId){
        $user = User::find($userId);
        $user->delete();
        return redirect()->route('admin')->with('message', 'User has been deleted!');
    }

    public function lockUser($userId){
        $user = User::find($userId);
        $user->locked = 1;
        $user->save();
        return redirect()->route('admin')->with('message', 'User has been locked!');
    }

    public function unlockUser($userId){
        $user = User::find($userId);
        $user->locked = 0;
        $user->save();
        return redirect()->route('admin')->with('message', 'User has been unlocked!');
    }
}