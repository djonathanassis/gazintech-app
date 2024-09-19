<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Developer;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeveloperTest extends TestCase
{
    use RefreshDatabase;

    final public function test_it_lists_all_developers(): void
    {
        $response = $this->getJson(route('desenvolvedores.index'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'nome', 'hobby', 'sexo', 'data_nascimento', 'nivel_id', 'created_at', 'updated_at']
                ],
                'meta' => ['total', 'per_page', 'current_page', 'last_page']
            ]);
    }

    final public function test_it_creates_a_new_developer(): void
    {
        $level = Level::factory()->create();

        $data = [
            'nome' => 'New Developer',
            'hobby' => 'Coding',
            'sexo' => 'M',
            'data_nascimento' => '1990-01-01',
            'nivel_id' => $level->getKey()
        ];

        $response = $this->postJson(route('desenvolvedores.store'), $data);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    final public function test_it_updates_an_existing_developer(): void
    {
        $developer = Developer::factory()->create();
        $level = Level::factory()->create();
        $data = [
            'nome' => 'Updated Developer',
            'hobby' => 'Reading',
            'sexo' => 'F',
            'data_nascimento' => '1992-02-02',
            'nivel_id' => $level->getKey()
        ];

        $response = $this->putJson(route('desenvolvedores.update', $developer->id), $data);

        $response->assertStatus(Response::HTTP_ACCEPTED);
    }

    final public function test_it_deletes_a_developer(): void
    {
        $developer = Developer::factory()->create();

        $response = $this->deleteJson(route('desenvolvedores.destroy', $developer->id));

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
