<?php

namespace Database\Seeders;

use App\Models\Documentos_Viajes;
use App\Models\Fotos_Viajes;
use App\Models\Inscripcion_Viajes;
use App\Models\Pagos_Viajes;
use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Viaje;

class DummyDataViajesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = Cliente::factory()->count(50)->create();
        $empleados = Empleado::factory()->count(50)->create();
        $viajes = Viaje::factory()->count(50)->create();
        foreach ($viajes as $viaje) {
            foreach ($clientes->random(10) as $cliente) {
                Inscripcion_Viajes::factory()->create([
                    'viaje_id' => $viaje->id,
                    'cliente_id' => $cliente->id,
                ]);
            }
        }
        $inscripciones = Inscripcion_Viajes::all();
        foreach ($inscripciones->random(50) as $inscripcion) {
            Pagos_Viajes::factory()->create([
                'inscripcion_viaje_id' => $inscripcion->id,
            ]);
        }
        foreach ($viajes as $viaje) {
            Documentos_Viajes::factory()->create([
                'viaje_id' => $viaje->id,
            ]);
        }
        foreach ($viajes as $viaje) {
            Fotos_Viajes::factory()->create([
                'viaje_id' => $viaje->id,
            ]);
        }
    }
}
