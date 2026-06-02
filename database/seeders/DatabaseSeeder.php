<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Concert;
use App\Models\Gallery;
use App\Models\Pengguna;
use App\Models\Schedule;
use App\Models\Ticket;
use App\Models\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
   public function run(): void
    {
        Pengguna::updateOrCreate(
            ['gmail' => 'admin@concert.test'],
            [
                'nama' => 'Admin Konserin',
                'password' => Hash::make('admin12345'),
                'nik' => '3171000000000001',
                'role' => 'admin',
            ]
        );

        Pengguna::updateOrCreate(
            ['gmail' => 'user@concert.test'],
            [
                'nama' => 'User Konserin',
                'password' => Hash::make('user12345'),
                'nik' => '3171000000000002',
                'role' => 'user',
            ]
        );

        $venues = [
            'gbk_1' => Venue::updateOrCreate(
                ['nama_venue' => 'GBK'],
                ['alamat' => 'Gelora Bung Karno, Jakarta Pusat', 'kota' => 'Jakarta', 'kapasitas' => 77000]
            ),
            'kasablanka' => Venue::updateOrCreate(
                ['nama_venue' => 'Kasablanka Hall'],
                ['alamat' => 'Kota Kasablanka, Jakarta Selatan', 'kota' => 'Jakarta', 'kapasitas' => 5500]
            ),
            'gbk_2' => Venue::updateOrCreate(
                ['nama_venue' => 'GBK Senayan'],
                ['alamat' => 'Area Gelora Bung Karno, Jakarta Pusat', 'kota' => 'Jakarta', 'kapasitas' => 77000]
            ),
            'jis' => Venue::updateOrCreate(
                ['nama_venue' => 'JIS'],
                ['alamat' => 'Jakarta International Stadium, Jakarta Utara', 'kota' => 'Jakarta', 'kapasitas' => 82000]
            ),
            'kridosono' => Venue::updateOrCreate(
                ['nama_venue' => 'Stadion Kridosono'],
                ['alamat' => 'Kotabaru, Yogyakarta', 'kota' => 'Yogyakarta', 'kapasitas' => 25000]
            ),
        ];

        $dataKonser = [
            [
                'artist_name' => 'Sukses Lancar Rejeki',
                'genre' => 'Indie Pop',
                'country' => 'Indonesia',
                'bio' => 'Band lokal dengan konsep musik ringan dan dekat dengan anak muda.',
                'image' => 'resource/image/slr.jpg',
                'concert_name' => 'Sukses Lancar Rejeki Live',
                'description' => 'Konser Sukses Lancar Rejeki dengan suasana santai dan penuh energi.',
                'event_date' => '2026-06-15 19:00:00',
                'status' => 'upcoming',
                'venue' => $venues['gbk_1'],
                'prices' => [1000000, 2000000, 3100000],
                'stocks' => [150, 90, 40],
            ],
            [
                'artist_name' => 'Ado',
                'genre' => 'J-Pop',
                'country' => 'Japan',
                'bio' => 'Penyanyi Jepang dengan karakter vokal kuat dan konsep panggung khas.',
                'image' => 'resource/image/ado.jpg',
                'concert_name' => 'Ado World Tour',
                'description' => 'Pertunjukan Ado dengan visual gelap dan atmosfer panggung intens.',
                'event_date' => '2026-07-02 20:00:00',
                'status' => 'upcoming',
                'venue' => $venues['kasablanka'],
                'prices' => [1250000, 2250000, 3200000],
                'stocks' => [120, 75, 35],
            ],
            [
                'artist_name' => '.Feast',
                'genre' => 'Rock',
                'country' => 'Indonesia',
                'bio' => 'Band rock Indonesia dengan lirik kritis dan performa panggung yang kuat.',
                'image' => 'resource/image/feast.jpg',
                'concert_name' => '.Feast Selamat Datang Tour',
                'description' => 'Konser .Feast dengan setlist populer dan suasana panggung padat.',
                'event_date' => '2026-07-20 19:30:00',
                'status' => 'ongoing',
                'venue' => $venues['gbk_2'],
                'prices' => [1500000, 2500000, 3300000],
                'stocks' => [100, 65, 25],
            ],
            [
                'artist_name' => 'Bruno Mars',
                'genre' => 'Pop R&B',
                'country' => 'United States',
                'bio' => 'Penyanyi internasional dengan gaya pop, funk, dan R&B.',
                'image' => 'resource/image/bruno.jpg',
                'concert_name' => 'Bruno Mars Live in Jakarta',
                'description' => 'Konser utama Bruno Mars dengan produksi panggung besar dan lagu populer.',
                'event_date' => '2026-08-10 20:00:00',
                'status' => 'upcoming',
                'venue' => $venues['jis'],
                'prices' => [1500000, 2500000, 3300000],
                'stocks' => [180, 100, 50],
            ],
            [
                'artist_name' => 'Dewa 19',
                'genre' => 'Pop Rock',
                'country' => 'Indonesia',
                'bio' => 'Grup musik legendaris Indonesia dengan lagu populer lintas generasi.',
                'image' => 'resource/image/dewa19.jpg',
                'concert_name' => 'Dewa 19 All Stars',
                'description' => 'Konser Dewa 19 dengan aransemen klasik dan penampilan spesial.',
                'event_date' => '2026-09-05 19:00:00',
                'status' => 'finished',
                'venue' => $venues['kridosono'],
                'prices' => [1000000, 2000000, 3100000],
                'stocks' => [0, 0, 0],
            ],
        ];

        foreach ($dataKonser as $data) {
            $artist = Artist::updateOrCreate(
                ['name' => $data['artist_name']],
                [
                    'genre' => $data['genre'],
                    'bio' => $data['bio'],
                    'photo_url' => $data['image'],
                    'country' => $data['country'],
                ]
            );

            $concert = Concert::updateOrCreate(
                ['name' => $data['concert_name']],
                [
                    'description' => $data['description'],
                    'poster_url' => $data['image'],
                    'event_date' => $data['event_date'],
                    'status' => $data['status'],
                ]
            );

            $concert->artists()->sync([$artist->id]);

            Gallery::updateOrCreate(
                ['judul' => 'Gallery ' . $data['artist_name']],
                [
                    'concert_id' => $concert->id,
                    'gambar' => $data['image'],
                    'deskripsi' => 'Dokumentasi visual untuk konser ' . $concert->name . '.',
                    'kategori' => 'concert',
                    'is_featured' => true,
                ]
            );

            $tipeTiket = [
                ['tipe_ticket' => 'Reguler', 'harga' => $data['prices'][0], 'stock' => $data['stocks'][0]],
                ['tipe_ticket' => 'Festival', 'harga' => $data['prices'][1], 'stock' => $data['stocks'][1]],
                ['tipe_ticket' => 'VIP', 'harga' => $data['prices'][2], 'stock' => $data['stocks'][2]],
            ];

            foreach ($tipeTiket as $tiket) {
                $ticket = Ticket::updateOrCreate(
                    ['concert_id' => $concert->id, 'tipe_ticket' => $tiket['tipe_ticket']],
                    [
                        'nama_konser' => $concert->name,
                        'nama_artis' => $artist->name,
                        'venue_id' => $data['venue']->id,
                        'tanggal_konser' => date('Y-m-d', strtotime($data['event_date'])),
                        'jam_konser' => date('H:i:s', strtotime($data['event_date'])),
                        'harga' => $tiket['harga'],
                        'stock' => $tiket['stock'],
                    ]
                );

                Schedule::updateOrCreate(
                    ['ticket_id' => $ticket->id],
                    ['catatan' => 'Gate dibuka 2 jam sebelum konser dimulai.']
                );
            }
        }
    }
    /**
     * Seed the application's database.
     */
}
