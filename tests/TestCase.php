<?php

namespace ElfSundae\Apps\Test;

use ElfSundae\Apps\AppsServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use Concerns\MakesHttpRequests;

    protected function setAppsConfig($config)
    {
        $this->app['config']['apps'] = $config;
    }

    protected function registerAppsService($config = [])
    {
        $this->setAppsConfig($config);
        $this->app->register(AppsServiceProvider::class);
    }

    protected function setRequestUrl($url)
    {
        $this->app['config']['app.url'] = $url;
        $this->app['Illuminate\Foundation\Bootstrap\SetRequestForConsole']->bootstrap($this->app);
    }
}
