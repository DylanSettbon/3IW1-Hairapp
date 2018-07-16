#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

DROP DATABASE IF EXISTS HairApp;
CREATE DATABASE HairApp;
USE HairApp;

#------------------------------------------------------------
# Table: Appointment
#------------------------------------------------------------

CREATE TABLE appointment(
        id              int (11) Auto_increment  NOT NULL ,
        dateAppointment Date NOT NULL ,
        hourAppointment Time NOT NULL ,
        id_user         Int ,
        id_Hairdresser  Int ,
        id_Package      Int ,
        status          TINYINT(1) DEFAULT 1,
        PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Product
#------------------------------------------------------------

CREATE TABLE product(
        id          int (11) Auto_increment  NOT NULL ,
        name        Varchar (50) NOT NULL ,
        description Varchar (250) NOT NULL ,
        price       Float NOT NULL ,
        id_user     Int ,
        id_Category Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Category
#------------------------------------------------------------

CREATE TABLE category(
        id              int (11) Auto_increment  NOT NULL ,
        description     Varchar (250) NOT NULL ,
        id_user         Int ,
        id_CategoryType Int ,
        status          TINYINT(1) DEFAULT 1,
        displayOrder    INT(4) NULL DEFAULT NULL,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        id               int (11) Auto_increment  NOT NULL ,
        firstname        Varchar (25) NOT NULL ,
        lastname         Varchar (25) NOT NULL ,
        email            Varchar (150) NOT NULL ,
        pwd              Varchar (60) NOT NULL ,
        token            Varchar (25) NOT NULL ,
        tel              Varchar (25) NOT NULL ,
        changetopwd      Boolean NOT NULL ,
        receivePromOffer TINYINT(1) NOT NULL,
        status           TINYINT(1) NOT NULL,
        dateInserted     Date NOT NULL ,
        dateUpdated      Date NOT NULL ,
        lastConnection   Date DEFAULT NULL ,
        picture          VARCHAR(150) DEFAULT NULL,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Color
#------------------------------------------------------------

CREATE TABLE color(
        id      int (11) Auto_increment  NOT NULL ,
        name    Varchar (50) NOT NULL ,
        code    Integer NOT NULL ,
        id_user Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Comment
#------------------------------------------------------------

CREATE TABLE comment(
        id         int (11) Auto_increment  NOT NULL ,
        content    Varchar (250) NOT NULL ,
        id_user    Int ,
        id_Article Int ,
        statut Int (11) NULL DEFAULT '1' COMMENT '1:en attente 0:refuse 2:accepté' ,
        date TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CategoryType
#------------------------------------------------------------

CREATE TABLE categorytype(
        id   int (11) Auto_increment  NOT NULL ,
        type Varchar (255) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Pages
#------------------------------------------------------------

CREATE TABLE pages (
        id int(11) AUTO_INCREMENT NOT NULL,
        title varchar(50) NOT NULL,
        content longtext NOT NULL,
        isNavbar tinyint(1) NOT NULL,
        url varchar(25) NOT NULL,
        active tinyint(4) NOT NULL,
        id_template INT NOT NULL,
        PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: Article
#------------------------------------------------------------

CREATE TABLE article(
        id          int (11) Auto_increment  NOT NULL ,
        name        Varchar (50) NOT NULL ,
        description Varchar (250) NOT NULL ,
        dateparution Date NOT NULL,
        minidescription Varchar(40) NOT NULL,
        image Varchar(250) ,
        status tinyint(1) NOT NULL,
        id_Category Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Package
#------------------------------------------------------------

CREATE TABLE package(
        id          int (11) Auto_increment  NOT NULL ,
        description Varchar (250) NOT NULL ,
        price       Float NOT NULL ,
        duration	int (5) DEFAULT 0,
        id_User     Int ,
        id_Category Int ,
        status          TINYINT(1) DEFAULT 1,
        PRIMARY KEY (id )
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Theme
#------------------------------------------------------------

CREATE TABLE theme(
        id      int (11) Auto_increment  NOT NULL ,
        name    Varchar (50) NOT NULL ,
        id_User Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Configuration
#------------------------------------------------------------

CREATE TABLE configuration(
        id       int (11) Auto_increment  NOT NULL ,
        admin    Varchar (50) NOT NULL ,
        logo     Varchar (100) NOT NULL ,
        image    Varchar (100) NOT NULL ,
        id_User  Int ,
        id_Color Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


ALTER TABLE appointment ADD CONSTRAINT FK_Appointment_id_user FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE appointment ADD CONSTRAINT FK_Appointment_id_Hairdresser FOREIGN KEY (id_Hairdresser) REFERENCES user(id);
ALTER TABLE appointment ADD CONSTRAINT FK_Appointment_id_Package FOREIGN KEY (id_Package) REFERENCES package(id);
ALTER TABLE product ADD CONSTRAINT FK_Product_id_user FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE product ADD CONSTRAINT FK_Product_id_Category FOREIGN KEY (id_Category) REFERENCES category(id);
ALTER TABLE category ADD CONSTRAINT FK_Category_id_user FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE category ADD CONSTRAINT FK_Category_id_CategoryType FOREIGN KEY (id_CategoryType) REFERENCES categoryType(id);
ALTER TABLE color ADD CONSTRAINT FK_Color_id_user FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE comment ADD CONSTRAINT FK_Comment_id_user FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE comment ADD CONSTRAINT FK_Comment_id_Article FOREIGN KEY (id_Article) REFERENCES article(id);
ALTER TABLE article ADD CONSTRAINT FK_Article_id_Category FOREIGN KEY (id_Category) REFERENCES category(id);
ALTER TABLE package ADD CONSTRAINT FK_Package_id_user FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE package ADD CONSTRAINT FK_Package_id_Category FOREIGN KEY (id_Category) REFERENCES category(id);
ALTER TABLE theme ADD CONSTRAINT FK_Theme_id_user FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE configuration ADD CONSTRAINT FK_Configuration_id_user FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE configuration ADD CONSTRAINT FK_Configuration_id_Color FOREIGN KEY (id_Color) REFERENCES color(id);

INSERT INTO categoryType(type)
VALUES  ('Article'),('Produits'),('Forfaits');