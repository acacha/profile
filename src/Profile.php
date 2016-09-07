<?php

namespace Acacha\Profile;

/**
 * Class Profile.
 */
class Profile
{
    /**
     * Tests copy path.
     *
     * @return array
     */
    public function tests()
    {
        return [
            ACACHA_PROFILE_PATH.'/tests'       => base_path('tests'),
            ACACHA_PROFILE_PATH.'/phpunit.xml' => base_path('phpunit.xml'),
        ];
    }

}
