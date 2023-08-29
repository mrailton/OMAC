<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:mrailton/OMAC.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('app.markrailton.com')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '/var/www/omac.markrailton.com');

// Hooks

after('deploy:failed', 'deploy:unlock');

after('deploy:publish', 'deploy:cleanup');
