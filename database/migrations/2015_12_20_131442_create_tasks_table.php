<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('description');
            $table->boolean('completed')->default(false);
            
             $table->integer('user_id')->unsigned();
             $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

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
        Schema::table('tasks', function ($table) {
            $table->dropForeign('tasks_user_id_foreign');
        });

        Schema::drop('tasks');
    }
}
