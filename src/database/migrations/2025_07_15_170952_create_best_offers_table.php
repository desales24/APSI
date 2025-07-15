<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('best_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shoe_id')->constrained('shoes')->onDelete('cascade');
            $table->integer('discount_percentage'); // nilai diskon dalam persen
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('best_offers');
    }
};
