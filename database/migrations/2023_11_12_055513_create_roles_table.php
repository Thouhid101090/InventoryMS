<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name',20)->unique();
            $table->string('identity',30)->unique();
            $table->boolean('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });


        DB::table('roles')->insert([
            [
                'name' => 'Super Admin',
                'identity' => 'superadmin',
                'created_at' => Carbon::now()
            ],[
                'name' => 'Admin',
                'identity' => 'admin',
                'created_at' => Carbon::now()
            ],[
                'name' => 'Sales Manager',
                'identity' => 'salesmanager',
                'created_at' => Carbon::now()
            ],[
                'name' => 'Sales Man',
                'identity' => 'salesman',
                'created_at' => Carbon::now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
