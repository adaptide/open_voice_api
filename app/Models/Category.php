<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    use HasFactory;

    protected $guarded = false;

    public static function boot(){
        parent::boot();
        static::creating(fn(Category $category) => $category->slug = Str::slug($category->name));
        static::updating(fn(Category $category) => $category->slug = Str::slug($category->name));
    }
}
