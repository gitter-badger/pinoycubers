<?php

namespace App\Http\Controllers\Market;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\MarketRequest;
use App\Market\Items\Item;
use App\Market\Items\ItemRepository;
use App\Market\Items\Comments\Comment;
use App\Market\Items\Comments\CommentRepository;
use Illuminate\Http\Request;
use Redirect;
use View;

class ItemController extends Controller
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
     * @param \App\Market\Items\ItemRepository $items
     * @param \App\Market\Items\Comments\CommentRepository $comments
     */
    public function __construct(ItemRepository $items, CommentRepository $comments)
    {
        $this->items = $items;
        $this->Comments = $Comments;
    }

    public function index()
    {
        $items = $this->items->getAllPaginated(15);

        return View::make('market.index', compact('items'));
    }

    public function show($slug)
    {
        $item = $this->items->getBySlug($slug);
        $comments = Comment::with('user')->where('item_id', $item->id)->get();

        $viewers = unserialize($item->viewers);
        $uid = Auth::user()->id;

        if($item->user->id != $uid && !in_array($uid, $viewers)) {
            array_push($viewers, $uid);
            $input = ['viewers' => serialize($viewers)];

            $item->fill($input)->save();
        }

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
        $Item = new Item;
        $Item['user_id'] = Auth::user()->id;
        $Item['title'] = $request['title'];
        $Item['description'] = $request['description'];
        $Item['contact'] = $request['contact'];
        $Item['price'] = $request['price'];
        $Item['type'] = $request['type'];
        $Item['other_type'] = $request['other_type'];
        $Item['manufacturer'] = $request['manufacturer'];
        $Item['other_manufacturer'] = $request['other_manufacturer'];
        $Item['condition'] = $request['condition'];
        $Item['condition_details'] = $request['condition-details'];
        $Item['container'] = $request['container'];
        $Item['shipping'] = $request['shipping'];
        $Item['shipping_details'] = $request['shipping-details'];
        $Item['meetups'] = $request['meetups'];
        $Item['meetup_details'] = $request['meetup-details'];
        $Item['viewers'] = serialize([]);

        $slug = str_slug($request['title']);
        $count = Item::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        $Item['slug'] = $count ? "{$slug}-{$count}" : $slug;

        Auth::user()->marketitem()->save($Item);

        return Redirect::to('market')->with('success', 'Item successfuly added');
    }

    public function getEdit($slug)
    {
        $item = Item::with('user')->where('slug', $slug)->firstOrFail();

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

    public function postEdit(MarketRequest $request, $slug)
    {
        $Item = Item::where('slug', $slug)->firstOrFail();

        if($Item->user_id != Auth::user()->id) {
            return Redirect::to('market');
        }

        $input_slug = str_slug($request['title']);

        if($slug != $input_slug) {
            $count = Item::whereRaw("slug RLIKE '^{$input_slug}(-[0-9]+)?$'")->count();
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
            'slug' => $slug,
        ];

        $Item->fill($input)->save();

        return Redirect::to('market')->with('success', 'Item successfuly updated');
    }
}
