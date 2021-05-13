<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

function setting($name)
{
    return \App\Models\Setting::getValue($name);
}

function upload_file($file, $file_path = null, $name = null)
{
    $path = '/uploads' . $file_path;
    // User image name is = user's phone.img
    if ($name) {
        $file_name = $name . "." . $file->getClientOriginalExtension();
    } else {
        $file_name = $file->getClientOriginalName();
    }
    // Upload Image
    $file->move(public_path($path), $file_name);
    // Generate image path
    return strval($path . "/" . $file_name);
}

function upload_files($files = null, $file_path = null, $random_name = false)
{
    if ($files != null) {
        $file_paths = [];
        foreach ($files as $file) {
            $path = upload_file($file, $file_path, $random_name ? Str::random(8) : null);
            array_push($file_paths, $path);
        }
        return $file_paths;
    }
}

function make_slug($string)
{
    return preg_replace('/\s+/u', '-', trim($string));
}

function DB_create($table, $data = [])
{
    DB::table($table)->insert($data);
}

function DB_update($table, $id, $data = [])
{
    DB::table($table)->where('id', '=', $id)->update($data);
}

function DB_delete($table, $id, $column = null)
{
    DB::table($table)->where($column ? $column : 'id', '=', $id)->delete();
}

if (!function_exists('try_catch_null')) {
    function try_catch_null($closure)
    {
        try {
            return $closure();
        } catch (Exception $ex) {
            return null;
        }
    }
}


function validatePhoneIR($phone)
{
    $status = 0;
    $pattern = null;
    if (strlen($phone) == 10) {
        $pattern = "/(9)[0-9]{9}/";
        $status = preg_match($pattern, $phone);
    } elseif (strlen($phone) == 11) {
        $pattern = "/(09)[0-9]{9}/";
        $status = preg_match($pattern, $phone);
    }
    return $status;
}

function CacheKey(Request $request, $type = 0, $prefix = '')
{
    $default = 0;
    if (Auth::user() && Auth::user()->default && Auth::user()->default->type) {
        $default = $type;
    }
    $key = $prefix . 'key_' . $default . "_";
    $keys = array_keys($request->all());
    foreach ($keys as $k) {
        if (is_array($request[$k])) {
            foreach ($request[$k] as $sub_k) {
                $key = $key . $k . "_" . $sub_k . "_";
            }
        } else {
            $key = $key . $k . "_" . $request[$k] . "_";
        }
    }
    if ($request->key && $request->SearchOptions) {
        foreach ($request->SearchOptions as $k) {
            $key = $key . $k . "_";
        }
    }
    if ($request->paginate) {
        $key = $key . $request->paginate . "_";
    }
    return $key;
}

function updateTags()
{
    $available_ids = \App\Models\DocTag::query()->distinct('content_id')->pluck('content_id');
    $contents = \App\Models\Content::query()->whereNotIn('id', $available_ids)->get();
    foreach ($contents as $content) {
        $content->getTags();
    }

}
