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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->foreignIdFor(\App\Models\Webinar::class)->constrained();
            $table->integer('amount');
            $table->boolean('status')->default(false);
            $table->string('ref_num');
            $table->string('res_num')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
