<?php


namespace App\Contracts\Media;

use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia\HasMedia;

interface IHasMedia extends Auditable, HasMedia
{

}
