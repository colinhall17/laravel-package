<?php

namespace MacsiDigital\Skeleton\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use MacsiDigital\Skeleton\Providers\SkeletonServiceProvider;

class TestCase extends OrchestraTestCase
{
    protected function setUp() : void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/../database/factories');
    }

    protected function getPackageProviders($app)
    {
        return [
            SkeletonServiceProvider::class
        ];
    }

    public function getEnvironmentSetup($app)
    {
        include_once __DIR__.'/../database/migrations/create_skeleton_tables.php.stub';

        (new \CreateSkeletonTables)->up();
    }
}
