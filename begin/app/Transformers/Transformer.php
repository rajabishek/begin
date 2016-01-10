<?php 

namespace Begin\Transformers;

abstract class Transformer
{
	/**
     * Transform the given collection of items
     *
     * @param array $items
     * @return array
     */
    public function transformCollection(array $items){

        return array_map([$this, 'transform'], $items);
    }

    /**
     * Transform the given item
     *
     * @param array $item
     * @return array
     */
    public abstract function transform($item);	
}