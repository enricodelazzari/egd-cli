<?php

namespace App\Commands;

use App\Support\Http\GetUsers;
use Illuminate\Support\Facades\Http;
use LaravelZero\Framework\Commands\Command;
use function Termwind\{render};

class ShowEgdUserCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'user:index
        {--country=? : The country of the user (optional)}
        {--lastname=? : The last name of the user (optional)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Show users information';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $players = app(GetUsers::class)(
            country: $this->option('country'),
            lastname: $this->option('lastname')
        );

        $view = view(
            'users.index',
            $players
        );

        $this->table(
            array_keys($players[0]),
            $players
        );

        // render((string) $view);
    }
}
