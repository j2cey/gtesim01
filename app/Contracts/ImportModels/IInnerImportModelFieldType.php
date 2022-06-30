<?php


namespace App\Contracts\ImportModels;

use App\Models\ImportModels\ImportModelField;
use OwenIt\Auditing\Contracts\Auditable;

interface IInnerImportModelFieldType extends Auditable
{
    public static function createNew();
    public function getFormattedValue($importvalue);
    
    public function importmodelfield();
    public function attachUpperImportModelField(ImportModelField $importmodelfield);
}
