<?php

namespace App\Services;

use App\Models\Lotacao;

class LotacaoService extends BaseService
{
    public function __construct(Lotacao $lotacao)
    {
        parent::__construct($lotacao);
    }

    public function findByNome($nome)
    {
        return $this->repository->where('lot_nome', 'like', '%' . $nome . '%')->get();
    }

    public function findBySigla($sigla)
    {
        return $this->repository->where('lot_sigla', 'like', '%' . $sigla . '%')->get();
    }

    public function findByNomeAndSigla($nome, $sigla)
    {
        return $this->repository->where('lot_nome', 'like', '%' . $nome . '%')
            ->where('lot_sigla', 'like', '%' . $sigla . '%')->get();
    }

    public function getAll()
    {
        return $this->repository->with(['pessoa', 'unidade'])->get();
    }

    public function findById($id)
    {
        return $this->repository->with(['pessoa', 'unidade'])->findOrFail($id);
    }

    public function findByPessoa($pessoaId)
    {
        return $this->repository->where('pes_id', $pessoaId)->with(['pessoa', 'unidade'])->get();
    }

    public function findByUnidade($unidadeId)
    {
        return $this->repository->where('unid_id', $unidadeId)->with(['pessoa', 'unidade'])->get();
    }
    public function findByDataLotacao($dataLotacao)
    {
        return $this->repository->where('lot_data_lotacao', $dataLotacao)->with(['pessoa', 'unidade'])->get();
    }
    public function findByDataRemocao($dataRemocao)
    {
        return $this->repository->where('lot_data_remocao', $dataRemocao)->with(['pessoa', 'unidade'])->get();
    }
    public function findByPortaria($portaria)
    {
        return $this->repository->where('lot_portaria', 'like', '%' . $portaria . '%')->with(['pessoa', 'unidade'])->get();
    }
    public function findByDataLotacaoAndDataRemocao($dataLotacao, $dataRemocao)
    {
        return $this->repository->where('lot_data_lotacao', $dataLotacao)
            ->where('lot_data_remocao', $dataRemocao)->with(['pessoa', 'unidade'])->get();
    }





}
