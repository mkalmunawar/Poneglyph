<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadBorrowingBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('head_borrowing_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('borrowing_date');
            $table->date('return_date');
            $table->integer('member_id');
            $table->integer('employee_id');
            $table->integer('total');
            $table->string('status');
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
        Schema::dropIfExists('head_borrowing_books');
    }
}
