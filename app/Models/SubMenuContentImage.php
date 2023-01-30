<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SubMenuContentImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_menu_content_id',
        'title',
        'url'
    ];

    protected $appends = ['full_path'];

    public function subMenuContent()
    {
        return $this->belongsTo(SubMenuContent::class);
    }

    public function getFullPathAttribute()
    {

        return  asset($this->attributes['url']);

    }
}
