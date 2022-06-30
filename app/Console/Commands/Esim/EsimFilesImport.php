<?php

namespace App\Console\Commands\Esim;

use App\Imports\EsimBodyImport;
use App\Imports\EsimHeaderImport;
use App\Models\Esims\EsimBodyFile;
use App\Models\Esims\EsimHeadFile;
use Illuminate\Console\Command;

class EsimFilesImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'esimfiles:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import les fichiers e-sim en attente dans la BD';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $raw_dir = config('app.RAW_FOLDER');

        $headfiles = EsimHeadFile::whereHas('fileimportresult', function($q) {
            $q->where('imported', 0)->where('import_processing', 0);
        })->get();

        $nb_to_import = 1;
        $nb_to_imported = 0;

        foreach ($headfiles as $headfile) {
            if ($nb_to_imported < $nb_to_import) {
                
                $headfile->fileimportresult->update([
                    'import_processing' => 1,
                ]);
                
                $import = new EsimHeaderImport($headfile->fileimportresult);
                $import->import($raw_dir . '/' . $headfile->file->relativepath);
                
                $headfile->fileimportresult->update([
                    'import_processing' => 0,
                    'imported' => 1
                ]);
                //$this->import_result->imported = 1;
            }
            $nb_to_imported++;
        }

        $bodyfiles = EsimBodyFile::whereHas('fileimportresult', function($q) {
            $q->where('imported', 0)->where('import_processing', 0);
        })->get();

        $nb_to_import = 1;
        $nb_to_imported = 0;

        foreach ($bodyfiles as $bodyfile) {
            if ($nb_to_imported < $nb_to_import) {
                
                $bodyfile->fileimportresult->update([
                    'import_processing' => 1,
                ]);
                
                $import = new EsimBodyImport($bodyfile->fileimportresult);
                $import->import($raw_dir . '/' . $bodyfile->file->relativepath);
                
                $bodyfile->fileimportresult->update([
                    'import_processing' => 0,
                    'imported' => 1
                ]);
                //$this->import_result->imported = 1;
            }
            $nb_to_imported++;
        }

        return 0;
    }
}
