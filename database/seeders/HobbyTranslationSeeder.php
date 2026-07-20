<?php

namespace Database\Seeders;

use App\Models\Hobby;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HobbyTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $languages = Language::pluck('id', 'code');

        $translations = [
            'photography' => [
                'en' => [
                    'name' => 'Photography',
                    'description' => 'Capturing landscapes, people, and everyday moments through creative photography.',
                ],
                'pt' => [
                    'name' => 'Fotografia',
                    'description' => 'Registrar paisagens, pessoas e momentos do dia a dia através da fotografia.',
                ],
                'es' => [
                    'name' => 'Fotografía',
                    'description' => 'Capturar paisajes, personas y momentos cotidianos mediante la fotografía.',
                ],
                'de' => [
                    'name' => 'Fotografie',
                    'description' => 'Landschaften, Menschen und alltägliche Momente kreativ mit der Kamera festhalten.',
                ],
                'tr' => [
                    'name' => 'Fotoğrafçılık',
                    'description' => 'Manzaraları, insanları ve günlük anları yaratıcı bir şekilde fotoğraflamak.',
                ],
                'fa' => [
                    'name' => 'عکاسی',
                    'description' => 'ثبت مناظر، افراد و لحظات روزمره با نگاهی خلاقانه.',
                ],
                'ar' => [
                    'name' => 'التصوير',
                    'description' => 'التقاط المناظر الطبيعية والأشخاص واللحظات اليومية بطريقة إبداعية.',
                ],
            ],

            'gaming' => [
                'en' => [
                    'name' => 'Gaming',
                    'description' => 'Enjoying story-driven, strategy, and multiplayer games.',
                ],
                'pt' => [
                    'name' => 'Jogos',
                    'description' => 'Apreciar jogos com foco em história, estratégia e experiências multiplayer.',
                ],
                'es' => [
                    'name' => 'Videojuegos',
                    'description' => 'Disfrutar de juegos de historia, estrategia y multijugador.',
                ],
                'de' => [
                    'name' => 'Gaming',
                    'description' => 'Spaß an Story-, Strategie- und Multiplayer-Spielen.',
                ],
                'tr' => [
                    'name' => 'Oyun',
                    'description' => 'Hikâye odaklı, strateji ve çok oyunculu oyunlardan keyif almak.',
                ],
                'fa' => [
                    'name' => 'بازی‌های ویدیویی',
                    'description' => 'لذت بردن از بازی‌های داستان‌محور، استراتژیک و چندنفره.',
                ],
                'ar' => [
                    'name' => 'الألعاب',
                    'description' => 'الاستمتاع بالألعاب القصصية والاستراتيجية ومتعددة اللاعبين.',
                ],
            ],

            'reading' => [
                'en' => [
                    'name' => 'Reading',
                    'description' => 'Reading books about technology, psychology, and personal development.',
                ],
                'pt' => [
                    'name' => 'Leitura',
                    'description' => 'Leitura de livros sobre tecnologia, psicologia e desenvolvimento pessoal.',
                ],
                'es' => [
                    'name' => 'Lectura',
                    'description' => 'Lectura de libros sobre tecnología, psicología y desarrollo personal.',
                ],
                'de' => [
                    'name' => 'Lesen',
                    'description' => 'Lesen von Büchern über Technologie, Psychologie und Persönlichkeitsentwicklung.',
                ],
                'tr' => [
                    'name' => 'Kitap Okuma',
                    'description' => 'Teknoloji, psikoloji ve kişisel gelişim üzerine kitaplar okumak.',
                ],
                'fa' => [
                    'name' => 'مطالعه',
                    'description' => 'مطالعه کتاب‌های مرتبط با فناوری، روان‌شناسی و توسعه فردی.',
                ],
                'ar' => [
                    'name' => 'القراءة',
                    'description' => 'قراءة الكتب المتعلقة بالتقنية وعلم النفس وتطوير الذات.',
                ],
            ],

            'travel' => [
                'en' => [
                    'name' => 'Travel',
                    'description' => 'Exploring new cultures, cities, and natural landscapes.',
                ],
                'pt' => [
                    'name' => 'Viagens',
                    'description' => 'Explorar novas culturas, cidades e paisagens naturais.',
                ],
                'es' => [
                    'name' => 'Viajes',
                    'description' => 'Explorar nuevas culturas, ciudades y paisajes naturales.',
                ],
                'de' => [
                    'name' => 'Reisen',
                    'description' => 'Neue Kulturen, Städte und Naturlandschaften entdecken.',
                ],
                'tr' => [
                    'name' => 'Seyahat',
                    'description' => 'Yeni kültürleri, şehirleri ve doğal güzellikleri keşfetmek.',
                ],
                'fa' => [
                    'name' => 'سفر',
                    'description' => 'کشف فرهنگ‌ها، شهرها و مناظر طبیعی جدید.',
                ],
                'ar' => [
                    'name' => 'السفر',
                    'description' => 'استكشاف ثقافات ومدن ومناظر طبيعية جديدة.',
                ],
            ],
        ];

        foreach ($translations as $slug => $languagesData) {
            $hobby = Hobby::where('slug', $slug)->first();
            if (!$hobby) {
                continue;
            }

            foreach ($languagesData as $code => $data) {
                $hobby->translations()->updateOrCreate(
                    [
                        'language_id' => $languages[$code],
                    ],
                    $data
                );
            }
        }
    }
}
