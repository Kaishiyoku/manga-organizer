@setup
    require __DIR__.'/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

    try {
        $dotenv->load();
        $dotenv->required(['DEPLOY_SERVER', 'DEPLOY_REPOSITORY', 'DEPLOY_PATH'])->notEmpty();
    } catch (Exception $e)  {
        echo $e->getMessage();
        exit;
    }

    $server = $_ENV['DEPLOY_SERVER'] ?? null;
    $repo = $_ENV['DEPLOY_REPOSITORY'] ?? null;
    $path = $_ENV['DEPLOY_PATH'] ?? null;
    $healthUrl = $_ENV['DEPLOY_HEALTH_CHECK'] ?? null;

    if (substr($path, 0, 1) !== '/') {
        throw new Exception('Careful - your deployment path does not begin with /');
    }

    $date = (new DateTime('now', new DateTimeZone('Europe/Berlin')))->format('YmdHis');
    $env = isset($env) ? $env : 'production';

    $branch = isset($branch) ? $branch : 'master';
    $path = rtrim($path, '/');
    $release = $path . '/releases/' . $date;
@endsetup

@servers(['web' => $server])

@task('init')
    if [ ! -d {{ $path }}/storage ]; then
        cd {{ $path }}
        git clone {{ $repo }} --branch={{ $branch }} --depth=1 -q {{ $release }}
        echo "Repository cloned"
        mv {{ $release }}/storage {{ $path }}/storage
        ln -s {{ $path }}/storage {{ $release }}/storage
        echo "Storage directory set up"
        cp {{ $release }}/.env.example {{ $path }}/.env
        ln -s {{ $path }}/.env {{ $release }}/.env
        echo "Environment file set up"
        rm -rf {{ $release }}
        echo "Deployment path initialised. Edit {{ $path }}/.env then run 'envoy run deploy'."
    else
        echo "Deployment path already initialised (storage directory exists)!"
    fi
@endtask

@story('deploy')
    deployment_start
    change_storage_owner_to_deployment_user
    deployment_links
    deployment_composer
    deployment_migrate
    deployment_cache
    deployment_npm
    deployment_finish
    change_storage_owner_to_www_data
    health_check
    deployment_option_cleanup
@endstory

@story('rollback')
    deployment_rollback
    health_check
@endstory

@story('list_releases')
    list_releases
@endstory

@task('deployment_start')
    cd {{ $path }}
    echo "Deployment ({{ $date }}) started"
    git clone {{ $repo }} --branch={{ $branch }} --depth=1 -q {{ $release }}
    echo "Repository cloned"
@endtask

@task('change_storage_owner_to_deployment_user')
    sudo chown -R forge:forge {{ $path }}/storage/*

    echo "Changed storage owner to deployment user"
@endtask

@task('deployment_links')
    cd {{ $path }}
    rm -rf {{ $release }}/storage
    ln -s {{ $path }}/storage {{ $release }}/storage
    echo "Storage directories set up"
    ln -s {{ $path }}/.env {{ $release }}/.env
    echo "Environment file set up"
@endtask

@task('deployment_composer')
    echo "Installing composer dependencies..."
    cd {{ $release }}
    composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader
@endtask

@task('deployment_migrate')
    php {{ $release }}/artisan migrate --env={{ $env }} --force --no-interaction
@endtask

@task('deployment_npm')
    echo "Installing npm dependencies..."
    cd {{ $release }}
    npm install --no-audit --no-fund --no-optional
    echo "Running npm..."
    npm run {{ $env }} --silent
@endtask

@task('deployment_cache')
    php {{ $release }}/artisan view:clear --quiet
    php {{ $release }}/artisan cache:clear --quiet
    php {{ $release }}/artisan config:cache --quiet
    php {{ $release }}/artisan route:cache --quiet
    php {{ $release }}/artisan view:cache --quiet
    echo "Cache cleared"

    sudo chown -R www-data:www-data {{ $release }}/storage/*
@endtask

@task('deployment_finish')
    php {{ $release }}/artisan storage:link
    echo "Storage symbolic links created"
    ln -nfs {{ $release }} {{ $path }}/current
    echo "Deployment ({{ $date }}) finished"
@endtask

@task('change_storage_owner_to_www_data')
    sudo chown -R www-data:www-data {{ $path }}/storage/*

    echo "Changed storage owner to www-data"
@endtask

@task('deployment_cleanup')
    cd {{ $path }}/releases
    find . -maxdepth 1 -name "20*" | sort | head -n -4 | xargs rm -Rf
    echo "Cleaned up old deployments"
@endtask

@task('deployment_option_cleanup')
    cd {{ $path }}/releases

    @if (isset($cleanup) && $cleanup)
        find . -maxdepth 1 -name "20*" | sort | head -n -4 | xargs rm -Rf
        echo "Cleaned up old deployments"
    @endif
@endtask


@task('health_check')
    @if (! empty($healthUrl))
        if [ "$(curl --write-out "%{http_code}\n" --silent --output /dev/null {{ $healthUrl }})" == "200" ]; then
            printf "\033[0;32mHealth check to {{ $healthUrl }} OK\033[0m\n"
        else
            printf "\033[1;31mHealth check to {{ $healthUrl }} FAILED\033[0m\n"
        fi
    @else
        echo "No health check set"
    @endif
@endtask


@task('deployment_rollback')
    cd {{ $path }}/releases

    @if($name)
        ln -nfs {{ $path }}/releases/{{ $name }} {{ $path }}/current
        echo "Rolled back to {{ $name }}"
    @else
        ln -nfs {{ $path }}/releases/$(find . -maxdepth 1 -name "20*" | sort  | tail -n 2 | head -n1) {{ $path }}/current
        echo "Rolled back to $(find . -maxdepth 1 -name "20*" | sort  | tail -n 2 | head -n1)"
    @endif
@endtask

@task('list_releases')
    cd {{ $path }}/releases
    echo "Releases:"
    ls -d -t */ | cut -f1 -d'/'
@endtask

{{--
@finished
	@slack($slack, '#deployments', "Deployment on {$server}: {$date} complete")
@endfinished
--}}

