<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Relationship to App\Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects() {
      return $this->belongsToMany('App\Project');
    }
}
