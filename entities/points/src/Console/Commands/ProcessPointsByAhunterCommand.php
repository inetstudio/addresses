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

        $points = $pointsService->getModel()->where('hash', '=', '')->get();

        $bar = $this->output->createProgressBar(count($points));

        foreach ($points as $point) {
            $ahunterResult = $point->raw_data ?? $ahunterService->recognizeAddress($point->user_address);

            $data = [];

            foreach ($ahunterResult['addresses'] as $address) {
                if ($address['quality']['precision'] > 80) {
                    foreach ($address['fields'] as $field) {
                        $fieldName = strtolower($field['level']);

                        if (isset($field['name'])) {
                            $value = $field['type'].'. '.$field['name'];
                            $data[$fieldName] = $value;
                        }
                    }

                    $data['hash'] = $address['codes']['fias_house'] ?? md5($address['pretty']);
                    $data['pretty_address'] = $address['pretty'];
                    $data['lon'] = $address['geo_data']['mid']['lon'];
                    $data['lat'] = $address['geo_data']['mid']['lat'];
                    $data['quality'] = $address['quality']['precision'];

                    break;
                }
            }

            $data['raw_data'] = $ahunterResult;

            $pointsService->save($data, $point->id);

            $bar->advance();
        }

        $bar->finish();
    }

    protected function processAhunterResult()
    {
    }
}
