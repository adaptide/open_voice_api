<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperText
 */
class Text extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function recordings()
    {
        return $this->hasMany(Recording::class);
    }
    public function organization()
    {
        return $this->hasOneThrough(
            Organization::class,
            Project::class,
            'id',
            'id',
            'project_id',
            'organization_id'
        );
    }
    // public function scopeGetText(Builder $query)
    // {

    //     $query->
    // }

}
