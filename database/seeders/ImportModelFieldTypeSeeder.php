<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImportModels\ImportModelFieldType;
use App\Models\ImportModels\ImportModelFieldString;
use App\Models\ImportModels\ImportModelFieldInteger;
use App\Models\ImportModels\ImportModelFieldDatetime;

class ImportModelFieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImportModelFieldType::createNew("String", ImportModelFieldString::class, "importmodelfieldstring", "Import Model Field of type String");
        ImportModelFieldType::createNew("Integer", ImportModelFieldInteger::class, "importmodelfieldinteger", "Import Model Field of type Integer");
        ImportModelFieldType::createNew("Datetime", ImportModelFieldDatetime::class, "importmodelfielddatetime", "Import Model Field of type Datetime");
    }
}
