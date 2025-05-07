<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\County;
use App\Models\Region;
use Illuminate\Console\Command;
use League\Csv\Reader;

class ImportCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import cities from orase.csv file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Announce the start of the import process
        $this->info('Starting import process...');

        try {
            // Read CSV file user League\Csv\Reader
            $csv = Reader::createFromPath(storage_path('orase.csv'), 'r');
            
            // Set the CSV to use the first row as headers
            $csv->setHeaderOffset(0);
            $csv->setDelimiter(',');

            // Create a collection of records
            $records = $csv->getRecords();

            foreach ($records as $record) {
                
                // Validate the record - skipped rows with missing fields
                if (!isset($record['X'], $record['Y'], $record['NUME'], $record['JUDET'], $record['JUDET AUTO'], $record['POPULATIE (in 2002)'],$record['REGIUNE'])) {
                    $this->warn("Skipping invalid row: " . json_encode($record));
                    continue;
                }
                // Find or create region
                $region = Region::firstOrCreate([
                    'name' => trim($record['REGIUNE'])
                ]);

                // Find or create county
                $county = County::firstOrCreate([
                    'name' => trim($record['JUDET']),
                    'auto_code' => trim($record['JUDET AUTO']),
                    'region_id' => $region->id
                ]);

                // Create city
                City::create([
                    'name' => trim($record['NUME']),
                    'county_id' => $county->id,
                    'latitude' => $record['X'],
                    'longitude' => $record['Y'],
                    'population_2002' => (int)$record['POPULATIE (in 2002)']
                ]);
            }

            // Announce the completion of the import process
            $this->info('Import completed successfully!');

        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
