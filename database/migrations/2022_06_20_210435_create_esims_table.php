<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Traits\Migrations\BaseMigrationTrait;

class CreateEsimsTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'esims';
    public $table_comment = 'liste des esims.';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            
            $table->string('imsi')->comment('imsi');
            $table->string('iccid')->comment('iccid');
            $table->string('pin')->default("0000")->comment('pin');
            $table->string('puk')->comment('puk');
            $table->string('ac', 500)->nullable()->comment('ac');
            $table->string('eki')->nullable()->comment('eki');
            $table->string('pin2')->nullable()->comment('pin2');
            $table->string('puk2')->nullable()->comment('puk2');
            $table->string('adm1')->nullable()->comment('adm1');
            $table->string('opc')->nullable()->comment('opc');

            $table->foreignId('statut_esim_id')->nullable()
                ->comment('reference du statut de l esim')
                ->constrained()->onDelete('set null');

            $table->foreignId('technologie_esim_id')->nullable()
                ->comment('reference de la technologie de l esim')
                ->constrained()->onDelete('set null');

            $table->baseFields();
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
            $table->dropBaseForeigns();
            $table->dropForeign(['statut_esim_id']);
            $table->dropForeign(['technologie_esim_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
