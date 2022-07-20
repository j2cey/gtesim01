<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Traits\Migrations\BaseMigrationTrait;

class CreateHowtoStepsTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'howto_steps';
    public $table_comment = 'howto steps';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();

            $table->string('title')->comment('step title');
            $table->string('view')->nullable()->comment('step view');
            $table->string('description')->nullable()->comment('step description');

            $table->foreignId('howto_step_type_id')->nullable()
                ->comment('howto_step_type reference')
                ->constrained('howto_step_types')->onDelete('set null');

            $table->foreignId('created_by')->nullable()
                ->comment('user creator reference')
                ->constrained('users')->onDelete('set null');

            $table->foreignId('updated_by')->nullable()
                ->comment('user updator reference')
                ->constrained('users')->onDelete('set null');

            $table->baseFields();
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
            $table->dropBaseForeigns();
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['howto_step_type_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
