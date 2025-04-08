<?php
namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Services\UnidadeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UnidadeController extends Controller
{
    protected $unidadeService;

    public function __construct(UnidadeService $unidadeService) {
        $this->unidadeService = $unidadeService;
    }

    public function index(Request $request) {
       return $this->unidadeService->findByNomeAndSigla(
            $request->query('unid_nome'),
            $request->query('unid_sigla')
        );
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'unid_nome' => 'required|string|max:200',
            'unid_sigla' => 'required|string|max:20',
        ]);

        return $this->unidadeService->create($validated);
    }

    public function show($id) {
       return $this->unidadeService->findById($id);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'unid_nome' => 'sometimes|required|string|max:200',
            'unid_sigla' => 'sometimes|required|string|max:20',
        ]);

        $unidade = $this->unidadeService->findById($id);
        $unidade->update($validated);

        return response()->json($unidade, Response::HTTP_OK);
    }

    public function destroy($id) {

        $unidade = $this->unidadeService->findById($id);
        $unidade->delete();

        return response()->json('Excluído com sucesso', Response::HTTP_OK);
    }
}
