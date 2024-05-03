<?php
namespace App;
use Session;
class Cart {
    public $groomings = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    //App/Cart.php
    public function __construct($oldCart) {
        if($oldCart) {
            $this->groomings = $oldCart->groomings;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    public function add($groomings, $id){
        $storedItem = ['qty'=>0, 'price'=>$groomings->grooming_cost, 'groomings'=> $groomings];
        if ($this->groomings){
            if (array_key_exists($id, $this->groomings)){
                $storedItem = $this->groomings[$id];
            }
        }
        $storedItem['qty'] += $groomings->qty;
        $storedItem['qty']++;
        $storedItem['price'] = $groomings->grooming_cost;
        $this->groomings[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $groomings->grooming_cost;
    }

    public function removeItem($id){
        $this->totalQty -= $this->groomings[$id]['qty'];
        $this->totalPrice -= $this->groomings[$id]['price'];
        unset($this->groomings[$id]);
    }
}