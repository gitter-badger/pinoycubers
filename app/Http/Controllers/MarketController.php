<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View, Auth, Redirect;
use App\MarketItem;
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
        $items = MarketItem::with('user')->paginate(20);

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

        return View::make('market.item', compact('item'));
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
    public function getEditItem($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEditItem($id)
    {
        //
    }
}
