<?php

use Faker\Factory as Faker;
use App\Models\Video;
use App\Repositories\VideoRepository;

trait MakeVideoTrait
{
    /**
     * Create fake instance of Video and save it in database
     *
     * @param array $videoFields
     * @return Video
     */
    public function makeVideo($videoFields = [])
    {
        /** @var VideoRepository $videoRepo */
        $videoRepo = App::make(VideoRepository::class);
        $theme = $this->fakeVideoData($videoFields);
        return $videoRepo->create($theme);
    }

    /**
     * Get fake instance of Video
     *
     * @param array $videoFields
     * @return Video
     */
    public function fakeVideo($videoFields = [])
    {
        return new Video($this->fakeVideoData($videoFields));
    }

    /**
     * Get fake data of Video
     *
     * @param array $postFields
     * @return array
     */
    public function fakeVideoData($videoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'titulo' => $fake->word,
            'descricao' => $fake->text,
            'link' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $videoFields);
    }
}
