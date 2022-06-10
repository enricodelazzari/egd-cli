<?php

namespace App\Support\Http;

use App\Support\Html\TableToArray;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Collection;

class GetUsers extends Http
{
    public const METHOD = 'POST';

    public function __invoke(
        ?string $lastname = null,
        ?string $country = null,
    ): array {
        
        $body = $this->send([
            'form_params' => [
                'ricerca' => true,

                // orderBy: orderBy=Last_Name
                // viewStart: viewStart=0
                // orderDir: 
                // ricerca: 1
                // last_name: 
                // name: 
                // pin_player: 
                // country_code: *
                // club: *
                // filter: 0

            ],
        ])->body();

        $doc = new DOMDocument();
        @$doc->loadHTML((string) $body);
        $xpath = new DOMXPath($doc);


        $table = $xpath->query('//th[@class="EGD_tabella_player"]//parent::table')[0];

        dd(
            app(TableToArray::class)($table)
        );

        $heading = [];
        $data = [];

        foreach ($rows as $row) {

            if (property_exists($row, 'tagName') && $row->tagName === 'th') {
                $heading[] = $row;
            }

            if (property_exists($row, 'tagName') && $row->tagName === 'tr') {
               $data[] = $row; 
            }
        }


        dd($data);

        $heading = [];
        

        foreach ($nodes as $key => $node) {
            if ($node->tagName === 'th') {
               $heading[] = $node->textContent; 
            }
        }

        dd();

        // //th[@class="EGD_tabella_player"]
        // [0]->textContent
    }

    protected function route(): string
    {
        return 'Find_Player.php';
    }
}
