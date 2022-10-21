<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected $guarded = [];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger("user_id");
            // $table->foreignId('noticket')->constrained('tickets');
            $table->string('ticket_id', 8);
            $table->foreign('ticket_id')->references('noticket')->on('tickets')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('user_id')->constrained();
            // $table->string("email_cust");
            $table->integer("star");
            // $table->integer("coin_tip");
            $table->text("comment")->nullable();
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
        Schema::dropIfExists('ratings');
    }
};
