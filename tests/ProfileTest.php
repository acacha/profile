<?php

namespace League\Skeleton;

class ProfileTest extends TestCase
{
    /**
     * Test settings route is installed.
     *
     * @return void
     */
    public function testSettingsRouteIsInstalled()
    {
        $this->visitRoute('settings');
//            ->see('Settings');
    }
}
