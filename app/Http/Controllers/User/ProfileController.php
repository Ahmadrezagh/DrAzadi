<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.profile.index');
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
        $id = Auth::user()->id;
        $validatedData = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8' ],
            're_password' => ['nullable', 'string', 'min:8'],
            'img' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);
        if($validatedData->fails()){
            return $validatedData->failed();
            alert()->warning("something wen't wrong...");
            return back()->withErrors($validatedData)->withInput();
        }
        if($request->img)
        {
            $profile_img = upload_file($request->img , '/profiles/'.$id,$request->name);
        }
        if($request->password != null && $request->re_password != null)
        {
            if($request->password != $request->re_password)
            {
                alert()->warning('رمز عبور و تکرار آن با یکدیگر برابر نیست');
                return back()->withErrors($validatedData)->withInput();
            }
        }
        User::where('id','=',$id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name." ".$request->last_name,
            'email' => $request->email,
            'password' => ($request->password != null)? Hash::make($request->password) : User::where('id','=',$id)->pluck('password')->first(),
            'profile' => ($request->img) ? $profile_img : User::where('id','=',$id)->pluck('profile')->first()
        ]);
        $user = User::where('id','=',$id)->first();
        if($request->role)
        {
            $user->refreshRoles($request->role);
        }
        if($request->default > 0 && $request->default < 4)
        {
            if(Auth::user()->default)
            {
                Auth::user()->default()->update(['type'=>$request->default]);
            }else{
                Auth::user()->default()->create([
                    'type'=>$request->default
                ]);
            }
        }else{
            Auth::user()->default()->delete();
        }
        if($request->national_code || $request->city || $request->organization || $request->position || $request->phone || $request->mail)
        {
            $data = $request->validate([
                'national_code' => 'required|numeric|digits:10',
                'city' => 'required|string',
                'organization' => 'required|string',
                'position' =>  'required|string',
                'phone'=> 'required|numeric',
                'mail' => 'required|email'
            ]);
            if(!validatePhoneIR($request->phone))
            {
                alert()->warning('شماره وارد شده معتبر نیست');
                return back();
            }
            if(Auth::user()->details)
            {
                Auth::user()->details()->update([
                    'national_code' => encrypt($request->national_code),
                    'city' => encrypt($request->city),
                    'organization' => encrypt($request->organization),
                    'position' => encrypt($request->position),
                    'phone'=> encrypt($request->phone),
                    'mail' => encrypt($request->mail)
                ]);
            }else{
                Auth::user()->details()->create([
                    'national_code' => encrypt($request->national_code),
                    'city' => encrypt($request->city),
                    'organization' => encrypt($request->organization),
                    'position' => encrypt($request->position),
                    'phone'=> encrypt($request->phone),
                    'mail' => encrypt($request->mail)
                ]);
            }
        }
        alert()->success('ویرایش با موفقیت انجام شد');
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
