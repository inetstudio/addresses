<?php

namespace InetStudio\AddressesPackage\Points\Console\Commands;

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
        $ahunterService = app()->make('InetStudio\AddressesPackage\Points\Contracts\Services\Back\AHunterServiceContract');

        $addresses = $pointsService->getModel()->where(
                [
                    ['quality', '=', 0],
                ]
            )->get();

        $bar = $this->output->createProgressBar(count($addresses));

        foreach ($addresses as $address) {
            $ahunterResult = $ahunterService->recognizeAddress($address->user_address);

            $data = [];
            
            if (count($ahunterResult['addresses']) == 1 && $ahunterResult['addresses'][0]['quality']['precision'] == 100) {
                foreach ($ahunterResult['addresses'][0]['fields'] as $field) {
                    $fieldName = strtolower($field['level']);

                    if (isset($field['name'])) {
                        $value = $field['type'].'. '.$field['name'];
                        $data[$fieldName] = $value;
                    }
                }

                $data['hash'] = $ahunterResult['addresses'][0]['codes']['fias_house'] ?? '';
                $data['pretty_address'] = $ahunterResult['addresses'][0]['pretty'];
                $data['lon'] = $ahunterResult['addresses'][0]['geo_data']['mid']['lon'];
                $data['lat'] = $ahunterResult['addresses'][0]['geo_data']['mid']['lat'];
                $data['quality'] = $ahunterResult['addresses'][0]['quality']['precision'];
            }
            
            $data['raw_data'] = $ahunterResult;

            $pointsService->save($data, $address->id);

            $bar->advance();
        }

        $bar->finish();
    }
}
