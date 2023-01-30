<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'title',
        'description'
    ];
    protected $with = ['images'];
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function images()
    {
        return $this->hasMany(MenuContentImage::class);
    }
}
