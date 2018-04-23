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


    protected $id=null;
    protected $product;
    protected $description;
    protected $image;

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

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


}