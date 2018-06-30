<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlanoApiTest extends TestCase
{
    use MakePlanoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePlano()
    {
        $plano = $this->fakePlanoData();
        $this->json('POST', '/api/v1/planos', $plano);

        $this->assertApiResponse($plano);
    }

    /**
     * @test
     */
    public function testReadPlano()
    {
        $plano = $this->makePlano();
        $this->json('GET', '/api/v1/planos/'.$plano->id);

        $this->assertApiResponse($plano->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePlano()
    {
        $plano = $this->makePlano();
        $editedPlano = $this->fakePlanoData();

        $this->json('PUT', '/api/v1/planos/'.$plano->id, $editedPlano);

        $this->assertApiResponse($editedPlano);
    }

    /**
     * @test
     */
    public function testDeletePlano()
    {
        $plano = $this->makePlano();
        $this->json('DELETE', '/api/v1/planos/'.$plano->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/planos/'.$plano->id);

        $this->assertResponseStatus(404);
    }
}
