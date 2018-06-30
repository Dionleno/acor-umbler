<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServicoApiTest extends TestCase
{
    use MakeServicoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateServico()
    {
        $servico = $this->fakeServicoData();
        $this->json('POST', '/api/v1/servicos', $servico);

        $this->assertApiResponse($servico);
    }

    /**
     * @test
     */
    public function testReadServico()
    {
        $servico = $this->makeServico();
        $this->json('GET', '/api/v1/servicos/'.$servico->id);

        $this->assertApiResponse($servico->toArray());
    }

    /**
     * @test
     */
    public function testUpdateServico()
    {
        $servico = $this->makeServico();
        $editedServico = $this->fakeServicoData();

        $this->json('PUT', '/api/v1/servicos/'.$servico->id, $editedServico);

        $this->assertApiResponse($editedServico);
    }

    /**
     * @test
     */
    public function testDeleteServico()
    {
        $servico = $this->makeServico();
        $this->json('DELETE', '/api/v1/servicos/'.$servico->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/servicos/'.$servico->id);

        $this->assertResponseStatus(404);
    }
}
