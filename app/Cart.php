<?php

namespace App;

class Cart
{
	public $products = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart)
	{
		if ($oldCart) {
			$this->products = $oldCart->products;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}
	//Add or create
	public function add($product, $unit)
	{
		//instantiate a new product to be added to cart
		$productInCart = ['units' => 0, 'unitsTotal' => $product->price, 'product' => $product];

		//check if we already have products added to carts
		if ($this->products) {
			// check if this product was already added to cart
			if (array_key_exists($product->id, $this->products)) {
				//assign the product cart details
				$productInCart = $this->products[$product->id];
			}
		}
		//increase product units
		$productInCart['units'] += $unit;
		$productInCart['unitsTotal'] = $product->price * $productInCart['units'];
		$this->products[$product->id] = $productInCart;
		$this->totalQty += $unit;
		$this->totalPrice += $productInCart['unitsTotal'];
	}

	//reduce product by 1
	public function decrQty($id)
	{
		$this->products[$id]['units']--;
		$this->products[$id]['price'] -= $this->products[$id]['product']['price'];
		$this->totalQty--;
		$this->totalPrice -= $this->products[$id]['product']['price'];
		if ($this->products[$id]['units'] <= 0) {
			unset($this->products[$id]);
		}
	}

	//remove a product from cart/ remove from session
	public function removeItem($id)
	{
		$this->totalQty -= $this->products[$id]['units'];
		$this->totalPrice -= $this->products[$id]['unitsTotal'];
		unset($this->products[$id]);
	}

	//update or create
	public function update($product, $unit)
	{
		//instantiate a new product to be added to cart
		$productInCart = ['units' => 0, 'unitsTotal' => 0, 'product' => $product];

		//check if we already have products added to carts
		if ($this->products) {
			// check if this product was already added to cart
			if (array_key_exists($product->id, $this->products)) {

				//assign the product in cart details
				$productInCart = $this->products[$product->id];

				//remove old values
				$this->totalQty -= $productInCart['units'];
				$this->totalPrice -= $productInCart['unitsTotal'];
				if ($this->products[$product->id]['units'] <= 0) {
					unset($this->products[$product->id]);
					return;
				}
			}
		}

		//set new values
		$productInCart['units'] = $unit;
		$productInCart['unitsTotal'] = $product->price * $unit;
		$this->products[$product->id] = $productInCart;
		$this->totalQty += $unit;
		$this->totalPrice += $productInCart['unitsTotal'];
	}
}
