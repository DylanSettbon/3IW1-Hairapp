<?php
class Appointment extends BaseSql{
    protected $id ;
    protected $id_Hairdresser;
    protected $dateAppointment;
    protected $hourAppointment;
    protected $id_Package;
    protected $id_User;
    protected $firstname;
    protected $lastname;

    /**
     * Appointment constructor.
     */
    public function __construct()
    {
        parent::__construct();

    }

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
    public function getIdHairdresser()
    {
        return $this->id_Hairdresser;
    }

    /**
     * @param mixed $id_Hairdresser
     */
    public function setIdHairdresser($id_Hairdresser)
    {
        $this->id_Hairdresser = $id_Hairdresser;
    }

    /**
     * @return mixed
     */
    public function getDateAppointment()
    {
        return $this->dateAppointment;
    }

    /**
     * @param mixed $dateAppointment
     */
    public function setDateAppointment($dateAppointment)
    {
        $this->dateAppointment = $dateAppointment;
    }

    /**
     * @return mixed
     */
    public function getHourAppointment()
    {
        return $this->hourAppointment;
    }

    /**
     * @param mixed $hourAppointment
     */
    public function setHourAppointment($hourAppointment)
    {
        $this->hourAppointment = $hourAppointment;
    }

    /**
     * @return mixed
     */
    public function getIdPackage()
    {
        return $this->id_Package;
    }

    /**
     * @param mixed $id_Package
     */
    public function setIdPackage($id_Package)
    {
        $this->id_Package = $id_Package;
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

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstnam
     */
    public function setFirstnam($firstname)
    {
        $this->firstnam = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public static  function changeMonth( $date ){
        $month = date( "F", strtotime($date) );

        switch ( $month ){
            case 'January' : $res = str_replace( 'January', 'Janvier', $date ); break;
            case 'February': $res = str_replace( 'February', 'Février', $date ); break;
            case 'March': $res = str_replace( 'March', 'Mars', $date ); break;
            case 'April': $res = str_replace( 'April', 'Avril', $date ); break;
            case 'May': $res = str_replace( 'May', 'Mai', $date ); break;
            case 'June': $res = str_replace( 'June', 'Juin', $date ); break;
            case 'July': $res = str_replace( 'July', 'Juillet', $date ); break;
            case 'August': $res = str_replace( 'August', 'Août', $date ); break;
            case 'September': $res = str_replace( 'September', 'Septembre', $date ); break;
            case 'October': $res = str_replace( 'October', 'Octobre', $date ); break;
            case 'November': $res = str_replace( 'November', 'Novembre', $date ); break;
            case 'December': $res = str_replace( 'December', 'Décembre', $date ); break;
        }

        return $res;
    }

}