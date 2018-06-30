<?php

use Faker\Factory as Faker;
use App\Models\Plano;
use App\Repositories\PlanoRepository;

trait MakePlanoTrait
{
    /**
     * Create fake instance of Plano and save it in database
     *
     * @param array $planoFields
     * @return Plano
     */
    public function makePlano($planoFields = [])
    {
        /** @var PlanoRepository $planoRepo */
        $planoRepo = App::make(PlanoRepository::class);
        $theme = $this->fakePlanoData($planoFields);
        return $planoRepo->create($theme);
    }

    /**
     * Get fake instance of Plano
     *
     * @param array $planoFields
     * @return Plano
     */
    public function fakePlano($planoFields = [])
    {
        return new Plano($this->fakePlanoData($planoFields));
    }

    /**
     * Get fake data of Plano
     *
     * @param array $postFields
     * @return array
     */
    public function fakePlanoData($planoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'vigencia' => $fake->word,
            'valor' => $fake->randomDigitNotNull,
            'tipo' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $planoFields);
    }
}
