CREATE TABLE IF NOT EXISTS Stelexos (
    ID_Stelexous INT UNSIGNED NOT NULL,
    Name VARCHAR(31) NOT NULL, 
    PRIMARY KEY(ID_Stelexous)
) ENGINE = INNODB;

create TABLE IF NOT EXISTS Program (
    Program_Address INT UNSIGNED NOT NULL,
    Names VARCHAR(45) NOT NULL,
    PRIMARY KEY(Program_Address)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Axiologisi (
  ID_Axiologisis INT UNSIGNED NOT NULL,
  Dates DATE NOT NULL,
  Vathmos DOUBLE NOT NULL,  
  PRIMARY KEY(ID_Axiologisis)
)
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Organization (
  ID_Organismou INT UNSIGNED NOT NULL,
  Syntomografia VARCHAR(15) NOT NULL,
  Name VARCHAR(15) NOT NULL,
  Odos VARCHAR(31) NOT NULL,
  City VARCHAR(15) NOT NULL,
  Postal_Code INT UNSIGNED NOT NULL,
  CHECK(Postal_Code > 9999 and Postal_Code < 100000),
  PRIMARY KEY (ID_Organismou))
ENGINE = INNODB;

create TABLE IF NOT EXISTS Epistimoniko_Pedio (
    Name_Science_Field VARCHAR(30) NOT NULL,
    Code_anaforas INT UNSIGNED NOT NULL,
    PRIMARY KEY(Name_Science_Field))
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Researcher (
  ID_Ereuniti INT UNSIGNED NOT NULL,
  ID_Organismou INT UNSIGNED NOT NULL,
  First_Name VARCHAR(15) NOT NULL,
  Last_Name VARCHAR(15) NOT NULL,
  Gender VARCHAR(15) NOT NULL,
  Date_Work_Relationship DATE NOT NULL,
  Birth_Date DATE NOT NULL,
  CHECK(Gender IN ('Male','Female')),
  CHECK(DATEDIFF(NOW(), Birth_Date) > 5840 AND DATEDIFF(Date_Work_Relationship, NOW()) < 0), 
  PRIMARY KEY (ID_Ereuniti),
  INDEX fk_Researcher_Organization1_idx (ID_Organismou ASC) ,
  CONSTRAINT fk_Researcher_Organization1
    FOREIGN KEY (ID_Organismou)
    REFERENCES Organization(ID_Organismou)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Ergo_Epixorigisi (
   ID_Ergou INT UNSIGNED NOT NULL,
   Title VARCHAR(30) NOT NULL,
   Perilipsi VARCHAR(150) NOT NULL,
   Funding VARCHAR(45) NOT NULL CHECK (Funding > 100000 AND Funding < 1000000),
   Start_Date DATE NOT NULL,
   End_Date DATE NOT NULL,
   CHECK(DATEDIFF(End_Date,Start_Date) > 364 AND DATEDIFF(End_Date,Start_Date) < 1461 AND DATEDIFF(Start_Date, NOW()) < 0),
   ID_Stelexous INT UNSIGNED NOT NULL,
   ID_Ereuniti INT UNSIGNED NOT NULL,
   Program_Address INT UNSIGNED NOT NULL,
   ID_Axiologisis INT UNSIGNED NOT NULL,
   ID_Organismou INT UNSIGNED NOT NULL,
   PRIMARY KEY (ID_Ergou),
   INDEX fk_Ergo_Epixorigisi_Stelexos_idx (ID_Stelexous ASC),
   INDEX fk_Ergo_Epixorigisi_Researcher_idx (ID_Ereuniti ASC),
   INDEX fk_Ergo_Epixorigisi_Program_idx (ID_Ergou ASC),
   INDEX fk_Ergo_Epixorigisi_Organization_idx (ID_Organismou ASC),
   INDEX Ergo_Epixorigisi_StartDate_idx (Start_Date),
   INDEX Ergo_Epixorigisi_EndDate_idx (End_Date),
   UNIQUE INDEX Ergo_Epixorigisi_ID_UNIQUE (ID_Ergou ASC),
   CONSTRAINT fk_Ergo_Epixorigisi_Organization
    FOREIGN KEY (ID_Organismou)
    REFERENCES Organization (ID_Organismou)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT fk_Ergo_Epixorigisi_Stelexos
    FOREIGN KEY (ID_Stelexous)
    REFERENCES Stelexos (ID_Stelexous)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT fk_Ergo_Epixorigisi_Researcher
    FOREIGN KEY (ID_Ereuniti)
    REFERENCES Researcher (ID_Ereuniti)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT fk_Ergo_Epixorigisi_Program
    FOREIGN KEY (Program_Address)
    REFERENCES Program (Program_Address)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

create TABLE IF NOT EXISTS Epistimoniko_Pedio_Ergou(
    Name_Science_Field VARCHAR(30) NOT NULL,
    ID_Ergou INT UNSIGNED NOT NULL,
    Code_anaforas INT UNSIGNED NOT NULL,
    PRIMARY KEY(Name_Science_Field,ID_Ergou),
    CONSTRAINT Field_ID
      FOREIGN KEY (Name_Science_Field)
      REFERENCES Epistimoniko_pedio (Name_Science_Field)
      ON DELETE RESTRICT
      ON UPDATE CASCADE,
    CONSTRAINT Project_Field_ID
      FOREIGN KEY (ID_Ergou)
      REFERENCES Ergo_Epixorigisi (ID_Ergou)
      ON DELETE RESTRICT
      ON UPDATE CASCADE
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS University (
    University VARCHAR(30) NOT NULL,
    ID_Organismou INT UNSIGNED NOT NULL,
    Budget_from_Ministry_of_Education INT UNSIGNED NOT NULL,   
    PRIMARY KEY(University),
    CONSTRAINT fk_University_Organization1
      FOREIGN KEY (ID_Organismou)
      REFERENCES Organization (ID_Organismou)
      ON DELETE CASCADE
      ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Research_Center (
    Research_Center VARCHAR(30) NOT NULL,
    ID_Organismou INT UNSIGNED NOT NULL,
    Budget_from_Ministry INT UNSIGNED NOT NULL,
    Budget_from_Individuals INT UNSIGNED NOT NULL,
    
    PRIMARY KEY(Research_Center),
    CONSTRAINT fk_Research_Center_Organization1
      FOREIGN KEY (ID_Organismou)
      REFERENCES Organization (ID_Organismou)
      ON DELETE CASCADE
      ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Company (
  Company VARCHAR(30) NOT NULL,
  ID_Organismou INT UNSIGNED NOT NULL,
  Own_Money INT UNSIGNED NOT NULL,
  PRIMARY KEY(Company),
  CONSTRAINT fk_Company_Organization1
    FOREIGN KEY (ID_Organismou)
    REFERENCES Organization (ID_Organismou)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Paradoteo (
  Title_Paradoteo VARCHAR(31) NOT NULL,
  ID_Ergou INT UNSIGNED NOT NULL,
  Perilipsi  VARCHAR(63) NOT NULL,
  Date_paradosis DATE NOT NULL,
  PRIMARY KEY (Title_Paradoteo, ID_Ergou),
  INDEX fk_project0_idx (ID_Ergou ASC) ,
  CONSTRAINT fk_project0
    FOREIGN KEY (ID_Ergou)
    REFERENCES Ergo_Epixorigisi (ID_Ergou)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Works_On (
  ID_Ereuniti INT UNSIGNED NOT NULL,
  ID_Ergou INT UNSIGNED NOT NULL,
  Enarxi_enasxolisis DATE NOT NULL,
  PRIMARY KEY (ID_Ereuniti, ID_Ergou),
  INDEX fk_project_idx (ID_Ergou ASC) ,
  CONSTRAINT fk_project
    FOREIGN KEY (ID_Ergou)
    REFERENCES Ergo_Epixorigisi (ID_Ergou)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT fk_researcher
    FOREIGN KEY (ID_Ereuniti)
    REFERENCES Researcher (ID_Ereuniti)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Phones (
  ID_Organismou INT UNSIGNED NOT NULL,
  Phone_Numbers CHAR(40) NOT NULL,
  CONSTRAINT chk_phone CHECK (Phone_Numbers RLIKE('[0-9]{10}')),
  -- CONSTRAINT chk_phone CHECK REGEXP('[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'), -- check that no number is not a digit 
  PRIMARY KEY (ID_Organismou,Phone_Numbers),
  CONSTRAINT fk_Organization_ID
    FOREIGN KEY (ID_Organismou)
    REFERENCES Organization (ID_Organismou)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

DELIMITER $
CREATE TRIGGER chk_Res_Work_On_One_Organ BEFORE INSERT ON Works_On 
FOR EACH ROW
BEGIN
    IF ((SELECT ID_Organismou FROM Researcher WHERE ID_Ereuniti = new.ID_Ereuniti) <> 
        (SELECT ID_Organismou FROM Ergo_Epixorigisi WHERE ID_Ergou = new.ID_Ergou)) THEN 
    SIGNAL SQLSTATE '45000'
           SET MESSAGE_TEXT = 'check constraint on Works_On failed - A researcher can only work on projects from the organization they are in.';
    END IF;
END$   
DELIMITER ;

DELIMITER $
CREATE TRIGGER chk_Work_Submission_between_projeDates BEFORE INSERT ON Axiologisi 
FOR EACH ROW
BEGIN    
    IF (DATEDIFF(new.Dates, (SELECT End_Date FROM Ergo_Epixorigisi WHERE ID_Axiologisis = new.ID_Axiologisis)) > 0 OR 
        DATEDIFF(new.Dates, (SELECT Start_Date FROM Ergo_Epixorigisi WHERE ID_Axiologisis = new.ID_Axiologisis)) < 0) THEN 
    SIGNAL SQLSTATE '45000'
           SET MESSAGE_TEXT = 'check constraint on Works_On failed - Start date must be between start and end date of project.';
    END IF;
END$   
DELIMITER ; 

DELIMITER $
CREATE TRIGGER chk_Work_Submission_between_projDates BEFORE INSERT ON Paradoteo 
FOR EACH ROW
BEGIN
    IF (DATEDIFF(new.Date_paradosis, (SELECT End_Date FROM Ergo_Epixorigisi WHERE ID_Ergou = new.ID_Ergou)) > 0 OR 
        DATEDIFF(new.Date_paradosis, (SELECT Start_Date FROM Ergo_Epixorigisi WHERE ID_Ergou = new.ID_Ergou)) < 0) THEN 
    SIGNAL SQLSTATE '45000'
           SET MESSAGE_TEXT = 'check constraint on Work_To_Be_Submitted failed - Submission date must be between start and end date of project.';
    END IF;
END$   
DELIMITER ; 

DELIMITER $
CREATE TRIGGER chk_res_org_update BEFORE UPDATE ON Researcher
FOR EACH ROW
BEGIN
    IF (new.ID_Organismou <> old.ID_Organismou) THEN 
		IF ((SELECT COUNT(*) FROM Works_On WHERE Works_On.ID_Ereuniti = old.ID_Ereuniti) > 0) THEN
    SIGNAL SQLSTATE '45000'
           SET MESSAGE_TEXT = 'check constraint on Researcher failed - Organization can only change if researcher has no projects.';
	   END IF;
    END IF;
END$   
DELIMITER ; 

DELIMITER $
CREATE TRIGGER chk_project_org_update BEFORE UPDATE ON Ergo_Epixorigisi
FOR EACH ROW
BEGIN
    IF (new.ID_Organismou <> old.ID_Organismou) THEN 
		IF ((SELECT COUNT(*) FROM Works_On WHERE Works_On.ID_Ergou = old.ID_Ergou) > 0) THEN
    SIGNAL SQLSTATE '45000'
           SET MESSAGE_TEXT = 'check constraint on Project failed - Organization can only change if project has no researchers.';
	   END IF;
    END IF;
END$   
DELIMITER ; 

-- -----------------------------------------------------
-- View 1: Projects per Researcher
-- -----------------------------------------------------

CREATE VIEW projects_per_researcher AS
SELECT Researcher.ID_Ereuniti,
	   CONCAT(Researcher.First_Name, ' ', Researcher.Last_Name) AS `Full_Name`,
       Researcher.ID_Organismou AS Org_ID,
       Ergo_Epixorigisi.ID_Ergou,
       Ergo_Epixorigisi.Title AS `Project_Name`
FROM Researcher INNER JOIN Works_On ON Researcher.ID_Ereuniti=Works_On.ID_Ereuniti
INNER JOIN Ergo_Epixorigisi on Works_On.ID_Ergou=Ergo_Epixorigisi.ID_Ereuniti
ORDER BY Researcher.ID_Ereuniti;

-- -----------------------------------------------------
-- View 2: Projects per Field
-- -----------------------------------------------------

CREATE VIEW projects_per_field AS
SELECT Ergo_Epixorigisi.ID_Ereuniti,
       Ergo_Epixorigisi.Title AS `Project_Name`,
       Epistimoniko_Pedio.Name_Science_Field as `Field_Name`
FROM Ergo_Epixorigisi INNER JOIN Epistimoniko_Pedio_Ergou ON Ergo_Epixorigisi.ID_Ergou=Epistimoniko_Pedio_Ergou.ID_Ergou
INNER JOIN Epistimoniko_Pedio on Epistimoniko_Pedio_Ergou.Name_Science_Field=Epistimoniko_Pedio.Name_Science_Field
ORDER BY Epistimoniko_Pedio_Ergou.Name_Science_Field;
