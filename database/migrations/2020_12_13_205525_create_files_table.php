<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('confirmed');
            $table->foreign('level_id')
                    ->nullable()
                    ->references('id')
                    ->on('levels')
                    ->constrained('levels')
                    ->onDelete('cascade');
                    
            $table->foreignId('created_by')
                    ->nullable()
                    ->constrained('users')
                    ->onDelete('cascade');
            $table->text('description')
                    ->nullable();        

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
        Schema::dropIfExists('files');
    }
}
