<?php

namespace App\Http\Controllers;

use App\Models\Lotacao;
use Illuminate\Http\Request;
use App\Services\LotacaoService;

class LotacaoController extends Controller
{
    protected $lotacaoService;
    public function __construct(LotacaoService $lotacaoService) {
        $this->lotacaoService = $lotacaoService;
    }

    public function index(Request $request) {
        return  $this->lotacaoService->getAll();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'pes_id' => 'required|exists:pessoa,pes_id',
            'unid_id' => 'required|exists:unidade,unid_id',
            'lot_data_lotacao' => 'required|date',
            'lot_data_remocao' => 'nullable|date|after_or_equal:lot_data_lotacao',
            'lot_portaria' => 'nullable|string|max:100',
        ]);

        return $this->lotacaoService->create($validated);
    }

    public function show($id) {
        return $this->lotacaoService->findById($id);
    }

    public function update(Request $request, $id) {

        $validated = $request->validate([
            'pes_id' => 'required|exists:pessoa,pes_id',
            'unid_id' => 'required|exists:unidade,unid_id',
            'lot_data_lotacao' => 'required|date',
            'lot_data_remocao' => 'nullable|date|after_or_equal:lot_data_lotacao',
            'lot_portaria' => 'nullable|string|max:100',
        ]);

        return $this->lotacaoService->update($id, $validated);
    }

    public function destroy($id) {
        $lotacao = $this->lotacaoService->find($id);
        if ($lotacao) {
            return $this->lotacaoService->delete($id);
        } else {
            return response()->json(['message' => 'Lotação não encontrada'], 404);
        }
    }
}

