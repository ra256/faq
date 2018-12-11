<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::table('users')->insert([
            'email' => 'admin@raheelminiproject3.herokuapp.com',
            'password' => bcrypt('adminadmin'),
            'permission' => 1,
            'locked' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'upated_at' => date("Y-m-d H:i:s")
        ]);
        $user = Auth::user();
        $questions = $user->questions()->paginate(6);
        return view('home')->with('questions', $questions);
    }
}