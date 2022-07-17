<?php


namespace App\Traits\Request;

use App\Models\User;
use App\Models\Status;
use App\Models\Esims\ClientEsim;
use Spatie\Permission\Models\Role;

trait RequestTraits
{
    public function getCheckValue($field) {
        $formInput = $this->all();
        if (array_key_exists($field, $formInput)) {
            if (is_null($formInput[$field])) {
                return 0;
            } else {
                return ($formInput[$field] === "true" || $formInput[$field] === "1" || $formInput[$field] === true) ? 1 : 0;
            }
        } else {
            return 0;
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function decodeJsonField($value) {
        return json_decode($value, true);
    }

    public function setRelevantRole($value, $json_decode_before = false) {
        if (is_null($value)) {
            return null;
        }
        if ($json_decode_before || is_string($value)) {
            $value = $this->decodeJsonField($value);
        }
        return $value ? Role::where('id', $value['id'])->first() : null;
    }

    public function setCheckOrOptionValue($value) {
        if (is_null($value) || $value === "null") {
            $value = null;
        }
        if ($value === "true") {
            $value = true;
        }
        if ($value === "false") {
            $value = false;
        }
        return intval($value);
    }

    public function setRelevantUser($value, $json_decode_before = false) {
        if (is_null($value)) {
            return null;
        }
        if ($json_decode_before || is_string($value)) {
            $value = $this->decodeJsonField($value);
        }
        return $value ? User::where('id', $value['id'])->first() : null;
    }

    public function setRelevantClientEsim($value, $field = 'id', $json_decode_before = false) {
        //dd($value, $field, $value[$field]);
        if (is_null($value)) {
            return null;
        }
        if ($json_decode_before || is_string($value)) {
            $value = $this->decodeJsonField($value);
        }
        return $value ? ClientEsim::where($field, $value[$field])->first() : null;
    }

    public function setRelevantStatus($value, $field = 'id', $json_decode_before = false) {
        if (is_null($value)) {
            return null;
        }
        if ($json_decode_before || is_string($value)) {
            $value = $this->decodeJsonField($value);
        }
        return $value ? Status::where($field, $value[$field])->first() : null;
    }

    public function setRelevantIdsList($value, $json_decode_before = false) {
        if (is_null($value) || empty($value)) {
            return null;
        }

        if ($json_decode_before) {
            $value = $this->decodeJsonField($value);
        }
        if (is_null($value) || empty($value)) {
            return null;
        }

        $ids = [];
        foreach ($value as $item) {
            $ids[] = $item['id'];
        }
        return $ids;
    }
}
