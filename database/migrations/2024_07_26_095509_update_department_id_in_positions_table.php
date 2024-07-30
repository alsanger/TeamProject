<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDepartmentIdInPositionsTable extends Migration
{
    public function up()
    {
        Schema::table('positions', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('positions', function (Blueprint $table) {
        $table->unsignedBigInteger('department_id')->nullable(false)->change();
        });
    }
}
