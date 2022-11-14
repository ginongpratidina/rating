<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('listguest', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        /* $query = 'CREATE VIEW v_list_guest
        AS SELECT t.noticket, t.status,t.created_at,t.name,t.nohp,t.necessity,u.name AS serveBy
        FROM tickets t
        LEFT JOIN progress_logs p ON t.noticket=p.ticket_id
        LEFT JOIN users u ON p.user_id=u.id'; */
        $query = 'CREATE VIEW v_list_guest
        AS SELECT t.noticket, t.status,t.created_at,t.name,t.nohp,t.necessity,u.name AS serveBy
        FROM tickets t
        LEFT JOIN (SELECT DISTINCT `ticket_id`, `user_id` FROM `progress_logs` GROUP BY `ticket_id`,`user_id`) p ON t.noticket=p.ticket_id
        LEFT JOIN users u ON p.user_id=u.id';
        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_list_guest');
    }
};
