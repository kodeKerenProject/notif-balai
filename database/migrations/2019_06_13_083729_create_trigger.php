<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::unprepared("CREATE TRIGGER persyaratan_dok_sni AFTER UPDATE ON persyaratan_dok_dalam_negeri FOR EACH ROW 
        //     BEGIN
        //         INSERT INTO notif_log SET user_id = OLD.user_id, notif = "";
        //     END");

        // DB::unprepared("CREATE TRIGGER log_approved_order AFTER UPDATE ON orders FOR EACH ROW 
        //     BEGIN
        //         INSERT INTO log_activities SET order_id = OLD.id, message = 'Order anda telah disetujui!', category = 'UPDATE';
        //     END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::unprepared('DROP TRIGGER `notif_log`');
    }
}
