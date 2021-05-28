<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Content extends Model
{
    use HasFactory;

    protected $guarded = [];
//    protected $with = ['score'];
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'doc_tags');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function getTags()
    {
        $tag_ids = [];
        $tags = Tag::all();
        foreach ($tags as $tag)
        {
            if(Str::contains($this->current_description,$tag->name) || Str::contains($this->analysis_description,$tag->name))
            {
                array_push($tag_ids,$tag->id);
            }
        }
        $this->tags()->sync($tag_ids);
    }

    public function getBrands()
    {
        $brand_ids = [];
        $brands = Brand::all();
        foreach ($brands as $brand)
        {
            if(Str::contains($this->current_description,' '.$brand->name) || Str::contains($this->analysis_description,' '.$brand->name))
            {
//                array_push($brand_ids,[
//                    'id' => $brand->id,
//                    'position' => strpos($this->current_description.$this->analysis_description,' '.$brand->name)
//                ]);
                $brand_ids[strpos($this->current_description.$this->analysis_description,' '.$brand->name)] = $brand->id;
            }
        }
        $this->brands()->sync($brand_ids);
    }

    public function doc(): BelongsTo
    {
        return $this->belongsTo(Doc::class);
    }

    public function score(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function getDictionaryUrlAttribute(): string
    {
        return 'https://cve.mitre.org/cgi-bin/cvename.cgi?name=' . $this->doc->slug;
    }
}
