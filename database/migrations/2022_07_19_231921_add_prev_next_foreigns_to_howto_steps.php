<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrevNextForeignsToHowtoSteps extends Migration
{
    public $table_name = 'howto_steps';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->table_name, function (Blueprint $table) {
            $table->foreignId('howto_step_prev_id')->nullable()
                ->comment('prev howto_step reference')
                ->constrained('howto_step_types')->onDelete('set null');

            $table->foreignId('howto_step_next_id')->nullable()
                ->comment('next howto_step reference')
                ->constrained('howto_step_types')->onDelete('set null');
        });
        $this->setTableComment($this->table_name,$this->table_comment);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->table_name, function (Blueprint $table) {
            $table->dropForeign(['howto_step_prev_id']);
            $table->dropForeign(['howto_step_next_id']);
        });
    }
}
