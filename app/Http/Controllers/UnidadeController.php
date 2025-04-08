<?php
namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function index(Request $request) {
        return Unidade::paginate(10);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'unid_nome' => 'required|string|max:200',
            'unid_sigla' => 'required|string|max:20',
        ]);
        return Unidade::create($validated);
    }

    public function show($id) {
        return Unidade::with('enderecos')->findOrFail($id);
    }

    public function update(Request $request, $id) {
        $unidade = Unidade::findOrFail($id);
        $unidade->update($request->only(['unid_nome', 'unid_sigla']));
        return $unidade;
    }

    public function destroy($id) {
        $unidade = Unidade::findOrFail($id);
        $unidade->delete();
        return response()->noContent();
    }
}
