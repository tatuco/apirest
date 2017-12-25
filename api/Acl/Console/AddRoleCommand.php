<?php

namespace Api\Acl\Console;

use Api\Acl\Repositories\RoleRepository;
use Illuminate\Console\Command;

class AddRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:add {name} {slug} {description}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a new role';

    /**
     * User repository to persist user in database
     *
     * @var UserRepository
     */
    protected $repository;

    /**
     * Create a new command instance.
     *
     * @param  UserRepository  $userRepository
     * @return void
     */
    public function __construct(RoleRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $role = $this->repository->create([
            'name' => $this->argument('name'),
            'slug' => $this->argument('slug'),
            'description' => $this->argument('description')
        ]);

        $this->info(sprintf('A role was created with ID %s', $role->id));
    }
}