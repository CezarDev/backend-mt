<?php

namespace App\Http\Controllers;

use App\Models\ServidorTemporario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServidorTemporarioController extends Controller
{
    public function index(Request $request) {
        return ServidorTemporario::with('pessoa')->paginate(10);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'pes_id' => 'required|exists:pessoa,pes_id',
            'st_data_admissao' => 'required|date',
            'st_data_demissao' => 'nullable|date|after_or_equal:st_data_admissao',
        ]);
        return ServidorTemporario::create($validated);
    }

    public function show($id) {
        return ServidorTemporario::with('pessoa')->findOrFail($id);
    }

    public function update(Request $request, $id) {
        $registro = ServidorTemporario::findOrFail($id);
        $registro->update($request->only(['st_data_admissao', 'st_data_demissao']));
        return $registro;
    }

    public function destroy($id) {
        $registro = ServidorTemporario::findOrFail($id);
        $registro->delete();
        return response()->noContent();
    }
}
