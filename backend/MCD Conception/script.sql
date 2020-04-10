#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

drop database if exists rolltogether;
create database rolltogether;
use rolltogether;
#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        Id        Int  Auto_increment  NOT NULL ,
        Pseudo    Varchar (32) NOT NULL ,
        Password  Varchar (255) NOT NULL ,
        Email     Varchar (60) NOT NULL ,
        Nom       Varchar (32) ,
        Prenom    Varchar (32) ,
        Photo     Blob ,
        VerifMail Bool NOT NULL
	,CONSTRAINT User_PK PRIMARY KEY (Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Scenario
#------------------------------------------------------------

CREATE TABLE Scenario(
        Id          Int  Auto_increment  NOT NULL ,
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


#------------------------------------------------------------
# Table: Diapositives
#------------------------------------------------------------

CREATE TABLE Diapositives(
        Numero     Int  Auto_increment  NOT NULL ,
        Text       Varchar (255) ,
        Background Blob NOT NULL ,
        Music      Varchar (255) ,
        Fog        Bool NOT NULL ,
        Id         Int NOT NULL
	,CONSTRAINT Diapositives_PK PRIMARY KEY (Numero)

	,CONSTRAINT Diapositives_Scenario_FK FOREIGN KEY (Id) REFERENCES Scenario(Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Token
#------------------------------------------------------------

CREATE TABLE Token(
        id_token   Int  Auto_increment  NOT NULL ,
        Img        Blob NOT NULL ,
        PlacementX Int NOT NULL ,
        PlacementY Int NOT NULL
	,CONSTRAINT Token_PK PRIMARY KEY (id_token)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Amis
#------------------------------------------------------------

CREATE TABLE Amis(
        Id      Int NOT NULL ,
        Id_User Int NOT NULL
	,CONSTRAINT Amis_PK PRIMARY KEY (Id,Id_User)

	,CONSTRAINT Amis_User_FK FOREIGN KEY (Id) REFERENCES User(Id)
	,CONSTRAINT Amis_User0_FK FOREIGN KEY (Id_User) REFERENCES User(Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contenir
#------------------------------------------------------------

CREATE TABLE contenir(
        id_token Int NOT NULL ,
        Numero   Int NOT NULL
	,CONSTRAINT contenir_PK PRIMARY KEY (id_token,Numero)

	,CONSTRAINT contenir_Token_FK FOREIGN KEY (id_token) REFERENCES Token(id_token)
	,CONSTRAINT contenir_Diapositives0_FK FOREIGN KEY (Numero) REFERENCES Diapositives(Numero)
)ENGINE=InnoDB;
