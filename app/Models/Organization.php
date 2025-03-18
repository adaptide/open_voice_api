<?php

namespace App\Models;

use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperOrganization
 */
class Organization extends Model implements HasAvatar
{
    use HasFactory;

    protected $guarded = false;

    public static function boot(){
        parent::boot();
        static::creating(function($organization) {
         $organization->slug  = Str::slug($organization->name);
        });
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('default.png');
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function members(){
        return $this->belongsToMany(User::class,'organization_user');
    }
    public function texts()
    {
        return $this->hasManyThrough(
            Text::class,
            Project::class,
            'organization_id',
            'project_id',
            'id',
            'id'
        );
    }
    public function recordings()
    {
        return $this->hasManyThrough(
            Recording::class,
            Text::class,
            'project_id',    // Foreign key on Texts table
            'text_id',       // Foreign key on Recordings table
            'id',            // Local key on Organizations table
            'id'             // Local key on Projects table
        )->join('projects', 'texts.project_id', '=', 'projects.id')
          ->whereColumn('projects.organization_id', 'organizations.id');
    }
}
