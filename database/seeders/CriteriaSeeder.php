<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Criteria::create([
            'name_criteria' => 'Menguasai karakteristik peserta didik',
            'weight' => 5.0,
            'category' => 'B'
        ]);
        Criteria::create([
            'name_criteria' => 'Menguasai teori belajar dan prinsip-prinsip pembelajaran yang mendidik',
            'weight' => 10.0,
            'category' => 'B'
        ]);
        Criteria::create([
            'name_criteria' => 'Pengembangan Kurikulum',
            'weight' => 10.0,
            'category' => 'B'
        ]);
        Criteria::create([
            'name_criteria' => 'Kegiatan pembelajaran yang mendidik',
            'weight' => 5.0,
            'category' => 'B'
        ]);
        Criteria::create([
            'name_criteria' => 'Pengembangan potensi peserta didik',
            'weight' => 5.0,
            'category' => 'B'
        ]);
        Criteria::create([
            'name_criteria' => 'Komunikasi dengan peserta didik',
            'weight' => 5.0,
            'category' => 'B'
        ]);
        Criteria::create([
            'name_criteria' => 'Penilaian dan evaluasi',
            'weight' => 10.0,
            'category' => 'B'
        ]);
        Criteria::create([
            'name_criteria' => 'Bertindak sesuai dengan norma agama, hukum, sosial dan kebudayaan nasional',
            'weight' => 5.0,
            'category' => 'C'
        ]);
        Criteria::create([
            'name_criteria' => 'Menunjukkan pribadi yang dewasa dan teladan',
            'weight' => 5.0,
            'category' => 'B'
        ]);
        Criteria::create([
            'name_criteria' => 'Etos kerja, tanggung jawab tinggi, rasa bangga menjadi guru',
            'weight' => 10.0,
            'category' => 'B'
        ]);
        Criteria::create([
            'name_criteria' => 'Bersikap inklusif, bertindak obyektif, serta tidak diskriminatif',
            'weight' => 10.0,
            'category' => 'C'
        ]);
        Criteria::create([
            'name_criteria' => 'Bersikap inklusif, bertindak obyektif, serta tidak diskriminatif',
            'weight' => 10.0,
            'category' => 'C'
        ]);
        Criteria::create([
            'name_criteria' => 'Komunikasi dengan sesama guru, tenaga kependidikan, orang tua, peserta didik, dan masyarakat',
            'weight' => 5.0,
            'category' => 'C'
        ]);
        Criteria::create([
            'name_criteria' => 'Penguasaan materi, struktur, konsep dan pola pikir keilmuan yang mendukung mata pelajaran yang diampu',
            'weight' => 10.0,
            'category' => 'B'
        ]);
        Criteria::create([
            'name_criteria' => 'Mengembangkan keprofesionalan melalui tindakan yang reflektif',
            'weight' => 5.0,
            'category' => 'C'
        ]);
    }
}
