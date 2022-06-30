<?php


namespace App\Traits\File;


use App\Models\Files\FileImportResult;

trait HasImportFileResult
{
    public function fileimportresult() {
        return $this->morphOne(FileImportResult::class, 'hasimportfileresult');
    }

    public static function bootHasImportFileResult()
    {
        //parent::boot();

        self::created(function ($model){
            $model->fileimportresult()->create([
                'report' => json_encode([]),
            ]);
        });
    }
}
