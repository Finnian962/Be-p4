<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS SP_GetAllUsers');
        DB::unprepared('
            CREATE PROCEDURE SP_GetAllUsers(
                IN p_Id INTEGER
            )
            BEGIN
                SELECT USRS.Id
                      ,USRS.name
                      ,USRS.email
                      ,USRS.rolename
                FROM Users as USRS
                WHERE USRS.Id != p_Id;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS SP_GetUserById');
        DB::unprepared('
            CREATE PROCEDURE SP_GetUserById(
                IN p_Id INTEGER
            )
            BEGIN
                SELECT USRS.Id
                      ,USRS.name
                      ,USRS.email
                      ,USRS.rolename
                FROM Users as USRS
                WHERE USRS.Id = p_Id;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS SP_GetAllUserroles');
        DB::unprepared('
            CREATE PROCEDURE SP_GetAllUserroles()
            BEGIN
                SELECT rolename FROM (
                    SELECT \'patient\' AS rolename
                    UNION SELECT \'tandarts\'
                    UNION SELECT \'mondhygienist\'
                    UNION SELECT \'assistent\'
                    UNION SELECT \'praktijkmanagement\'
                ) AS roles;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_UpdateUser');
        DB::unprepared('
            CREATE PROCEDURE Sp_UpdateUser(
                 IN p_Id INTEGER
                ,IN p_Name VARCHAR(50)
                ,IN p_Email VARCHAR(100)
                ,IN p_Rolename VARCHAR(50)
            )
            BEGIN
                UPDATE Users as USRS
                SET    USRS.name = p_Name,
                       USRS.email = p_Email,
                       USRS.rolename = p_Rolename
                WHERE  USRS.id = p_Id;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_DeleteUser');
        DB::unprepared('
            CREATE PROCEDURE sp_DeleteUser(
                IN p_id INT
            )
            BEGIN
                DELETE FROM Users
                WHERE Id = p_id;

                SELECT ROW_COUNT() AS affected;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS SP_GetAllUsers');
        DB::unprepared('DROP PROCEDURE IF EXISTS SP_GetUserById');
        DB::unprepared('DROP PROCEDURE IF EXISTS SP_GetAllUserroles');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_UpdateUser');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_DeleteUser');
    }
};
