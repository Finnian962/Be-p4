<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::unprepared('DROP PROCEDURE IF EXISTS SP_GetAllAllergenen');
        DB::unprepared('
            CREATE PROCEDURE SP_GetALLAllergenen()
            BEGIN
                SELECT ALGE.Id
                      ,ALGE.Naam
                      ,ALGE.Omschrijving
                FROM Allergeen AS ALGE;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_CreateAllergeen');
        DB::unprepared('
            CREATE PROCEDURE sp_CreateAllergeen(
                IN p_name VARCHAR(50),
                IN p_description VARCHAR(255)
            )
            BEGIN
                INSERT INTO Allergeen (naam, omschrijving)
                VALUES (p_name, p_description);

                SELECT LAST_INSERT_ID() AS new_id;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_DeleteAllergeen');
        DB::unprepared('
            CREATE PROCEDURE sp_DeleteAllergeen(
                IN p_id INT
            )
            BEGIN
                DELETE FROM Allergeen
                WHERE Id = p_id;

                SELECT ROW_COUNT() AS affected;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetAllergeenById');
        DB::unprepared('
            CREATE PROCEDURE sp_GetAllergeenById(
                IN p_id INT
            )
            BEGIN
                SELECT Id
                      ,Naam
                      ,Omschrijving
                FROM Allergeen
                WHERE Id = p_id;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_UpdateAllergeen');
        DB::unprepared('
            CREATE PROCEDURE sp_UpdateAllergeen(
                IN p_id INT,
                IN p_name VARCHAR(50),
                IN p_description VARCHAR(255)
            )
            BEGIN
                UPDATE Allergeen
                    SET Naam = p_name,
                        Omschrijving = p_description,
                        DatumGewijzigd = SYSDATE(6)
                WHERE Id = p_id;

                SELECT ROW_COUNT() AS affected;
            END
        ');
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::unprepared('DROP PROCEDURE IF EXISTS SP_GetAllAllergenen');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_CreateAllergeen');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_DeleteAllergeen');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetAllergeenById');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_UpdateAllergeen');
    }
};
