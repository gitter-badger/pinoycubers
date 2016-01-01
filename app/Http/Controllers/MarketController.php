<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View, Auth, Redirect;
use App\MarketItem;
use App\MarketItemComments;
use App\Http\Requests;
use App\Http\Requests\MarketRequest;
use App\Http\Controllers\Controller;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showIndex()
    {
        $items = MarketItem::with('user', 'comments')->orderBy('created_at', 'desc')->paginate(10);

        return View::make('market.index', compact('items'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getItem($slug)
    {
        $item = MarketItem::with('user')->where('slug', $slug)->firstOrFail();
        $comments = MarketItemComments::with('user')->where('item_id', $item->id)->get();

        return View::make('market.item', compact('item', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getAddItem()
    {
        $types = [
            'puzzle' => 'Puzzle',
            'timer' => 'Timer',
            'sticker' => 'Sticker',
            'accessory' => 'Accessory',
            'other' => 'Other'
        ];

        $manufacturers = [
            'dayan' => 'Dayan',
            'moyu' => 'Moyu',
            'yj' => 'YongJun/YJ',
            'lanlan' => 'Lanlan',
            'shengshou' => 'Shengshou',
            'gans' => 'Gans',
            'cyclone' => 'Cyclone Boys',
            'qj' => 'QJ',
            'yuxin' => 'Yuxin',
            'other' => 'Other'
        ];

        return View::make('market.add', compact('types', 'manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postAddItem(MarketRequest $request)
    {
        $MarketItem = new MarketItem;
        $MarketItem['user_id'] = Auth::user()->id;
        $MarketItem['title'] = $request['title'];
        $MarketItem['description'] = $request['description'];
        $MarketItem['contact'] = $request['contact'];
        $MarketItem['price'] = $request['price'];
        $MarketItem['type'] = $request['type'];
        $MarketItem['other_type'] = $request['other_type'];
        $MarketItem['manufacturer'] = $request['manufacturer'];
        $MarketItem['other_manufacturer'] = $request['other_manufacturer'];
        $MarketItem['condition'] = $request['condition'];
        $MarketItem['condition_details'] = $request['condition-details'];
        $MarketItem['container'] = $request['container'];
        $MarketItem['shipping'] = $request['shipping'];
        $MarketItem['shipping_details'] = $request['shipping-details'];
        $MarketItem['meetups'] = $request['meetups'];
        $MarketItem['meetup_details'] = $request['meetup-details'];

        $slug = str_slug($request['title']);
        $count = MarketItem::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        $MarketItem['slug'] = $count ? "{$slug}-{$count}" : $slug;

        Auth::user()->marketitem()->save($MarketItem);

        return Redirect::to('market')->with('success', 'Item successfuly added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEditItem($slug)
    {
        $item = MarketItem::with('user')->where('slug', $slug)->firstOrFail();

        if($item->user_id != Auth::user()->id) {
            return Redirect::to('market');
        }

        $types = [
            'puzzle' => 'Puzzle',
            'timer' => 'Timer',
            'sticker' => 'Sticker',
            'accessory' => 'Accessory',
            'other' => 'Other'
        ];

        $manufacturers = [
            'dayan' => 'Dayan',
            'moyu' => 'Moyu',
            'yj' => 'YongJun/YJ',
            'lanlan' => 'Lanlan',
            'shengshou' => 'Shengshou',
            'gans' => 'Gans',
            'cyclone' => 'Cyclone Boys',
            'qj' => 'QJ',
            'yuxin' => 'Yuxin',
            'other' => 'Other'
        ];

        return View::make('market.edit', compact('item', 'types', 'manufacturers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEditItem(MarketRequest $request, $slug)
    {
        $MarketItem = MarketItem::where('slug', $slug)->firstOrFail();

        if($MarketItem->user_id != Auth::user()->id) {
            return Redirect::to('market');
        }

        $input_slug = str_slug($request['title']);

        if($slug != $input_slug) {
            $count = MarketItem::whereRaw("slug RLIKE '^{$input_slug}(-[0-9]+)?$'")->count();
            $slug = $count ? "{$input_slug}-{$count}" : $input_slug;
        }

        $input = [
            'title' => $request['title'],
            'description' => $request['description'],
            'contact' => $request['contact'],
            'type' => $request['type'],
            'other_type' => $request['other_type'],
            'manufacturer' => $request['manufacturer'],
            'other_manufacturer' => $request['other_manufacturer'],
            'condition' => $request['condition'],
            'condition_details' => $request['condition-details'],
            'container' => $request['container'],
            'shipping' => $request['shipping'],
            'shipping_details' => $request['shipping-details'],
            'meetups' => $request['meetups'],
            'meetup_details' => $request['meetup-details'],
            'slug' => $slug
        ];

        $MarketItem->fill($input)->save();

        return Redirect::to('market')->with('success', 'Item successfuly updated');
    }

    public function postComment(Request $request, $id) {
        $MarketItem = MarketItem::where('id', $id)->firstOrFail();

        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = new MarketItemComments;
        $comment['item_id'] = $MarketItem->id;
        $comment['comment'] = $request['comment'];

        Auth::user()->itemcomments()->save($comment);

        return Redirect::to('market/item/'.$MarketItem->slug);
    }
}
