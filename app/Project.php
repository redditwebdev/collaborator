<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'repo_name', 'repo_owner', 'user_id', 'description'];

    public function user() {
      return $this->belongsTo('App\User');
    }

    public function tags() {
      return $this->belongsToMany('App\Tag');
    }
}
