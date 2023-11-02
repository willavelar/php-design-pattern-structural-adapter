<?php

namespace DesignPattern\Wrong;

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