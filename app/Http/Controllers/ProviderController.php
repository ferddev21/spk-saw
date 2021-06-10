<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->alternative = new Alternative();
    }

    public function index()
    {
        $data = [
            'providers' => $this->alternative->all()
        ];

        return view('pages.providers', $data);
    }

    public function add()
    {
        return view('pages.provider_add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'provider' => 'required|max:128|min:3|unique:alternatives,alternative',
        ]);

        $this->alternative->alternative = $request->provider;
        $this->alternative->save();

        $request->session()->flash('success', $request->provider . ' berhasil dibuat');
        return redirect()->route('provider.add');
    }

    public function edit($id_provider)
    {
        $data = [
            'alternative' => $this->alternative->where(['id' => decrypt($id_provider)])->first()
        ];

        return view('pages.provider_edit', $data);
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
        return redirect()->route('provider.edit', ['id_provider' => encrypt($request->id)]);
    }

    public function delete(Request $request)
    {
        $criteria = $this->alternative->find($request->id);

        if ($request->check) {
            $criteria->forceDelete();
            $request->session()->flash('success', 'Provider ' . $request->criteria . ' berhasil dihapus permanen');
            return redirect()->route('providers');
        }
        if ($criteria->delete()) {
            $request->session()->flash('success', 'Provider ' . $request->criteria . ' berhasil dihapus, check riwayat');
        }
        return redirect()->route('providers');
    }
}
