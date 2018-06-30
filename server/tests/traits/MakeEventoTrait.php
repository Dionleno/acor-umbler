<?php

use Faker\Factory as Faker;
use App\Models\Evento;
use App\Repositories\EventoRepository;

trait MakeEventoTrait
{
    /**
     * Create fake instance of Evento and save it in database
     *
     * @param array $eventoFields
     * @return Evento
     */
    public function makeEvento($eventoFields = [])
    {
        /** @var EventoRepository $eventoRepo */
        $eventoRepo = App::make(EventoRepository::class);
        $theme = $this->fakeEventoData($eventoFields);
        return $eventoRepo->create($theme);
    }

    /**
     * Get fake instance of Evento
     *
     * @param array $eventoFields
     * @return Evento
     */
    public function fakeEvento($eventoFields = [])
    {
        return new Evento($this->fakeEventoData($eventoFields));
    }

    /**
     * Get fake data of Evento
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEventoData($eventoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'logo' => $fake->word,
            'titulo' => $fake->word,
            'descricao' => $fake->text,
            'data' => $fake->word,
            'local' => $fake->word,
            'horario' => $fake->word,
            'valor' => $fake->randomDigitNotNull,
            'site' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $eventoFields);
    }
}
