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
            $table->string('file_drive_id');
            $table->boolean('confirmed')
                    ->default(0);
            $table->foreignId('level_id')
                    ->nullable()
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
