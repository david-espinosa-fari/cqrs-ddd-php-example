<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Video\Infrastructure\Persistence;

use CodelyTv\Mooc\Video\Domain\VideoRepository;
use CodelyTv\Test\Mooc\Video\Domain\VideoIdMother;
use CodelyTv\Test\Mooc\Video\Domain\VideoMother;
use CodelyTv\Test\Mooc\Video\VideoModuleFunctionalTestCase;

final class VideoRepositoryTest extends VideoModuleFunctionalTestCase
{
    /** @test */
    public function it_should_save_a_video(): void
    {
        $this->repository()->save(VideoMother::random());
    }

    /** @test */
    public function it_should_find_an_existing_video(): void
    {
        $video = VideoMother::random();

        $this->repository()->save($video);
        $this->clearUnitOfWork();

        $this->assertSimilar($video, $this->repository()->search($video->id()));
    }

    /** @test */
    public function it_should_not_find_a_non_existing_video(): void
    {
        $this->assertNull($this->repository()->search(VideoIdMother::random()));
    }

    private function repository(): VideoRepository
    {
        return $this->service('codely.mooc.video.repository');
    }
}
