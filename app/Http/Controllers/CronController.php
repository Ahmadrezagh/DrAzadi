<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doc;
use Illuminate\Support\Facades\Auth;

class CronController extends Controller
{
    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            if (Auth::user()->isSuperAdmin())
            {
                return $next($request);
            }else{
                abort(404);
            }
        });

    }
    public function fetchContent(Request $request)
    {
        Doc::query()->each(function (Doc $doc) {
            $doc->fetchContent();
        });
    }


    public function fetchDocs(Request $request)
    {
        Doc::fetchNews($request->input('fromYear') ?? now()->year);
    }
}
