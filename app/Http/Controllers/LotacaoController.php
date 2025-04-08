<?php

namespace App\Http\Controllers;

use App\Models\Lotacao;
use Illuminate\Http\Request;

class LotacaoController extends Controller
{
    public function index(Request $request) {
        return Lotacao::with(['pessoa', 'unidade'])->paginate(10);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'pes_id' => 'required|exists:pessoa,pes_id',
            'unid_id' => 'required|exists:unidade,unid_id',
            'lot_data_lotacao' => 'required|date',
            'lot_data_remocao' => 'nullable|date|after_or_equal:lot_data_lotacao',
            'lot_portaria' => 'nullable|string|max:100',
        ]);
        return Lotacao::create($validated);
    }

    public function show($id) {
        return Lotacao::with(['pessoa', 'unidade'])->findOrFail($id);
    }

    public function update(Request $request, $id) {
        $lotacao = Lotacao::findOrFail($id);
        $lotacao->update($request->only(['lot_data_lotacao', 'lot_data_remocao', 'lot_portaria']));
        return $lotacao;
    }

    public function destroy($id) {
        $lotacao = Lotacao::findOrFail($id);
        $lotacao->delete();
        return response()->noContent();
    }
}

