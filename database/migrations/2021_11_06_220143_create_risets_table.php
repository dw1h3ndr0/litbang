<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRisetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risets', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('pelaksana');
            $table->string('no_surat_izin')->nullable();
            $table->string('kuesioner')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risets');
    }
}
