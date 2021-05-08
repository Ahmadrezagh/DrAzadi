<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Doc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DocumentController extends Controller
{
    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            if ((Auth::user()->isUser() && Auth::user()->can('doc')))
            {
                return $next($request);
            }else{
                abort(404);
            }
        });

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = CacheKey($request);
        if(!Cache::has($key))
        {
            $documents = Cache::remember($key,33600,function () use ($request) {
                $_documents = Doc::query()
                    ->where('id', '<=', Content::all()->count())
                    ->sortById($request->sortById)
                    ->sortByName($request->sortByName)
                    ->sortByYear($request->sortByYear)
                    ->sortByMonth($request->sortByMonth)
                    ->sortByScore($request->sortByScore)
                    ->search($request->key, $request->SearchOptions);
                if (isset($request->paginate) && $request->paginate > 0) {
                    $_documents = $_documents->paginate($request->paginate)->withPath(url()->full());
                } elseif (isset($request->paginate) && $request->paginate == 0) {
                    $_documents = $_documents->get();
                } else {
                    $_documents = $_documents->orderBy('id', 'desc')->paginate()->withPath(url()->full());
                }
                return $_documents;
            });
        }else{
            $documents = Cache::get($key);
        }
        return view('user.documents.index',compact('documents'));
    }

    public function type(Request $request,$type)
    {
        if($type > 0 && $type < 4) {
            $pageName = null;
            if ($type == 1)
            {
                $pageName = 'آسیب پذیری های با درجه کم';
                if(!Auth::user()->can('doc_count_low'))
                {
                    alert()->warning('شما دسترسی به این صفحه را ندارید');
                    return back();
                }
            }
            if ($type == 2)
            {
                $pageName = 'آسیب پذیری های با درجه متوسط';
                if(!Auth::user()->can('doc_count_medium'))
                {
                    alert()->warning('شما دسترسی به این صفحه را ندارید');
                    return back();
                }
            }
            if ($type == 3)
            {
                $pageName = 'آسیب پذیری های با درجه بالا';
                if(!Auth::user()->can('doc_count_high'))
                {
                    alert()->warning('شما دسترسی به این صفحه را ندارید');
                    return back();
                }
            }

            $key = CacheKey($request,$type,'single_type'.$type.'_');
            if(!Cache::has($key)) {
                $documents = Cache::remember($key, 33600, function () use ($type, $request) {
                    $_documents = Doc::query()
                        ->where('id', '<=', Content::all()->count())
                        ->default($type)
                        ->sortById($request->sortById)
                        ->sortByName($request->sortByName)
                        ->sortByYear($request->sortByYear)
                        ->sortByMonth($request->sortByMonth)
                        ->sortByScore($request->sortByScore)
                        ->search($request->key, $request->SearchOptions);
                    if (isset($request->paginate) && $request->paginate > 0) {
                        $_documents = $_documents->paginate($request->paginate)->withPath(url()->full());
                    } elseif (isset($request->paginate) && $request->paginate == 0) {
                        $_documents = $_documents->get();
                    } else {
                        $_documents = $_documents->orderBy('id', 'desc')->paginate()->withPath(url()->full());
                    }
                    return $_documents;
                });
            }else{
                $documents = Cache::get($key);
            }
            return view('user.documents.index',compact('documents','pageName'));
        }
        return abort(404);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doc = Doc::findOrFail($id);
        $content = $doc->content;
        return view('user.content.index',compact('content','doc'));
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
    }
}
