<?php
class Package extends BaseSql {
    protected $id = null;
    protected $description;
    protected $price;
    protected $duration;
    protected $id_Category;
    protected $id_User;

    //getters and setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getIdCategory()
    {
        return $this->id_Category;
    }

    /**
     * @param mixed $id_Category
     */
    public function setIdCategory($id_Category)
    {
        $this->id_Category = $id_Category;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_User;
    }

    /**
     * @param mixed $id_User
     */
    public function setIdUser($id_User)
    {
        $this->id_User = $id_User;
    }

    public function getTextDuration(){
        if($this->duration == 0){ return 'Aucune durée précisée';}

        if ($this->duration < 60){
            return $this->duration.' minute(s)';
        }
        else if($this->duration % 60 == 0){
            return $this->duration/60 .' heure(s)';
        }
        else{
            return ($this->duration - $this->duration % 60) / 60 .' heure(s) ' . ($this->duration % 60) . ' minute(s)';
        }
    }

    public function getAssociativeArrayPackage(){
        $package = new Package();
        $packages = $package->getAllBy([], null, 2);
        $associativePackages = [];
        foreach($packages as $package){
            if(array_key_exists($package->getIdCategory(),$associativePackages)){
                array_push($associativePackages[$package->getIdCategory()],$package);
            }
            else{
                $associativePackages[$package->getIdCategory()] = [$package];
            }
        }
        return $associativePackages;
    }
}