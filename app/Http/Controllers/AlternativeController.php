<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function __construct()
    {
        $this->alternative = new Alternative();
    }

    public function index()
    {
        $data = [
            'alternatives' => $this->alternative->all()
        ];

        return view('pages.alternatives', $data);
    }

    public function add()
    {
        return view('pages.alternative_add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'alternative' => 'required|max:128|min:3|unique:alternatives,alternative',
        ]);

        $this->alternative->alternative = $request->alternative;
        $this->alternative->save();

        $request->session()->flash('success', $request->alternative . ' berhasil dibuat');
        return redirect()->route('alternative.add');
    }

    public function edit($id_alternative)
    {
        $data = [
            'alternative' => $this->alternative->where(['id' => decrypt($id_alternative)])->first()
        ];

        return view('pages.alternative_edit', $data);
    }

    public function update(Request $request)
    {
        $prov = $this->alternative->find($request->id);

        $request->validate([
            'alternative' => [
                'required', 'max:128', 'min:3',
                Rule::unique('alternatives')->ignore($request->id),
            ],
        ]);

        $prov->update([
            'alternative' => $request->alternative,
        ]);

        $request->session()->flash('success', $request->alternative . ' Berhasil diupdate');
        return redirect()->route('alternative.edit', ['id_alternative' => encrypt($request->id)]);
    }

    public function delete(Request $request)
    {
        $criteria = $this->alternative->find($request->id);

        if ($request->check) {
            $criteria->forceDelete();
            $request->session()->flash('success', 'alternative ' . $request->criteria . ' berhasil dihapus permanen');
            return redirect()->route('alternatives');
        }
        if ($criteria->delete()) {
            $request->session()->flash('success', 'alternative ' . $request->criteria . ' berhasil dihapus, check riwayat');
        }
        return redirect()->route('alternatives');
    }
}
