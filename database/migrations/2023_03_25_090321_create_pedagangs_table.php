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
        Schema::create('pedagangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_users');
            $table->string('ttl');
            $table->string('alamat');
            $table->string('telp');
            $table->string('jk');
            $table->string('jenis');
            $table->string('id_pasar');
            $table->string('status');
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
        Schema::dropIfExists('pedagangs');
    }
};
