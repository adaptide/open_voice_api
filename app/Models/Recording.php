<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperRecording
 */
class Recording extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function text()
    {
        return $this->belongsTo(Text::class);
    }
    public function organization()
    {
        return $this->hasOneThrough(
            Organization::class,
            Project::class,
            'id',              // Project's local key
            'id',              // Organization's local key
            'text_id',         // Foreign key in Texts table
            'organization_id'  // Foreign key in Projects table
        )->join('texts', 'projects.id', '=', 'texts.project_id')
         ->join('recordings', 'texts.id', '=', 'recordings.text_id')
         ->whereColumn('recordings.id', 'recordings.id');
    }
}
