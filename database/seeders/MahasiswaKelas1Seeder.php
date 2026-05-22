<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaKelas1Seeder extends Seeder
{
    public function run()
    {
        $mahasiswas = [
            ['nim' => '2110050',  'nama' => 'ACHMAD MUBAROK NUR AFENDI',            'k1' => 80, 'k2' => 0, 'k3' => 78.54,   'k4' => 0, 'mid' => 24, 'uas' => 48,    'remidi' => 0],
            ['nim' => '2210127',  'nama' => 'ROSTINA LUKITASARI',                   'k1' => 90, 'k2' => 0, 'k3' => 81.2,    'k4' => 0, 'mid' => 72, 'uas' => 68.57, 'remidi' => 0],
            ['nim' => '2310001',  'nama' => 'ADINDA MEGA FITRIANTOMO',              'k1' => 50, 'k2' => 0, 'k3' => 0,       'k4' => 0, 'mid' => 84, 'uas' => 0,     'remidi' => 0],
            ['nim' => '2310003',  'nama' => 'MUHAMMAD BAGAS SATRIA',                'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 68, 'uas' => 44.29, 'remidi' => 0],
            ['nim' => '2310005',  'nama' => 'ABRILYA SOFY JANUARY PURNOMO',         'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 84, 'uas' => 88.57, 'remidi' => 0],
            ['nim' => '2310007',  'nama' => 'AHMAD RIZKI NURHANIF',                 'k1' => 90, 'k2' => 0, 'k3' => 81.0714, 'k4' => 0, 'mid' => 68, 'uas' => 60,    'remidi' => 0],
            ['nim' => '2310009',  'nama' => 'AJENG LISA ARIYANTI',                  'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 70, 'uas' => 61.43, 'remidi' => 0],
            ['nim' => '2310011',  'nama' => 'ALFINA WIDAYANTI',                     'k1' => 90, 'k2' => 0, 'k3' => 81.0714, 'k4' => 0, 'mid' => 94, 'uas' => 88.57, 'remidi' => 0],
            ['nim' => '2310013',  'nama' => 'ANANDA SHENIA PUTRI ALTINO',           'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 74, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310015',  'nama' => 'ANGGUN LAKSANA PUTRI AL AKROFF',       'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 84, 'uas' => 55.71, 'remidi' => 0],
            ['nim' => '2310017',  'nama' => 'ANNISA TRI AGUSTIN',                   'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 88, 'uas' => 52.86, 'remidi' => 0],
            ['nim' => '2310019',  'nama' => 'ANYA MARWA ZAMZAMIL FIRDAUS',          'k1' => 90, 'k2' => 0, 'k3' => 89,      'k4' => 0, 'mid' => 70, 'uas' => 74.29, 'remidi' => 0],
            ['nim' => '2310021',  'nama' => 'ATIKHA NATHANIA JUANTIKA',             'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 70, 'uas' => 61.43, 'remidi' => 0],
            ['nim' => '2310023',  'nama' => 'AYU AGUSTINA',                         'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 88, 'uas' => 81.43, 'remidi' => 0],
            ['nim' => '2310025',  'nama' => 'BELLA NAVYTA PERMATASARI',             'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 76, 'uas' => 80,    'remidi' => 0],
            ['nim' => '2310029',  'nama' => 'DARA INTAN TALISYA SUTRISNO',          'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 90, 'uas' => 80,    'remidi' => 0],
            ['nim' => '2310031',  'nama' => 'DELLA PRAMESTI REGITA CAHYANI',        'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 88, 'uas' => 57.14, 'remidi' => 0],
            ['nim' => '2310033',  'nama' => 'DHYA\'A NABILLA',                      'k1' => 90, 'k2' => 0, 'k3' => 73.2,    'k4' => 0, 'mid' => 42, 'uas' => 40,    'remidi' => 0],
            ['nim' => '2310035',  'nama' => 'DISA MUFIDAH LUTHFIANA',               'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 86, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310039',  'nama' => 'FERNANDA VIONICA PUTRI',               'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 80, 'uas' => 80,    'remidi' => 0],
            ['nim' => '2310041',  'nama' => 'FIRA MAULIDIYA',                       'k1' => 90, 'k2' => 0, 'k3' => 73.2,    'k4' => 0, 'mid' => 60, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310043',  'nama' => 'GALUH LINTANG LARASSASI',              'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 88, 'uas' => 84.29, 'remidi' => 0],
            ['nim' => '2310045',  'nama' => 'HAWA ARAMADHANI',                      'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 68, 'uas' => 62.86, 'remidi' => 0],
            ['nim' => '2310047',  'nama' => 'IMELDA AMELIA ARGATA',                 'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 70, 'uas' => 72.86, 'remidi' => 0],
            ['nim' => '2310049',  'nama' => 'IN\'AAM ZERLINDA ADRIYANI',            'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 80, 'uas' => 64.29, 'remidi' => 0],
            ['nim' => '2310051',  'nama' => 'INDAH NUR HIDAYAH',                    'k1' => 90, 'k2' => 0, 'k3' => 73.2,    'k4' => 0, 'mid' => 78, 'uas' => 84.29, 'remidi' => 0],
            ['nim' => '2310053',  'nama' => 'JAZILATUL HIKMIA',                     'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 86, 'uas' => 81.43, 'remidi' => 0],
            ['nim' => '2310055',  'nama' => 'JOESAFAT ELPANDO',                     'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 68, 'uas' => 68.57, 'remidi' => 0],
            ['nim' => '2310057',  'nama' => 'KEVIN CLAUDIO PESURNAY',               'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 74, 'uas' => 72.86, 'remidi' => 0],
            ['nim' => '2310059',  'nama' => 'LILIK KUAT SELLADITIA',                'k1' => 90, 'k2' => 0, 'k3' => 73.2,    'k4' => 0, 'mid' => 72, 'uas' => 48.57, 'remidi' => 0],
            ['nim' => '2310061',  'nama' => 'MARTASYA NUR HARIATI',                 'k1' => 90, 'k2' => 0, 'k3' => 88.2143, 'k4' => 0, 'mid' => 80, 'uas' => 65.71, 'remidi' => 0],
            ['nim' => '2310063',  'nama' => 'MOCHAMAD RIFQI DIMAS FIRMANSYAH',      'k1' => 90, 'k2' => 0, 'k3' => 88.2143, 'k4' => 0, 'mid' => 84, 'uas' => 81.43, 'remidi' => 0],
            ['nim' => '2310065',  'nama' => 'MUHAMMAD DAFFA MAULANA YAHYA',         'k1' => 90, 'k2' => 0, 'k3' => 89,      'k4' => 0, 'mid' => 68, 'uas' => 64.29, 'remidi' => 0],
            ['nim' => '2310067',  'nama' => 'MUHAMMAD WAHYU DWI FIRMANSYAH',        'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 90, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310069',  'nama' => 'MYLANIE AGUSTIN',                      'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 88, 'uas' => 41.43, 'remidi' => 0],
            ['nim' => '2310071',  'nama' => 'NADIA KIRANA PUTRI',                   'k1' => 90, 'k2' => 0, 'k3' => 73.2,    'k4' => 0, 'mid' => 92, 'uas' => 78.57, 'remidi' => 0],
            ['nim' => '2310073',  'nama' => 'NAILATUS SHOFFI',                      'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 90, 'uas' => 50,    'remidi' => 0],
            ['nim' => '2310075',  'nama' => 'NODYA SHOFA MARWAH',                   'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 90, 'uas' => 71.43, 'remidi' => 0],
            ['nim' => '2310077',  'nama' => 'NURCHOLIS ARIYANTO',                   'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 90, 'uas' => 37.14, 'remidi' => 0],
            ['nim' => '2310079',  'nama' => 'NURMAZIDA',                             'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 70, 'uas' => 62.86, 'remidi' => 0],
            ['nim' => '2310081',  'nama' => 'PUTRI AULIA NURDIYANTI',               'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 92, 'uas' => 75.71, 'remidi' => 0],
            ['nim' => '2310083',  'nama' => 'PUTRI NATASYA ARIANTO',                'k1' => 90, 'k2' => 0, 'k3' => 73.9286, 'k4' => 0, 'mid' => 84, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310085',  'nama' => 'PUTRI WIDYA PUSPITA',                  'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 92, 'uas' => 55,    'remidi' => 0],
            ['nim' => '2310087',  'nama' => 'RASYIQAH SALWASARAYA',                 'k1' => 90, 'k2' => 0, 'k3' => 73.2,    'k4' => 0, 'mid' => 46, 'uas' => 50,    'remidi' => 0],
            ['nim' => '2310089',  'nama' => 'REO YONANG RIKY REONAL VETER PRAKOSO', 'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 52, 'uas' => 51.43, 'remidi' => 0],
            ['nim' => '2310091',  'nama' => 'RISKA FITRI AMELIA',                   'k1' => 90, 'k2' => 0, 'k3' => 83.9,    'k4' => 0, 'mid' => 58, 'uas' => 47.14, 'remidi' => 0],
            ['nim' => '2310093',  'nama' => 'ROSSA MAYANG SARI',                    'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 48, 'uas' => 50,    'remidi' => 0],
            ['nim' => '2310095',  'nama' => 'SAFIA MUYASSAR PUTRI',                 'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 56, 'uas' => 47.14, 'remidi' => 0],
            ['nim' => '2310097',  'nama' => 'SALSABILA LAILATUN NI\'MAH',           'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 64, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310099',  'nama' => 'SALLY NATHANIA ZERLYNDA',              'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 88, 'uas' => 87.14, 'remidi' => 0],
            ['nim' => '2310101',  'nama' => 'SILVIA DAMAYANTI',                     'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 40, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310103',  'nama' => 'SISKA AYU SETIAWATI',                  'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 72, 'uas' => 71.43, 'remidi' => 0],
            ['nim' => '2310105',  'nama' => 'TEGUH WASKITO SUGIYONO',               'k1' => 90, 'k2' => 0, 'k3' => 73.2,    'k4' => 0, 'mid' => 88, 'uas' => 52.86, 'remidi' => 0],
            ['nim' => '2310107',  'nama' => 'TIARA SETYO ARINDYA',                  'k1' => 90, 'k2' => 0, 'k3' => 88.2143, 'k4' => 0, 'mid' => 72, 'uas' => 75.71, 'remidi' => 0],
            ['nim' => '2310111',  'nama' => 'WANDA AMELIA PUTRI',                   'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 48, 'uas' => 58.57, 'remidi' => 0],
            ['nim' => '2310113',  'nama' => 'YOGA INDRA WASKITA',                   'k1' => 90, 'k2' => 0, 'k3' => 73.9286, 'k4' => 0, 'mid' => 58, 'uas' => 80,    'remidi' => 0],
            ['nim' => '2310115',  'nama' => 'ZAHWA AZ ZAHRA SALSABILA YUDHA',       'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 74, 'uas' => 68.57, 'remidi' => 0],
            ['nim' => '2310119',  'nama' => 'ZULFA NUR JANNAH',                     'k1' => 90, 'k2' => 0, 'k3' => 85.2,    'k4' => 0, 'mid' => 78, 'uas' => 91.43, 'remidi' => 0],
            ['nim' => '2310121P', 'nama' => 'DIVA MARINA EKA PUTRI',                'k1' => 90, 'k2' => 0, 'k3' => 58.35,   'k4' => 0, 'mid' => 54, 'uas' => 57.14, 'remidi' => 0],
        ];

        foreach ($mahasiswas as $data) {
            Mahasiswa::create([
                'nama'          => $data['nama'],
                'nim'           => $data['nim'],
                'program_studi' => 'Teknik Informatika',
                'kelas'         => 'Kelas 1',
                'email'         => strtolower(str_replace(['\'', ' ', '/'], ['', '.', ''], $data['nim'])) . '@student.ac.id',
                'no_hp'         => null,
                'status'        => 'Aktif',
                'k1'            => $data['k1'],
                'k2'            => $data['k2'],
                'k3'            => $data['k3'],
                'k4'            => $data['k4'],
                'mid'           => $data['mid'],
                'uas'           => $data['uas'],
                'remidi'        => $data['remidi'],
            ]);
        }

        $this->command->info('✅ 59 mahasiswa Kelas 1 berhasil ditambahkan!');
    }
}
