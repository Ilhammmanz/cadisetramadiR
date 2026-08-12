<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    protected $model = Produk::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hargaBeli = fake()->numberBetween(10000, 500000);

        return [
            'user_id' => User::where('role_id', 1)->inRandomOrder()->value('id') ?? User::first()->id,
            'foto' => 'produk/' . fake()->uuid() . '.jpg',

            // WAJIB ADA
            'jenis' => fake()->randomElement([
                'Makanan',
                'Minuman',
                'Snack',
                'Elektronik',
                'ATK',
            ]),

            'nama' => fake()->words(3, true),
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaBeli + fake()->numberBetween(5000, 100000),
            'stok' => fake()->numberBetween(1, 500),
        ];
    }
}
