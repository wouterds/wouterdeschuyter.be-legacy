<?php

namespace WouterDeSchuyter\Infrastructure\Config;

use League\Container\ServiceProvider\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        Config::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->container->share(Config::class, function () {
            // Defaults
            $defaults = $_ENV;

            // Load version
            $version = $this->loadVersion();

            return new Config(array_merge(
                $defaults,
                $version
            ));
        });
    }

    /**
     * @return array
     */
    private function loadVersion(): array
    {
        // Version file
        $file = APP_DIR . '/.version';

        // File doesn't exist?
        if (!file_exists($file)) {
            return [
                'APP_VERSION_NUMBER' => 'unknown',
                'APP_VERSION_COMMIT' => 'unknown',
            ];
        }

        // Get contents
        $version = file_get_contents($file);

        // Parse file
        $version = array_filter(explode(PHP_EOL, $version));

        // No contents?
        if (empty($version)) {
            return [
                'APP_VERSION_NUMBER' => 'unknown',
                'APP_VERSION_COMMIT' => 'unknown',
            ];
        }

        $versionNumber = $version[0];
        $versionCommit = $version[1];

        return [
            'APP_VERSION_NUMBER' => $versionNumber,
            'APP_VERSION_COMMIT' => $versionCommit,
        ];
    }
}
