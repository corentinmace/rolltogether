#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        Id       Int  Auto_increment  NOT NULL ,
        Pseudo   Varchar (32) NOT NULL ,
        Password Varchar (255) NOT NULL ,
        Email    Varchar (60) NOT NULL ,
        Nom      Varchar (32) ,
        Prenom   Varchar (32) ,
        Photo    Blob
	,CONSTRAINT User_PK PRIMARY KEY (Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Scenario
#------------------------------------------------------------

CREATE TABLE Scenario(
        Id          Int  Auto_increment  NOT NULL ,
        Chemin      Varchar (60) NOT NULL ,
        Nom         Varchar (60) NOT NULL ,
        Note        TinyINT NOT NULL ,
        Description Varchar (500) NOT NULL ,
        Id_User     Int NOT NULL
	,CONSTRAINT Scenario_PK PRIMARY KEY (Id)

	,CONSTRAINT Scenario_User_FK FOREIGN KEY (Id_User) REFERENCES User(Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Partie
#------------------------------------------------------------

CREATE TABLE Partie(
        Id          Int  Auto_increment  NOT NULL ,
        NbJoueur    TinyINT NOT NULL ,
        Visible     Bool NOT NULL ,
        Nom         Varchar (60) NOT NULL ,
        Id_Scenario Int NOT NULL ,
        Id_User     Int NOT NULL
	,CONSTRAINT Partie_PK PRIMARY KEY (Id)

	,CONSTRAINT Partie_Scenario_FK FOREIGN KEY (Id_Scenario) REFERENCES Scenario(Id)
	,CONSTRAINT Partie_User0_FK FOREIGN KEY (Id_User) REFERENCES User(Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Sauvegarde
#------------------------------------------------------------

CREATE TABLE Sauvegarde(
        Id        Int  Auto_increment  NOT NULL ,
        Nom       Varchar (50) NOT NULL ,
        Chemin    Varchar (50) NOT NULL ,
        Id_Partie Int NOT NULL
	,CONSTRAINT Sauvegarde_PK PRIMARY KEY (Id)

	,CONSTRAINT Sauvegarde_Partie_FK FOREIGN KEY (Id_Partie) REFERENCES Partie(Id)
)ENGINE=InnoDB;

