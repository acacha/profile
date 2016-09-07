<?php

namespace League\Skeleton;

class ExampleTest extends TestCase
{
    /**
     * Test settings route is installed.
     *
     * @return void
     */
    public function testSettingsRouteIsInstalled()
    {
        $this->visit('/settings')
            ->see('Settings');
    }
}
