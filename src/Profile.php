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

    /**
     * Views copy path.
     *
     * @return array
     */
    public function views()
    {
        return [
            ACACHA_PROFILE_PATH.'/resources/views/profile'              => base_path('resources/views/profile'),
        ];
    }

    /**
     * Resource assets copy path.
     *
     * @return array
     */
    public function resourceAssets()
    {
        return [
            ACACHA_PROFILE_PATH.'/resources/assets/less' => base_path('resources/assets/less')
        ];
    }

    /**
     * Public assets copy path.
     *
     * @return array
     */
    public function publicAssets()
    {
        return [
            ACACHA_PROFILE_PATH.'/public/img'     => public_path('img'),
        ];
    }
}
