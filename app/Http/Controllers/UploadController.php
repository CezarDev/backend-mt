<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FotoPessoa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class UploadController extends Controller
{
    public function upload(Request $request) {
        $request->validate([
            'fotos.*' => 'required|image|max:2048',
            'pes_id' => 'required|exists:pessoa,pes_id'
        ]);

        $links = [];

        foreach ($request->file('fotos') as $foto) {
            $hash = Str::uuid()->toString();
            $path = "fotos/{$hash}.{$foto->getClientOriginalExtension()}";

            Storage::disk('minio')->put($path, file_get_contents($foto));

            FotoPessoa::create([
                'pes_id' => $request->pes_id,
                'fp_data' => now(),
                'fp_bucket' => 'minio',
                'fp_hash' => $hash
            ]);

            $url = Storage::disk('minio')->temporaryUrl($path, now()->addMinutes(5));
            $links[] = $url;
        }

        return response()->json($links);
    }

    public function visualizar($hash) {
        $foto = FotoPessoa::where('fp_hash', $hash)->firstOrFail();n
        $path = "fotos/{$hash}.*"; // tipo wildcard

        $file = collect(Storage::disk('minio')->files('fotos'))->first(fn($f) => str_contains($f, $hash));

        if (!$file) {
            return response()->json(['error' => 'Arquivo não encontrado'], 404);
        }

        $url = Storage::disk('minio')->temporaryUrl($file, now()->addMinutes(5));
        return response()->json(['url' => $url]);
    }
}
