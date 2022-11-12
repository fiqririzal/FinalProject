<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_toko');
            $table->string('name');
            $table->string('detail');
            $table->decimal('price', 25,5);
            $table->string('stok');
            $table->text('image');

            $table->foreign('id_toko')
                ->references('id')
                ->on('toko')
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
        Schema::dropIfExists('produk');
    }
}
