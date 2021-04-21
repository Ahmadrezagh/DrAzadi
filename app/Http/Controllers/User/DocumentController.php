<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Doc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $documents = Doc::query()
            ->where('id','<=',Content::all()->count())
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
            $documents = $documents->paginate()->withPath(url()->full());
        }
        return view('user.documents.index',compact('documents'));
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
