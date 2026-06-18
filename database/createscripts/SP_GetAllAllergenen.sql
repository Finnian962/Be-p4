DROP PROCEDURE IF EXISTS SP_GetAllAllergenen;

DELIMITER $$

CREATE PROCEDURE SP_GetALLAllergenen()
BEGIN
    SELECT ALGE.Id
          ,ALGE.Naam
          ,ALGE.Omschrijving
    FROM Allergeen AS ALGE;
END$$

DELIMITER ;
