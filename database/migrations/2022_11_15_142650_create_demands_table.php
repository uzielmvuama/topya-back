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
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('letter',1);
            $table->boolean('response')->nullable();
            $table->text('id_game');
            $table->bigInteger('id_user');
            $table->bigInteger('id_dest'); 
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demands');
    }
};
