<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackupTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backup_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hp');
            $table->BigInteger('code')->nullable();
            $table->BigInteger('reff')->nullable();
            $table->BigInteger('amount')->nullable();
            $table->timestamp('expired')->nullable();
            $table->timestamp('paid')->nullable();
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('backup_transaksi');
    }
}
