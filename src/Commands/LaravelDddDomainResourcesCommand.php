<?php

declare(strict_types=1);

namespace Alibori\LaravelDddDomainResources\Commands;

use Illuminate\Console\Command;

class LaravelDddDomainResourcesCommand extends Command
{
    public $signature = 'domain:generate {domain} {--scaffold}';

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

        if ($this->option(key: 'scaffold')) {
            $this->info(string: 'Generating Domain Scaffold for '.$domain_data['name'].' \'s Domain...');

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

            $this->info(string: 'Domain Scaffold generated successfully!');
        }

        return self::SUCCESS;
    }
}
