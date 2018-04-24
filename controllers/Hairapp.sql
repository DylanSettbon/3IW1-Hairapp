#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

DROP DATABASE IF EXISTS HairApp;
CREATE DATABASE HairApp;
USE HairApp;

#------------------------------------------------------------
# Table: Hairdresser
#------------------------------------------------------------

CREATE TABLE Hairdresser(
        id            int (11) Auto_increment  NOT NULL ,
        firstname     Varchar (50) NOT NULL ,
        lastname      Varchar (50) NOT NULL ,
        email         Varchar (250) NOT NULL ,
        profilPicture Varchar (100) NOT NULL ,
        pwd           Varchar (50) NOT NULL ,
        token         Varchar (250) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Appointment
#------------------------------------------------------------

CREATE TABLE Appointment(
        id              int (11) Auto_increment  NOT NULL ,
        dateAppointment Date NOT NULL ,
        hourAppointment Time NOT NULL ,
        id_User         Int ,
        id_Hairdresser  Int ,
        id_Package      Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Product
#------------------------------------------------------------

CREATE TABLE Product(
        id          int (11) Auto_increment  NOT NULL ,
        name        Varchar (50) NOT NULL ,
        description Varchar (250) NOT NULL ,
        price       Float NOT NULL ,
        id_User     Int ,
        id_Category Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Category
#------------------------------------------------------------

CREATE TABLE Category(
        id              int (11) Auto_increment  NOT NULL ,
        description     Varchar (250) NOT NULL ,
        id_User         Int ,
        id_CategoryType Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        id               int (11) Auto_increment  NOT NULL ,
        firstname        Varchar (25) NOT NULL ,
        lastname         Varchar (25) NOT NULL ,
        email            Varchar (25) NOT NULL ,
        pwd              Varchar (25) NOT NULL ,
        token            Varchar (25) NOT NULL ,
        number           Integer NOT NULL ,
        receivePromOffer Integer NOT NULL ,
        status           Integer NOT NULL ,
        dateInserted     Date NOT NULL ,
        dateUpdated      Date NOT NULL ,
        lastConnection   Date NOT NULL ,
        id_Theme         Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Color
#------------------------------------------------------------

CREATE TABLE Color(
        id      int (11) Auto_increment  NOT NULL ,
        name    Varchar (50) NOT NULL ,
        code    Integer NOT NULL ,
        id_User Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Comment
#------------------------------------------------------------

CREATE TABLE Comment(
        id         int (11) Auto_increment  NOT NULL ,
        content    Varchar (250) NOT NULL ,
        id_User    Int ,
        id_Article Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CategoryType
#------------------------------------------------------------

CREATE TABLE CategoryType(
        id   int (11) Auto_increment  NOT NULL ,
        type Varchar (255) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Article
#------------------------------------------------------------

CREATE TABLE Article(
        id          int (11) Auto_increment  NOT NULL ,
        name        Varchar (50) NOT NULL ,
        description Varchar (250) NOT NULL ,
        id_Category Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Package
#------------------------------------------------------------

CREATE TABLE Package(
        id          int (11) Auto_increment  NOT NULL ,
        description Varchar (250) NOT NULL ,
        price       Float NOT NULL ,
        id_User     Int ,
        id_Category Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


