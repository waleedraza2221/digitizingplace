<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Billinginfotble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('phone',50)->nullable();
            $table->string('address1',50)->nullable();
            $table->string('address2',50)->nullable();
            $table->string('postalcode',50)->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('country',50)->nullable();
            $table->unsignedBigInteger('user_id')->default(0);

         
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
        Schema::dropIfExists('billing_infos');
    }
}
