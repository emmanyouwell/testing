<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = new Item([
            'image_path' => 'https://media.istockphoto.com/id/1135733200/es/foto/cartas-de-harry-potter-hogwarts-en-una-ventana-de-venta-minorista-de-la-tienda-minalima-en.jpg?s=2048x2048&w=is&k=20&c=4Trjp4u1H1LPMNTLbkMK4DSxdQPzOXRDhqEzOYLX9dA=',
            'title' => 'Harry Potter',
            'description' => 'Lorem ipsum dolor sit ',
            'cost_price' => 10,
            'sell_price' => 15
        ]);
        $item->save();

        $item = new Item([
            'image_path' => 'https://media.istockphoto.com/id/458600123/es/foto/harry-potter-minifigures.jpg?s=2048x2048&w=is&k=20&c=t7ZlP4RGwJbikJRzSkqeFb8n13a5kCurKYSxCkdNBj0=',
            'title' => 'Harry Potter',
            'description' => 'Lorem ipsum dolor sit  ',
            'cost_price' => 10,
            'sell_price' => 15
        ]);
        $item->save();

        $item = new Item([
            'image_path' => 'https://media.istockphoto.com/id/458538517/es/foto/harry-potter-minifigure.jpg?s=2048x2048&w=is&k=20&c=CUPlbLq6tQOT2YuyD3R3BOyquCjay0oL5t9GfwLfbdo=',
            'title' => 'Harry Potter',
            'description' => 'Lorem ipsum dolor sit a  ',
            'cost_price' => 10,
            'sell_price' => 15
        ]);
        $item->save();

        $item = new Item([
            'image_path' => 'https://media.istockphoto.com/id/458526315/es/foto/francia-harry-potter-sello-postal.jpg?s=2048x2048&w=is&k=20&c=IhFXZdvJrPAFhW2OCQwuCkFSsN28EoB6VY8HsAvXbng=',
            'title' => 'Harry Potter',
            'description' => 'Lorem ipsum dolor sit   ',
            'cost_price' => 10,
            'sell_price' => 15
        ]);
        $item->save();

        $item = new Item([
            'image_path' => 'https://media.istockphoto.com/id/458625763/es/foto/sombrero-de-clasificaci%C3%B3n-en-harry-potter-juego-de-mesa.jpg?s=2048x2048&w=is&k=20&c=3jJV83ZSnFoaycqamvs9VI87iDSAPu7zF_1PjiFUFDY=',
            'title' => 'Harry Potter',
            'description' => 'Lorem ipsum  ',
            'cost_price' => 10,
            'sell_price' => 15
        ]);
        $item->save();
    }

}