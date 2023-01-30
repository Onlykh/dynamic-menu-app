<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MenuContentImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_content_id',
        'title',
        'url'
    ];

    protected $appends = ['full_path'];

    public function menuContent()
    {
        return $this->belongsTo(MenuContent::class);
    }

    public function getFullPathAttribute()
    {
        return  asset($this->attributes['url']);
    }
}
