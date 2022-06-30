<?php


namespace App\Contracts\Files;

use App\Models\Files\File;
use OwenIt\Auditing\Contracts\Auditable;

interface IFile extends Auditable
{
    public function files();
    public function file();
    public function latestFile();
}
