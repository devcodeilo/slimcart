<?php

namespace Cart\Models;

use Cart\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	public $quantity = null;

	/* Checks for low stock. */
	public function hasLowStock() {
		if ($this->outOfStock()) {
			return false;
		}
		return (bool) ($this->stock <= 5);
	}

	/* Checks for out of stock. */
	public function outOfStock() {
		return $this->stock === 0;
	}

	/* Checks for in stock. */
	public function inStock() {
		return $this->stock >= 1;
	}

	/* Checks for any stock. */
	public function hasStock($quantity) {
		return $this->stock >= $quantity;
	}

	/* Relationship. */
	public function order() {

		return $this->belongsToMany(Order::class, 'orders_products')->withPivot('quantity');

	}
	
}
