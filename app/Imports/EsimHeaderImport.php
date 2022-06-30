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

class EsimHeaderImport implements ToModel, WithChunkReading, WithEvents, WithValidation, SkipsOnError
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
        //IMSI,ICCID,PIN1,PUK1,EKI,PIN2,PUK2,ADM1,OPC
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

        // Skip Duplicates
        if( Esim::where('imsi', $row[0])->count() > 0 ) {
            return null;
        }
        
        // createNew($imsi, $iccid, $ac, $pin, $puk, $eki = null, $pin2 = null, $puk2 = null, $adm1 = null, $opc = null)
        $new_esim = Esim::createNew($row[0],$row[1],null, $row[2],$row[3],$row[4],$row[5], $row[6],$row[7],$row[8]);

        $this->import_result->row_last_processed = $currentRowNumber;
        //$this->import_result->imported = 1; //($this->import_result->nb_rows == $currentRowNumber);
        $this->import_result->save();

        $this->nextRow();

        return $new_esim;
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
