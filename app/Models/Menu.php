<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'url',
        'order',
        'visible',
    ];

    public function contents()
    {
        return $this->hasMany(MenuContent::class);
    }

    public function submenus()
    {
        return $this->hasMany(SubMenu::class);
    }
}