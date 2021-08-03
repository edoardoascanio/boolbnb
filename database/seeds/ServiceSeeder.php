<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $services = [
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'wi-fi',
                'icon' => "<i class='fas fa-wifi'></i>"
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'garage',
                'icon' => "<i class='fas fa-parking'></i>",
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'tv',
                'icon' => "<i class='fas fa-tv'></i>"
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'piscina',
                'icon' => "<i class='fas fa-swimming-pool'></i>",
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'giardino',
                'icon' => "<i class='fas fa-tree'></i>"
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'allarme antincendio',
                'icon' => "<i class='fas fa-fire-alt'></i>"
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'casseta prontosoccorso',
                'icon' => "<i class='fas fa-briefcase-medical'></i>"
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'aria condizionata',
                'icon' => "<i class='fas fa-snowflake'></i>",
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'riscaldamento',
                'icon' => "<i class='fas fa-thermometer-empty'></i>"
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'sala studio',
                'icon' => "<i class='fas fa-book-reader'></i>"
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'idromassaggio',
                'icon' => "<i class='fas fa-hot-tub'></i>"
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'cassaforte',
                'icon' => "<i class='fas fa-door-closed'></i>"
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'animali ammessi',
                'icon' => "<i class='fas fa-dog'></i>"
            ],
            [
                'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
                'title' => 'self checkin',
                'icon' => "<i class='fas fa-key'></i>"
            ]
        ];

        foreach ($services as $service) {
            $new_servicesaccomodations = new Service();

            $new_servicesaccomodations->fill($service);

            $new_servicesaccomodations->save();
        }
    }
}
