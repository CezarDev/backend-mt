<?php

namespace Tests\Feature;

use App\Models\Pessoa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// Teste para verificar se o usuário não autenticado não pode criar um servidor efetivo
class ServidorEfetivoTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_pode_criar_servidor_efetivo()
    {
        // Cria um usuário e autentica
        $user = User::factory()->create();
        $token = auth()->login($user);

        // Cria uma pessoa vinculada
        $pessoa = Pessoa::factory()->create();

        // Dados para o POST
        $payload = [
            'pes_id' => $pessoa->id,
            'se_matricula' => 'MAT12345'
        ];

        // Requisição autenticada
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/servidores-efetivos', $payload);

        // Verificações
        $response->assertStatus(201)
            ->assertJsonFragment([
                'pes_id' => $pessoa->id,
                'se_matricula' => 'MAT12345'
            ]);

        $this->assertDatabaseHas('servidores_efetivos', [
            'pes_id' => $pessoa->id,
            'se_matricula' => 'MAT12345'
        ]);
    }
}
