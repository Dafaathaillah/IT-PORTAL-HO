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
        Schema::create('inv_printers', function (Blueprint $table) {
            $table->id();
            $table->string('printer_code', 255);
            $table->string('serial_number', 255);
            $table->string('ip_address', 255);
            $table->string('item_name', 255);
            $table->longText('printer_brand');
            $table->string('printer_type', 255);
            $table->string('location', 255);
            $table->dateTime('date_of_inventory');
            $table->string('status', 255);
            $table->string('note', 255);
            $table->string('division', 255);
            $table->string('department', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_printers');
    }
};
