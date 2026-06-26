<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('subtotal', 14, 2)->default(0);
            $table->decimal('discount', 14, 2)->default(0);
            $table->decimal('tax', 14, 2)->default(0);
            $table->decimal('total', 14, 2)->default(0);
            $table->string('payment_method')->default('cash'); // cash|card|gcash|bank
            $table->decimal('amount_paid', 14, 2)->default(0);
            $table->decimal('change_due', 14, 2)->default(0);
            $table->string('status')->default('completed'); // completed|refunded
            $table->foreignId('cashier_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('sale_date');
            $table->timestamps();
        });

        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('unit_price', 12, 2)->default(0);
            $table->decimal('unit_cost', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total', 14, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action');               // login, create, update, delete, stock_in...
            $table->string('description');
            $table->nullableMorphs('subject');      // subject_type, subject_id
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->json('properties')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('app_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type');                 // low_stock|out_of_stock|purchase_order|...
            $table->string('title');
            $table->text('message')->nullable();
            $table->string('level')->default('info'); // info|warning|danger|success
            $table->string('url')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_notifications');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('sale_items');
        Schema::dropIfExists('sales');
    }
};
