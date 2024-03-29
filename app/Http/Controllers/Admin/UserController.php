<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doc;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            if ((Auth::user()->isAdmin() && Auth::user()->can('User')) || Auth::user()->isSuperAdmin())
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
    public function index()
    {
        $users = User::Users()->latest()->get();
        $roles = Role::where('type','=','1')->get();
        return view('admin.users.index',compact('users','roles'));
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
        $validatedData = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8' ],
            're_password' => ['required', 'string', 'min:8'],
        ]);
        if($validatedData->fails()){
            alert()->warning("فرایند با مشکل روبرو شد");
            return back()->withErrors($validatedData)->withInput();
        }
        if($request->password != $request->re_password)
        {
            alert()->warning('رمز عبور و تکرار آن با یکدیگر برابر نیستند');
            return back()->withErrors($validatedData)->withInput();
        }
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name." ".$request->last_name,
            'email' => $request->email,
            'type_id' => '3',
            'password' => Hash::make($request->password),
        ]);
        if($request->role)
        {
            $user->refreshRoles($request->role);
        }
        alert()->success('کاربر با موفقیت ایجاد شد');
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
//        $time_start = microtime(true);

//        if(!Cache::has('user_'.$id))
//        {
////            return 'not cache';
//            $user = Cache::rememberForever('user_'.$id,function () use ($id) {
//                return Doc::query()->take(10000)->get();
//            });
//        }else{
////            return 'cache';
//            $user = Cache::get('user_'.$id);
//        }
//        Cache::flush();
//        $user = Cache::get('user_'.$id,function () use ($id) {
//            return Doc::query()->take(5000)->get();
//        });


//        $time_end = microtime(true);
//        return $user;
//        return ($time_end-$time_start) * 1000 . " Milliseconds";
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

    public function changeStatus(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $message = $request->message;
        if($user->active == 1)
        {
            $user->update([
                'active' => 0,
                'deactive_reason' => encrypt($message)
            ]);
            alert()->success('کاربر با موفقیت مسدود شد');
        }else{

            $user->update([
                'active' => 1
            ]);
            alert()->success('کاربر با موفقیت فعال شد');
        }
        return back();
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
        $validatedData = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8' ],
            're_password' => ['nullable', 'string', 'min:8'],
            'img' => 'image|mimes:jpeg,jpg,png',
        ]);
        if($validatedData->fails()){
            alert()->warning("فرایند با مشکل روبرو شد");
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
        alert()->success('کاربر با موفقیت ویرایش شد');
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
        User::where('id',$id)->delete();
        alert()->success('کاربر با موفقیت حذف شد');
        return back();
    }
}
