<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use simplehtmldom\HtmlWeb;
use Illuminate\Support\Facades\Http;
class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function contents()
    {
        return $this->belongsToMany(Content::class,'doc_tags');
    }

    public static function getTagList()
    {
        $response = Http::get('https://cve.circl.lu/api/browse');
        $tags = json_decode($response)->vendor;
        if(count($tags) > count(Tag::all()))
        {
            foreach ($tags as $tag)
            {
                if(!Tag::where('name','=',$tag)->first())
                {
                    Tag::create([
                        'name'=>$tag
                    ]);
                }
            }
        }
    }

    public static function updateTags()
    {
        $tags = Tag::all();
        foreach ($tags as $tag)
        {
            $contents = Content::where('current_description','like','%'.$tag->name.'%')->orwhere('analysis_description','like','%'.$tag->name.'%')->get()->pluck('id');
            $tag->contents()->sync($contents);
        }
    }



}

