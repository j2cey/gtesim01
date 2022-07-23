<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStepsOfHowTosTable extends Migration
{
    public $table_name = 'steps_of_how_tos';
    public $table_comment = 'list of steps (child) of a given how-to (parent)';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();

            $table->foreignId('how_to_parent_id')->nullable()
                ->comment('how_to parent reference')
                ->constrained('how_tos')->onDelete('set null');

            $table->integer('posi')->default(0)->comment('step (child) position in children list');

            $table->foreignId('how_to_child_id')->nullable()
                ->comment('how_to child reference')
                ->constrained('how_tos')->onDelete('set null');

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
        Schema::table($this->table_name, function (Blueprint $table) {
            $table->dropForeign(['how_to_parent_id']);
            $table->dropForeign(['how_to_child_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
