<?php

use App\Models\Servico;
use App\Repositories\ServicoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServicoRepositoryTest extends TestCase
{
    use MakeServicoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ServicoRepository
     */
    protected $servicoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->servicoRepo = App::make(ServicoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateServico()
    {
        $servico = $this->fakeServicoData();
        $createdServico = $this->servicoRepo->create($servico);
        $createdServico = $createdServico->toArray();
        $this->assertArrayHasKey('id', $createdServico);
        $this->assertNotNull($createdServico['id'], 'Created Servico must have id specified');
        $this->assertNotNull(Servico::find($createdServico['id']), 'Servico with given id must be in DB');
        $this->assertModelData($servico, $createdServico);
    }

    /**
     * @test read
     */
    public function testReadServico()
    {
        $servico = $this->makeServico();
        $dbServico = $this->servicoRepo->find($servico->id);
        $dbServico = $dbServico->toArray();
        $this->assertModelData($servico->toArray(), $dbServico);
    }

    /**
     * @test update
     */
    public function testUpdateServico()
    {
        $servico = $this->makeServico();
        $fakeServico = $this->fakeServicoData();
        $updatedServico = $this->servicoRepo->update($fakeServico, $servico->id);
        $this->assertModelData($fakeServico, $updatedServico->toArray());
        $dbServico = $this->servicoRepo->find($servico->id);
        $this->assertModelData($fakeServico, $dbServico->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteServico()
    {
        $servico = $this->makeServico();
        $resp = $this->servicoRepo->delete($servico->id);
        $this->assertTrue($resp);
        $this->assertNull(Servico::find($servico->id), 'Servico should not exist in DB');
    }
}
