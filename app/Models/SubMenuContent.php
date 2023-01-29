<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenuContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_menu_id',
        'title',
        'description'
    ];

    public function submenu()
    {
        return $this->belongsTo(SubMenu::class);
    }

    public function images()
    {
        return $this->hasMany(SubMenuContentImage::class);
    }
}