<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Alternativecriteria extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alternative_id',
        'criteria_id',
        'criteriavariabel_id',
        'value',
        'user_id',
    ];

    public function selections()
    {
        return DB::table('alternatives')
            ->join('alternativecriterias', 'alternatives.id', '=', 'alternativecriterias.alternative_id')
            ->get()->unique('alternative_id');
    }

    public function getCriteriaVarBySelection($alternative_id = null, $criteria_id = null)
    {
        $result = DB::table('alternativecriterias')->where(['alternative_id' => $alternative_id, 'criteria_id' => $criteria_id])->first();

        return $result != null ? $result->criteriavariabel_id : null;
    }

    public function checkCriteriaVarBySelection($alternative_id = null, $criteriaVar_id = null)
    {
        $result = DB::table('alternativecriterias')->where(['alternative_id' => $alternative_id, 'criteriavariabel_id' => $criteriaVar_id])->first();

        return $result != null ? true : false;
    }

    public function getNormaliasasiVariabel($valueVar = null, $criteria_id = null, $typeCriteria = null)
    {
        $getValueCriteria = DB::table('alternativecriterias')->where(['criteria_id' => $criteria_id]);

        $valueVar = ($valueVar) ? $valueVar : 0;

        if ($typeCriteria == 'benefit') {
            $valueMax =  $getValueCriteria->max('value');

            $normalize =  ($valueVar != 0) ? $valueVar / $valueMax : 0;
            return  $this->check_decimal($normalize);
        }

        if ($typeCriteria == 'cost') {
            $valueMin =  $getValueCriteria->min('value');
            $normalize =  $valueMin / $valueVar;
            return  $this->check_decimal($normalize);
        }
    }

    private function check_decimal($val)
    {
        if (is_float($val)) {
            return  number_format($val, 2);
        }
        return $val;
    }
}
