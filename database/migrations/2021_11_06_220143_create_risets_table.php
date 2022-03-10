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
            $table->year('tahun_data');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('sumber_dana');
            $table->string('judul');
            $table->string('slug')->unique();
            // $table->string('kategori_id');
            $table->string('kategori_id');
            $table->string('penyelenggara');
            $table->string('pelaksana');
            $table->string('penanggungjawab');
            $table->string('nik')->nullable();            
            $table->string('kontak');
            $table->string('no_surat_izin')->nullable();
            $table->date('tgl_surat_izin')->nullable();
            $table->string('ktp')->nullable();
            $table->longText('abstrak')->nullable();
            $table->string('proposal')->nullable();
            $table->longText('resume')->nullable();
            $table->string('hasil_penelitian')->nullable();
            $table->string('kode_wilayah');
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
