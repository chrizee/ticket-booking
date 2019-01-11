<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string("event");
            $table->double("price");
            $table->integer("ticket_type_id")->unsigned();
            $table->integer("total_number_available");
            $table->integer("number_sold")->default(0);
            $table->integer("number_unsold")->default(0);
            
            $table->foreign("ticket_type_id")->references("id")->on("ticket_types");
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
}
