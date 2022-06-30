<?php


namespace App\Traits\ImportModels;

use App\Models\ImportModels\ImportModel;
use App\Models\ImportModels\ImportModelField;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait IsInnerImportModelFieldType
{
    use \OwenIt\Auditing\Auditable;

    #region Eloquent Relationships

    public $importvalue;

    /**
     * @return morphOne
     */
    public function importmodelfield() {
        return $this->morphOne(ImportModelField::class,"innerfieldtype");
    }

    public function getImportmodelfield() : ImportModelField {
        return $this->importmodelfield;
    }

    public function getImportmodel() : ImportModel {
        return $this->importmodelfield->importmodel;
    }

    #endregion

    #region Custom Methods

    public function attachUpperImportModelField(ImportModelField $importmodelfield) {
        $this->importmodelfield()->save($importmodelfield);
    }

    #endregion

    /**
     * Add, dynamically, Eloquent relation (eager loading) to this model
     */
    protected function initializeIsInnerImportModelFieldType()
    {
        //$this->with = array_unique(array_merge($this->with, ['analysishighlight']));
    }

    public static function bootIsInnerImportModelFieldType()
    {
        static::deleting(function ($model) {

        });
    }
}
