namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServidorEfetivo;
use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
// ✅ Servidores efetivos lotados em uma unidade
public function servidoresPorUnidade($unid_id) {
$servidores = ServidorEfetivo::select('pessoa.pes_nome', 'pessoa.pes_data_nascimento', 'unidade.unid_nome', 'foto_pessoa.fp_hash')
->join('pessoa', 'pessoa.pes_id', '=', 'servidor_efetivos.pes_id')
->join('lotacaos', 'lotacaos.pes_id', '=', 'pessoa.pes_id')
->join('unidade', 'unidade.unid_id', '=', 'lotacaos.unid_id')
->leftJoin('foto_pessoa', 'foto_pessoa.pes_id', '=', 'pessoa.pes_id')
->where('unidade.unid_id', $unid_id)
->paginate(10);

// Adiciona idade e link da foto temporário (simulado por enquanto)
$servidores->getCollection()->transform(function ($s) {
$s->idade = \Carbon\Carbon::parse($s->pes_data_nascimento)->age;
$s->foto_url = $s->fp_hash ? route('fotos.visualizar', $s->fp_hash) : null;
return $s;
});

return $servidores;
}

// ✅ Endereço funcional (da unidade) a partir de parte do nome do servidor efetivo
public function enderecoFuncionalPorNome(Request $request) {
$nome = $request->input('nome');

$result = DB::table('pessoa')
->join('servidor_efetivos', 'servidor_efetivos.pes_id', '=', 'pessoa.pes_id')
->join('lotacaos', 'lotacaos.pes_id', '=', 'pessoa.pes_id')
->join('unidade', 'unidade.unid_id', '=', 'lotacaos.unid_id')
->join('unidade_endereco', 'unidade_endereco.unid_id', '=', 'unidade.unid_id')
->join('endereco', 'endereco.end_id', '=', 'unidade_endereco.end_id')
->where('pessoa.pes_nome', 'ilike', "%$nome%")
->select(
'pessoa.pes_nome',
'unidade.unid_nome',
'endereco.end_logradouro',
'endereco.end_numero',
'endereco.end_bairro'
)
->paginate(10);

return $result;
}
}
