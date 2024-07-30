<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReorderUsersTableColumnsV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Упорядочиваем колонки
            $table->string('password')->after('login')->change();
            $table->string('first_name')->after('password')->change();
            $table->string('last_name')->after('first_name')->change();
            $table->string('email')->after('last_name')->change();
            $table->string('phone')->after('email')->change();
            $table->string('image_link')->after('phone')->change();
            $table->boolean('is_removed')->after('image_link')->change();
            $table->timestamp('email_verified_at')->nullable()->after('is_removed')->change();
            $table->rememberToken()->after('email_verified_at')->change();
            $table->timestamp('created_at')->nullable()->after('remember_token')->change();
            $table->timestamp('updated_at')->nullable()->after('created_at')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Возвращаем колонки к их первоначальному порядку
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->nullable()->after('email')->change();
            $table->rememberToken()->after('password')->change();
            $table->timestamp('created_at')->nullable()->after('remember_token')->change();
            $table->timestamp('updated_at')->nullable()->after('created_at')->change();
            $table->string('first_name')->after('updated_at')->change();
            $table->string('last_name')->after('first_name')->change();
            $table->string('phone')->after('last_name')->change();
            $table->string('image_link')->after('phone')->change();
            $table->boolean('is_removed')->after('image_link')->change();
        });
    }
}
