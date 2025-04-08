<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ServidorEfetivoController,
    ServidorTemporarioController,
    UnidadeController,
    LotacaoController,
    ConsultaController,
    UploadController
};

Route::middleware('auth:sanctum')->group(function () {
    // CRUDs
    Route::apiResource('servidores-efetivos', ServidorEfetivoController::class);
    Route::apiResource('servidores-temporarios', ServidorTemporarioController::class);
    Route::apiResource('unidades', UnidadeController::class);
    Route::apiResource('lotacoes', LotacaoController::class);

    // Endpoints específicos:
    Route::get('/servidores-efetivos/unidade/{unid_id}', [ConsultaController::class, 'servidoresPorUnidade']);
    Route::get('/enderecos-funcionais/servidor', [ConsultaController::class, 'enderecoFuncionalPorNome']);

    // Upload de fotos
    Route::post('/upload-fotos', [UploadController::class, 'upload']);
    Route::get('/fotos/{fp_hash}', [UploadController::class, 'visualizar']);
});
