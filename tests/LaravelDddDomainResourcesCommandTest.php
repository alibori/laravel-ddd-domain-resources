<?php

declare(strict_types=1);

// Test that the command can be executed
it(description: 'can execute the command', closure: function (): void {
    $this->artisan(command: 'domain:generate fake --scaffold')
        ->expectsOutput('Domain not found in config file!')
        ->assertExitCode(1);
});

// Test that the command can be executed with a valid domain and scaffold option
it(description: 'can execute the command with a valid domain and scaffold option', closure: function (): void {
    $this->artisan(command: 'domain:generate user --scaffold')
        ->expectsOutput('Generating Domain Scaffold for User\'s Domain...')
        ->expectsOutput('Domain Scaffold generated successfully!')
        ->assertExitCode(0);

    // Delete the generated User directory and its contents
    deleteAll(dir: config(key: 'ddd-domain-resources.domains_path').'\\'.'User');
});

// Test that the command will abort if the domain directory already exists
it(description: 'will abort if the domain directory already exists', closure: function (): void {
    // Create a User directory
    mkdir(directory: config(key: 'ddd-domain-resources.domains_path').'\\'.'User');

    $this->artisan(command: 'domain:generate user --scaffold')
        ->expectsOutput('Domain directory already exists, aborting...')
        ->assertExitCode(1);

    // Delete the generated User directory and its contents
    deleteAll(dir: config(key: 'ddd-domain-resources.domains_path').'\\'.'User');
});

// Test that the command can generate a Use Case
it(description: 'can generate a Use Case', closure: function (): void {
    $this->artisan(command: 'domain:generate user --scaffold')
        ->expectsOutput('Generating Domain Scaffold for User\'s Domain...')
        ->expectsOutput('Domain Scaffold generated successfully!')
        ->assertExitCode(0);

    $this->artisan(command: 'domain:generate user use_case')
        ->expectsQuestion(question: 'Enter the name of the Use Case', answer: 'FakeUseCase')
        ->assertExitCode(0);

    // Delete the generated User directory and its contents
    deleteAll(dir: config(key: 'ddd-domain-resources.domains_path').'\\'.'User');
});

// Test that the command can generate a Contract
it(description: 'can generate a Contract', closure: function (): void {
    $this->artisan(command: 'domain:generate user --scaffold')
        ->expectsOutput('Generating Domain Scaffold for User\'s Domain...')
        ->expectsOutput('Domain Scaffold generated successfully!')
        ->assertExitCode(0);

    $this->artisan(command: 'domain:generate user contract')
        ->expectsQuestion(question: 'Enter the name of the Contract', answer: 'FakeContract')
        ->assertExitCode(0);

    // Delete the generated User directory and its contents
    deleteAll(dir: config(key: 'ddd-domain-resources.domains_path').'\\'.'User');
});

// Test that the command can generate an Event
it(description: 'can generate an Event', closure: function (): void {
    $this->artisan(command: 'domain:generate user --scaffold')
        ->expectsOutput('Generating Domain Scaffold for User\'s Domain...')
        ->expectsOutput('Domain Scaffold generated successfully!')
        ->assertExitCode(0);

    $this->artisan(command: 'domain:generate user event')
        ->expectsQuestion(question: 'Enter the name of the Event', answer: 'FakeEvent')
        ->assertExitCode(0);

    // Delete the generated User directory and its contents
    deleteAll(dir: config(key: 'ddd-domain-resources.domains_path').'\\'.'User');
});

// Test that the command can generate an Exception
it(description: 'can generate an Exception', closure: function (): void {
    $this->artisan(command: 'domain:generate user --scaffold')
        ->expectsOutput('Generating Domain Scaffold for User\'s Domain...')
        ->expectsOutput('Domain Scaffold generated successfully!')
        ->assertExitCode(0);

    $this->artisan(command: 'domain:generate user exception')
        ->expectsQuestion(question: 'Enter the name of the Exception', answer: 'FakeException')
        ->assertExitCode(0);

    // Delete the generated User directory and its contents
    deleteAll(dir: config(key: 'ddd-domain-resources.domains_path').'\\'.'User');
});

// Test that the command can generate a Value Object
it(description: 'can generate a Value Object', closure: function (): void {
    $this->artisan(command: 'domain:generate user --scaffold')
        ->expectsOutput('Generating Domain Scaffold for User\'s Domain...')
        ->expectsOutput('Domain Scaffold generated successfully!')
        ->assertExitCode(0);

    $this->artisan(command: 'domain:generate user value_object')
        ->expectsQuestion(question: 'Enter the name of the Value Object', answer: 'FakeValueObject')
        ->assertExitCode(0);

    // Delete the generated User directory and its contents
    deleteAll(dir: config(key: 'ddd-domain-resources.domains_path').'\\'.'User');
});

// Test that the command can generate a Repository
it(description: 'can generate a Repository', closure: function (): void {
    $this->artisan(command: 'domain:generate user --scaffold')
        ->expectsOutput('Generating Domain Scaffold for User\'s Domain...')
        ->expectsOutput('Domain Scaffold generated successfully!')
        ->assertExitCode(0);

    $this->artisan(command: 'domain:generate user repository')
        ->expectsQuestion(question: 'Enter the name of the Repository', answer: 'FakeRepository')
        ->assertExitCode(0);

    // Delete the generated User directory and its contents
    deleteAll(dir: config(key: 'ddd-domain-resources.domains_path').'\\'.'User');
});

// Test that the command can generate a Controller
it(description: 'can generate a Controller', closure: function (): void {
    $this->artisan(command: 'domain:generate user --scaffold')
        ->expectsOutput('Generating Domain Scaffold for User\'s Domain...')
        ->expectsOutput('Domain Scaffold generated successfully!')
        ->assertExitCode(0);

    $this->artisan(command: 'domain:generate user controller')
        ->expectsQuestion(question: 'Enter the name of the Controller', answer: 'FakeController')
        ->assertExitCode(0);

    // Delete the generated User directory and its contents
    deleteAll(dir: config(key: 'ddd-domain-resources.domains_path').'\\'.'User');
});

// delete all files and sub-folders from a folder
function deleteAll(string $dir): void
{
    foreach(glob(pattern: $dir.'/*') as $file) {
        if(is_dir($file)) {
            deleteAll($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dir);
}
