<?php

namespace InetStudio\AddressesPackage\Points\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Class ProcessPointsByAhunterCommand.
 */
class ProcessPointsByAhunterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inetstudio:addresses-package:points:ahunter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process points by ahunter service';

    /**
     * Execute the console command.
     *
     * @throws BindingResolutionException
     */
    public function handle()
    {
        $pointsService = app()->make('InetStudio\AddressesPackage\Points\Contracts\Services\Back\ItemsServiceContract');

        $client = new Client();

        $addresses = $pointsService->getModel()->where(
                [
                    ['quality', '=', 0],
                ]
            )->get();

        $bar = $this->output->createProgressBar(count($addresses));

        foreach ($addresses as $address) {
            $url = config('services.ahunter.search_url').$address->user_address;

            $response = $client->post($url);
            $addressAH = json_decode($response->getBody()->getContents(), true);

            if (count($addressAH['addresses']) == 1 && $addressAH['addresses'][0]['quality']['precision'] == 100) {
                $data = [];

                foreach ($addressAH['addresses'][0]['fields'] as $field) {
                    $fieldName = strtolower($field['level']);

                    if (isset($field['name'])) {
                        $value = $field['type'].'. '.$field['name'];
                        $data[$fieldName] = $value;
                    }
                }

                $data['pretty_address'] = $addressAH['addresses'][0]['pretty'];
                $data['lon'] = $addressAH['addresses'][0]['geo_data']['mid']['lon'];
                $data['lat'] = $addressAH['addresses'][0]['geo_data']['mid']['lat'];
                $data['quality'] = $addressAH['addresses'][0]['quality']['precision'];

                $pointsService->save($data, $address->id);
            }

            $bar->advance();
        }

        $bar->finish();
    }
}
