<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            //$table->bigInteger('user_id', false, true);
            //$table->bigInteger('post_id', false, true);
            $table->string('user_name');
            $table->bigInteger('reply_id', false, true)->index()->nullable();
            $table->tinyInteger('level', false, true)->default(1);
            $table->string('text');
            $table->timestamps();

            $table->foreign('reply_id')->references('id')->on('comments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
