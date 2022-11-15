<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePabrikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pabrik', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_user');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->text('image', 25,5);
            $table->string('status');

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onUpdate(DB::raw('NO ACTION'))
                ->onDelete(DB::raw('NO ACTION'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pabrik');
    }
}
