<?php

namespace App\Models\Esims;

use GuzzleHttp\Client;
use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use App\Models\Employes\PhoneNum;
use App\Traits\PhoneNum\HasPhoneNums;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\EmailAddress\HasEmailAddresses;
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
    use HasPhoneNums, HasEmailAddresses, HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    #region Validation Rules

    public static function defaultRules() {
        return [
            'nom_raison_sociale' => ['required'],
            'email' => ['required','email'],
        ];
    }
    public static function createRules() {
        return array_merge(self::defaultRules(), [
            'numero_telephone' => [
                'required',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:8',
                'unique:phone_nums,numero,NULL,id',
            ],
        ]);
    }
    public static function updateRules($model) {
        return array_merge(self::defaultRules(), [
            'numero_telephone' => [
                'required',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:8',
            ],
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
            'numero_telephone.unique' => 'Numéro déjà attribué',
        ];
    }

    #endregion

    #region Eloquent Relationships

    public function esim() {
        return $this->belongsTo(Esim::class, 'esim_id');
    }

    #endregion

    #region Custom Functions

    public static function createNew($nom_raison_sociale, $prenom, $email, $numero_telephone)
    {
        //$esim = Esim::getFirstFree($esim_id);

        //$esim->setStatutAttribution();

        $clientesim = ClientEsim::create([
            'nom_raison_sociale' => strtoupper($nom_raison_sociale),
            'prenom' => ucwords($prenom),
            'email' => $email,
            'numero_telephone' => $numero_telephone,
        ]);

        //$clientesim->esim()->associate($esim);
       //$clientesim->save();
        //$clientesim->esim->saveQrcode();
        //$clientesim->save();

        //$esim->setStatutAttribue();

        return $clientesim;
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

    public function sendmailprofile(PhoneNum $phonenum)
    {
        $post_link = "http://192.168.5.174/clientesims.sendmail";
        $directory = "esim_fichier_qrcode";

        $phonenum->esim->saveQrcode();

        $file_name = public_path('/') . config('app.' . $directory) . '/' . $phonenum->esim->qrcode->qrcode_img;

        $qrcode_img = $file_name;

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
                ['name' => 'email', 'contents' => $this->latestEmailAddress->email,],
                ['name' => 'telephone', 'contents' => $phonenum->numero,],
                ['name' => 'imsi', 'contents' => $phonenum->esim->imsi,],
                ['name' => 'iccid', 'contents' => $phonenum->esim->iccid,],
                ['name' => 'pin', 'contents' => $phonenum->esim->pin,],
                ['name' => 'puk', 'contents' => $phonenum->esim->puk,],
                ['name' => 'ac', 'contents' => $phonenum->esim->ac,],
            ]
        ];

        return $client->post($post_link, $options);
    }

    #endregion
}
