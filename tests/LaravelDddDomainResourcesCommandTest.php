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
        ->expectsOutput('Generating Domain Scaffold for User \'s Domain...')
        ->expectsOutput('Domain Scaffold generated successfully!')
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
