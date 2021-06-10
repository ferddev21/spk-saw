<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Criteriavariabel extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'criteria_id',
        'variabel',
        'value',
    ];

    public function getVariabel($id = null)
    {
        $result =  DB::table('criteriavariabels')->where(['id' => $id])->first();
        return $result != null ? $result->variabel : null;
    }

    public function getValueVariabel($id = null)
    {
        $result =  DB::table('criteriavariabels')->where(['id' => $id])->first();
        return $result != null ? $result->value : null;
    }
}
