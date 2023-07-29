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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('vendor_id')->constrained();
            $table->foreignId('governorate_id')->constrained();
            $table->date('date');
            $table->string('first_name', 999);
            $table->string('last_name',999);
            $table->string('email', 999);
            $table->enum('status', [0, 1, 2, 3, 4])->default(0);
            $table->string('phone');
            $table->string('city');
            $table->string('apartment');
            $table->string('floor');
            $table->string('street');
            $table->string('building');
            $table->string('wallet_number')->nullable();
            $table->enum('payment_method', [0, 1]);
            $table->string('notes')->nullable();
            $table->integer('quantity');
            $table->float('total_price');
            $table->text('image')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
