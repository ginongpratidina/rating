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
        Schema::create('tickets', function (Blueprint $table) {
            $table->string('noticket', 8);
            $table->string('name', 25)->nullable()->default('Tamu');
            $table->string('nohp', 12)->nullable();
            $table->string('job',25);
            $table->string('institution',150);
            $table->text('necessity')->nullable();
            $table->string('bersedia',1)->comment('Bersedia untuk dihubungi kembali sebagai responden survei layanan');
            // $table->bigInteger('user_id');
            $table->string('status',1)->default(0)->comment('0=open, 1=onProgress, 9=closed');
            $table->primary('noticket');
            // $table->bigIncrements('user_id')->default('0')->comment('sengaja tidak dibuat foreignkey karena jika tiket di-create oleh tamu tidak ada id yg dirujuk pada tabel user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
