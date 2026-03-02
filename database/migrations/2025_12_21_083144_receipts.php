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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->integer('storage_id');
            $table->integer('category_id');
            $table->integer('total_price');
            $table->integer('quantity')->default(0);
            $table->string('note', 255)->nullable();
            $table->timestamp('delivery_date')->nullable();
            // Type field: 1: import, 2: export receipt.
            $table->integer('type')->default(1);
            $table->integer('user_id');
            $table->string('image')->nullable();
            $table->string('name', 255);
            $table->integer('logistics_provider_id');
            // 'status' field: 0: processing, 1 done.
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
