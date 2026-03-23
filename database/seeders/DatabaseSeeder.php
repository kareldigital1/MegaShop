<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValue;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un utilisateur administrateur
        User::factory()->create([
            'email' => 'admin@megashop.com',
            'password' => Hash::make('password'),
            'name' => 'Admin',
            'role' => 'admin',
        ]);

        // Créer des catégories
        $electronique = Category::create([
            'name' => 'Électronique',
            'slug' => 'electronique',
            'description' => 'Produits électroniques et gadgets',
            'is_active' => true,
            'image' => 'assets/categories/electronique.jpeg'
        ]);

        $vetements = Category::create([
            'name' => 'Vêtements',
            'slug' => 'vetements',
            'description' => 'Vêtements et accessoires de mode',
            'is_active' => true,
            'image' => 'assets/categories/vetement.jpeg'
        ]);

        $maison = Category::create([
            'name' => 'Maison',
            'slug' => 'maison',
            'description' => 'Articles pour la maison et décoration',
            'is_active' => true,
            'image' => 'assets/categories/maison.jpeg'
        ]);

        // Créer des attributs
        $couleur = Attribute::create(['name' => 'Couleur']);
        $taille = Attribute::create(['name' => 'Taille']);

        // Créer des valeurs d'attributs
        AttributeValue::create(['attribute_id' => $couleur->id, 'value' => 'Rouge']);
        AttributeValue::create(['attribute_id' => $couleur->id, 'value' => 'Bleu']);
        AttributeValue::create(['attribute_id' => $taille->id, 'value' => 'S']);
        AttributeValue::create(['attribute_id' => $taille->id, 'value' => 'M']);

        // Créer des produits avec image dans le champ 'image'
        Product::create([
            'name' => 'Smartphone XL Pro',
            'slug' => 'smartphone-xl-pro',
            'image' => 'assets/products/pro-xl.jpg',
            'short_description' => 'Smartphone très avancé',
            'description' => 'Un smartphone puissant avec grand écran haute résolution.',
            'price' => 500000,
            'cost_price' => 400000,
            'sku' => 'SP-XL-PRO',
            'stock' => 50,
            'is_featured' => true,
            'is_new' => true,
            'is_sale' => true,
            'category_id' => $electronique->id,
        ]);

        Product::create([
            'name' => 'T-Shirt Premium',
            'slug' => 't-shirt-premium',
            'image' => 'assets/products/t-shirt.jpg',
            'short_description' => 'Confort et style',
            'description' => 'T-shirt en coton de qualité supérieure.',
            'price' => 10000,
            'cost_price' => 6000,
            'sku' => 'TS-PREM',
            'stock' => 100,
            'is_featured' => false,
            'is_new' => true,
            'is_sale' => false,
            'category_id' => $vetements->id,
        ]);

        Product::create([
            'name' => 'Lampe Design',
            'slug' => 'lampe-design',
            'image' => 'assets/products/lampe-design.jpg',
            'short_description' => 'Lampe moderne et élégante',
            'description' => 'Lampe décorative pour maison et bureau.',
            'price' => 25000,
            'cost_price' => 15000,
            'sku' => 'LAM-DES',
            'stock' => 30,
            'is_featured' => true,
            'is_new' => false,
            'is_sale' => false,
            'category_id' => $maison->id,
        ]);
    }
}