<?php

namespace App\Http\Controllers\Market;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\MarketRequest;
use App\Market\Items\Item;
use App\Market\Items\Comments\Comment;
use Illuminate\Http\Request;
use Redirect;
use View;

class CommentController extends Controller
{
	public function postComment(Request $request, $slug) {
        $Item = Item::where('slug', $slug)->firstOrFail();

        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = new Comment;
        $comment['item_id'] = $Item->id;
        $comment['comment'] = $request['comment'];

        Auth::user()->itemcomments()->save($comment);

        return Redirect::to('market/item/'.$Item->slug);
    }
}
