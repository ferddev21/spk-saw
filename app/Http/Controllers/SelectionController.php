<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Criteriavariabel;
use App\Models\Alternativecriteria;

class SelectionController extends Controller
{
    public function __construct()
    {
        $this->alternative = new Alternative();
        $this->criteria = new Criteria();
        $this->criteriaVariabel = new Criteriavariabel();
        $this->alternativeCriteria = new Alternativecriteria();
    }

    public function index()
    {
        $data = [
            'criterias' => $this->criteria,
            'selections' => $this->alternativeCriteria->selections(),
            'alternativeCriteria' => $this->alternativeCriteria,
            'criteriaVariabel' => $this->criteriaVariabel
        ];
        return view('pages.selection_index', $data);
    }

    public function add()
    {
        $data = [
            'alternatives' => $this->alternative->all(),
            'criterias' => $this->criteria->all(),
            'criteriaVariabelsModel' => $this->criteriaVariabel
        ];
        return view('pages.selection_add', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'alternative_id' => [
                'required',
                Rule::unique('alternativecriterias')->ignore($request->alternative_id),
            ],
            'id_criteriaVar' => 'required',
        ]);


        foreach ($request->id_criteriaVar as $cr => $cv) {
            $criteriaVar = $this->criteriaVariabel->where(['id' => $cv])->first();

            $selections = new Alternativecriteria();
            $selections->alternative_id = $request->alternative_id;
            $selections->criteria_id = $cr;
            $selections->criteriavariabel_id = $cv;
            $selections->user_id = $request->id_user;
            $selections->value = $criteriaVar->value;
            $selections->save();
        }

        $request->session()->flash('success', 'Data berhasil ditambahkan');
        return redirect()->route('selection.add');
    }

    public function edit($id_alternative)
    {

        $data = [
            'alternative_selection' => $this->alternative->where(['id' => decrypt($id_alternative)])->first(),
            'alternatives' => $this->alternative->all(),
            'criterias' => $this->criteria->all(),
            'criteriaVariabelsModel' => $this->criteriaVariabel,
            'alternativeCriteria' => $this->alternativeCriteria,
        ];
        return view('pages.selection_edit', $data);
    }

    public function update(Request $request)
    {

        foreach ($request->id_criteriaVar as $cr => $cv) {

            $alternativeCriteria = $this->alternativeCriteria->where(['alternative_id' => $request->id_alternative, 'criteria_id' => $cr]);
            $criteriaVar = $this->criteriaVariabel->where(['id' => $cv])->first();

            if ($alternativeCriteria->first()) {
                $alternativeCriteria->update([
                    'criteriavariabel_id' => $cv,
                    'value' =>  $criteriaVar->value,
                ]);
            } else {
                $selections = new Alternativecriteria();
                $selections->alternative_id = $request->id_alternative;
                $selections->criteria_id = $cr;
                $selections->criteriavariabel_id = $cv;
                $selections->user_id = $request->id_user;
                $selections->value = $criteriaVar->value;
                $selections->save();
            }
        }

        $request->session()->flash('success', 'Data berhasil diupdate');
        return redirect()->route('selection.edit', ['id_alternative' => encrypt($request->id_alternative)]);
    }
}
