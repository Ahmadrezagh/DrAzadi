<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UpgradeRequest;
use Illuminate\Http\Request;
use Auth;
class UpgradeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = Auth::user()->upgradeRequests;
        return view('user.upgradeRequest.index',compact('requests'));
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
         $request->validate([
             '_request' =>   'required|string'
         ]);
         UpgradeRequest::create([
             'user_id' => Auth::user()->id,
             'request' => encrypt($request->_request)
         ]);
         alert()->success('درخواست شما با موفقیت ثبت شد');
         return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $r = UpgradeRequest::findOrFail($id);
        if($r->status == 0)
        {
            $request->validate(['_request' => 'required|string']);
            $r->update([
                'request' => encrypt($request->_request)
            ]);
            alert()->success('درخواست با موفقیت ویرایش شد');
        }else{
            alert()->warning('فقط درخواست های ایجاد شده قابلیت ویرایش دارند');
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
