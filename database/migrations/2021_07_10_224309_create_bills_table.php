<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名称');
            $table->integer('money')->comment('金额');
            $table->date('start_date')->comment('开始年月');
            $table->date('end_date')->comment('结束年月');
            $table->string('note')->nullable()->comment('备注');
            $table->boolean('is_renewal')->default(0)->comment('是否续费');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
