<?php
class Appointment extends BaseSql{
    protected $id = null;
    protected $hairdresser;
    protected $date;
    protected $hour;
    protected $package;
    protected $customer;


    //getters and setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getHairdresser()
    {
        return $this->hairdresser;
    }

    public function setHairdresser($hairdresser): void
    {
        $this->hairdresser = $hairdresser;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getHour()
    {
        return $this->hour;
    }

    public function setHour($hour): void
    {
        $this->hour = $hour;
    }

    public function getPackage()
    {
        return $this->package;
    }

    public function setPackage($package): void
    {
        $this->package = $package;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }
}