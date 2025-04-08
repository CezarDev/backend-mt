<?php

namespace App\Services;

use App\Models\Unidade;

class UnidadeService extends BaseService
{
    public function __construct(Unidade $unidade)
    {
        parent::__construct($unidade);
    }

    public function findBySigla($sigla)
    {
        return $this->repository->where('unid_sigla', $sigla)->first();
    }

    public function findByNome($nome)
    {
        return $this->repository->where('unid_nome', 'like', '%' . $nome . '%')->get();
    }
    public function findById($id)
    {
        return $this->repository->with('enderecos')->findOrFail($id);
    }
    public function findByNomeAndSigla($nome, $sigla)
    {
        return $this->repository->where('unid_nome', 'like', '%' . $nome . '%')
            ->where('unid_sigla', 'like', '%' . $sigla . '%')->get();
    }

}
