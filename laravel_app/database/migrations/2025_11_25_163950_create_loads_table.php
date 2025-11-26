<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('loads')) {
            Schema::create('loads', function (Blueprint $table) {
                $table->id();
                $table->string('load_number')->unique();
                $table->string('pickup_location');
                $table->string('delivery_location');
                $table->dateTime('pickup_date');
                $table->dateTime('delivery_date');
                $table->decimal('weight', 10, 2)->nullable();
                $table->decimal('miles', 10, 2)->nullable();
                $table->decimal('rate', 10, 2)->nullable();
                $table->string('equipment_type')->nullable();
                $table->text('special_requirements')->nullable();
                $table->foreignId('customer_id')->constrained('users');
                $table->foreignId('driver_id')->nullable()->constrained('users');
                $table->foreignId('dispatcher_id')->nullable()->constrained('users');
                $table->string('status')->default('available');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('loads');
    }
};
