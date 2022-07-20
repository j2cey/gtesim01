<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'tags';
    public $table_comment = 'tags';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('tag name');
            $table->string('slug')->nullable()->comment('tag sliug');
            $table->string('description')->nullable()->comment('tag description');

            $table->bigInteger('taggable_id')->nullable()->comment('tagged Model id');
            $table->string('taggable_type')->nullable()->comment('tagged Model type');

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
        });
        Schema::dropIfExists($this->table_name);
    }
}
