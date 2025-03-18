<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
/**
 * @mixin IdeHelperProject
 */
class Project extends Model
{
    use HasFactory;

    protected $guarded = false;
    public static function boot(){
        parent::boot();
        static::creating(function($project) {
         $project->slug  = Str::slug($project->name);
        });
    }
    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
