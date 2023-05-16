<?php

declare(strict_types=1);

namespace Alibori\LaravelDddDomainResources\Commands\Generators;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class LaravelDddDomainResourcesGeneratorCommand extends GeneratorCommand
{
    protected $name = 'make:ddd-domain-resources-file';

    protected $description = 'Create a new DDD Domain Resources file';

    protected function getStub(): string|int
    {
        return match ($this->argument(key: 'type')) {
            'use_case', 'contract', 'event', 'exception', 'value_object', 'repository', 'controller' => $this->getFileStub(),
            default => $this->invalidFileType(),
        };
    }

    private function getFileStub(): string
    {
        /** @var string $type */
        $type = $this->argument(key: 'type');

        if (file_exists(base_path(path: 'stubs/ddd-domain-resources/'.$type.'.php.stub'))) {
            return base_path(path: 'stubs/ddd-domain-resources/'.$type.'.php.stub');
        }

        return __DIR__.'/stubs/'.$type.'.php.stub';
    }

    private function invalidFileType(): int
    {
        $this->error(string: 'Invalid file type!');
        return self::FAILURE;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        /** @var string $namespace */
        $namespace = $this->argument(key: 'namespace');

        /** @var string $type */
        $type = $this->argument(key: 'type');

        return match ($type) {
            'use_case' => $namespace.'\\Application',
            'contract' => $namespace.'\\Domain\\Contracts',
            'event' => $namespace.'\\Domain\\Events',
            'exception' => $namespace.'\\Domain\\Exceptions',
            'value_object' => $namespace.'\\Domain\\ValueObjects',
            'repository' => $namespace.'\\Infrastructure\\Repositories',
            'controller' => $namespace.'\\Infrastructure\\Controllers',
            default => $namespace,
        };
    }

    protected function getArguments(): array
    {
        return [
            ['type', InputArgument::REQUIRED, 'The type of class'],
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['namespace', InputArgument::REQUIRED, 'The namespace of the class'],
        ];
    }

    public function handle(): bool
    {
        parent::handle();

        $this->generateUseCase();

        return true;
    }

    protected function generateUseCase(): void
    {
        // Get the fully qualified class name (FQN)
        $class = $this->qualifyClass($this->getNameInput());

        // get the destination path, based on the default namespace
        $path = $this->getPath($class);

        $content = file_get_contents($path);

        file_put_contents($path, $content);
    }
}
