<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class BotCommandMake extends GeneratorCommand
{
    protected $name = 'bot:command';

    protected $description = 'Create a new bot command class';

    protected $type = 'Bot command';

    protected function getStub() {
        return base_path('stubs/command.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Commands';
    }
}
