<?php

namespace App\Support\Http;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class GetUser extends Http
{
    public const METHOD = 'GET';

    public function __invoke(
        ?string $lastname = null,
    ): array {
        
        $players = $this
            ->send([
                'query' => [
                    'lastname' => $lastname,
                ],
            ])
            ->collect()
            ->tap(fn (Collection $players) => abort_if(
                $players->get('retcode') === 'not found',
                404,
                'User not found'
            ))
            ->get('players');

        return Arr::first($players);
    }

    protected function route(): string
    {
        return 'GetPlayerDataByData.php';
    }
}
