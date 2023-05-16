<?php

declare(strict_types=1);

namespace Alibori\LaravelDddDomainResources\Commands;

use Alibori\LaravelDddDomainResources\Commands\Generators\LaravelDddDomainResourcesGeneratorCommand;
use Illuminate\Console\Command;

class LaravelDddDomainResourcesCommand extends Command
{
    public $signature = 'domain:generate {domain} {file?} {--scaffold}';

    public $description = 'Command to generate basic DDD Domain Resources';

    public function handle(): int
    {
        /** @var string $domain */
        $domain = $this->argument(key: 'domain');

        /** @var array $domains_array */
        $domains_array = config(key: 'ddd-domain-resources.domains');

        if ( ! array_key_exists(key: $domain, array: $domains_array)) {
            $this->error(string: 'Domain not found in config file!');
            return self::FAILURE;
        }

        $domain_data = $domains_array[$domain];

        if ($this->option(key: 'scaffold') && ! $this->argument(key: 'file')) {
            $this->info(string: 'Generating Domain Scaffold for '.$domain_data['name'].'\'s Domain...');

            // Check if Domain directory already exists
            if (is_dir(filename: config(key: 'ddd-domain-resources.domains_path').'\\'.$domain_data['name'])) {
                $this->error(string: 'Domain directory already exists, aborting...');
                return self::FAILURE;
            }

            $this->generateDomainScaffold(domain_data: $domain_data);

            $this->info(string: 'Domain Scaffold generated successfully!');
        } elseif ($this->argument(key: 'file') && ! $this->option(key: 'scaffold')) {
            switch ($this->argument(key: 'file')) {
                case 'use_case':
                    $name = $this->ask(question: 'Enter the name of the Use Case');
                    break;
                case 'contract':
                    $name = $this->ask(question: 'Enter the name of the Contract');
                    break;
                case 'event':
                    $name = $this->ask(question: 'Enter the name of the Event');
                    break;
                case 'exception':
                    $name = $this->ask(question: 'Enter the name of the Exception');
                    break;
                case 'value_object':
                    $name = $this->ask(question: 'Enter the name of the Value Object');
                    break;
                case 'repository':
                    $name = $this->ask(question: 'Enter the name of the Repository');
                    break;
                case 'controller':
                    $name = $this->ask(question: 'Enter the name of the Controller');
                    break;
                default:
                    $this->error(string: 'Invalid file type!');
                    return self::FAILURE;
            }

            $this->info(string: 'Generating '.$name.' for '.$domain_data['name'].'\'s Domain...');

            $this->call(command: LaravelDddDomainResourcesGeneratorCommand::class, arguments: [
                'type' => $this->argument(key: 'file'),
                'name' => $name,
                'namespace' => $domain_data['namespace'],
            ]);
        } elseif ( ! $this->argument(key: 'file') && ! $this->option(key: 'scaffold')) {
            $this->error(string: 'You must specify a file type or use the --scaffold option!');
            return self::FAILURE;
        } else {
            $this->error(string: 'You must specify a file type or use the --scaffold option, not both!');
            return self::FAILURE;
        }

        return self::SUCCESS;
    }

    private function generateDomainScaffold(array $domain_data): void
    {
        // Generate Generic Domain directory
        mkdir(directory: config(key: 'ddd-domain-resources.domains_path').'\\'.$domain_data['name']);

        // Generate Application directory
        mkdir(directory: config(key: 'ddd-domain-resources.domains_path').'\\'.$domain_data['name'].'\\'.'Application');

        // Generate Domain directory
        mkdir(directory: config(key: 'ddd-domain-resources.domains_path').'\\'.$domain_data['name'].'\\'.'Domain');

        // Generate Contracts/Events/Exceptions/Value Objects directory inside Domain directory
        mkdir(directory: config(key: 'ddd-domain-resources.domains_path').'\\'.$domain_data['name'].'\\'.'Domain'.'\\'.'Contracts');
        mkdir(directory: config(key: 'ddd-domain-resources.domains_path').'\\'.$domain_data['name'].'\\'.'Domain'.'\\'.'Events');
        mkdir(directory: config(key: 'ddd-domain-resources.domains_path').'\\'.$domain_data['name'].'\\'.'Domain'.'\\'.'Exceptions');
        mkdir(directory: config(key: 'ddd-domain-resources.domains_path').'\\'.$domain_data['name'].'\\'.'Domain'.'\\'.'ValueObjects');

        // Generate Infrastructure directory
        mkdir(directory: config(key: 'ddd-domain-resources.domains_path').'\\'.$domain_data['name'].'\\'.'Infrastructure');

        // Generate Repositories directory inside Infrastructure directory
        mkdir(directory: config(key: 'ddd-domain-resources.domains_path').'\\'.$domain_data['name'].'\\'.'Infrastructure'.'\\'.'Repositories');
        mkdir(directory: config(key: 'ddd-domain-resources.domains_path').'\\'.$domain_data['name'].'\\'.'Infrastructure'.'\\'.'Controllers');
    }
}
