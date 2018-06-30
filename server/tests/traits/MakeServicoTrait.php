<?php

use Faker\Factory as Faker;
use App\Models\Servico;
use App\Repositories\ServicoRepository;

trait MakeServicoTrait
{
    /**
     * Create fake instance of Servico and save it in database
     *
     * @param array $servicoFields
     * @return Servico
     */
    public function makeServico($servicoFields = [])
    {
        /** @var ServicoRepository $servicoRepo */
        $servicoRepo = App::make(ServicoRepository::class);
        $theme = $this->fakeServicoData($servicoFields);
        return $servicoRepo->create($theme);
    }

    /**
     * Get fake instance of Servico
     *
     * @param array $servicoFields
     * @return Servico
     */
    public function fakeServico($servicoFields = [])
    {
        return new Servico($this->fakeServicoData($servicoFields));
    }

    /**
     * Get fake data of Servico
     *
     * @param array $postFields
     * @return array
     */
    public function fakeServicoData($servicoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'titulo' => $fake->word,
            'descricao' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $servicoFields);
    }
}
