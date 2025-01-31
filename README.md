A complete rewrite of [MHWDB-API](https://github.com/LartTyler/MHWDB-API), with the primary goal of being extendable to
support any Monster Hunter game.

More information to come soon.

## Installation
This project ships with a `docker-compose.yaml` configuration that should be suitable for production environments. The
database password can be set by placing a text file containing the desired password at
`/docker/secrets/db_password.txt`.

The database can be initialized by running the composer script `db:migrate`, and the `deploy` script can be used to
update the repository from remote, install or update any necessary dependencies, and synchronize the database state with
any new migrations in a single command.

```shell
$ docker compose exec php composer db:migrate
$ docker compose exec php composer deploy
```

## Data Sources (Imports)
Data can be imported from a static source using the CLI command `app:import`.

```shell
$ docker compose exec php bin/console app:import --help
```

Because data sources can vary wildly from game to game, no importers are provided as part of this project. Instead, a
general framework is provided to streamline building per-game importers.

Each importer should be a Symfony service that either:
- Implements `App\Import\ImporterInterface`, or
- Is tagged with the `AsImporter` attribute.

Classes placed in `/src/Import/Importers` are configured to be registered as services automatically. Importers support
a `priority` tag argument, allowing you to control the order they run in; importers with a higher priority will be run
first. This can be useful if you have an importer that defines data that other importers rely on.

In order to manage PHP's memory limits, you should use the `BatchManager` instance provided in the `ImportContext`
object passed to each importer. Calling `BatchManager::increment()` will increase the internal object counter, and once
that counter passes the configured limit any pending database changes will be flushed and all entities detached from
Doctrine's object manager. Note that you may need to manually call `BatchManager::dispatch()` after loops and the like
to ensure that any changes that didn't quite pass the batch threshold are saved.

```php
<?php
    #[\App\Import\AsImporter(priority: 10)]
    class MyImporter {
        public function __construct(
            protected \Doctrine\ORM\EntityManagerInterface $entityManager
        ) {}
    
        public function __invoke(\App\Import\ImportContext $context) {
            $sourceData = loadDataFromSomeSource();
            
            foreach ($sourceData as $data) {
                // Initialize the new entity...
                $entity = new Entity();
                $this->entityManager->persist($entity);
                
                // Increment the batch counter so the manager knows we've added a new tracked object.
                // An argument can be passed to `increment()` to change how much the counter is increased by.
                $context->batch->increment();
            }
            
            // Manually trigger a dispatch to ensure that all our changes are saved. Without this, any changes made at
            // the end of the previous loop may not be saved.
            //
            // This is not necessary at the end of your importer, as `BatchManager::dispatch()` is automatically called
            // after each importer finishes running, but is included here as an example.
            $context->batch->dispatch();
        }
    }
```

If you're working with a CSV data source, you can use the `CsvReader` class to simplify loading the CSV and parsing
each row into an object.