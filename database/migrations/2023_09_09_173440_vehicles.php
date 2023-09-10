<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->string('vehicle_class');
            $table->string('manufacturer');
            $table->string('length');
            $table->string('crew');
            $table->string('cost_in_credits');
            $table->string('passengers');
            $table->string('max_atmosphering_speed');
            $table->string('cargo_capacity');
            $table->string('consumables');
            $table->json('films');
            $table->json('pilots');
            $table->string('url');
            $table->integer('count')->default(1);
            $table->timestamps();
        });

        $api_url = 'https://swapi.dev/api/vehicles';

        do {
            $response = Http::get($api_url);
            $data = $response->json();

            $vehicles = $data['results'];

            foreach ($vehicles as $vehicle) {
                DB::table('vehicles')->insert([
                    'name' => $vehicle['name'],
                    'model' => $vehicle['model'],
                    'vehicle_class' => $vehicle['vehicle_class'],
                    'manufacturer' => $vehicle['manufacturer'],
                    'cost_in_credits' => $vehicle['cost_in_credits'],
                    'length' => $vehicle['length'],
                    'crew' => $vehicle['crew'],
                    'passengers' => $vehicle['passengers'],
                    'max_atmosphering_speed' => $vehicle['max_atmosphering_speed'],
                    'cargo_capacity' => $vehicle['cargo_capacity'],
                    'consumables' => $vehicle['consumables'],
                    'films' => json_encode($vehicle['films']),
                    'pilots' => json_encode($vehicle['pilots']), 
                    'url' => $vehicle['url'],
                    'created_at' => Carbon::parse($vehicle['created']),
                    'updated_at' => Carbon::parse($vehicle['edited'])
                ]);
            }
            $api_url = $data['next'];

        } while ($api_url);
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
