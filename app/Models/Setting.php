<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ReflexiveRelationship\HasReflexivePath;

/**
 * Class Setting
 *
 * @package App\Models
 * @property integer $id
 * @property string $group_id
 * @property string $name
 * @property string|null $full_path
 * @property string|null $value
 * @property string $type
 * @property string $array_sep
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int|null $created_by user creator reference
 * @property int|null $updated_by user updator reference
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read Setting|null $group
 * @property-read \Illuminate\Database\Eloquent\Collection|Setting[] $subsettings
 * @property-read int|null $subsettings_count
 * @method static \Database\Factories\SettingFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereArraySep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFullPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model implements Auditable
{
    use HasFactory, HasReflexivePath, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    public static $SETTINGTYPES = [
        [
            'label' => "string", 'value' => "string", 'parserFunc' => "getParsedStringValue", 'validationRule' => "required|string"
        ],
        [
            'label' => "integer", 'value' => "integer", 'parserFunc' => "getParsedIntegerValue", 'validationRule' => "required|integer"
        ],
        [
            'label' => "bool", 'value' => "bool", 'parserFunc' => "getParsedBoolValue", 'validationRule' => "required|boolean"
        ],
        [
            'label' => "float", 'value' => "float", 'parserFunc' => "getParsedFloatValue", 'validationRule' => "required|integer"
        ],
        [
            'label' => "array", 'value' => "array", 'parserFunc' => "getParsedArrayValue", 'validationRule' => "required|string"
        ],
    ];

    #region Validation Tools

    public static function defaultRules($type,$value) {
        $rules = [
            'name' => ['required'],
            'type' => ['required'],
            'value' => "",
        ];
        if ( ! is_null($value) ) {
            $settingtype = self::getSettingType($type);
            $rules['value'] = $settingtype['validationRule'];
        }
        return $rules;
    }
    public static function createRules($type,$value)  {
        return array_merge(self::defaultRules($type,$value), [

        ]);
    }
    public static function updateRules($model) {
        return array_merge(self::defaultRules($model->type,$model->value), [

        ]);
    }
    public static function validationMessages() {
        return [];
    }

    #endregion

    #region Relationships

    public function group() {
        return $this->belongsTo(Setting::class, "group_id");
    }

    public function subsettings() {
        return $this->hasMany(Setting::class, 'group_id');
    }

    #endregion

    #region Custom Functions

    public static function getAllGrouped() {
        try {
            /*$collection = Setting::all()->groupBy('group');
            foreach ($collection as $group => $coll) {
                foreach ($coll as $sett) {
                    $final_array[$group][$sett->name] = self::getParsedValue($sett);
                }
            }*/

            $all_settings = Setting::all()->toArray();
            $tree_settings = self::buildTree($all_settings);
            $final_array = self::cleanTree($tree_settings);

            return $final_array;
        } catch (\Exception $e) {
            return [];
        }
    }

    public static function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['group_id'] == $parentId) {
                $children = self::buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['name']] = $element;
            }
        }

        return $branch;
    }

    public static function cleanTree($tree) {
        $final_tree = [];
        foreach ($tree as $key => $item) {
            if (isset($item['children'])) {
                $final_tree[$key]['default'] = $item['value'];
                $final_tree[$item['name']] = self::cleanTree($item['children']);
            } else {
                $final_tree[$key] = isset($item['value']) ? self::getParsedValue($item) : $item;
            }
        }
        return $final_tree;
    }

    private static function getParsedValue($setting) {
        $type = self::getSettingType($setting['type']);
        // call the type parser function from a string stored in the variable 'parserFunc'
        return self::{$type['parserFunc']}($setting);
    }

    private static function getParsedStringValue($setting) {
        if ($setting['value'] === null) {
            return $setting['value'];
        }
        return $setting['value'];
    }
    private static function getParsedIntegerValue($setting) {
        if ($setting['value'] === null) {
            return $setting['value'];
        }
        return (int)$setting['value'];
    }
    private static function getParsedBoolValue($setting) {
        if ($setting['value'] === null) {
            return $setting['value'];
        }
        return (bool)$setting['value'];
    }
    private static function getParsedFloatValue($setting) {
        if ($setting['value'] === null) {
            return $setting['value'];
        }
        return (float)$setting['value'];
    }
    private static function getParsedArrayValue($setting) {
        if ($setting['value'] === null) {
            return $setting['value'];
        }
        return explode($setting['array_sep'], $setting['value']);
    }

    public static function getSettingType($type) {
        foreach (self::$SETTINGTYPES as $SETTINGTYPE) {
            if ($SETTINGTYPE['value'] === $type) {
                return $SETTINGTYPE;
            }
        }
        return null;
    }

    public function setGroup(Setting $group = null, $save = true) : Setting {
        if ( is_null($group) ) {
            $this->group()->disassociate();
        } else {
            $this->group()->associate($group);
        }

        if ($save) { $this->save(); }

        return $this;
    }

    #endregion

    public function getReflexiveChildrenRelationName(): string
    {
        return "subsettings";
    }

    public static function getReflexiveParentIdField(): string
    {
        return "group_id";
    }

    public static function getTitleField(): string
    {
        return "name";
    }

    public static function getReflexiveFullPathField(): string
    {
        return "full_path";
    }

    public static function getReflexivePathSeparator(): string
    {
        return ".";
    }
}
