<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralChainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_chains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_by'); // User ID of the referrer
            $table->unsignedBigInteger('ref_to'); // User ID of the referred person
            $table->unsignedInteger('level'); // Level in the referral chain
            $table->timestamps(); // Adds created_at and updated_at columns

            // Foreign keys
            $table->foreign('ref_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ref_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_chains');
    }
}
