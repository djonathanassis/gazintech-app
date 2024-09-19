<?php

namespace Tests\Feature;

use App\Models\Level;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LevelTest extends TestCase
{
    final public function setUp(): void
    {
        parent::setUp();
    }

    final public function test_it_lists_all_levels(): void
    {
        $response = $this->getJson('/api/niveis');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['nivel', 'created_at', 'updated_at']
                ],
                'meta' => ['total', 'per_page', 'current_page', 'last_page']
            ]);
    }

    final public function test_it_fails_to_creates_nonexistent_level(): void
    {
        $response = $this->postJson(route('niveis.store'), []);

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'message' => 'O campo level é obrigatório',
                'errors' => [
                    'nivel' => ['O campo level é obrigatório'],
                ]
            ]);
    }

    final public function test_it_creates_a_new_level(): void
    {
        $data = ['nivel' => 'New Level'];

        $response = $this->postJson(route('niveis.store'), $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonFragment($data)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'nivel',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    final public function test_it_updates_an_existing_level(): void
    {
        $level = Level::factory()->create();
        $data = ['nivel' => 'Updated Level'];

        $response = $this->putJson(route('niveis.update', $level->id), $data);

        $response->assertStatus(Response::HTTP_ACCEPTED)
            ->assertJsonFragment($data)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'nivel',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    final public function test_it_fails_to_update_nonexistent_level(): void
    {
        $data = ['nivel' => 'Updated Level'];

        $response = $this->putJson(route('niveis.update', [999]), $data);

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson(['message' => 'Registro não encontrado.']);
    }

    final public function test_it_deletes_a_level(): void
    {
        $level = Level::factory()->create();

        $response = $this->deleteJson(route('niveis.destroy', $level->id));

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
