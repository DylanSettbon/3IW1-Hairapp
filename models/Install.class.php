<?php
/**
 * Created by PhpStorm.
 * User: Dylan
 * Date: 05/04/2018
 * Time: 14:25
 */

 class Install{
   protected $id=null;
   protected $admin;
   protected $logo;
   protected $image;
   protected $color;

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
   public function getAdmin()
   {
       return $this->admin;
   }

   /**
    * @param mixed $admin
    */
   public function setAdmin($admin)
   {
       $this->admin = $admin;
   }

   /**
    * @return mixed
    */
   public function getLogo()
   {
       return $this->logo;
   }

   /**
    * @param mixed $logo
    */
   public function setLogo($logo)
   {
       $this->logo = $logo;
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

   /**
    * @return mixed
    */
   public function getColor()
   {
       return $this->color;
   }

   /**
    * @param mixed $color
    */
   public function setColor($color)
   {
       $this->color = $color;
   }
  }
