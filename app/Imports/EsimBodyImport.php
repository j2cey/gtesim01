<?php

namespace App\Imports;

use App\Models\Esims\Esim;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use App\Models\Files\FileImportResult;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;

class EsimBodyImport implements ToModel, WithChunkReading, WithEvents, WithValidation, SkipsOnError
{
    use RemembersRowNumber, Importable, SkipsFailures, SkipsErrors;

    private $rownum = 0;
    private $totalRows = 0;
    private FileImportResult $import_result;

    /**
    * @param Collection $collection
    */
    public function __construct(FileImportResult $import_result)
    {
        $this->import_result = $import_result;
    }


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //ICCID,MATCHING_ID,ACTIVATION_CODE CONFIRMATION_CODE (ac)
        //imsi,iccid,pin,puk,eki,pin2,puk2,adm1,opc
        $currentRowNumber = $this->getRowNumber();

        if ($currentRowNumber == 1) {
            $this->nextRow();
            $this->registerEvents();
            $this->import_result->update(['nb_rows' => $this->totalRows]);
            return null;
        }

        if ($currentRowNumber < $this->import_result->row_last_processed) {
            $this->nextRow();
            return null;
        }

        $iccid = substr($row[0], 0, -1);

        // Skip Duplicates
        if( Esim::where('iccid', $iccid)->count() > 0 ) {
            return null;
        }

        $old_esim = Esim::where('iccid', $iccid)->first();
        if ( $old_esim ) {
            $old_esim->update([
                'ac' => $row[2],
            ]);
        }

        $this->import_result->row_last_processed = $currentRowNumber;
        //$this->import_result->imported = 1; //($this->import_result->nb_rows == $currentRowNumber);
        $this->import_result->save();

        $this->nextRow();

        return $old_esim;
    }


    public function chunkSize(): int
    {
        return 500;
    }

    private function nextRow() {
        //$this->rownum++;
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $totalRows = $event->getReader()->getTotalRows();

                foreach ($totalRows as $row) {
                    $this->totalRows = $row;
                }
            }
        ];
    }

    /**
     * @param Failure[] $failures
     */
    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
    }

    public function rules(): array
    {
        return [];
    }
}
