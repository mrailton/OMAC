<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/php-fpm.php';

set('application', 'omac');
set('repository', 'git@github.com:mrailton/omac.git');
set('php_fpm_version', '8.2');

host(getenv('HOST'))
    ->set('remote_user', getenv('USER'))
    ->set('deploy_path', '~/www');

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:migrate',
    'deploy:publish',
    'artisan:queue:restart',
]);

after('deploy:failed', 'deploy:unlock');
