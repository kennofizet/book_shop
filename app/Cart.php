<?php

namespace App;

class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function updateSingle($id, $qty)
	{
		if(array_key_exists($id, $this->items)){
			$item = $this->items[$id];
		}
		$new_qty = $qty;
		$old_qty = $item['qty'];
		$old_total_price_item = $item['price'];
		
		if($item['item']->sale_price == 0){
			$new_total_price_item = ($item['item']->price)*$new_qty;
		}
		else{
			$new_total_price_item = ($item['item']->sale_price)*$new_qty;
		}
		$item['qty'] = $new_qty;
		$item['price'] = $new_total_price_item;
		
		$this->items[$id] = $item;
		$this->totalQty = $this->totalQty - $old_qty + $new_qty;
		$this->totalPrice = $this->totalPrice - $old_total_price_item + $new_total_price_item;
	}

	public function add($item, $id){
		if($item->sale_price == 0){
			$giohang = ['qty'=>0, 'price' => $item->price, 'item' => $item];
		}
		else{
			$giohang = ['qty'=>0, 'price' => $item->sale_price, 'item' => $item];
		}
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
			}
		}
		$giohang['qty']++;
		if($item->sale_price == 0){
			$giohang['price'] = $item->price * $giohang['qty'];
		}
		else{
			$giohang['price'] = $item->sale_price * $giohang['qty'];
		}
		$this->items[$id] = $giohang;
		$this->totalQty++;
		if($item->sale_price == 0){
			$this->totalPrice += $item->price;
		}
		else{
			$this->totalPrice += $item->sale_price;
		}
		
	}

	public function addMulti($item, $id, $qty){
		if($item->sale_price == 0){
			$giohang = ['qty'=>0, 'price' => $item->price, 'item' => $item];
		}
		else{
			$giohang = ['qty'=>0, 'price' => $item->sale_price, 'item' => $item];
		}
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
			}
		}
		$giohang['qty'] = $giohang['qty'] + $qty;
		if($item->sale_price == 0){
			$giohang['price'] = $item->price * $giohang['qty'];
		}
		else{
			$giohang['price'] = $item->sale_price * $giohang['qty'];
		}
		$this->items[$id] = $giohang;
		$this->totalQty = $this->totalQty + $qty;
		if($item->sale_price == 0){
			$this->totalPrice += $item->price*$qty;
		}
		else{
			$this->totalPrice += $item->sale_price*$qty;
		}
		
	}
	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
