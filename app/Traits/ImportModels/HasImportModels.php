<?php

namespace App\Traits\ImportModels;

use Illuminate\Support\Str;

trait HasImportModels
{
    /**
     * Get all of the model's dynamic attributes
     * @return mixed
     */
    public function importmodels()
    {
        return $this->morphMany(ImportModel::class, 'hasimportmodel');
    }


    /**
     * Get the lastets of the model's import model
     * @return mixed
     */
    public function latestDynamicattribute()
    {
        return $this->morphOne(ImportModel::class, 'hasimportmodel')->latest('id');
    }

    /**
     * Get the oldest of the model's import model
     * @return mixed
     */
    public function oldestDynamicattribute()
    {
        return $this->morphOne(ImportModel::class, 'hasimportmodel')->oldest('id');
    }

    #region Custom Functions

    public function addImportModel($title,$code = null,$description = null) {

        // set code as title slug if not given
        $code = (is_null($code) ? Str::slug($title, '_') : $code);

        $importmodel = $this->importmodels()->create([
            'title' => $title,
            'code' => $code,
            'description' => $description,
        ]);                                                 // create and attach a new ImportModel to the current model object

        return $importmodel;
    }

    public function removeImportmodels() {
        $this->importmodels()->each(function($importmodel) {
            $importmodel->delete();
        });
    }

    #endregion

    /**
     * add to $with attribute (for eager loading)
     *
     * @return void
     */
    protected function initializeHasImportModels()
    {
        $this->with = array_unique(array_merge($this->with, ['importmodels']));
    }

    public static function bootHasImportModels()
    {
        static::deleting(function ($model) {
            $model->removeImportmodels();
        });
    }
}
