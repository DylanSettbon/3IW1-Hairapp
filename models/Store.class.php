<?php
/**
 * Created by PhpStorm.
 * User: Dylan
 * Date: 05/04/2018
 * Time: 14:20
 */

class Store{
	 protected $id=null;
   	 protected $product;

   	    /**
    * @return null
    */
   public function getId()
   {
       return $this->id;
   }

   /**
    * @param null $id
    */
   public function setId($id)
   {
       $this->id = $id;
   }

   /**
    * @return mixed
    */
   public function getProduct()
   {
       return $this->product;
   }

   /**
    * @param mixed $product
    */
   public function setProduct($product)
   {
       $this->product = $product;
   }


}