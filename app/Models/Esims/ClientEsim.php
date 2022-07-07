<?php

namespace App\Models\Esims;

use GuzzleHttp\Client;
use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ClientEsim
 * @package App\Models\Esims
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $nom_raison_sociale
 * @property string $prenom 
 * @property string $email
 * @property string $numero_telephone 
 * @property string $pin
 * @property string $puk
 * 
 * @property integer|null $esim_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ClientEsim extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];
    protected $with = ['esim'];

    #region Validation Rules

    public static function defaultRules() {
        return [
            'nom_raison_sociale' => ['required'],
            'email' => ['required','email'],
            'numero_telephone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:8',],
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
            'nom_raison_sociale.required' => 'Nom ou Raison Sociale du client requis',
            'email.required' => 'Adresse e-mail requise',
            'email.email' => 'Adresse e-mail non valide',
            'numero_telephone.required' => 'Numéro de téléphone requis',
            'numero_telephone.regex' => 'Numéro de téléphone non valide',
            'numero_telephone.min' => 'Numéro de téléphone doit avoir 8 digits minimum',
        ];
    }

    #endregion

    #region Eloquent Relationships

    public function esim() {
        return $this->belongsTo(Esim::class, 'esim_id');
    }

    #endregion

    #region Custom Functions

    public static function createNew($esim_id, $nom_raison_sociale, $prenom, $email, $numero_telephone)
    {
        $esim = Esim::getFirstFree($esim_id);
        
        $clientesim = ClientEsim::create([
            'nom_raison_sociale' => $nom_raison_sociale,
            'prenom' => $prenom,
            'email' => $email,
            'numero_telephone' => $numero_telephone,
        ]);

        $clientesim->esim()->associate($esim);
        $clientesim->save();
        $clientesim->esim->saveQrcode();
        $clientesim->save();

        $esim->setStatutAttribue();

        return $clientesim->load(['esim','esim.qrcode']);;
    }

    public function updateOne($esim_id, $nom_raison_sociale, $prenom, $email, $numero_telephone)
    {
        $esim = Esim::getFirstFree($esim_id);

        $esim->setStatutFree();

        $this->update([
            'nom_raison_sociale' => $nom_raison_sociale,
            'prenom' => $prenom,
            'email' => $email,
            'numero_telephone' => $numero_telephone,
        ]);

        $this->esim()->associate($esim);

        $this->save();

        $esim->setStatutAttribue();

        return $this;
    }

    public function sendmailprofile()
    {
        $post_link = "http://192.168.5.174/clientesims.sendmail";
        $directory = "esim_fichier_qrcode";

        $this->esim->saveQrcode();
        
        $file_name = config('app.' . $directory) . '/' . $this->esim->qrcode->qrcode_img;
        
        $qrcode_img = public_path($file_name);

        $client = new Client(['headers' => ['Authorization' => 'auth_trusted_header']]);
        $options = [
            'multipart' => [
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'file',
                    'contents' => file_get_contents($qrcode_img),//base64_encode( file_get_contents($qrcode_img) ), // fopen('data:image/png;base64,' . $qrcode_img, 'r'), // data://text/plain;base64
                    'filename' => 'qrcode_image.png',
                ],
                ['name' => 'nom', 'contents' => $this->nom_raison_sociale . ' ' .$this->prenom],
                ['name' => 'email', 'contents' => $this->email,],
                ['name' => 'telephone', 'contents' => $this->numero_telephone,],
                ['name' => 'imsi', 'contents' => $this->esim->imsi,],
                ['name' => 'iccid', 'contents' => $this->esim->iccid,],
                ['name' => 'pin', 'contents' => $this->esim->pin,],
                ['name' => 'puk', 'contents' => $this->esim->puk,],
                ['name' => 'ac', 'contents' => $this->esim->ac,],
            ]
        ];

        return $client->post($post_link, $options);
    }

    #endregion
}
