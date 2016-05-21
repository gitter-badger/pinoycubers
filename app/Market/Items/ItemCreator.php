<?php

namespace App\Market\Items;

class ItemCreator
{
    /**
     * @var \App\Market\Items\ItemRepository
     */
    protected $items;

    /**
     * @param \App\Market\Items\ItemRepository $items
     */
    public function __construct(ItemRepository $items)
    {
        $this->items = $items;
    }

    public function create($listener, $data)
    {
        $item = $this->items->getNew($data);
        $item->slug = $this->createSlug($item->title);

        $this->items->save($item);

        return $listener->itemCreated();
    }

    public function createSlug($title)
    {
        $slug = str_slug($title);

        $count = $this->items->countSameSlug($slug);

        return $count ? "{$slug}-{$count}" : $slug;
    }
}
