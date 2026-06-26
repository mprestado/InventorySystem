<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number')->unique();
            $table->foreignId('supplier_id')->constrained()->cascadeOnDelete();
            $table->string('status')->default('pending'); // pending|approved|ordered|partially_received|completed|cancelled
            $table->date('order_date');
            $table->date('expected_date')->nullable();
            $table->decimal('subtotal', 14, 2)->default(0);
            $table->decimal('tax', 14, 2)->default(0);
            $table->decimal('total', 14, 2)->default(0);
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->integer('received_quantity')->default(0);
            $table->decimal('unit_cost', 12, 2)->default(0);
            $table->decimal('total', 14, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('stock_ins', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->unique();
            $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('purchase_order_id')->nullable()->constrained()->nullOnDelete();
            $table->string('invoice_number')->nullable();
            $table->date('received_date');
            $table->foreignId('received_by')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('total_cost', 14, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('stock_in_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_in_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('unit_cost', 12, 2)->default(0);
            $table->decimal('total', 14, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('stock_outs', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->unique();
            $table->string('reason'); // sale|damaged|expired|returned_supplier|internal_usage
            $table->date('date');
            $table->foreignId('handled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        Schema::create('stock_out_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_out_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('unit_cost', 12, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->unique();
            $table->string('type'); // add|remove|correct
            $table->string('reason');
            $table->date('date');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        Schema::create('adjustment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adjustment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity_before');
            $table->integer('quantity_after');
            $table->integer('difference');
            $table->timestamps();
        });

        // Unified inventory ledger — every stock change is recorded here
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->string('type');        // stock_in|stock_out|adjustment|sale|purchase_return
            $table->string('direction');   // in|out
            $table->integer('quantity');   // always positive
            $table->integer('quantity_before');
            $table->integer('quantity_after');
            $table->decimal('unit_cost', 12, 2)->default(0);
            $table->nullableMorphs('source'); // source_type, source_id
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
        Schema::dropIfExists('adjustment_items');
        Schema::dropIfExists('adjustments');
        Schema::dropIfExists('stock_out_items');
        Schema::dropIfExists('stock_outs');
        Schema::dropIfExists('stock_in_items');
        Schema::dropIfExists('stock_ins');
        Schema::dropIfExists('purchase_order_items');
        Schema::dropIfExists('purchase_orders');
    }
};
