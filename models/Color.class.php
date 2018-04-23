<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 08/04/2018
 * Time: 21:13
 */

class Color extends BaseSql
{
    protected $id=null;
    protected $name;
    protected $code;

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
   public function getName()
   {
       return $this->name;
   }

   /**
    * @param mixed $name
    */
   public function setName($name)
   {
       $this->name = $name;
   }

   /**
    * @return mixed
    */
   public function getCode()
   {
       return $this->code;
   }

   /**
    * @param mixed $code
    */
   public function setCode($code)
   {
       $this->code = $code;
   }

}