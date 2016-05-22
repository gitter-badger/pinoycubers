<?php

namespace App\Http\Controllers\Market;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\MarketRequest;
use App\Market\Items\Item;
use App\Market\Items\ItemRepository;
use App\Market\Items\ItemCreator;
use App\Market\Items\ItemCreatorListener;
use App\Market\Items\ItemUpdater;
use App\Market\Items\ItemUpdaterListener;
use App\Market\Items\Comments\Comment;
use App\Market\Items\Comments\CommentRepository;
use Illuminate\Http\Request;
use Redirect;
use View;

class ItemController extends Controller implements ItemCreatorListener
{
    /**
     * @var \App\Market\Items\ItemRepository
     */
    protected $items;

    /**
     * @var \App\Market\Items\Comments\CommentRepository
     */
    protected $comments;

    /**
     * @var \App\Market\Items\ItemCreator
     */
    protected $itemCreator;

    /**
     * @var \App\Market\Items\ItemUpdater
     */
    protected $itemUpdater;

    protected $itemsPerPage = 15;

    protected $commentsPerPage = 10;

    /**
     * @param \App\Market\Items\ItemRepository $items
     * @param \App\Market\Items\Comments\CommentRepository $comments
     * @param \App\Market\Items\ItemCreator $itemCreator
     * @param \App\Market\Items\ItemUpdater $itemUpdater
     */
    public function __construct(ItemRepository $items, CommentRepository $comments, ItemCreator $itemCreator, ItemUpdater $itemUpdater)
    {
        $this->items = $items;
        $this->comments = $comments;
        $this->itemCreator = $itemCreator;
        $this->itemUpdater = $itemUpdater;
    }

    public function index()
    {
        $items = $this->items->getAllPaginated($this->itemsPerPage);

        return View::make('market.index', compact('items'));
    }

    public function show($slug)
    {
        $item = $this->items->getBySlug($slug);
        $comments = $this->comments->getFromItemPaginated($item, $this->commentsPerPage);

        return View::make('market.show', compact('item', 'comments'));
    }

    public function getAdd()
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

    public function postAdd(MarketRequest $request)
    {
        $data = $request->all();
        $data['seller'] = $request->user();
        $data['viewers'] = serialize([]);

        return $this->itemCreator->create($this, $data);
    }

    public function getEdit($slug, Request $request)
    {
        $item = $this->items->getBySlug($slug);

        if(! $item && ! $item->isManageableBy($request->user()))
        {
            return $this->actionNotAllowed();
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

    public function postEdit($slug, MarketRequest $request)
    {
        $item = $this->items->getBySlug($slug);

        if(! $item && ! $item->isManageableBy($request->user()))
        {
            return $this->actionNotAllowed();
        }

        $data = $request->all();

        return $this->itemUpdater->update($this, $item, $data);
    }

    public function itemCreated()
    {
        return Redirect::to('market')->with('success', 'Item successfuly added');
    }

    public function itemUpdated()
    {
        return Redirect::to('market')->with('success', 'Item successfuly updated');
    }

    public function actionNotAllowed()
    {
        return Redirect::to('market');
    }
}
