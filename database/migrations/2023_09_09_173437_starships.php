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
        Schema::create('starships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->string('starship_class');
            $table->string('manufacturer');
            $table->string('cost_in_credits');
            $table->string('length');
            $table->string('crew');
            $table->string('passengers');
            $table->string('max_atmosphering_speed');
            $table->string('hyperdrive_rating');
            $table->string('MGLT');
            $table->string('cargo_capacity');
            $table->string('consumables');
            $table->json('films');
            $table->json('pilots');
            $table->string('url');
            $table->integer('count')->default(1);
            $table->timestamps();
        });

        $api_url = 'https://swapi.dev/api/starships';

        do {
            $response = Http::get($api_url);
            $data = $response->json();

            $starships = $data['results'];

            foreach ($starships as $starship) {
                DB::table('starships')->insert([
                    'name' => $starship['name'],
                    'model' => $starship['model'],
                    'starship_class' => $starship['starship_class'],
                    'manufacturer' => $starship['manufacturer'],
                    'cost_in_credits' => $starship['cost_in_credits'],
                    'length' => $starship['length'],
                    'crew' => $starship['crew'],
                    'passengers' => $starship['passengers'],
                    'max_atmosphering_speed' => $starship['max_atmosphering_speed'],
                    'hyperdrive_rating' => $starship['hyperdrive_rating'],
                    'MGLT' => $starship['MGLT'],
                    'cargo_capacity' => $starship['cargo_capacity'],
                    'consumables' => $starship['consumables'],
                    'films' => json_encode($starship['films']),
                    'pilots' => json_encode($starship['pilots']), 
                    'url' => $starship['url'],
                    'created_at' => Carbon::parse($starship['created']),
                    'updated_at' => Carbon::parse($starship['edited']),
                    'count' => 0, 
                ]);
            }
            $api_url = $data['next'];

        } while ($api_url);
    }

    public function down(): void
    {
        Schema::dropIfExists('starships');
    }
};
