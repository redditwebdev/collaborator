<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tag;

class TagController extends Controller
{
    /**
     * @var Tag
     */
    private $tag;

    /**
     * TagController constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag) {
      $this->tag = $tag;
    }

    /**
     * View for tag
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTag(Request $request) {
      $tag = $this->tag->whereName(urldecode($request->q))->firstOrFail();

      return view('project.tag', compact('tag'));
    }
}
