<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('theme')->default('light')->after('google_avatar');
            $table->string('language')->default('id')->after('theme');
            $table->boolean('email_notifications')->default(true)->after('language');
            $table->boolean('sales_notifications')->default(true)->after('email_notifications');
            $table->boolean('stock_notifications')->default(false)->after('sales_notifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['theme', 'language', 'email_notifications', 'sales_notifications', 'stock_notifications']);
        });
    }
};
