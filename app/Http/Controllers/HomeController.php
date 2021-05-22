<?php

namespace App\Http\Controllers;

use App\Events\DocumentRegistered;
use App\Models\Brand;
use App\Models\BrandContent;
use App\Models\Category;
use App\Models\Content;
use App\Models\Doc;
use App\Models\Permission;
use App\Models\Score;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\CVENotification;
use http\QueryString;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cache;

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

//            Score::create([
//                'content_id' => 1,
//                'score_desc' => 'high',
//            ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $key = CacheKey($request,Auth::user()->default->type ?? 0);
        if(!Cache::has($key))
        {
            $documents = Cache::remember($key,33600,function () use ($request)  {
                $_documents = Doc::query()
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
                    $_documents = $_documents->paginate($request->paginate)->withPath(url()->full());
                }
                elseif(isset($request->paginate) && $request->paginate == 0)
                {
                    $_documents = $_documents->get();
                }
                else{
                    $_documents = $_documents->orderBy('id','desc')->paginate()->withPath(url()->full());
                }
                return $_documents;

            });
        }else{
            $documents = Cache::get($key);
        }


        if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
        {



            return view('admin.index',compact('documents'));


        }elseif(Auth::user()->isUser())
        {

//            Score::create([
//                'content_id' => 1,
//                'score_desc' => 'high',
//            ]);
            if(Auth::user()->active != 1)
            {
                $message = Auth::user()->deactive_reason ? decrypt(Auth::user()->deactive_reason) : null;
                Auth::logout();
                alert()->warning('دسترسی شما به سامانه مسدود شده است');
                return view('auth.login',compact('message'));
            }
//            Cache::flush();
            return view('user.index',compact('documents'));
        }

    }
}
