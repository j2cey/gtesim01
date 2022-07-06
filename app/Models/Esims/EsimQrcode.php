<?php

namespace App\Models\Esims;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Esim
 * @package App\Models\Esims
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * 
 * @property string|null $raw_value
 * @property string|null $qrcode_img
 * 
 * @property integer|null $esim_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class EsimQrcode extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    #region Validation Rules

    public static function defaultRules() {
        return [
        ];
    }
    public static function createRules() {
        return array_merge(self::defaultRules(), [

        ]);
    }
    public static function updateRules($model) {
        return array_merge(self::defaultRules(), [

        ]);
    }

    public static function messagesRules() {
        return [

        ];
    }

    #endregion

    #region Eloquent Relationships

    public function esim() {
        return $this->belongsTo(Esim::class, 'esim_id');
    }

    #endregion

    #region Custom Functions

    public static function createNew(Esim $esim, $raw_value)
    {
        $esimqrcode = EsimQrcode::create([
            'raw_value' => $raw_value,
        ]);

        $esimqrcode->esim()->associate($esim); 
        
        $esimqrcode->save();

        $esimqrcode->generateQrcodeImage();

        return $esimqrcode;
    }

    public function generateQrcodeImage() {
        // <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate($client->esim->ac)) }} ">
        $directory = "esim_fichier_qrcode";
        
        $file_dir = config('app.' . $directory);
        $file_name = md5($directory . '_' . time()) . '.png';
        $output_file = $file_dir . '/' . $file_name;

        $this->qrcode_img = $file_name;
        $this->save();

        $image = QrCode::format('png')
            //->merge('img/jpg', 0.1, true)
            ->size(200)->errorCorrection('H')
            ->generate($this->raw_value, public_path($output_file));

        

        //Storage::disk('public')->put($output_file, $image);
    }

    #endregion

    public static function boot ()
    {
        parent::boot();

        // juste avant suppression
        self::creating(function($model){
            
        });
    }
}
