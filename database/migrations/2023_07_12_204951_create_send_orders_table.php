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
        Schema::create('send_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained();
            $table->foreignId('order_id')->constrained();
            $table->enum('status', [0, 1])->default(0);
            $table->enum('role', ['receive', 'delivery']);
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
        Schema::dropIfExists('send_orders');
    }
};
