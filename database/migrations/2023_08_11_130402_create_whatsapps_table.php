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
        Schema::create('whatsapps', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('title');
            $table->text('description');
            $table->string('button');
            $table->timestamps();
        });

        \App\Models\Whatsapp::query()->create([
            'number' => '01021811237',
            'title' => [
                'ar' => 'whatsapp',
                'en' => 'whatsapp',
            ],
            'description' => [
                'ar' => 'whatsapp description',
                'en' => 'whatsapp description',
            ],
            'button' => [
                'ar' => 'send',
                'en' => 'send',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whatsapps');
    }
};
