<?php

namespace App\Commands;

use App\Support\Http\GetUser;
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
    protected $signature = 'user:show {lastname? : The last name of the user (optional)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Show user information';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $player = app(GetUser::class)(
            lastname: $this->argument('lastname')
        );

        $view = view(
            'users.show',
            $player
        );

        render((string) $view);
    }
}
