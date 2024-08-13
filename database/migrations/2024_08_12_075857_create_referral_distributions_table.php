<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralDistributionsTable extends Migration
{
    public function up()
    {
        Schema::create('referral_distributions', function (Blueprint $table) {
            $table->id();
            $table->integer('level')->unique(); // Ensuring level is unique
            $table->decimal('percentage', 5, 2); // Percentage in decimal format
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('referral_distributions');
    }
}
