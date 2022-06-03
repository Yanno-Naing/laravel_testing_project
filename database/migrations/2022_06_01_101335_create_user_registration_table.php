<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_registration', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable(false);
            $table->string('father_name', 100)->nullable();
            $table->string('nrc', 50)->nullable(false);
            $table->string('phone_no', 11)->nullable(false);
            $table->string('email', 20)->nullable(false);
            $table->string('address', 255);
            $table->tinyInteger('gender')->comment('1 for male, 2 for female')->nullable(false)->default(1);
            $table->date('birthday');
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_registration');
    }
}
