<?php

use App\Models\Projeto;
use App\Repositories\ProjetoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjetoRepositoryTest extends TestCase
{
    use MakeProjetoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProjetoRepository
     */
    protected $projetoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->projetoRepo = App::make(ProjetoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProjeto()
    {
        $projeto = $this->fakeProjetoData();
        $createdProjeto = $this->projetoRepo->create($projeto);
        $createdProjeto = $createdProjeto->toArray();
        $this->assertArrayHasKey('id', $createdProjeto);
        $this->assertNotNull($createdProjeto['id'], 'Created Projeto must have id specified');
        $this->assertNotNull(Projeto::find($createdProjeto['id']), 'Projeto with given id must be in DB');
        $this->assertModelData($projeto, $createdProjeto);
    }

    /**
     * @test read
     */
    public function testReadProjeto()
    {
        $projeto = $this->makeProjeto();
        $dbProjeto = $this->projetoRepo->find($projeto->id);
        $dbProjeto = $dbProjeto->toArray();
        $this->assertModelData($projeto->toArray(), $dbProjeto);
    }

    /**
     * @test update
     */
    public function testUpdateProjeto()
    {
        $projeto = $this->makeProjeto();
        $fakeProjeto = $this->fakeProjetoData();
        $updatedProjeto = $this->projetoRepo->update($fakeProjeto, $projeto->id);
        $this->assertModelData($fakeProjeto, $updatedProjeto->toArray());
        $dbProjeto = $this->projetoRepo->find($projeto->id);
        $this->assertModelData($fakeProjeto, $dbProjeto->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProjeto()
    {
        $projeto = $this->makeProjeto();
        $resp = $this->projetoRepo->delete($projeto->id);
        $this->assertTrue($resp);
        $this->assertNull(Projeto::find($projeto->id), 'Projeto should not exist in DB');
    }
}
