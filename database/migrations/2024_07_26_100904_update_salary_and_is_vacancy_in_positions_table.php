<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSalaryAndIsVacancyInPositionsTable extends Migration
{
    public function up()
    {
        Schema::table('positions', function (Blueprint $table) {
        $table->decimal('salary', 10, 2)->nullable()->default(null)->change();
        $table->boolean('is_vacancy')->default(false)->change();
    });
}

public function down()
{
    Schema::table('positions', function (Blueprint $table) {
        $table->decimal('salary', 10, 2)->nullable(false)->default(0)->change();
        $table->boolean('is_vacancy')->default(false)->change();
        });
    }
}
