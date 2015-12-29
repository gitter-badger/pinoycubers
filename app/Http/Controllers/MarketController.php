<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;
use App\Http\Requests;
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
        return View::make('market.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getItem($id)
    {
        //
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
    public function postAddItem()
    {
        //
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
