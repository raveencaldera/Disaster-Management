<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('place');
            $table->string('type');
            $table->double('lat', 10, 6);
            $table->double('long', 10, 6);
            $table->enum('level', ['Severe', 'High', 'Elevated', 'Guarded', 'Low']);
            $table->text('description');
            $table->text('reporter_id');
            $table->text('verifier_id')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('reports');
    }
}
