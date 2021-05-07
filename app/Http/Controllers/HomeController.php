<?php

namespace App\Http\Controllers;

use App\Events\DocumentRegistered;
use App\Models\Category;
use App\Models\Content;
use App\Models\Doc;
use App\Models\Permission;
use App\Models\Score;
use App\Models\User;
use App\Notifications\CVENotification;
use Illuminate\Http\Request;
use Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $documents = Doc::query()
            ->where('id','<=',Content::all()->count())
            ->default(Auth::user()->default->type ?? 0)
            ->sortById($request->sortById)
            ->sortByName($request->sortByName)
            ->sortByYear($request->sortByYear)
            ->sortByMonth($request->sortByMonth)
            ->sortByScore($request->sortByScore)
            ->search($request->key,$request->SearchOptions);
        if(isset($request->paginate) && $request->paginate > 0)
        {
            $documents = $documents->paginate($request->paginate)->withPath(url()->full());
        }
        elseif(isset($request->paginate) && $request->paginate == 0)
        {
            $documents = $documents->get();
        }
        else{
            $documents = $documents->orderBy('id','desc')->paginate()->withPath(url()->full());
        }
        if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
        {

//            Score::create([
//                'content_id' => 1,
//                'score_desc' => 'high',
//            ]);

            return view('admin.index',compact('documents'));


        }elseif(Auth::user()->isUser())
        {

//            Score::create([
//                'content_id' => 1,
//                'score_desc' => 'high',
//            ]);
            if(Auth::user()->active != 1)
            {
                Auth::logout();
                alert()->warning('دسترسی شما به سامانه مسدود شده است');
                return redirect(route('login'));
            }
            return view('user.index',compact('documents'));
        }

    }
}
