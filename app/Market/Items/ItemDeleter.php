<?php

namespace App\Market\Items;

class ItemDeleter
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

    public function delete($listener, $item)
    {
        $this->items->delete($item);

        return $listener->itemDeleted();
    }
}
