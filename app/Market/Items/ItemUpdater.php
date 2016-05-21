<?php

namespace App\Market\Items;

class ItemUpdater
{
    /**
     * @var \App\Market\Items\ItemRepository
     */
    protected $items;

    /**
     * @var \App\Market\Items\ItemCreator
     */
    protected $itemCreator;

    /**
     * @param \App\Market\Items\ItemRepository $items
     * @param \App\Market\Items\ItemCreator $itemCreator
     */
    public function __construct(ItemRepository $items, ItemCreator $itemCreator)
    {
        $this->items = $items;
        $this->itemCreator = $itemCreator;
    }

    public function update($listener, $item, $data)
    {
        $item->fill($data);

        $item->slug = $this->itemCreator->createSlug($data['title']);

        $this->items->save($item);

        return $listener->itemUpdated();
    }
}
