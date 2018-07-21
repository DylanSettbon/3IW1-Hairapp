#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

DROP DATABASE IF EXISTS DB_NAME;
CREATE DATABASE DB_NAME;
USE DB_NAME;

#------------------------------------------------------------
# Table: Appointment
#------------------------------------------------------------

CREATE TABLE appointment(
        idAppointment   int (11) Auto_increment  NOT NULL ,
        dateAppointment Date NOT NULL ,
        hourAppointment Time NOT NULL ,
        id_user         Int ,
        id_Hairdresser  Int ,
        id_Package      Int ,
        planned         TINYINT(1) DEFAULT 1,
        took            Date NOT NULL,
        PRIMARY KEY (idAppointment)
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
        id_category              int (11) Auto_increment  NOT NULL ,
        description_category     Varchar (250) NOT NULL ,
        id_user         Int ,
        id_CategoryType Int ,
        status_category          TINYINT(1) DEFAULT 1,
        displayOrder    INT(4) NULL DEFAULT NULL,
        PRIMARY KEY (id_category )
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
        tel              Varchar (25) DEFAULT NULL ,
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
        name    Varchar (200) NOT NULL ,
        code    Varchar (7) NOT NULL ,
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
        description LONGTEXT NOT NULL ,
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
        id_config int(11) NOT NULL AUTO_INCREMENT,
        logo varchar(100) NOT NULL,
        name VARCHAR(50) NOT NULL,
        email_address varchar(150) DEFAULT NULL,
        email_pwd varchar(60) DEFAULT NULL,
        postal_address varchar(255) DEFAULT NULL,
        status_configuration int(1) NOT NULL DEFAULT '1',
        facebook_link VARCHAR(150) DEFAULT NULL,
        twitter_link VARCHAR(150) DEFAULT NULL,
        instagram_link VARCHAR(150) DEFAULT NULL,
        pinterest_link VARCHAR(150) DEFAULT NULL,
        PRIMARY KEY (id_config)
)ENGINE=InnoDB;


ALTER TABLE appointment ADD CONSTRAINT FK_Appointment_id_user FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE appointment ADD CONSTRAINT FK_Appointment_id_Hairdresser FOREIGN KEY (id_Hairdresser) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE appointment ADD CONSTRAINT FK_Appointment_id_Package FOREIGN KEY (id_Package) REFERENCES package(id) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE product ADD CONSTRAINT FK_Product_id_user FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE product ADD CONSTRAINT FK_Product_id_Category FOREIGN KEY (id_Category) REFERENCES category(id_category) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE category ADD CONSTRAINT FK_Category_id_user FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE category ADD CONSTRAINT FK_Category_id_CategoryType FOREIGN KEY (id_CategoryType) REFERENCES categoryType(id) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE color ADD CONSTRAINT FK_Color_id_user FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE comment ADD CONSTRAINT FK_Comment_id_user FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE comment ADD CONSTRAINT FK_Comment_id_Article FOREIGN KEY (id_Article) REFERENCES article(id) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE article ADD CONSTRAINT FK_Article_id_Category FOREIGN KEY (id_Category) REFERENCES category(id_category) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE package ADD CONSTRAINT FK_Package_id_user FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE package ADD CONSTRAINT FK_Package_id_Category FOREIGN KEY (id_Category) REFERENCES category(id_category) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE theme ADD CONSTRAINT FK_Theme_id_user FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE ;
