<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaKelas2Seeder extends Seeder
{
    public function run()
    {
        $mahasiswas = [
            ['nim' => '2310002', 'nama' => 'LOLITA PAYA LEMBONG PADANG',    'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 74, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310004', 'nama' => 'NINDI ALFIKA RAHMA TANIA',      'k1' => 90, 'k2' => 0, 'k3' => 64.2857, 'k4' => 0, 'mid' => 58, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310006', 'nama' => 'AFRIANI CAHYA WIDYANINGRUM',    'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 92, 'uas' => 90,    'remidi' => 0],
            ['nim' => '2310008', 'nama' => 'AINNUR RAFLI ANUGRAH',          'k1' => 90, 'k2' => 0, 'k3' => 83.2,    'k4' => 0, 'mid' => 60, 'uas' => 87.14, 'remidi' => 0],
            ['nim' => '2310010', 'nama' => 'AJENG LUSTIA DEWI MAHARANI',    'k1' => 90, 'k2' => 0, 'k3' => 71.4286, 'k4' => 0, 'mid' => 74, 'uas' => 71.43, 'remidi' => 0],
            ['nim' => '2310012', 'nama' => 'ALIYAH HAYU ATSILAH',           'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 45, 'uas' => 65,    'remidi' => 0],
            ['nim' => '2310014', 'nama' => 'ANGELINA SALSABILA OKTAFIANI',  'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 60, 'uas' => 54.29, 'remidi' => 0],
            ['nim' => '2310016', 'nama' => 'ANINDYA RAHMAWATI WIBOWO',      'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 66, 'uas' => 62.86, 'remidi' => 0],
            ['nim' => '2310018', 'nama' => 'ANNISSA DINDA PUTRI',           'k1' => 90, 'k2' => 0, 'k3' => 83.2,    'k4' => 0, 'mid' => 76, 'uas' => 71.43, 'remidi' => 0],
            ['nim' => '2310020', 'nama' => 'ARI ANGGARA',                   'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 60, 'uas' => 61.43, 'remidi' => 0],
            ['nim' => '2310022', 'nama' => 'AUFA SYAKIRA',                  'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 54, 'uas' => 55,    'remidi' => 0],
            ['nim' => '2310024', 'nama' => 'BAGUS SURYO BINTORO',           'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 92, 'uas' => 91.43, 'remidi' => 0],
            ['nim' => '2310026', 'nama' => 'CANDRA DWI SETIAWAN',           'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 88, 'uas' => 87.14, 'remidi' => 0],
            ['nim' => '2310028', 'nama' => 'CITRA DINATA',                  'k1' => 90, 'k2' => 0, 'k3' => 85.71,   'k4' => 0, 'mid' => 50, 'uas' => 50,    'remidi' => 0],
            ['nim' => '2310030', 'nama' => 'DELINA PRIGATA ASIH',           'k1' => 90, 'k2' => 0, 'k3' => 71.4286, 'k4' => 0, 'mid' => 60, 'uas' => 84.29, 'remidi' => 0],
            ['nim' => '2310032', 'nama' => 'DEVI MAHA REDHA',               'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 52, 'uas' => 51.43, 'remidi' => 0],
            ['nim' => '2310034', 'nama' => 'DINI PUSPITA ANGGRAINI',        'k1' => 90, 'k2' => 0, 'k3' => 85.71,   'k4' => 0, 'mid' => 45, 'uas' => 47,    'remidi' => 0],
            ['nim' => '2310036', 'nama' => 'DWINALA MEISTIARATNA PRASASTI', 'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 68, 'uas' => 72.86, 'remidi' => 0],
            ['nim' => '2310040', 'nama' => 'FIBRIANTY DWI CAHYANI',         'k1' => 90, 'k2' => 0, 'k3' => 85.71,   'k4' => 0, 'mid' => 45, 'uas' => 55,    'remidi' => 0],
            ['nim' => '2310042', 'nama' => 'FIRDA ALLAFAH PUTRI JOFA',      'k1' => 90, 'k2' => 0, 'k3' => 83.2,    'k4' => 0, 'mid' => 78, 'uas' => 77.14, 'remidi' => 0],
            ['nim' => '2310044', 'nama' => 'HANANIA GHUFRANI KHALISTA',     'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 74, 'uas' => 77.14, 'remidi' => 0],
            ['nim' => '2310046', 'nama' => 'ILVINA NUR SILKI',              'k1' => 90, 'k2' => 0, 'k3' => 71.4286, 'k4' => 0, 'mid' => 72, 'uas' => 82.86, 'remidi' => 0],
            ['nim' => '2310050', 'nama' => 'INAYATUS SAIDAH',               'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 82, 'uas' => 72.86, 'remidi' => 0],
            ['nim' => '2310052', 'nama' => 'INTAN AULIA MAFASA',            'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 52, 'uas' => 55.71, 'remidi' => 0],
            ['nim' => '2310054', 'nama' => 'JESSICA BERTHA LUMI',           'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 80, 'uas' => 87.14, 'remidi' => 0],
            ['nim' => '2310056', 'nama' => 'KAYLA ZAHRA SAFINA',            'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 78, 'uas' => 72.86, 'remidi' => 0],
            ['nim' => '2310058', 'nama' => 'KINANTI PUTRI NASTITI',         'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 52, 'uas' => 58.57, 'remidi' => 0],
            ['nim' => '2310060', 'nama' => 'MARSELLA DWI FIRANI',           'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 62, 'uas' => 67.14, 'remidi' => 0],
            ['nim' => '2310062', 'nama' => 'MELDA SADIA PERMATA',           'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 44, 'uas' => 58,    'remidi' => 0],
            ['nim' => '2310064', 'nama' => 'MOCHAMAD YUSUF ROMADHONI',      'k1' => 90, 'k2' => 0, 'k3' => 64.2857, 'k4' => 0, 'mid' => 92, 'uas' => 68.57, 'remidi' => 0],
            ['nim' => '2310066', 'nama' => 'MUHAMMAD HILMI DHIYA ULHAQ',    'k1' => 90, 'k2' => 0, 'k3' => 83.2,    'k4' => 0, 'mid' => 92, 'uas' => 68.57, 'remidi' => 0],
            ['nim' => '2310068', 'nama' => 'MUNTASYIROTUL KHOIROH',         'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 72, 'uas' => 65.71, 'remidi' => 0],
            ['nim' => '2310072', 'nama' => 'NAIANA LAURA PUTRIAYU',         'k1' => 90, 'k2' => 0, 'k3' => 83.2,    'k4' => 0, 'mid' => 62, 'uas' => 55.71, 'remidi' => 0],
            ['nim' => '2310074', 'nama' => 'NASYA NABIILAH ALAYYA',         'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 64, 'uas' => 68.57, 'remidi' => 0],
            ['nim' => '2310076', 'nama' => 'NOVELINA CAHYA FITRIYANI',      'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 78, 'uas' => 74.29, 'remidi' => 0],
            ['nim' => '2310078', 'nama' => 'NURINDA ARIYANTI',              'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 68, 'uas' => 62.86, 'remidi' => 0],
            ['nim' => '2310080', 'nama' => 'PREVIA KURNIA RAMADHANI',       'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 72, 'uas' => 65.71, 'remidi' => 0],
            ['nim' => '2310082', 'nama' => 'PUTRI NABILAH AZHARIA',         'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 68, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310084', 'nama' => 'PUTRI SAFINA ELDIANA',          'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 84, 'uas' => 61.43, 'remidi' => 0],
            ['nim' => '2310086', 'nama' => 'RAKASIWI',                      'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 64, 'uas' => 72.86, 'remidi' => 0],
            ['nim' => '2310088', 'nama' => 'REGY ANANTA TRI HERLAMBANG',    'k1' => 90, 'k2' => 0, 'k3' => 64.2857, 'k4' => 0, 'mid' => 88, 'uas' => 60,    'remidi' => 0],
            ['nim' => '2310090', 'nama' => 'REYKA PUTRI AYU NINGRUM',       'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 80, 'uas' => 50,    'remidi' => 0],
            ['nim' => '2310092', 'nama' => 'RISMA FERLIZA ARYANTI',         'k1' => 90, 'k2' => 0, 'k3' => 64.2857, 'k4' => 0, 'mid' => 62, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310094', 'nama' => 'SABLA PIRA SAFITRI',            'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 68, 'uas' => 65.71, 'remidi' => 0],
            ['nim' => '2310096', 'nama' => 'SALMAN SYARIF PRANAYA',         'k1' => 90, 'k2' => 0, 'k3' => 83.2,    'k4' => 0, 'mid' => 62, 'uas' => 87.14, 'remidi' => 0],
            ['nim' => '2310098', 'nama' => 'SALSABILA PUTRI NURUDIN',       'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 92, 'uas' => 85.71, 'remidi' => 0],
            ['nim' => '2310100', 'nama' => 'SILVI DWI MAHARANI',            'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 56, 'uas' => 50,    'remidi' => 0],
            ['nim' => '2310102', 'nama' => 'SINDY AYU PUSPITA',             'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 74, 'uas' => 67.14, 'remidi' => 0],
            ['nim' => '2310104', 'nama' => 'SOFYA RIZKY DEWI INFANTRI',     'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 84, 'uas' => 60,    'remidi' => 0],
            ['nim' => '2310106', 'nama' => 'TIA RAHMANIDA',                 'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 70, 'uas' => 70,    'remidi' => 0],
            ['nim' => '2310108', 'nama' => 'TSANIATURROHMAH',               'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 68, 'uas' => 72.86, 'remidi' => 0],
            ['nim' => '2310110', 'nama' => 'VANYA PUTRI AMELIA',            'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 82, 'uas' => 75.71, 'remidi' => 0],
            ['nim' => '2310112', 'nama' => 'WIDIARTAMA ADI PURWANTO',       'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 68, 'uas' => 72.86, 'remidi' => 0],
            ['nim' => '2310114', 'nama' => 'YUSA FIRNANDA',                 'k1' => 90, 'k2' => 0, 'k3' => 64.2857, 'k4' => 0, 'mid' => 80, 'uas' => 90,    'remidi' => 0],
            ['nim' => '2310116', 'nama' => 'ZHEGA ADHI PRATAMA',            'k1' => 90, 'k2' => 0, 'k3' => 85.7143, 'k4' => 0, 'mid' => 88, 'uas' => 88.57, 'remidi' => 0],
            ['nim' => '2310118', 'nama' => 'ZUHRUFANO TABASSUMI HULWA',     'k1' => 90, 'k2' => 0, 'k3' => 78.5714, 'k4' => 0, 'mid' => 84, 'uas' => 30,    'remidi' => 0],
            ['nim' => '2310120', 'nama' => 'DEVINTA AHUMAWATI',             'k1' => 90, 'k2' => 0, 'k3' => 71.43,   'k4' => 0, 'mid' => 44, 'uas' => 50,    'remidi' => 0],
        ];

        foreach ($mahasiswas as $data) {
            Mahasiswa::create([
                'nama'          => $data['nama'],
                'nim'           => $data['nim'],
                'program_studi' => 'S1 Keperawatan',
                'kelas'         => 'Kelas 2',
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

        $this->command->info('✅ 57 mahasiswa Kelas 2 berhasil ditambahkan!');
    }
}
