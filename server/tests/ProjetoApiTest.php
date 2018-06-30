<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjetoApiTest extends TestCase
{
    use MakeProjetoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProjeto()
    {
        $projeto = $this->fakeProjetoData();
        $this->json('POST', '/api/v1/projetos', $projeto);

        $this->assertApiResponse($projeto);
    }

    /**
     * @test
     */
    public function testReadProjeto()
    {
        $projeto = $this->makeProjeto();
        $this->json('GET', '/api/v1/projetos/'.$projeto->id);

        $this->assertApiResponse($projeto->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProjeto()
    {
        $projeto = $this->makeProjeto();
        $editedProjeto = $this->fakeProjetoData();

        $this->json('PUT', '/api/v1/projetos/'.$projeto->id, $editedProjeto);

        $this->assertApiResponse($editedProjeto);
    }

    /**
     * @test
     */
    public function testDeleteProjeto()
    {
        $projeto = $this->makeProjeto();
        $this->json('DELETE', '/api/v1/projetos/'.$projeto->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/projetos/'.$projeto->id);

        $this->assertResponseStatus(404);
    }
}
