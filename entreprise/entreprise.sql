DROP DATABASE IF EXISTS employe;

CREATE DATABASE IF NOT EXISTS employe;

USE employe;

#------------------------------------------------------------
# Table: employe
#------------------------------------------------------------

CREATE TABLE employe(
        idemploye Int  Auto_increment  NOT NULL ,
        nom      Varchar (50) NOT NULL ,
        prenom   Varchar (50) NOT NULL ,
        sexe     Varchar (1) NOT NULL ,
        departement Varchar (50) NOT NULL ,
        salaire  Varchar (50) NOT NULL ,
        dateContrat Date NOT NULL 
	,CONSTRAINT employe_PK PRIMARY KEY (idemploye)
)ENGINE=InnoDB;