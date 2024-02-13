<?php

use App\Models\Customer;
use App\Models\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class, 'send_by')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate();
            $table->foreignIdFor(Customer::class, 'receive_by')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate();
            $table->foreignIdFor(Status::class, 'latest_status_id')
                ->default(1)
                ->constrained('statuses')
                ->cascadeOnUpdate();
            $table->integer('package_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
