<?php

use Faker\Factory as Faker;
use App\Models\Projeto;
use App\Repositories\ProjetoRepository;

trait MakeProjetoTrait
{
    /**
     * Create fake instance of Projeto and save it in database
     *
     * @param array $projetoFields
     * @return Projeto
     */
    public function makeProjeto($projetoFields = [])
    {
        /** @var ProjetoRepository $projetoRepo */
        $projetoRepo = App::make(ProjetoRepository::class);
        $theme = $this->fakeProjetoData($projetoFields);
        return $projetoRepo->create($theme);
    }

    /**
     * Get fake instance of Projeto
     *
     * @param array $projetoFields
     * @return Projeto
     */
    public function fakeProjeto($projetoFields = [])
    {
        return new Projeto($this->fakeProjetoData($projetoFields));
    }

    /**
     * Get fake data of Projeto
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProjetoData($projetoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nome' => $fake->word,
            'objetivo' => $fake->text,
            'descricao' => $fake->text,
            'link' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $projetoFields);
    }
}
