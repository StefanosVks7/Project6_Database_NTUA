3.3) Query
ΕΡΓΑ ΠΟΥ ΧΡΗΜΑΤΟΔΟΤΟΥΝΤΑΙ ΣΕ ΕΝΑΝ ΣΥΓΚΕΚΡΙΜΕΝΟ ΕΠΙΣΤΗΜΟΝΙΚΟ ΤΟΜΕΑ, ΠΧ ΒΑΛΑΜΕ "Flagship Projects" που είναι ένας από τους υπαρκτούς του ΕΛΙΔΕΚ:

SELECT ergo_epixorigisi.ID_Ergou, Title 
FROM ergo_epixorigisi INNER JOIN epistimoniko_pedio_ergou 
ON ergo_epixorigisi.ID_Ergou = epistimoniko_pedio_ergou.ID_Ergou 
WHERE Name_Science_Field = "Flagship Projects" 
AND DATEDIFF(ergo_epixorigisi.End_Date, NOW()) > 0;

ΕΡΕΥΝΗΤΕΣ ΠΟΥ ΔΡΑΣΤΗΡΙΟΠΟΙΟΥΝΤΑΙ ΣΕ ΑΥΤΟ ΤΟ ΠΕΔΙΟ ΣΤΟ ΤΕΛΕΥΤΑΙΟ ΕΤΟΣ ΣΤΟΝ ΕΛΙΔΕΚ ΜΕ QUERY:

SELECT Researcher.ID_Ereuniti, CONCAT(Researcher.First_Name,' ',Researcher.Last_Name) 
AS Full_Name, works_on.Enarxi_enasxolisis 
FROM epistimoniko_pedio_ergou INNER JOIN ergo_epixorigisi 
ON ergo_epixorigisi.ID_Ergou = epistimoniko_pedio_ergou.ID_Ergou 
AND Name_Science_Field = "Flagship Projects" 
INNER JOIN works_on 
ON ergo_epixorigisi.ID_Ergou = works_on.ID_Ergou 
INNER JOIN researcher 
ON works_on.ID_Ereuniti = researcher.ID_Ereuniti 
WHERE DATEDIFF(NOW(), works_on.Enarxi_enasxolisis) > 365 
GROUP BY researcher.ID_Ereuniti;

3.4) Query
ΟΡΓΑΝΙΣΜΟΙ ΠΟΥ ΕΧΟΥΝ ΛΑΒΕΙ ΤΟΝ ΙΔΙΟ ΑΡΙΘΜΟ ΕΡΓΩΝ ΣΕ ΔΙΑΣΤΗΜΑ ΔΤΟ ΣΥΝΕΧΟΜΕΝΩΝ ΕΤΩΝ ΜΕ ΤΟΥΛΑΧΙΣΤΟΝ 10 ΕΡΓΑ ΕΤΗΣΙΩΣ, ΜΕ:

SELECT Organization.ID_Organismou , organization.Name , Organization.Syntomografia, 
X. Y AS Year, Projects_fetina 
FROM ( 
     SELECT DISTINCT ID_Organismou AS O, YEAR(Start_Date) as Y,
      ( 
         SELECT count(*) 
         FROM ergo_epixorigisi 
         WHERE YEAR(Start_Date) = Y 
         AND ID_Organismou = O 
      ) AS Projects_fetina , 
      ( 
         SELECT count(*) 
         FROM ergo_epixorigisi 
         WHERE YEAR(Start_Date) + 1 = Y 
         AND ID_Organismou = O 
      ) AS Projects_persina 
      FROM ergo_epixorigisi 
      HAVING Projects_fetina = Projects_persina 
      AND Projects_fetina >= 10 
      ORDER BY O 
    ) X INNER JOIN Organization ON Organization.ID_Organismou = X.O;

3.5) Query
ΕΜΦΑΝΙΣΗ top-3 ΖΕΥΓΩΝ ΩΣ ΕΞΗΣ:

SELECT Pedio_1 , N1.Name_Science_Field AS Name_1, Pedio_2 , N2.Name_Science_Field AS Name_2 , pair_count FROM ( SELECT DISTINCT A.Code_anaforas AS Pedio_1 , B.Code_anaforas AS Pedio_2 , ( SELECT COUNT(*) FROM epistimoniko_pedio_ergou AA INNER JOIN epistimoniko_pedio_ergou BB ON AA.ID_Ergou = BB.ID_Ergou WHERE AA.Code_anaforas = A.Code_anaforas AND BB.Code_anaforas = B.Code_anaforas AND AA.Code_anaforas <> BB.Code_anaforas ) AS pair_count FROM epistimoniko_pedio_ergou A INNER JOIN epistimoniko_pedio_ergou B ON A.ID_Ergou = B.ID_Ergou WHERE A.Code_anaforas < B.Code_anaforas ORDER BY pair_count DESC LIMIT 3 ) AS top_pairs INNER JOIN epistimoniko_pedio N1 ON N1.Code_anaforas = top_pairs.Pedio_1 INNER JOIN epistimoniko_pedio N2 ON top_pairs.Pedio_2 = N2.Code_anaforas;

3.6) Query
CREATE VIEW IF NOT EXISTS metrima_ergon AS
 SELECT DISTINCT Researcher.ID_Ereuniti AS ID_Er , CONCAT(Researcher.First_Name , ' ', Researcher.Last_Name) 
AS Onomateponimo , FLOOR( DATEDIFF( NOW() , Birth_Date ) /365) AS Ilikia , 
( 
   SELECT COUNT(*) FROM Works_On 
   INNER JOIN Researcher 
   ON Works_On.ID_Ereuniti = Researcher.ID_Ereuniti 
   INNER JOIN ergo_epixorigisi  
   ON ergo_epixorigisi.ID_Ergou = Works_On.ID_Ergou 
   WHERE Researcher.ID_Ereuniti = ID_Er 
   AND DATEDIFF(ergo_epixorigisi.End_Date , NOW()) > 0 ) AS metritis_ergon 
   FROM Works_On INNER JOIN Researcher ON Works_On.ID_Ereuniti = Researcher.ID_Ereuniti 
   WHERE DATEDIFF( NOW(),Birth_Date) < 365*40 
-- ----------------------------------------------------- 
-- we want lower than 365 * 40 (40 years for those who are younger) 
-- 365 due to 365 days per year 
-- ----------------------------------------------------- 
   ORDER BY metritis_ergon DESC;
SELECT DISTINCT Person2.ID_Er , Person2.Onomateponimo , Person2.Ilikia , Person2.metritis_ergon  
FROM 
( 
   SELECT * FROM metrima_ergon HAVING metritis_ergon = MAX(metritis_ergon)
) Person1 
  INNER JOIN metrima_ergon Person2 
  ON Person1.metritis_ergon = Person2.metritis_ergon;

3.7) Query
Εύρεση των κορυφαίων 5 στελεχών το βρίσκω ως εξής:

CREATE VIEW IF NOT EXISTS company_funders AS 
SELECT DISTINCT stelexos.ID_Stelexous , stelexos.Name AS Onomateponimo , company.Company AS onoma_etairias , SUM(ergo_epixorigisi.Funding) AS Synolika_Funds 
FROM stelexos INNER JOIN ergo_epixorigisi 
ON stelexos.ID_Stelexous = ergo_epixorigisi.ID_Stelexous 
INNER JOIN company 
ON ergo_epixorigisi.ID_Organismou = company.ID_Organismou 
INNER JOIN organization 
ON organization.ID_Organismou = company.ID_Organismou 
WHERE Organization.ID_Organismou = company.ID_Organismou 
GROUP BY stelexos.ID_Stelexous , Organization.ID_Organismou 
ORDER BY Synolika_Funds DESC;
SELECT DISTINCT ID_Stelexous , Onomateponimo , onoma_etairias , MAX(Synolika_Funds) AS Nea_Synolika_Funds 
FROM company_funders 
GROUP BY ID_Stelexous 
ORDER BY Nea_Synolika_Funds DESC LIMIT 5;
-- ----------------------------------------------------- 
-- apo ta parapanw filtraroume kai theloume mono 5
-- ----------------------------------------------------- 

3.8) Βρίσκω τους ερευνητές που εργάζονται σε 5 ή περισσότερα έργα που δεν έχουν παραδοτέα ως:

SELECT r.ID_Ereuniti, r.first_name, r.last_name, COUNT(*) `metrima` FROM researcher r INNER JOIN works_on w ON r.ID_Ereuniti = w.ID_Ereuniti inner join ergo_epixorigisi p ON w.ID_Ergou = p.ID_Ergou WHERE w.ID_Ereuniti NOT IN (SELECT ID_Ergou FROM ergo_epixorigisi) GROUP BY r.ID_Ereuniti HAVING COUNT(*) > 4 ORDER BY COUNT(*) DESC;