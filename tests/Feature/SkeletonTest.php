<?php


namespace MacsiDigital\Skeleton\Tests\Feature;

use MacsiDigital\Skeleton\Skeleton;
use MacsiDigital\Skeleton\Tests\TestCase;

class SkeletonTest extends TestCase
{
    public function the_package_config_is_accessible()
    {
        $this->assertNotNull(config('skeleton'));
    }

    public function a_package_route_can_be_hit()
    {
        $this->get(config('skeleton.routes.web_prefix').'/')
            ->assertStatus('200')
            ->assertSeeText('test route is good');
    }

    public function a_package_route_can_go_to_controller_and_return_a_view()
    {
        $this->get(config('skeleton.routes.web_prefix').'/controller')
            ->assertStatus('200')
            ->assertSeeText('SkeletonMiddleware blade ok!');
    }

    public function a_package_api_route_can_be_hit()
    {
        $this->getJson(config('skeleton.routes.api_prefix').'/test')
            ->assertStatus('200')
            ->assertJson([
                'message' => 'all good',
            ]);
        ;
    }

    public function a_package_api_route_can_go_to_controller_and_return_a_resource()
    {
        factory(Skeleton::class)->create(['name' => 'ApiTest']);

        $this->getJson(config('skeleton.routes.api_prefix').'/skeleton')
            ->assertStatus('200')
            ->assertJson([
                'name' => 'ApiTest',
            ]);
        ;
    }

    public function a_package_command_works()
    {
        $this->artisan('skeleton')
            ->assertOutput('Commands are good');
    }
}
