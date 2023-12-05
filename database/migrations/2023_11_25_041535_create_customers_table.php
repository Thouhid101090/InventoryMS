

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);
            $table->string('email', 50)->nullable();
            $table->text('address');
            $table->string('contact', 255);
             $table->boolean('status')->default(1);
             $table->integer('created_by')->nullable();
             $table->integer('updated_by')->nullable();


            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
