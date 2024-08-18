<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'parent_id',
        'menu_name',
        'route',
    ];
    // public function submenu()
    // {
    //     return $this->hasMany(Menu::class,'parent_id')->with('subchild');
    // }
    // public function subchild()
    // {
    //     return $this->hasMany(Menu::class,'child_id');
    // }
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id')->orderBy('id','asc');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('id','asc');
    }


}
