<?php

use App\Models\Evento;
use App\Repositories\EventoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventoRepositoryTest extends TestCase
{
    use MakeEventoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EventoRepository
     */
    protected $eventoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->eventoRepo = App::make(EventoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEvento()
    {
        $evento = $this->fakeEventoData();
        $createdEvento = $this->eventoRepo->create($evento);
        $createdEvento = $createdEvento->toArray();
        $this->assertArrayHasKey('id', $createdEvento);
        $this->assertNotNull($createdEvento['id'], 'Created Evento must have id specified');
        $this->assertNotNull(Evento::find($createdEvento['id']), 'Evento with given id must be in DB');
        $this->assertModelData($evento, $createdEvento);
    }

    /**
     * @test read
     */
    public function testReadEvento()
    {
        $evento = $this->makeEvento();
        $dbEvento = $this->eventoRepo->find($evento->id);
        $dbEvento = $dbEvento->toArray();
        $this->assertModelData($evento->toArray(), $dbEvento);
    }

    /**
     * @test update
     */
    public function testUpdateEvento()
    {
        $evento = $this->makeEvento();
        $fakeEvento = $this->fakeEventoData();
        $updatedEvento = $this->eventoRepo->update($fakeEvento, $evento->id);
        $this->assertModelData($fakeEvento, $updatedEvento->toArray());
        $dbEvento = $this->eventoRepo->find($evento->id);
        $this->assertModelData($fakeEvento, $dbEvento->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEvento()
    {
        $evento = $this->makeEvento();
        $resp = $this->eventoRepo->delete($evento->id);
        $this->assertTrue($resp);
        $this->assertNull(Evento::find($evento->id), 'Evento should not exist in DB');
    }
}
