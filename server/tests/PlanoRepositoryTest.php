<?php

use App\Models\Plano;
use App\Repositories\PlanoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlanoRepositoryTest extends TestCase
{
    use MakePlanoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlanoRepository
     */
    protected $planoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->planoRepo = App::make(PlanoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePlano()
    {
        $plano = $this->fakePlanoData();
        $createdPlano = $this->planoRepo->create($plano);
        $createdPlano = $createdPlano->toArray();
        $this->assertArrayHasKey('id', $createdPlano);
        $this->assertNotNull($createdPlano['id'], 'Created Plano must have id specified');
        $this->assertNotNull(Plano::find($createdPlano['id']), 'Plano with given id must be in DB');
        $this->assertModelData($plano, $createdPlano);
    }

    /**
     * @test read
     */
    public function testReadPlano()
    {
        $plano = $this->makePlano();
        $dbPlano = $this->planoRepo->find($plano->id);
        $dbPlano = $dbPlano->toArray();
        $this->assertModelData($plano->toArray(), $dbPlano);
    }

    /**
     * @test update
     */
    public function testUpdatePlano()
    {
        $plano = $this->makePlano();
        $fakePlano = $this->fakePlanoData();
        $updatedPlano = $this->planoRepo->update($fakePlano, $plano->id);
        $this->assertModelData($fakePlano, $updatedPlano->toArray());
        $dbPlano = $this->planoRepo->find($plano->id);
        $this->assertModelData($fakePlano, $dbPlano->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePlano()
    {
        $plano = $this->makePlano();
        $resp = $this->planoRepo->delete($plano->id);
        $this->assertTrue($resp);
        $this->assertNull(Plano::find($plano->id), 'Plano should not exist in DB');
    }
}
