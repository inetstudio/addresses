<?php

namespace InetStudio\AddressesPackage\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

/**
 * Class SetupCommand.
 */
class SetupCommand extends BaseSetupCommand
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:addresses-package:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup addresses package';

    /**
     * Инициализация команд.
     */
    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Addresses points setup',
                'command' => 'inetstudio:addresses-package:points:setup',
            ],
        ];
    }
}
