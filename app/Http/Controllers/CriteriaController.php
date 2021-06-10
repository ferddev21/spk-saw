<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Criteriavariabel;

class CriteriaController extends Controller
{
    public function __construct()
    {
        $this->criteria = new Criteria();
        $this->criteriaVaribel = new Criteriavariabel();
    }
    public function index()
    {
        $data = [
            'criterias' => $this->criteria->all(),
            'criteriaVariabelModel' => $this->criteriaVaribel
        ];
        return view('pages.criteria_index', $data);
    }

    public function add()
    {
        return view('pages.criteria_add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'criteria' => 'required|max:128|min:3|unique:criterias,criteria',
            'type' => 'required',
            'bobot' => 'required|numeric',
        ]);

        $criteria = new Criteria();
        $criteria->criteria = $request->criteria;
        $criteria->type = $request->type;
        $criteria->bobot = $request->bobot;

        $criteria->save();

        $request->session()->flash('success', 'kriteria ' . $request->criteria . ' berhasil dibuat');
        return redirect()->route('criteria.add');
    }

    public function edit($id_criteria)
    {
        $data = [
            'criteria' => $this->criteria->where(['id' => decrypt($id_criteria)])->first(),
            'variabel' => $this->criteriaVaribel->where(['criteria_id' => decrypt($id_criteria)])->get()
        ];
        return view('pages.criteria_edit', $data);
    }

    public function update(Request $request)
    {
        $criteria = $this->criteria->find($request->id);

        $request->validate([
            'criteria' => [
                'required', 'max:128', 'min:3',
                Rule::unique('criterias')->ignore($request->id),
            ],
            'type' => 'required',
            'bobot' => 'required|numeric',
        ]);

        $criteria->update([
            'criteria' => $request->criteria,
            'type' => $request->type,
            'bobot' => $request->bobot,
        ]);

        $request->session()->flash('success', 'Kriteria ' . $request->criteria . ' berhasil diupdate');
        return redirect()->route('criteria.edit', ['id_criteria' => encrypt($request->id)]);
    }

    public function delete(Request $request)
    {

        $criteria = $this->criteria->find($request->id);

        $check_var = $this->criteriaVaribel->where(['criteria_id' => $criteria['id']])->get();

        if ($request->check) {
            if ($check_var) {
                if ($this->criteriaVaribel->where(['criteria_id' => $criteria['id']])->forceDelete()) {

                    $criteria->forceDelete();
                    $request->session()->flash('success', 'Kriteria ' . $request->criteria . ' berhasil dihapus permanen');
                    return redirect()->route('criterias');
                }
                $request->session()->flash('error', 'Kriteria ' . $request->criteria . ' gagal dihapus permanen');
                return redirect()->route('criteria.edit', ['id_criteria' => encrypt($request->id)]);
            }

            $criteria->forceDelete();
            $request->session()->flash('success', 'Kriteria ' . $request->criteria . ' berhasil dihapus permanen');
            return redirect()->route('criterias');
        }
        if ($criteria->delete()) {
            $request->session()->flash('success', 'Kriteria ' . $request->criteria . ' berhasil dihapus, check riwayat');
        }
        return redirect()->route('criterias');
    }

    public function addVariable($id_criteria)
    {
        $data = [
            'criteria' => $this->criteria->where(['id' => decrypt($id_criteria)])->first(),
        ];
        return view('pages.criteria_add_variable', $data);
    }

    public function createVariable(Request $request)
    {
        $request->validate([
            'criteria_id' => 'required',
            'variabel' => [
                'required', 'max:128', 'min:3',
            ],
            'value' => 'required|numeric',
        ]);

        $this->criteriaVaribel->criteria_id = $request->criteria_id;
        $this->criteriaVaribel->variabel = $request->variabel;
        $this->criteriaVaribel->value = $request->value;
        $this->criteriaVaribel->save();

        $request->session()->flash('success', 'variabel ' . $request->variabel . ' berhasil ditambahkan');
        return redirect()->route('criteria.variable.add', ['id_criteria' => encrypt($request->criteria_id)]);
    }

    public function editVariable($id_variabel)
    {
        $criteriaVar = $this->criteriaVaribel->where(['id' => decrypt($id_variabel)])->first();
        $data = [
            'criteria' => $this->criteria->where(['id' => $criteriaVar['criteria_id']])->first(),
            'variabel' => $criteriaVar
        ];
        return view('pages.criteria_edit_variable', $data);
    }

    public function updateVariable(Request $request)
    {
        $criteriaVar = $this->criteriaVaribel->find($request->id);

        $request->validate([
            'variabel' => [
                'required', 'max:128', 'min:3',
            ],
            'value' => 'required|numeric',
        ]);

        $criteriaVar->update([
            'variabel' => $request->variabel,
            'value' => $request->value,
        ]);

        $request->session()->flash('success', 'Variabel ' . $request->variabel . ' berhasil diupdate');
        return redirect()->route('criteria.variable.edit', ['id_variabel' => encrypt($request->id)]);
    }

    public function deleteVariable(Request $request)
    {
        $criteriaVariabel = $this->criteriaVaribel->find($request->id);

        if ($request->check) {
            $criteriaVariabel->forceDelete();
            $request->session()->flash('success', 'variabel ' . $request->variabel . ' berhasil dihapus permanen');
        }
        if ($criteriaVariabel->delete()) {
            $request->session()->flash('success', 'variabel ' . $request->variabel . ' berhasil dihapus, check riwayat');
        }
        return redirect()->route('criteria.edit', ['id_criteria' => encrypt($criteriaVariabel->criteria_id)]);
    }
}
