<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doc;
use App\Models\DocTranslate;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translates = DocTranslate::query()->latest()->get();
        return view('admin.translates.index',compact('translates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $translate = $doc->translate;
        return view('admin.translates.create&edit',compact('doc','translate'));
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
        $doc = Doc::findOrFail($id);
        if($doc->translate)
        {
            $doc->translate()->update([
                'content' => $request->text
            ]);
            alert()->success('ترجمه با موفقیت ویرایش شد');
        }else{
            $doc->translate()->create([
                'content' => $request->text
            ]);
            alert()->success('ترجمه با موفقیت ایجاد شد');
        }
        return back();
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
