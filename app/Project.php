<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Columns that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'repo_name', 'repo_owner', 'user_id', 'description'];

    /**
     * Relationship to App\User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
      return $this->belongsTo('App\User');
    }

    /**
     * Relationship to App\Tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags() {
      return $this->belongsToMany('App\Tag');
    }
}
