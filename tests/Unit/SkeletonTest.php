<?php


namespace MacsiDigital\Skeleton\Tests\Unit;

use MacsiDigital\Skeleton\Skeleton;
use MacsiDigital\Skeleton\Tests\TestCase;

class SkeletonTest extends TestCase
{
    public function a_skeleton_model_can_be_created()
    {
        $model = Skeleton::create(['name' => 'Test']);

        $this->assertDatabaseHas('skeletons', ['name' => 'Test']);
    }

    public function the_skeleton_factory_works()
    {
        $model = factory(Skeleton::class)->create();

        $this->assertDatabaseHas('skeletons', ['name' => $model->name]);
    }

    public function the_skeleton_facade_works()
    {
        Skeleton::create(['name' => 'Test']);

        $model = MacsiDigital\Skeleton\Facades\Skeleton::whereName('John')->first();

        $this->assertEquals('John', $model->name);
    }
}
