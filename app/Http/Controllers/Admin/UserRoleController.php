<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
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
        $roles = Role::where('type','=',1)->get();
        $permissions = Permission::where('type','=',1)->parents()->get();
        return view('admin.users.roles',compact('roles','permissions'));

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
            'name' => 'required',
        ]);
        $role = new Role();
        try {
            $role->name = $request->name;
            $role->type = 1;
            $role->save();

            $role->refreshPermissions($request->permissions);
        } catch (\Exception $exception) {
            alert()->warning('warning', $exception->getCode());
            return redirect()->back();
        }
        alert()->success('نقش با موفقیت ایجاد شد');
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
        $role = Role::findOrFail($id);
        $validationData = $request->validate([
            'name' => 'required',
        ]);
        $role->update($request->only('name'));
        $role->refreshPermissions($request->permissions);
        alert()->success('نقش با موفقیت ویرایش شد');
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
        Role::findOrFail($id)->delete();
        alert()->success('نقش با موفقیت حذف شد');
        return back();
    }
}
