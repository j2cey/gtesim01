<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHowToThreadStepsTable extends Migration
{
    public $table_name = 'how_to_thread_steps';
    public $table_comment = 'list of steps (articulations) of a given how-to-thread (parent)';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();

            $table->foreignId('how_to_thread_id')->nullable()
                ->comment('how_to_thread reference')
                ->constrained('how_to_threads')->onDelete('set null');

            $table->integer('posi')->default(1)->comment('step (child) position in children list');
            $table->string('step_title')->nullable()->comment('step (child) title');

            $table->foreignId('how_to_id')->nullable()
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
            $table->dropForeign(['how_to_thread_id']);
            $table->dropForeign(['how_to_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
