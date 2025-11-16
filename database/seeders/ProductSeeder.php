<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [

            // ==========================================================
            // 1. BAHAN BESI (10 DATA)
            // ==========================================================
            [
                'name' => 'Besi Beton Polos 6mm',
                'category' => 'Bahan Besi',
                'stock' => 100,
                'price' => 29000,
                'image' => 'images/products/besi-6.jpg'
            ],
            [
                'name' => 'Besi Beton Polos 8mm',
                'category' => 'Bahan Besi',
                'stock' => 100,
                'price' => 45000,
                'image' => 'images/products/besi-8.jpg'
            ],
            [
                'name' => 'Besi Beton Polos 10mm',
                'category' => 'Bahan Besi',
                'stock' => 100,
                'price' => 72000,
                'image' => 'images/products/besi-10.jpg'
            ],
            [
                'name' => 'Besi Beton Ulir 10mm',
                'category' => 'Bahan Besi',
                'stock' => 100,
                'price' => 76000,
                'image' => 'images/products/besi-ulir10.jpg'
            ],
            [
                'name' => 'Begel 8x8',
                'category' => 'Bahan Besi',
                'stock' => 100,
                'price' => 18000,
                'image' => 'images/products/begel-8x8.jpg'
            ],
            [
                'name' => 'Begel 10x10',
                'category' => 'Bahan Besi',
                'stock' => 100,
                'price' => 18000,
                'image' => 'images/products/begel-10x10.jpg'
            ],
            [
                'name' => 'Kawat Bendrat',
                'category' => 'Bahan Besi',
                'stock' => 100,
                'price' => 27000,
                'image' => 'images/products/kawat-bendrat.jpg'
            ],
            [
                'name' => 'Paku 1.5 Bambu',
                'category' => 'Bahan Besi',
                'stock' => 100,
                'price' => 18000,
                'image' => 'images/products/paku15.jpg'
            ],
            [
                'name' => 'Paku 2 Bengkirai',
                'category' => 'Bahan Besi',
                'stock' => 100,
                'price' => 26000,
                'image' => 'images/products/paku2.jpg'
            ],
            [
                'name' => 'Paku 3 Plafon',
                'category' => 'Bahan Besi',
                'stock' => 100,
                'price' => 15000,
                'image' => 'images/products/paku3.jpg'
            ],

            // ==========================================================
            // 2. BAHAN PASANGAN (10 DATA)
            // ==========================================================
            [
                'name' => 'Pasir Beton Rit Engkel',
                'category' => 'Bahan Pasangan',
                'stock' => 100,
                'price' => 294000,
                'image' => 'images/products/pasir-beton.jpg'
            ],
            [
                'name' => 'Semen Tiga Roda 40kg',
                'category' => 'Bahan Pasangan',
                'stock' => 100,
                'price' => 42000,
                'image' => 'images/products/semen.jpg'
            ],
            [
                'name' => 'Semen Gresik 40kg',
                'category' => 'Bahan Pasangan',
                'stock' => 100,
                'price' => 43000,
                'image' => 'images/products/semen-gresik.jpg'
            ],
            [
                'name' => 'Mortar MU 40kg',
                'category' => 'Bahan Pasangan',
                'stock' => 100,
                'price' => 92000,
                'image' => 'images/products/mortar-mu.jpg'
            ],
            [
                'name' => 'Mortar GE 40kg',
                'category' => 'Bahan Pasangan',
                'stock' => 100,
                'price' => 95000,
                'image' => 'images/products/mortar-ge.jpg'
            ],
            [
                'name' => 'Koral Rit Colt',
                'category' => 'Bahan Pasangan',
                'stock' => 100,
                'price' => 300000,
                'image' => 'images/products/koral.jpg'
            ],
            [
                'name' => 'Split Beton Rit Truck',
                'category' => 'Bahan Pasangan',
                'stock' => 100,
                'price' => 1200000,
                'image' => 'images/products/split.jpg'
            ],
            [
                'name' => 'Tanah Urug Rit Colt',
                'category' => 'Bahan Pasangan',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/tanah.jpg'
            ],
            [
                'name' => 'Pasir Sirtu',
                'category' => 'Bahan Pasangan',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/sirtu.jpg'
            ],
            [
                'name' => 'Pasir Beton per m3',
                'category' => 'Bahan Pasangan',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/pasir.jpg'
            ],

            // ==========================================================
            // 3. BAHAN DINDING (10 DATA)
            // ==========================================================
            [
                'name' => 'Batako',
                'category' => 'Bahan Dinding',
                'stock' => 100,
                'price' => 4000,
                'image' => 'images/products/batako.jpg'
            ],
            [
                'name' => 'Batu Bata Merah',
                'category' => 'Bahan Dinding',
                'stock' => 100,
                'price' => 1000,
                'image' => 'images/products/bata-merah.jpg'
            ],
            [
                'name' => 'Glass Block Diamond',
                'category' => 'Bahan Dinding',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/glassblock.jpg'
            ],
            [
                'name' => 'Roster Nako',
                'category' => 'Bahan Dinding',
                'stock' => 100,
                'price' => 14000,
                'image' => 'images/products/roster1.jpg'
            ],
            [
                'name' => 'Roster Silang Kotak',
                'category' => 'Bahan Dinding',
                'stock' => 100,
                'price' => 10000,
                'image' => 'images/products/roster2.jpg'
            ],
            [
                'name' => 'Bata Ringan Kecil 7x20x40',
                'category' => 'Bahan Dinding',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/bata-ring7.jpg'
            ],
            [
                'name' => 'Bata Ringan Kecil 10x20x40',
                'category' => 'Bahan Dinding',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/bata-ring10.jpg'
            ],
            [
                'name' => 'Keramik 30x30 Arwana Putih',
                'category' => 'Bahan Dinding',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/keramik-arwana.jpg'
            ],
            [
                'name' => 'Keramik 30x30 Mulia Putih',
                'category' => 'Bahan Dinding',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/keramik-mulia.jpg'
            ],
            [
                'name' => 'List Keramik 20 cm',
                'category' => 'Bahan Dinding',
                'stock' => 100,
                'price' => 5000,
                'image' => 'images/products/list-keramik.jpg'
            ],

            // ==========================================================
            // 4. BAHAN LANTAI (10 DATA)
            // ==========================================================
            [
                'name' => 'Keramik 20x20 Motif 1',
                'category' => 'Bahan Lantai',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/keramik-20x20a.jpg'
            ],
            [
                'name' => 'Keramik 20x20 Motif 2',
                'category' => 'Bahan Lantai',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/keramik-20x20b.jpg'
            ],
            [
                'name' => 'Keramik 30x30 Motif 1',
                'category' => 'Bahan Lantai',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/keramik-30x30a.jpg'
            ],
            [
                'name' => 'Keramik 30x30 Motif 2',
                'category' => 'Bahan Lantai',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/keramik-30x30b.jpg'
            ],
            [
                'name' => 'Keramik 40x40 Motif 1',
                'category' => 'Bahan Lantai',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/keramik-40x40a.jpg'
            ],
            [
                'name' => 'Keramik 40x40 Motif 2',
                'category' => 'Bahan Lantai',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/keramik-40x40b.jpg'
            ],
            [
                'name' => 'Keramik Putih 30x30 ARWANA',
                'category' => 'Bahan Lantai',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/keramik-p30a.jpg'
            ],
            [
                'name' => 'Keramik Putih 30x30 MULIA',
                'category' => 'Bahan Lantai',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/keramik-p30b.jpg'
            ],
            [
                'name' => 'List 20 cm',
                'category' => 'Bahan Lantai',
                'stock' => 100,
                'price' => 5000,
                'image' => 'images/products/list20.jpg'
            ],
            [
                'name' => 'List 25 cm',
                'category' => 'Bahan Lantai',
                'stock' => 100,
                'price' => 7000,
                'image' => 'images/products/list25.jpg'
            ],

            // ==========================================================
            // 5. FONDASI (10 DATA)
            // ==========================================================
            [
                'name' => 'Batu Putih Rit Colt',
                'category' => 'Fondasi',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/batu-putih.jpg'
            ], 
            [
                'name' => 'Batu Kali Rit Colt',
                'category' => 'Fondasi',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/batu-kali.jpg'
            ],
            [
                'name' => 'Batu Kali per m3',
                'category' => 'Fondasi',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/batu-kali-m3.jpg'
            ],
            [
                'name' => 'Batu Putih per m3',
                'category' => 'Fondasi',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/batu-putih-m3.jpg'
            ],
            [
                'name' => 'Batu Kali Rit Truck',
                'category' => 'Fondasi',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/batu-truck.jpg'
            ],
            [
                'name' => 'Batu Putih Rit Truck',
                'category' => 'Fondasi',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/batu-putihtruck.jpg'
            ],
            [
                'name' => 'Split Pondasi',
                'category' => 'Fondasi',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/split-fondasi.jpg'
            ],
            [
                'name' => 'Koral Pondasi',
                'category' => 'Fondasi',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/koral-fondasi.jpg'
            ],
            [
                'name' => 'Pasir Pondasi',
                'category' => 'Fondasi',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/pasir-fondasi.jpg'
            ],
            [
                'name' => 'Material Pondasi Campuran',
                'category' => 'Fondasi',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/material-fondasi.jpg'
            ],

            // ==========================================================
            // 6. KAYU (10 DATA)
            // ==========================================================
            [
                'name' => 'Kayu Papan Bangkirai',
                'category' => 'Kayu',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/kayu-bangkirai.jpg'
            ],
            [
                'name' => 'Kayu Papan Meranti',
                'category' => 'Kayu',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/kayu-meranti.jpg'
            ],
            [
                'name' => 'Tripleks 3mm',
                'category' => 'Kayu',
                'stock' => 100,
                'price' => 59000,
                'image' => 'images/products/tripleks3.jpg'
            ],
            [
                'name' => 'Tripleks 4mm',
                'category' => 'Kayu',
                'stock' => 100,
                'price' => 71000,
                'image' => 'images/products/tripleks4.jpg'
            ],
            [
                'name' => 'Tripleks 6mm',
                'category' => 'Kayu',
                'stock' => 100,
                'price' => 87000,
                'image' => 'images/products/tripleks6.jpg'
            ],
            [
                'name' => 'Tripleks 9mm',
                'category' => 'Kayu',
                'stock' => 100,
                'price' => 138000,
                'image' => 'images/products/tripleks9.jpg'
            ],
            [
                'name' => 'Kayu Balok Sengon 4/6',
                'category' => 'Kayu',
                'stock' => 100,
                'price' => 20000,
                'image' => 'images/products/balok-sengon.jpg'
            ],
            [
                'name' => 'Kayu Balok Kalimantan 5/7',
                'category' => 'Kayu',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/balok-kalimantan.jpg'
            ],
            [
                'name' => 'Kayu Reng Kalimantan',
                'category' => 'Kayu',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/reng-kalimantan.jpg'
            ],
            [
                'name' => 'Papan Cor Tebal',
                'category' => 'Kayu',
                'stock' => 100,
                'price' => 12000,
                'image' => 'images/products/papan-cor.jpg'
            ],

            // ==========================================================
            // 7. PENUTUP LANGIT-LANGIT / PLAFON (10 DATA)
            // ==========================================================
            [
                'name' => 'GRC Plafon 3mm 100x100',
                'category' => 'Plafon',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/grc-3mm.jpg'
            ],
            [
                'name' => 'Asbes 2400x1200x3mm',
                'category' => 'Plafon',
                'stock' => 100,
                'price' => 57000,
                'image' => 'images/products/asbes-2400.jpg'
            ],
            [
                'name' => 'Asbes Gelombang 180cm',
                'category' => 'Plafon',
                'stock' => 100,
                'price' => 68000,
                'image' => 'images/products/asbes180.jpg'
            ],
            [
                'name' => 'Gypsum 9mm',
                'category' => 'Plafon',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/gypsum9.jpg'
            ],
            [
                'name' => 'Kalsiboard 3.5mm',
                'category' => 'Plafon',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/kalsiboard.jpg'
            ],
            [
                'name' => 'Timberplank 20x2.4',
                'category' => 'Plafon',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/timberplank.jpg'
            ],
            [
                'name' => 'Asbes Gelombang Besar 180cm',
                'category' => 'Plafon',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/asbes-big.jpg'
            ],
            [
                'name' => 'GRC 4mm',
                'category' => 'Plafon',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/grc4.jpg'
            ],
            [
                'name' => 'Kalsiplank JT 20x3',
                'category' => 'Plafon',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/kalsiplank.jpg'
            ],
            [
                'name' => 'Kalsiplank PL 20x3',
                'category' => 'Plafon',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/kalsiplank2.jpg'
            ],

            // ==========================================================
            // 8. PENUTUP ATAP (10 DATA)
            // ==========================================================
            [
                'name' => 'Genteng Plentong',
                'category' => 'Penutup Atap',
                'stock' => 100,
                'price' => 17000,
                'image' => 'images/products/genteng1.jpg'
            ],
            [
                'name' => 'Genteng Berjo',
                'category' => 'Penutup Atap',
                'stock' => 100,
                'price' => 61000,
                'image' => 'images/products/genteng2.jpg'
            ],
            [
                'name' => 'Galvalum 0.3 x 45cm',
                'category' => 'Penutup Atap',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/galvalum45.jpg'
            ],
            [
                'name' => 'Seng Datar 45cm',
                'category' => 'Penutup Atap',
                'stock' => 100,
                'price' => 18000,
                'image' => 'images/products/seng45.jpg'
            ],
            [
                'name' => 'Seng Datar 60cm',
                'category' => 'Penutup Atap',
                'stock' => 100,
                'price' => 25000,
                'image' => 'images/products/seng60.jpg'
            ],
            [
                'name' => 'Seng Gelombang 180cm',
                'category' => 'Penutup Atap',
                'stock' => 100,
                'price' => 67000,
                'image' => 'images/products/seng180.jpg'
            ],
            [
                'name' => 'Seng Gelombang 240cm',
                'category' => 'Penutup Atap',
                'stock' => 100,
                'price' => 75000,
                'image' => 'images/products/seng240.jpg'
            ],
            [
                'name' => 'Asbes Gelombang 1800x1050',
                'category' => 'Penutup Atap',
                'stock' => 100,
                'price' => 68000,
                'image' => 'images/products/asbes-small.jpg'
            ],
            [
                'name' => 'Karpet Talang 60cm',
                'category' => 'Penutup Atap',
                'stock' => 100,
                'price' => 12000,
                'image' => 'images/products/karpet60.jpg'
            ],
            [
                'name' => 'Karpet Talang 70cm',
                'category' => 'Penutup Atap',
                'stock' => 100,
                'price' => 14000,
                'image' => 'images/products/karpet70.jpg'
            ],

            // ==========================================================
            // 9. CAT (10 DATA)
            // ==========================================================
            [
                'name' => 'Minyak Cat 1 Liter',
                'category' => 'Cat',
                'stock' => 100,
                'price' => 17000,
                'image' => 'images/products/minyak-cat.jpg'
            ],
            [
                'name' => 'Tiner 1 Liter',
                'category' => 'Cat',
                'stock' => 100,
                'price' => 23000,
                'image' => 'images/products/tiner.jpg'
            ],
            [
                'name' => 'Spiritus 1 Liter',
                'category' => 'Cat',
                'stock' => 100,
                'price' => 10000,
                'image' => 'images/products/spiritus.jpg'
            ],
            [
                'name' => 'Plamir Kayu 1kg',
                'category' => 'Cat',
                'stock' => 100,
                'price' => 43000,
                'image' => 'images/products/plamir-kayu.jpg'
            ],
            [
                'name' => 'Plamir Dinding 1kg',
                'category' => 'Cat',
                'stock' => 100,
                'price' => 40000,
                'image' => 'images/products/plamir-dinding.jpg'
            ],
            [
                'name' => 'Cat Besi Merk A',
                'category' => 'Cat',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/catbesi.jpg'
            ],
            [
                'name' => 'Cat Besi Merk B',
                'category' => 'Cat',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/catbesi2.jpg'
            ],
            [
                'name' => 'Cat Tembok Galon Merk A',
                'category' => 'Cat',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/catwall1.jpg'
            ],
            [
                'name' => 'Cat Tembok Galon Merk B',
                'category' => 'Cat',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/catwall2.jpg'
            ],
            [
                'name' => 'Kuas Roll',
                'category' => 'Cat',
                'stock' => 100,
                'price' => 28000,
                'image' => 'images/products/kuas-roll.jpg'
            ],

            // ==========================================================
            // 10. LISTRIK (10 DATA)
            // ==========================================================
            [
                'name' => 'Lampu Philips 5W',
                'category' => 'Listrik',
                'stock' => 100,
                'price' => 20000,
                'image' => 'images/products/ph5.jpg'
            ],
            [
                'name' => 'Lampu Philips 12W',
                'category' => 'Listrik',
                'stock' => 100,
                'price' => 23000,
                'image' => 'images/products/ph12.jpg'
            ],
            [
                'name' => 'Lampu Philips 14W',
                'category' => 'Listrik',
                'stock' => 100,
                'price' => 28000,
                'image' => 'images/products/ph14.jpg'
            ],
            [
                'name' => 'Lampu Philips 18W',
                'category' => 'Listrik',
                'stock' => 100,
                'price' => 38000,
                'image' => 'images/products/ph18.jpg'
            ],
            [
                'name' => 'Kabel NYA 1.5m',
                'category' => 'Listrik',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/kabel-nya.jpg'
            ],
            [
                'name' => 'Kabel NYM 2x1.5 50m',
                'category' => 'Listrik',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/kabel-nym.jpg'
            ],
            [
                'name' => 'Saklar Broco Engkel',
                'category' => 'Listrik',
                'stock' => 100,
                'price' => 17000,
                'image' => 'images/products/saklar-engkel.jpg'
            ],
            [
                'name' => 'Saklar Broco Tempel',
                'category' => 'Listrik',
                'stock' => 100,
                'price' => 17000,
                'image' => 'images/products/saklar-tempel.jpg'
            ],
            [
                'name' => 'Stop Kontak Broco',
                'category' => 'Listrik',
                'stock' => 100,
                'price' => 15000,
                'image' => 'images/products/stopbroco.jpg'
            ],
            [
                'name' => 'MCB Broco',
                'category' => 'Listrik',
                'stock' => 100,
                'price' => 35000,
                'image' => 'images/products/mcb.jpg'
            ],

            // ==========================================================
            // 11. SANITASI (10 DATA)
            // ==========================================================
            [
                'name' => 'Kloset Duduk Cina',
                'category' => 'Sanitasi',
                'stock' => 100,
                'price' => 120000,
                'image' => 'images/products/kloset-duduk.jpg'
            ],
            [
                'name' => 'Kloset Jongkok Triliun',
                'category' => 'Sanitasi',
                'stock' => 100,
                'price' => 148000,
                'image' => 'images/products/kloset-jongkok.jpg'
            ],
            [
                'name' => 'Kloset Jongkok INA',
                'category' => 'Sanitasi',
                'stock' => 100,
                'price' => 165000,
                'image' => 'images/products/kloset-ina.jpg'
            ],
            [
                'name' => 'Kloset Jongkok American Standard',
                'category' => 'Sanitasi',
                'stock' => 100,
                'price' => 290000,
                'image' => 'images/products/kloset-as.jpg'
            ],
            [
                'name' => 'Bak Mandi Fiber',
                'category' => 'Sanitasi',
                'stock' => 100,
                'price' => 299000,
                'image' => 'images/products/bak-fiber.jpg'
            ],
            [
                'name' => 'Tandon Air 300 Liter',
                'category' => 'Sanitasi',
                'stock' => 100,
                'price' => 700000,
                'image' => 'images/products/tandon300.jpg'
            ],
            [
                'name' => 'Tandon Air 520 Liter',
                'category' => 'Sanitasi',
                'stock' => 100,
                'price' => 1000000,
                'image' => 'images/products/tandon520.jpg'
            ],
            [
                'name' => 'Pipa Rucika AW 0.5"',
                'category' => 'Sanitasi',
                'stock' => 100,
                'price' => 26000,
                'image' => 'images/products/pipa-aw05.jpg'
            ],
            [
                'name' => 'Pipa Rucika D 1.25"',
                'category' => 'Sanitasi',
                'stock' => 100,
                'price' => 47000,
                'image' => 'images/products/pipa-d125.jpg'
            ],
            [
                'name' => 'Pipa Rucika D 2"',
                'category' => 'Sanitasi',
                'stock' => 100,
                'price' => 82000,
                'image' => 'images/products/pipa-d2.jpg'
            ],

            // ==========================================================
            // 12. PIPA & FITTING (10 DATA)
            // ==========================================================
            [
                'name' => 'Knee 1/2"',
                'category' => 'Pipa & Fitting',
                'stock' => 100,
                'price' => 3000,
                'image' => 'images/products/knee12.jpg'
            ],
            [
                'name' => 'Knee 1"',
                'category' => 'Pipa & Fitting',
                'stock' => 100,
                'price' => 4500,
                'image' => 'images/products/knee1.jpg'
            ],
            [
                'name' => 'Knee 1.25"',
                'category' => 'Pipa & Fitting',
                'stock' => 100,
                'price' => 6000,
                'image' => 'images/products/knee125.jpg'
            ],
            [
                'name' => 'Knee 2"',
                'category' => 'Pipa & Fitting',
                'stock' => 100,
                'price' => 9000,
                'image' => 'images/products/knee2.jpg'
            ],
            [
                'name' => 'Sambungan T 1/2"',
                'category' => 'Pipa & Fitting',
                'stock' => 100,
                'price' => 4000,
                'image' => 'images/products/t12.jpg'
            ],
            [
                'name' => 'Penutup Pipa 1"',
                'category' => 'Pipa & Fitting',
                'stock' => 100,
                'price' => 6000,
                'image' => 'images/products/penutup1.jpg'
            ],
            [
                'name' => 'Oversok 1x3/4 AW',
                'category' => 'Pipa & Fitting',
                'stock' => 100,
                'price' => 5000,
                'image' => 'images/products/oversok.jpg'
            ],
            [
                'name' => 'Double Nepel 1/2 Besi',
                'category' => 'Pipa & Fitting',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/nepel.jpg'
            ],
            [
                'name' => 'Stop Kran 1/2"',
                'category' => 'Pipa & Fitting',
                'stock' => 100,
                'price' => 13000,
                'image' => 'images/products/kran12.jpg'
            ],
            [
                'name' => 'Shower Mandi Biasa',
                'category' => 'Pipa & Fitting',
                'stock' => 100,
                'price' => 65000,
                'image' => 'images/products/shower.jpg'
            ],

            // ==========================================================
            // 13. BAHAN TAMBAHAN (10 DATA)
            // ==========================================================
            [
                'name' => 'Kaca Bening 3mm',
                'category' => 'Bahan Tambahan',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/kaca3.jpg'
            ],
            [
                'name' => 'Kaca Bening 5mm',
                'category' => 'Bahan Tambahan',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/kaca5.jpg'
            ],
            [
                'name' => 'No Drop Putih 1kg',
                'category' => 'Bahan Tambahan',
                'stock' => 100,
                'price' => 65000,
                'image' => 'images/products/nodrop.jpg'
            ],
            [
                'name' => 'Aquaproof 1kg Abu',
                'category' => 'Bahan Tambahan',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/aqua-abu.jpg'
            ],
            [
                'name' => 'Serabut 1 Meter',
                'category' => 'Bahan Tambahan',
                'stock' => 100,
                'price' => 17000,
                'image' => 'images/products/serabut.jpg'
            ],
            [
                'name' => 'Timberplank PL 20x2',
                'category' => 'Bahan Tambahan',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/timber2.jpg'
            ],
            [
                'name' => 'Kalsiplank PL 20x3',
                'category' => 'Bahan Tambahan',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/kalsi20x3.jpg'
            ],
            [
                'name' => 'Kuas 5 Inch',
                'category' => 'Bahan Tambahan',
                'stock' => 100,
                'price' => 21000,
                'image' => 'images/products/kuas5.jpg'
            ],
            [
                'name' => 'Buis Beton 40cm',
                'category' => 'Bahan Tambahan',
                'stock' => 100,
                'price' => 42000,
                'image' => 'images/products/buis40.jpg'
            ],
            [
                'name' => 'Buis Beton 50cm',
                'category' => 'Bahan Tambahan',
                'stock' => 100,
                'price' => 52000,
                'image' => 'images/products/buis50.jpg'
            ],

            // ==========================================================
            // 14. BUIS BETON (10 DATA)
            // ==========================================================
            [
                'name' => 'Buis Beton 30cm',
                'category' => 'Buis Beton',
                'stock' => 100,
                'price' => 50000,
                'image' => 'images/products/buis30.jpg'
            ],
            [
                'name' => 'Buis Beton 40cm',
                'category' => 'Buis Beton',
                'stock' => 100,
                'price' => 42000,
                'image' => 'images/products/buis40.jpg'
            ],
            [
                'name' => 'Buis Beton 50cm',
                'category' => 'Buis Beton',
                'stock' => 100,
                'price' => 52000,
                'image' => 'images/products/buis50.jpg'
            ],
            [
                'name' => 'Buis Beton 60cm',
                'category' => 'Buis Beton',
                'stock' => 100,
                'price' => 21000,
                'image' => 'images/products/buis60.jpg'
            ],
            [
                'name' => 'Buis Beton 80cm',
                'category' => 'Buis Beton',
                'stock' => 100,
                'price' => 9000,
                'image' => 'images/products/buis80.jpg'
            ],
            [
                'name' => 'Buis Beton 100cm',
                'category' => 'Buis Beton',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/buis100.jpg'
            ],
            [
                'name' => 'Buis Beton Segi 4 Tebal 6cm',
                'category' => 'Buis Beton',
                'stock' => 100,
                'price' => 19000,
                'image' => 'images/products/buis-segi4-6.jpg'
            ],
            [
                'name' => 'Buis Beton Segi 4 Tebal 8cm',
                'category' => 'Buis Beton',
                'stock' => 100,
                'price' => 12000,
                'image' => 'images/products/buis-segi4-8.jpg'
            ],
            [
                'name' => 'Buis Beton Segi 6 Tebal 6cm',
                'category' => 'Buis Beton',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/buis-segi6-6.jpg'
            ],
            [
                'name' => 'Buis Beton Segi 6 Tebal 8cm',
                'category' => 'Buis Beton',
                'stock' => 100,
                'price' => 41000,
                'image' => 'images/products/buis-segi6-8.jpg'
            ],

            // ==========================================================
            // 15. LEM & ADHESIVE (10 DATA)
            // ==========================================================
            [
                'name' => 'Lem Aica Aibon 300gr',
                'category' => 'Lem',
                'stock' => 100,
                'price' => 84000,
                'image' => 'images/products/aibon300.jpg'
            ],
            [
                'name' => 'Lem Castol Besar',
                'category' => 'Lem',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/castol-besar.jpg'
            ],
            [
                'name' => 'Lem Castol Mini',
                'category' => 'Lem',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/castol-mini.jpg'
            ],
            [
                'name' => 'Lem Fox Kayu 400gr',
                'category' => 'Lem',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/fox400.jpg'
            ],
            [
                'name' => 'Lem Fox Kayu 800gr',
                'category' => 'Lem',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/fox800.jpg'
            ],
            [
                'name' => 'Alteco Lem',
                'category' => 'Lem',
                'stock' => 100,
                'price' => 7000,
                'image' => 'images/products/alteco.jpg'
            ],
            [
                'name' => 'Dextone Silicone Sealant 30gr',
                'category' => 'Lem',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/dextone30.jpg'
            ],
            [
                'name' => 'Dextone Silicone Sealant 70gr',
                'category' => 'Lem',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/dextone70.jpg'
            ],
            [
                'name' => 'Aica Aibon Mini',
                'category' => 'Lem',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/aibon-mini.jpg'
            ],
            [
                'name' => 'Isarplas Super',
                'category' => 'Lem',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/isarplas.jpg'
            ],

            // ==========================================================
            // 16. ALAT PERTUKANGAN (10 DATA)
            // ==========================================================
            [
                'name' => 'Palu',
                'category' => 'Alat Pertukangan',
                'stock' => 100,
                'price' => 27000,
                'image' => 'images/products/palu.jpg'
            ],
            [
                'name' => 'Linggis',
                'category' => 'Alat Pertukangan',
                'stock' => 100,
                'price' => 31000,
                'image' => 'images/products/linggis.jpg'
            ],
            [
                'name' => 'Betel',
                'category' => 'Alat Pertukangan',
                'stock' => 100,
                'price' => 18000,
                'image' => 'images/products/betel.jpg'
            ],
            [
                'name' => 'Sabit',
                'category' => 'Alat Pertukangan',
                'stock' => 100,
                'price' => 16000,
                'image' => 'images/products/sabit.jpg'
            ],
            [
                'name' => 'Cethok',
                'category' => 'Alat Pertukangan',
                'stock' => 100,
                'price' => 16000,
                'image' => 'images/products/cethok.jpg'
            ],
            [
                'name' => 'Cangkul',
                'category' => 'Alat Pertukangan',
                'stock' => 100,
                'price' => 16000,
                'image' => 'images/products/cangkul.jpg'
            ],
            [
                'name' => 'Obeng',
                'category' => 'Alat Pertukangan',
                'stock' => 100,
                'price' => 15000,
                'image' => 'images/products/obeng.jpg'
            ],
            [
                'name' => 'Tang',
                'category' => 'Alat Pertukangan',
                'stock' => 100,
                'price' => 15000,
                'image' => 'images/products/tang.jpg'
            ],
            [
                'name' => 'Helm Pengaman',
                'category' => 'Alat Pertukangan',
                'stock' => 100,
                'price' => 83000,
                'image' => 'images/products/helm.jpg'
            ],
            [
                'name' => 'Sepatu Pengaman',
                'category' => 'Alat Pertukangan',
                'stock' => 100,
                'price' => 75000,
                'image' => 'images/products/sepatu.jpg'
            ],

            // ==========================================================
            // 17. AKSESORIS PINTU / JENDELA (10 DATA)
            // ==========================================================
            [
                'name' => 'Gembok HPP 40mm',
                'category' => 'Aksesoris Pintu',
                'stock' => 100,
                'price' => 18000,
                'image' => 'images/products/gembok40.jpg'
            ],
            [
                'name' => 'Gembok Jeje 30',
                'category' => 'Aksesoris Pintu',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/gembok30.jpg'
            ],
            [
                'name' => 'Handel Laci Kecil',
                'category' => 'Aksesoris Pintu',
                'stock' => 100,
                'price' => 4000,
                'image' => 'images/products/handle-kecil.jpg'
            ],
            [
                'name' => 'Handel Laci Besar',
                'category' => 'Aksesoris Pintu',
                'stock' => 100,
                'price' => 7000,
                'image' => 'images/products/handle-besar.jpg'
            ],
            [
                'name' => 'Engsel 2"',
                'category' => 'Aksesoris Pintu',
                'stock' => 100,
                'price' => 8000,
                'image' => 'images/products/engsel2.jpg'
            ],
            [
                'name' => 'Engsel 3"',
                'category' => 'Aksesoris Pintu',
                'stock' => 100,
                'price' => 8000,
                'image' => 'images/products/engsel3.jpg'
            ],
            [
                'name' => 'Engsel 4" Tebal',
                'category' => 'Aksesoris Pintu',
                'stock' => 100,
                'price' => 11000,
                'image' => 'images/products/engsel4.jpg'
            ],
            [
                'name' => 'Slot Pintu Geser',
                'category' => 'Aksesoris Pintu',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/slotpintu.jpg'
            ],
            [
                'name' => 'Kunci Laci 808',
                'category' => 'Aksesoris Pintu',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/kuncilaci.jpg'
            ],
            [
                'name' => 'Rel Gordyn',
                'category' => 'Aksesoris Pintu',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/rel-gordyn.jpg'
            ],

            // ==========================================================
            // 18. RUMAH TANGGA / POMPA (10 DATA)
            // ==========================================================
            [
                'name' => 'Pompa Air Shimizu',
                'category' => 'Rumah Tangga',
                'stock' => 100,
                'price' => 410000,
                'image' => 'images/products/pompa-shi.jpg'
            ],
            [
                'name' => 'Pompa Air Panasonic',
                'category' => 'Rumah Tangga',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/pompa-panasonic.jpg'
            ],
            [
                'name' => 'Jet Pump',
                'category' => 'Rumah Tangga',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/jetpump.jpg'
            ],
            [
                'name' => 'Klep Pompa 3/4',
                'category' => 'Rumah Tangga',
                'stock' => 100,
                'price' => 20000,
                'image' => 'images/products/klep34.jpg'
            ],
            [
                'name' => 'Klep Pompa 1"',
                'category' => 'Rumah Tangga',
                'stock' => 100,
                'price' => 21000,
                'image' => 'images/products/klep1.jpg'
            ],
            [
                'name' => 'Radar Otomatis Pompa',
                'category' => 'Rumah Tangga',
                'stock' => 100,
                'price' => 40000,
                'image' => 'images/products/radar.jpg'
            ],
            [
                'name' => 'Bakteri Penguras WC 1',
                'category' => 'Rumah Tangga',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/bakteri1.jpg'
            ],
            [
                'name' => 'Bakteri Penguras WC 2',
                'category' => 'Rumah Tangga',
                'stock' => 100,
                'price' => 0,
                'image' => 'images/products/bakteri2.jpg'
            ],
            [
                'name' => 'Slang Air 1/2"',
                'category' => 'Rumah Tangga',
                'stock' => 100,
                'price' => 300000,
                'image' => 'images/products/slang12.jpg'
            ],
            [
                'name' => 'Slang Air 3/4"',
                'category' => 'Rumah Tangga',
                'stock' => 100,
                'price' => 300000,
                'image' => 'images/products/slang34.jpg'
            ],
        ];

        Product::insert($products);
    }
}
