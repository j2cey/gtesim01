<?php

namespace App\Traits\ImportModels;

use App\Models\ImportModels\ImportModel;
use Illuminate\Support\Str;

trait HasImportModel
{
    public function importmodel()
    {
        $elem_type = get_called_class();
        return ImportModel::where('filemodel_type', $elem_type);
    }

    #region Custom Functions

    public function setImportModel($title,$targetmodel_type,$code = null,$description = null) {

        $elem_type = get_called_class();
        // set code as title slug if not given
        $code = (is_null($code) ? Str::slug($title, '_') : $code);
        $vals = [
            'targetmodel_type' => $targetmodel_type,
            'filemodel_type' => $elem_type,
            'title' => $title,
            'code' => $code,
            'description' => $description,
        ];

        if ( is_null($this->importmodel) ) {
            $importmodel = ImportModel::create($vals);
        } else {
            $importmodel = $this->importmodel->update($vals);
        }                                                 // create and attach a new ImportModel to the current model object

        return $importmodel;
    }

    public function removeImportmodel() {
        $this->importmodel()->delete();
    }

    #endregion

    /**
     * add to $with attribute (for eager loading)
     *
     * @return void
     */
    protected function initializeHasImportModels()
    {
        $this->with = array_unique(array_merge($this->with, ['importmodel']));
    }

    public static function bootHasImportModels()
    {
        static::deleting(function ($model) {
            $model->removeImportmodel();
        });
    }
}
