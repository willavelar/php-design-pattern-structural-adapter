<?php

namespace DesignPattern\Right;

class Budget
{
    public float $value;
    public int $items;

    public function toArray() : array
    {
        return [
            'value' => $this->value,
            'items' => $this->items
        ];
    }
}