<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventoApiTest extends TestCase
{
    use MakeEventoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEvento()
    {
        $evento = $this->fakeEventoData();
        $this->json('POST', '/api/v1/eventos', $evento);

        $this->assertApiResponse($evento);
    }

    /**
     * @test
     */
    public function testReadEvento()
    {
        $evento = $this->makeEvento();
        $this->json('GET', '/api/v1/eventos/'.$evento->id);

        $this->assertApiResponse($evento->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEvento()
    {
        $evento = $this->makeEvento();
        $editedEvento = $this->fakeEventoData();

        $this->json('PUT', '/api/v1/eventos/'.$evento->id, $editedEvento);

        $this->assertApiResponse($editedEvento);
    }

    /**
     * @test
     */
    public function testDeleteEvento()
    {
        $evento = $this->makeEvento();
        $this->json('DELETE', '/api/v1/eventos/'.$evento->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/eventos/'.$evento->id);

        $this->assertResponseStatus(404);
    }
}
