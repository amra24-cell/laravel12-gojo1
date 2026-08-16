<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pakarang_boonjan', function (Blueprint $table) {
            $table->id(); // PK หลักของตาราง
            
            // 5 คอลัมน์ตามโจทย์กำหนด
            $table->integer('age')->nullable();
            $table->float('weight')->nullable();
            $table->string('note')->nullable();
            $table->date('date')->nullable();
            $table->text('remark')->nullable();
            
            $table->timestamps(); // created_at และ updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakarang_boonjan');
    }
};