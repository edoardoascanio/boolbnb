<?php

use App\Accomodation;

use Illuminate\Database\Seeder;


class AccomodationSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run() {
      $accomodations = [
         [
            'title' => 'L\'intero alloggio (casa)',
            'description' => 'Situato a due passi del centro storico di Roma e dalla Stazione Trastevere questo delizioso loft gode di una location privilegiata che permette di esplorare la città a piedi.',
            'number_rooms' => 4,
            'number_bathrooms' => 2,
            'number_beds' => 2,
            'square_mts' => 130,
            'price_per_night' => 30,
            'visibility' => true,
            'country' => 'Italy',
            'city' => 'Roma',
            'province' => 'Roma',
            'type_street' => 'Via',
            'street_name' => 'in arcione',
            'building_number' => 2,
            'zip' => '00100',
            'lat' => -10.01,
            'lon' => 0,
            'placeholder' => 'ciao',
            'user_id' => 1,
            'check_in' => 12,
            'check_out' => 10
         ],
         [
            'title' => 'Artists House - CENTRUM - Campo de fiori',
            'description' => "Appartamento situato in un palazzo medioevale del 1200. E' stato completamenete ristrutturato, con rifiniture di lusso: wifi, computer, Tv Grande schermo HD, impianto stereo centralizzato, cassaforte a muro.",
            'number_rooms' => 5,
            'number_bathrooms' => 3,
            'number_beds' => 3,
            'square_mts' => 120,
            'price_per_night' => 40,
            'visibility' => true,
            'country' => 'Italy',
            'city' => 'Roma',
            'province' => 'Roma',
            'type_street' => 'Via',
            'street_name' => 'in arcione',
            'building_number' => 2,
            'zip' => '00100',
            'lat' => 40.987,
            'lon' => 0,
            'placeholder' => 'ciao',
            'user_id' => 2,
            'check_in' => 12,
            'check_out' => 10
         ],
         [
            'title' => 'Domus Chiavari House',
            'description' =>   "Situata nell'incantevole quartiere di Campo de Fiori, in uno dei più caratteristici vicoli di Roma, a pochi metri dal Pantheon, Piazza Navona e Piazza Venezia, la Domus Campo de' Fiori offre un grazioso appartamento, finemente decorato e posto al piano terra di un delizioso cortile condominiale. La struttura dispone di angolo cottura attrezzato, macchina da caffè, soggiorno con divano e area dining e bagno con doccia set di cortesia.",
            'number_rooms' => 5,
            'number_bathrooms' => 3,
            'number_beds' => 3,
            'square_mts' => 120,
            'price_per_night' => 40,
            'visibility' => true,
            'country' => 'Italy',
            'city' => 'Roma',
            'province' => 'Roma',
            'type_street' => 'Via',
            'street_name' => 'in arcione',
            'building_number' => 2,
            'zip' => '00100',
            'lat' => -40.543,
            'lon' => 0,
            'placeholder' => 'ciao',
            'user_id' => 3,
            'check_in' => 13,
            'check_out' => 10
         ],
         [
            'title' => 'Intero alloggio (loft)',
            'description' => "Loft a Trastevere, nel centro di Roma, completamente ristrutturato nel 2019. Finemente arredato, dotato di ogni comodità, lavatrice ed asciugatrice, aria condizionata, TV, Wifi Free, bagno con grande doccia, angolo cottura, frigo, forno a microonde, bollitore elettrico, macchina con capsule Nescafè. Caratteristico e funzionale, con entrata indipendente e check_in automatico, ti sentirai libero di godere della vera atmosfera romana, in un quartiere tipico della vecchia Roma! La posizione è eccezionale: vicino ai mezzi pubblici, stazione taxi, market, negozi per lo shopping e i monumenti più famosi sono raggiungibili camminando a piedi. Trastevere è il vero cuore di Roma, qui potrai deliziarti con menù tipici nelle molte osterie, ristoranti , pizzerie, gelaterie; potrai rilassarti al tramonto bevendo un calice di vino o un bicchiere di birra nei vari pub o wine bar della zona, potrai vivere una vacanza indimenticabile non solo all'insegna della cultura e della bellezza, ma anche del divertimento!",
            'number_rooms' => 2,
            'number_bathrooms' => 1,
            'number_beds' => 4,
            'square_mts' => 90,
            'price_per_night' => 70,
            'visibility' => true,
            'country' => 'Italy',
            'city' => 'Roma',
            'province' => 'Roma',
            'type_street' => 'Vicolo',
            'street_name' => 'della torre',
            'building_number' => 2,
            'zip' => '00100',
            'lat' => 40.8765,
            'lon' => 0,
            'placeholder' => 'ciao',
            'user_id' => 4,
            'check_in' => 14,
            'check_out' => 11
         ],
         [
            'title' => 'Graziosa mansarda con vista sul Pantheon',
            'description' => "Pittoresca mansarda con travi a vista e magnifico affaccio sulla piazza del Pantheon, nel cuore di Roma, composta da camera con letto matrimoniale, smart tv e aria condizionata; seconda stanza con cucina e divano letto per 1 adulto o 2 bambini (larghezza 140 cm.); bagno con doccia. Materasso e cuscini confortevoli. L'appartamento è dotato di WI-FI, lavatrice, stendibiancheria, ferro e asse da stiro, frigo con piccolo freezer, forno a micronde e tutto il necessario per cucinare.",
            'number_rooms' => 1,
            'number_bathrooms' => 1,
            'number_beds' => 1,
            'square_mts' => 70,
            'price_per_night' => 150,
            'visibility' => true,
            'country' => 'Italy',
            'city' => 'Roma',
            'province' => 'Roma',
            'type_street' => 'Piazza',
            'street_name' => 'capranica',
            'building_number' => 2,
            'zip' => '00100',
            'lat' => -440.9876,
            'lon' => 0,
            'placeholder' => 'ciao',
            'user_id' => 5,
            'check_in' => 15,
            'check_out' => 11
         ],
         [
            'title' => "Colosseo's door",
            'description' => "Colosseum at your door step! Located in one of the oldest streets in Rome called Via Labicana, this apartment is perfect for a couple, or friends alike looking for a place to stay for that perfect get away. A bus stop located 50m away and a total of 100m walk to the metro stations. Lo spazio. The apartment has a fully equipped kitchen and a small table to enjoy your coffee. Has a full bathroom, and a king size bed located on the mezzanine to maximize the cozy space of this apartment",
            'number_rooms' => 2,
            'number_bathrooms' => 1,
            'number_beds' => 2,
            'square_mts' => 100,
            'price_per_night' => 135,
            'visibility' => true,
            'country' => 'Italy',
            'city' => 'Roma',
            'province' => 'Roma',
            'type_street' => 'Via',
            'street_name' => 'ludovico muratori',
            'building_number' => 2,
            'zip' => '00100',
            'lat' => 1276.4567,
            'lon' => 0,
            'placeholder' => 'ciao',
            'user_id' => 2,
            'check_in' => 12,
            'check_out' => 10
         ],
         [
            'title' => "Loft Garden San Lorenzo",
            'description' => "Loft Garden San Lorenzo è una deliziosa villetta con un piccolo cortile al centro di Roma, ubicata in una posizione strategica nel mezzo tra Stazione Termini e Stazione Tiburtina, nel quartiere di San Lorenzo. La zona è tra le più apprezzabili della città col suo essere tipicamente bohemien grazie ai moltissimi locali e ristoranti che la animano. Centrale e collegatissima, la peculiartità della villetta è il silenzio e la tranquillità che garantisce. Un' oasi di pace nel cuore della città.",
            'number_rooms' => 2,
            'number_bathrooms' => 1,
            'number_beds' => 3,
            'square_mts' => 90,
            'price_per_night' => 115,
            'visibility' => true,
            'country' => 'Italy',
            'city' => 'Roma',
            'province' => 'Roma',
            'type_street' => 'Via',
            'street_name' => 'dei sabelli',
            'building_number' => 2,
            'zip' => '00100',
            'lat' => 1276.4567,
            'lon' => 0,
            'placeholder' => 'ciao',
            'user_id' => 4,
            'check_in' => 12,
            'check_out' => 10
         ]
      ];

      foreach ($accomodations as $accomodation) {
         $new_accomodation = new Accomodation();

         $new_accomodation->fill($accomodation);

         $new_accomodation->save();
      }
   }
}
