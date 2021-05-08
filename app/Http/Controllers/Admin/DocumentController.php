<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Doc;
use App\Models\Score;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DocumentController extends Controller
{
    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            if ((Auth::user()->isAdmin() && Auth::user()->can('Documents')) || Auth::user()->isSuperAdmin())
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
        return view('admin.documents.index',compact('documents'));
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

    public function type(Request $request,$type)
    {
        if($type > 0 && $type < 4) {
            $pageName = null;
            if ($type == 1)
            {
                $pageName = 'آسیب پذیری های با درجه کم';
            }
            if ($type == 2)
            {
                $pageName = 'آسیب پذیری های با درجه متوسط';
            }
            if ($type == 3)
            {
                $pageName = 'آسیب پذیری های با درجه بالا';
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
            return view('admin.documents.index',compact('documents','pageName'));
        }
        return abort(404);
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
        return view('admin.content.index',compact('content','doc'));
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
