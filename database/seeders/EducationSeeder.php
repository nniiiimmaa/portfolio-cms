<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Language;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $educations = [
            [
                'start_date' => '2019-01-01',
                'end_date' => '2020-12-31',
                'score' => 89.00,
                'verification_url' => null,
                'verification_id' => null,
                'current' => false,
                'order' => 1,
                'translations' => [
                    'en' => [
                        'institution' => 'Karamanoğlu Mehmetbey University',
                        'degree' => 'TÖMER Degree',
                        'field' => 'Turkish Language',
                        'location' => 'Karaman, Turkey',
                        'description' => 'Completed one year of Turkish language studies at Karamanoğlu Mehmetbey University, earning a TÖMER Turkish Language Certificate. Developed proficiency in reading, writing, listening, and speaking with a focus on both academic and everyday communication.',
                    ],
                    'pt' => [
                        'institution' => 'Universidade Karamanoğlu Mehmetbey',
                        'degree' => 'Certificado TÖMER',
                        'field' => 'Língua Turca',
                        'location' => 'Karaman, Turquia',
                        'description' => 'Concluí um ano de estudos de língua turca na Universidade Karamanoğlu Mehmetbey, obtendo o Certificado de Língua Turca TÖMER. Desenvolvi habilidades de leitura, escrita, compreensão auditiva e conversação com foco na comunicação acadêmica e cotidiana.',
                    ],
                    'es' => [
                        'institution' => 'Universidad Karamanoğlu Mehmetbey',
                        'degree' => 'Certificado TÖMER',
                        'field' => 'Idioma Turco',
                        'location' => 'Karaman, Turquía',
                        'description' => 'Completé un año de estudios de idioma turco en la Universidad Karamanoğlu Mehmetbey, obteniendo el Certificado de Lengua Turca TÖMER. Desarrollé habilidades de lectura, escritura, comprensión auditiva y expresión oral enfocadas en la comunicación académica y cotidiana.',
                    ],
                    'de' => [
                        'institution' => 'Karamanoğlu Mehmetbey Universität',
                        'degree' => 'TÖMER-Zertifikat',
                        'field' => 'Türkische Sprache',
                        'location' => 'Karaman, Türkei',
                        'description' => 'Ein einjähriges Türkischstudium an der Karamanoğlu Mehmetbey Universität wurde abgeschlossen und ein TÖMER-Türkischzertifikat erworben. Dabei wurden Lese-, Schreib-, Hör- und Sprechfähigkeiten für akademische und alltägliche Kommunikation entwickelt.',
                    ],
                    'tr' => [
                        'institution' => 'Karamanoğlu Mehmetbey Üniversitesi',
                        'degree' => 'TÖMER Sertifikası',
                        'field' => 'Türk Dili',
                        'location' => 'Karaman, Türkiye',
                        'description' => 'Karamanoğlu Mehmetbey Üniversitesi’nde bir yıl Türkçe eğitimi tamamlanarak TÖMER Türkçe Sertifikası alındı. Akademik ve günlük iletişim odaklı olarak okuma, yazma, dinleme ve konuşma becerileri geliştirildi.',
                    ],
                    'fa' => [
                        'institution' => 'دانشگاه کارامان اوغلو محمدبی',
                        'degree' => 'مدرک TÖMER',
                        'field' => 'زبان ترکی',
                        'location' => 'کارامان، ترکیه',
                        'description' => 'یک سال آموزش زبان ترکی در دانشگاه کارامان اوغلو محمدبی گذرانده شد و گواهینامه زبان ترکی TÖMER دریافت شد. مهارت‌های خواندن، نوشتن، شنیدن و صحبت کردن با تمرکز بر ارتباطات دانشگاهی و روزمره توسعه یافت.',
                    ],
                    'ar' => [
                        'institution' => 'جامعة كرمان أوغلو محمد بيه',
                        'degree' => 'شهادة TÖMER',
                        'field' => 'اللغة التركية',
                        'location' => 'كرمان، تركيا',
                        'description' => 'تم إكمال سنة واحدة من دراسة اللغة التركية في جامعة كرمان أوغلو محمد بيه والحصول على شهادة TÖMER. تم تطوير مهارات القراءة والكتابة والاستماع والتحدث مع التركيز على التواصل الأكاديمي واليومي.',
                    ],
                ],
            ],

            [
                'start_date' => '2020-01-01',
                'end_date' => '2021-12-31',
                'score' => null,
                'verification_url' => null,
                'verification_id' => null,
                'current' => false,
                'order' => 2,
                'translations' => [
                    'en' => [
                        'institution' => 'Akdeniz University',
                        'degree' => 'Goethe Preparation Degree',
                        'field' => 'German Language',
                        'location' => 'Antalya, Turkey',
                        'description' => 'Completed nine months of German language studies at Akdeniz University, covering Goethe-based Aspekte Neu A1, A2, and B1 levels. Developed foundational communication and grammar skills in reading, writing, listening, and speaking.',
                    ],
                    'pt' => [
                        'institution' => 'Universidade Akdeniz',
                        'degree' => 'Curso Preparatório Goethe',
                        'field' => 'Língua Alemã',
                        'location' => 'Antalya, Turquia',
                        'description' => 'Concluí nove meses de estudos de língua alemã na Universidade Akdeniz, abrangendo os níveis A1, A2 e B1 do material Aspekte Neu baseado no Goethe. Desenvolvi fundamentos de comunicação e gramática em leitura, escrita, audição e fala.',
                    ],
                    'es' => [
                        'institution' => 'Universidad Akdeniz',
                        'degree' => 'Preparación Goethe',
                        'field' => 'Idioma Alemán',
                        'location' => 'Antalya, Turquía',
                        'description' => 'Completé nueve meses de estudios de alemán en la Universidad Akdeniz, cubriendo los niveles A1, A2 y B1 del programa Aspekte Neu basado en Goethe. Desarrollé habilidades fundamentales de comunicación y gramática.',
                    ],
                    'de' => [
                        'institution' => 'Akdeniz Universität',
                        'degree' => 'Goethe-Vorbereitungskurs',
                        'field' => 'Deutsche Sprache',
                        'location' => 'Antalya, Türkei',
                        'description' => 'Neun Monate Deutschunterricht an der Akdeniz Universität wurden abgeschlossen. Der Kurs umfasste die Goethe-basierten Aspekte-Neu-Stufen A1, A2 und B1 mit Fokus auf grundlegende Kommunikations- und Grammatikfähigkeiten.',
                    ],
                    'tr' => [
                        'institution' => 'Akdeniz Üniversitesi',
                        'degree' => 'Goethe Hazırlık Eğitimi',
                        'field' => 'Almanca',
                        'location' => 'Antalya, Türkiye',
                        'description' => 'Akdeniz Üniversitesi’nde dokuz aylık Almanca eğitimi tamamlandı. Goethe tabanlı Aspekte Neu A1, A2 ve B1 seviyeleri çalışılarak okuma, yazma, dinleme ve konuşma becerileri geliştirildi.',
                    ],
                    'fa' => [
                        'institution' => 'دانشگاه آکدنیز',
                        'degree' => 'دوره آمادگی گوته',
                        'field' => 'زبان آلمانی',
                        'location' => 'آنتالیا، ترکیه',
                        'description' => 'نه ماه آموزش زبان آلمانی در دانشگاه آکدنیز گذرانده شد که شامل سطوح A1، A2 و B1 کتاب Aspekte Neu بر اساس استاندارد گوته بود. مهارت‌های پایه ارتباطی و گرامری در خواندن، نوشتن، شنیدن و صحبت کردن توسعه یافت.',
                    ],
                    'ar' => [
                        'institution' => 'جامعة أكدنيز',
                        'degree' => 'دورة تحضيرية لغوته',
                        'field' => 'اللغة الألمانية',
                        'location' => 'أنطاليا، تركيا',
                        'description' => 'تم إكمال تسعة أشهر من دراسة اللغة الألمانية في جامعة أكدنيز، بما يشمل مستويات Aspekte Neu A1 وA2 وB1 المعتمدة على منهج غوته، مع تطوير مهارات التواصل والقواعد الأساسية.',
                    ],
                ],
            ],
            [
                'start_date' => '2021-01-01',
                'end_date' => '2022-12-31',
                'score' => 3.64,
                'verification_url' => 'https://www.turkiye.gov.tr/belge-dogrulama?islem=dogrulama',
                'verification_id' => 'YOKTRES91R5DZ9RHHV',
                'current' => false,
                'order' => 3,
                'translations' => [
                    'en' => [
                        'institution' => 'Akdeniz University',
                        'degree' => 'Associate Degree',
                        'field' => 'Computer Programming',
                        'location' => 'Antalya, Turkey',
                        'description' => 'Completed three semesters of Computer Programming studies at Akdeniz University, earning 90 academic credits. The program focused on both front-end and back-end web development, covering software development fundamentals, programming concepts, databases, and modern web technologies.',
                    ],
                    'pt' => [
                        'institution' => 'Universidade Akdeniz',
                        'degree' => 'Curso Técnico Superior',
                        'field' => 'Programação de Computadores',
                        'location' => 'Antalya, Turquia',
                        'description' => 'Concluí três semestres de Programação de Computadores na Universidade Akdeniz, totalizando 90 créditos acadêmicos. O curso teve foco no desenvolvimento web front-end e back-end, abrangendo fundamentos de software, conceitos de programação, bancos de dados e tecnologias web modernas.',
                    ],
                    'es' => [
                        'institution' => 'Universidad Akdeniz',
                        'degree' => 'Grado Asociado',
                        'field' => 'Programación Informática',
                        'location' => 'Antalya, Turquía',
                        'description' => 'Completé tres semestres de estudios de Programación Informática en la Universidad Akdeniz, obteniendo 90 créditos académicos. El programa se enfocó en desarrollo web front-end y back-end, fundamentos de software, programación, bases de datos y tecnologías web modernas.',
                    ],
                    'de' => [
                        'institution' => 'Akdeniz Universität',
                        'degree' => 'Associate Degree',
                        'field' => 'Computerprogrammierung',
                        'location' => 'Antalya, Türkei',
                        'description' => 'Drei Semester Computerprogrammierung an der Akdeniz Universität wurden abgeschlossen und 90 akademische Credits erworben. Der Schwerpunkt lag auf Frontend- und Backend-Webentwicklung, Softwaregrundlagen, Programmierung, Datenbanken und modernen Webtechnologien.',
                    ],
                    'tr' => [
                        'institution' => 'Akdeniz Üniversitesi',
                        'degree' => 'Ön Lisans',
                        'field' => 'Bilgisayar Programcılığı',
                        'location' => 'Antalya, Türkiye',
                        'description' => 'Akdeniz Üniversitesi’nde üç dönem Bilgisayar Programcılığı eğitimi tamamlandı ve 90 akademik kredi kazanıldı. Eğitim sürecinde ön yüz ve arka yüz web geliştirme, yazılım temelleri, programlama, veritabanları ve modern web teknolojileri üzerine çalışıldı.',
                    ],
                    'fa' => [
                        'institution' => 'دانشگاه آکدنیز',
                        'degree' => 'مدرک کاردانی',
                        'field' => 'برنامه‌نویسی کامپیوتر',
                        'location' => 'آنتالیا، ترکیه',
                        'description' => 'سه ترم تحصیل در رشته برنامه‌نویسی کامپیوتر در دانشگاه آکدنیز به پایان رسید و ۹۰ واحد تحصیلی کسب شد. این دوره بر توسعه وب فرانت‌اند و بک‌اند، مفاهیم برنامه‌نویسی، پایگاه داده و فناوری‌های مدرن وب تمرکز داشت.',
                    ],
                    'ar' => [
                        'institution' => 'جامعة أكدنيز',
                        'degree' => 'درجة جامعية متوسطة',
                        'field' => 'برمجة الحاسوب',
                        'location' => 'أنطاليا، تركيا',
                        'description' => 'تم إكمال ثلاثة فصول دراسية في تخصص برمجة الحاسوب بجامعة أكدنيز والحصول على 90 ساعة أكاديمية. ركز البرنامج على تطوير الواجهات الأمامية والخلفية للويب، وأساسيات البرمجة، وقواعد البيانات وتقنيات الويب الحديثة.',
                    ],
                ],
            ],

            [
                'start_date' => '2020-06-01',
                'end_date' => '2022-06-01',
                'score' => 6.50,
                'verification_url' => null,
                'verification_id' => '20TR001652KHAA002A',
                'current' => false,
                'order' => 4,
                'translations' => [
                    'en' => [
                        'institution' => 'Cambridge University',
                        'degree' => 'IELTS',
                        'field' => 'English Language',
                        'location' => null,
                        'description' => 'Achieved an IELTS score of 6.5, corresponding to B2 level proficiency according to the Common European Framework of Reference for Languages (CEFR). Demonstrated English communication skills across reading, writing, listening, and speaking competencies.',
                    ],
                    'pt' => [
                        'institution' => 'Universidade de Cambridge',
                        'degree' => 'IELTS',
                        'field' => 'Língua Inglesa',
                        'location' => null,
                        'description' => 'Obtive a pontuação 6.5 no IELTS, correspondente ao nível B2 de acordo com o Quadro Europeu Comum de Referência para Línguas (QECR). Demonstrei habilidades de comunicação em inglês nas áreas de leitura, escrita, compreensão auditiva e fala.',
                    ],
                    'es' => [
                        'institution' => 'Universidad de Cambridge',
                        'degree' => 'IELTS',
                        'field' => 'Idioma Inglés',
                        'location' => null,
                        'description' => 'Obtuve una puntuación de 6.5 en IELTS, equivalente al nivel B2 según el Marco Común Europeo de Referencia para las Lenguas (MCER). Demostré habilidades de comunicación en inglés en lectura, escritura, comprensión auditiva y expresión oral.',
                    ],
                    'de' => [
                        'institution' => 'Universität Cambridge',
                        'degree' => 'IELTS',
                        'field' => 'Englische Sprache',
                        'location' => null,
                        'description' => 'Ein IELTS-Ergebnis von 6,5 wurde erreicht, entsprechend dem B2-Niveau des Gemeinsamen Europäischen Referenzrahmens für Sprachen. Nachgewiesene Fähigkeiten in Lesen, Schreiben, Hören und Sprechen.',
                    ],
                    'tr' => [
                        'institution' => 'Cambridge Üniversitesi',
                        'degree' => 'IELTS',
                        'field' => 'İngiliz Dili',
                        'location' => null,
                        'description' => 'Avrupa Ortak Dil Referans Çerçevesine göre B2 seviyesine karşılık gelen 6.5 IELTS puanı elde edildi. Okuma, yazma, dinleme ve konuşma alanlarında İngilizce iletişim becerileri gösterildi.',
                    ],
                    'fa' => [
                        'institution' => 'دانشگاه کمبریج',
                        'degree' => 'IELTS',
                        'field' => 'زبان انگلیسی',
                        'location' => null,
                        'description' => 'نمره ۶.۵ در آزمون IELTS کسب شد که مطابق با سطح B2 در چارچوب مشترک اروپایی مرجع زبان‌ها است. مهارت‌های ارتباطی زبان انگلیسی در خواندن، نوشتن، شنیدن و صحبت کردن ارزیابی شد.',
                    ],
                    'ar' => [
                        'institution' => 'جامعة كامبريدج',
                        'degree' => 'IELTS',
                        'field' => 'اللغة الإنجليزية',
                        'location' => null,
                        'description' => 'تم الحصول على درجة 6.5 في اختبار IELTS، والتي تعادل مستوى B2 وفقاً للإطار الأوروبي المرجعي المشترك للغات. تم إثبات مهارات التواصل باللغة الإنجليزية في القراءة والكتابة والاستماع والتحدث.',
                    ],
                ],
            ],
            [
                'start_date' => '2024-01-01',
                'end_date' => null,
                'score' => null,
                'verification_url' => null,
                'verification_id' => null,
                'current' => true,
                'order' => 5,
                'translations' => [
                    'en' => [
                        'institution' => 'IAP',
                        'degree' => 'Bachelor Degree',
                        'field' => 'Psychology',
                        'location' => 'Brazil',
                        'description' => 'Currently pursuing a Psychology degree at IAP, developing knowledge in human behavior, cognitive processes, social interaction, and psychological assessment. The program combines theoretical foundations with practical experiences, strengthening analytical skills, communication abilities, and understanding of human development.',
                    ],
                    'pt' => [
                        'institution' => 'IAP',
                        'degree' => 'Graduação',
                        'field' => 'Psicologia',
                        'location' => 'Brasil',
                        'description' => 'Atualmente cursando Psicologia no IAP, desenvolvendo conhecimentos sobre comportamento humano, processos cognitivos, interação social e avaliação psicológica. O curso combina fundamentos teóricos com experiências práticas, fortalecendo habilidades analíticas, comunicação e compreensão do desenvolvimento humano.',
                    ],
                    'es' => [
                        'institution' => 'IAP',
                        'degree' => 'Licenciatura',
                        'field' => 'Psicología',
                        'location' => 'Brasil',
                        'description' => 'Actualmente cursando Psicología en IAP, desarrollando conocimientos sobre comportamiento humano, procesos cognitivos, interacción social y evaluación psicológica. El programa combina fundamentos teóricos con experiencias prácticas para fortalecer habilidades analíticas y de comunicación.',
                    ],
                    'de' => [
                        'institution' => 'IAP',
                        'degree' => 'Bachelorstudium',
                        'field' => 'Psychologie',
                        'location' => 'Brasilien',
                        'description' => 'Derzeit Studium der Psychologie am IAP mit Schwerpunkt auf menschlichem Verhalten, kognitiven Prozessen, sozialen Interaktionen und psychologischer Bewertung. Das Studium verbindet theoretische Grundlagen mit praktischen Erfahrungen.',
                    ],
                    'tr' => [
                        'institution' => 'IAP',
                        'degree' => 'Lisans Eğitimi',
                        'field' => 'Psikoloji',
                        'location' => 'Brezilya',
                        'description' => 'Şu anda IAP bünyesinde Psikoloji eğitimi almaktayım. İnsan davranışı, bilişsel süreçler, sosyal etkileşim ve psikolojik değerlendirme alanlarında bilgi geliştiriyorum.',
                    ],
                    'fa' => [
                        'institution' => 'IAP',
                        'degree' => 'مقطع کارشناسی',
                        'field' => 'روانشناسی',
                        'location' => 'برزیل',
                        'description' => 'در حال حاضر در رشته روانشناسی در IAP تحصیل می‌کنم و دانش خود را در زمینه رفتار انسان، فرآیندهای شناختی، تعاملات اجتماعی و ارزیابی روانشناختی توسعه می‌دهم.',
                    ],
                    'ar' => [
                        'institution' => 'IAP',
                        'degree' => 'درجة البكالوريوس',
                        'field' => 'علم النفس',
                        'location' => 'البرازيل',
                        'description' => 'أتابع حالياً دراسة علم النفس في IAP، مع تطوير المعرفة في السلوك الإنساني والعمليات المعرفية والتفاعل الاجتماعي والتقييم النفسي.',
                    ],
                ],
            ],

            [
                'start_date' => '2025-01-01',
                'end_date' => null,
                'score' => null,
                'verification_url' => null,
                'verification_id' => null,
                'current' => true,
                'order' => 6,
                'translations' => [
                    'en' => [
                        'institution' => 'IAP',
                        'degree' => 'Associate Degree',
                        'field' => 'Programming',
                        'location' => 'Brazil',
                        'description' => 'Currently pursuing a Programming Associate Degree at IAP, focusing on software development, algorithms, databases, and modern web technologies. The program strengthens practical programming skills and provides a foundation for building scalable software solutions.',
                    ],
                    'pt' => [
                        'institution' => 'IAP',
                        'degree' => 'Curso Técnico / Tecnólogo',
                        'field' => 'Programação',
                        'location' => 'Brasil',
                        'description' => 'Atualmente cursando Programação no IAP, com foco em de desenvolvimento de software, algoritmos, bancos de dados e tecnologias web modernas. O curso fortalece habilidades práticas de programação e a criação de soluções escaláveis.',
                    ],
                    'es' => [
                        'institution' => 'IAP',
                        'degree' => 'Grado Asociado',
                        'field' => 'Programación',
                        'location' => 'Brasil',
                        'description' => 'Actualmente cursando Programación en IAP, con enfoque en de desarrollo de software, algoritmos, bases de datos y tecnologías web modernas.',
                    ],
                    'de' => [
                        'institution' => 'IAP',
                        'degree' => 'Associate Degree',
                        'field' => 'Programmierung',
                        'location' => 'Brasilien',
                        'description' => 'Derzeit Studium im Bereich Programmierung am IAP mit Fokus auf Softwareentwicklung, Algorithmen, Datenbanken und moderne Webtechnologien.',
                    ],
                    'tr' => [
                        'institution' => 'IAP',
                        'degree' => 'Ön Lisans',
                        'field' => 'Programlama',
                        'location' => 'Brezilya',
                        'description' => 'IAP bünyesinde Programlama eğitimi devam etmektedir. Yazılım geliştirme, algoritmalar, veritabanları ve modern web teknolojileri üzerine çalışılmaktadır.',
                    ],
                    'fa' => [
                        'institution' => 'IAP',
                        'degree' => 'مدرک کاردانی',
                        'field' => 'برنامه‌نویسی',
                        'location' => 'برزیل',
                        'description' => 'در حال حاضر در رشته برنامه‌نویسی در IAP تحصیل می‌کنم و بر توسعه نرم‌افزار، الگوریتم‌ها، پایگاه داده‌ها و فناوری‌های مدرن وب تمرکز دارم.',
                    ],
                    'ar' => [
                        'institution' => 'IAP',
                        'degree' => 'درجة جامعية متوسطة',
                        'field' => 'البرمجة',
                        'location' => 'البرازيل',
                        'description' => 'أدرس حالياً البرمجة في IAP مع التركيز على أساسيات تطوير البرمجيات والخوارزميات وقواعد البيانات وتقنيات الويب الحديثة.',
                    ],
                ],
            ],
        ];

        foreach ($educations as $education) {
            $translations = $education['translations'];

            unset($education['translations']);

            $item = Education::updateOrCreate(
                [
                    'start_date' => $education['start_date'],
                    'order' => $education['order'],
                ],
                $education
            );

            foreach ($translations as $locale => $translation) {
                $language = Language::where('code', $locale)->first();

                if (! $language) {
                    continue;
                }

                $item->translations()->updateOrCreate(
                    [
                        'language_id' => $language->id,
                    ],
                    $translation
                );
            }
        }

    }
}
