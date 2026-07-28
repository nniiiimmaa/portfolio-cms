<?php

namespace Database\Seeders;

use App\Models\Hobby;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobbies = [
            [
                'slug' => 'traveling',
                'icon' => 'travel',
                'featured' => true,
                'order' => 1,
                'translations' => [
                    'en' => [
                        'name' => 'Traveling',
                        'description' => 'Passionate about exploring new cultures, cuisines, traditions, and landscapes through travel. Experiences across five countries on three continents have broadened cultural awareness and adaptability.',
                    ],
                    'pt' => [
                        'name' => 'Viagens',
                        'description' => 'Apaixonado por explorar novas culturas, gastronomias, tradições e paisagens por meio de viagens. Experiências em cinco países distribuídos por três continentes ampliaram minha visão cultural e capacidade de adaptação.',
                    ],
                    'es' => [
                        'name' => 'Viajes',
                        'description' => 'Apasionado por explorar nuevas culturas, gastronomías, tradiciones y paisajes a través de los viajes. Las experiencias en cinco países de tres continentes han ampliado mi conciencia cultural y capacidad de adaptación.',
                    ],
                    'de' => [
                        'name' => 'Reisen',
                        'description' => 'Leidenschaft für das Entdecken neuer Kulturen, Küchen, Traditionen und Landschaften durch Reisen. Erfahrungen in fünf Ländern auf drei Kontinenten haben mein kulturelles Verständnis und meine Anpassungsfähigkeit erweitert.',
                    ],
                    'tr' => [
                        'name' => 'Seyahat',
                        'description' => 'Seyahat ederek yeni kültürleri, mutfakları, gelenekleri ve doğal güzellikleri keşfetmekten keyif alıyorum. Üç kıtada beş farklı ülkede edindiğim deneyimler kültürel farkındalığımı ve uyum yeteneğimi geliştirdi.',
                    ],
                    'fa' => [
                        'name' => 'سفر',
                        'description' => 'علاقه‌مند به کشف فرهنگ‌ها، غذاها، سنت‌ها و مناظر طبیعی جدید از طریق سفر هستم. تجربه سفر به پنج کشور در سه قاره، دیدگاه فرهنگی و توانایی سازگاری مرا گسترش داده است.',
                    ],
                    'ar' => [
                        'name' => 'السفر',
                        'description' => 'شغوف باستكشاف الثقافات والمأكولات والتقاليد والمناظر الطبيعية الجديدة من خلال السفر. ساهمت التجارب في خمس دول عبر ثلاث قارات في توسيع الوعي الثقافي وتعزيز القدرة على التكيف.',
                    ],
                ],
            ],
            [
                'slug' => 'drone',
                'icon' => 'drone',
                'featured' => false,
                'order' => 2,
                'translations' => [
                    'en' => [
                        'name' => 'Drone',
                        'description' => 'Enjoy aerial photography and videography using drones, capturing landscapes, architecture, nature, and unique perspectives from above.',
                    ],
                    'pt' => [
                        'name' => 'Fotografia e Videografia com Drone',
                        'description' => 'Gosto de produzir fotografias e vídeos aéreos com drones, registrando paisagens, arquitetura, natureza e perspectivas únicas vistas do alto.',
                    ],
                    'es' => [
                        'name' => 'Fotografía y Videografía con Dron',
                        'description' => 'Disfruto realizando fotografía y videografía aérea con drones, capturando paisajes, arquitectura, naturaleza y perspectivas únicas desde las alturas.',
                    ],
                    'de' => [
                        'name' => 'Drohnenfotografie und -Videografie',
                        'description' => 'Ich fotografiere und filme gerne mit Drohnen und halte Landschaften, Architektur, Natur und einzigartige Perspektiven aus der Luft fest.',
                    ],
                    'tr' => [
                        'name' => 'Drone Fotoğrafçılığı ve Videografi',
                        'description' => 'Drone kullanarak havadan fotoğraf ve video çekmeyi; manzaraları, mimari yapıları, doğayı ve benzersiz açılardan görüntüler yakalamayı seviyorum.',
                    ],
                    'fa' => [
                        'name' => 'عکاسی و فیلم‌برداری با پهپاد',
                        'description' => 'از عکاسی و فیلم‌برداری هوایی با استفاده از پهپاد لذت می‌برم و مناظر طبیعی، معماری و چشم‌اندازهای منحصربه‌فرد را از زاویه‌ای متفاوت ثبت می‌کنم.',
                    ],
                    'ar' => [
                        'name' => 'التصوير الفوتوغرافي وتصوير الفيديو بالطائرات المسيّرة',
                        'description' => 'أستمتع بالتصوير الجوي الفوتوغرافي وتصوير الفيديو باستخدام الطائرات المسيّرة، مع التركيز على المناظر الطبيعية والهندسة المعمارية والطبيعة والزوايا الفريدة من الأعلى.',
                    ],
                ],
            ],
            [
                'slug' => 'volleyball',
                'icon' => 'sports_volleyball',
                'featured' => false,
                'order' => 3,
                'translations' => [
                    'en' => [
                        'name' => 'Volleyball',
                        'description' => 'Regularly participate in volleyball through recreational matches, local leagues, and tournaments, developing teamwork, communication, discipline, and strategic decision-making.',
                    ],
                    'pt' => [
                        'name' => 'Voleibol',
                        'description' => 'Participo regularmente de partidas recreativas, ligas locais e torneios de voleibol, desenvolvendo trabalho em equipe, comunicação, disciplina e tomada de decisões estratégicas.',
                    ],
                    'es' => [
                        'name' => 'Voleibol',
                        'description' => 'Participo regularmente en partidos recreativos, ligas locales y torneos de voleibol, desarrollando trabajo en equipo, comunicación, disciplina y toma de decisiones estratégicas.',
                    ],
                    'de' => [
                        'name' => 'Volleyball',
                        'description' => 'Ich spiele regelmäßig Volleyball in Freizeitspielen, lokalen Ligen und Turnieren und fördere dabei Teamarbeit, Kommunikation, Disziplin und strategisches Denken.',
                    ],
                    'tr' => [
                        'name' => 'Voleybol',
                        'description' => 'Takım çalışması, iletişim, disiplin ve stratejik karar verme becerilerini geliştirmek amacıyla düzenli olarak voleybol maçlarına, yerel liglere ve turnuvalara katılıyorum.',
                    ],
                    'fa' => [
                        'name' => 'والیبال',
                        'description' => 'به‌صورت منظم در مسابقات دوستانه، لیگ‌های محلی و تورنمنت‌های والیبال شرکت می‌کنم و از این طریق مهارت‌های کار تیمی، ارتباط مؤثر، نظم و تصمیم‌گیری راهبردی را تقویت می‌کنم.',
                    ],
                    'ar' => [
                        'name' => 'الكرة الطائرة',
                        'description' => 'أشارك بانتظام في مباريات الكرة الطائرة الترفيهية والدوريات المحلية والبطولات، مما يساهم في تطوير العمل الجماعي والتواصل والانضباط واتخاذ القرارات الاستراتيجية.',
                    ],
                ],
            ],
            [
                'slug' => 'psychology',
                'icon' => 'psychology',
                'featured' => false,
                'order' => 4,
                'translations' => [
                    'en' => [
                        'name' => 'Psychology',
                        'description' => 'Passionate about psychology, cognitive science, philosophy, and human behavior, with ongoing academic studies focused on understanding cognition, learning, emotions, personality, and decision-making.',
                    ],
                    'pt' => [
                        'name' => 'Psicologia',
                        'description' => 'Apaixonado por psicologia, ciência cognitiva, filosofia e comportamento humano, com estudos acadêmicos em andamento voltados à compreensão da cognição, aprendizagem, emoções, personalidade e tomada de decisões.',
                    ],
                    'es' => [
                        'name' => 'Psicología',
                        'description' => 'Apasionado por la psicología, la ciencia cognitiva, la filosofía y el comportamiento humano, con estudios académicos en curso centrados en comprender la cognición, el aprendizaje, las emociones, la personalidad y la toma de decisiones.',
                    ],
                    'de' => [
                        'name' => 'Psychologie',
                        'description' => 'Leidenschaft für Psychologie, Kognitionswissenschaft, Philosophie und menschliches Verhalten, ergänzt durch ein laufendes Studium mit Schwerpunkt auf Kognition, Lernen, Emotionen, Persönlichkeit und Entscheidungsfindung.',
                    ],
                    'tr' => [
                        'name' => 'Psikoloji',
                        'description' => 'Psikoloji, bilişsel bilim, felsefe ve insan davranışlarına büyük ilgi duyuyorum. Devam eden akademik çalışmalarım biliş, öğrenme, duygular, kişilik ve karar verme süreçlerini anlamaya odaklanmaktadır.',
                    ],
                    'fa' => [
                        'name' => 'روان‌شناسی',
                        'description' => 'علاقه‌مند به روان‌شناسی، علوم شناختی، فلسفه و رفتار انسان هستم و در حال ادامه تحصیلات دانشگاهی با تمرکز بر شناخت، یادگیری، هیجانات، شخصیت و فرایندهای تصمیم‌گیری می‌باشم.',
                    ],
                    'ar' => [
                        'name' => 'علم النفس',
                        'description' => 'شغوف بعلم النفس والعلوم المعرفية والفلسفة والسلوك الإنساني، مع دراسة أكاديمية مستمرة تركز على فهم الإدراك والتعلم والعواطف والشخصية واتخاذ القرار.',
                    ],
                ],
            ],
            [
                'slug' => 'language-learning',
                'icon' => 'translate',
                'featured' => true,
                'order' => 5,
                'translations' => [
                    'en' => [
                        'name' => 'Language Learning',
                        'description' => 'Passionate about learning new languages and exploring different cultures. Professional proficiency has been developed in Persian, English, Turkish, and Portuguese, while continuing to study German and planning future learning in Spanish and Arabic.',
                    ],
                    'pt' => [
                        'name' => 'Aprendizado de Idiomas',
                        'description' => 'Apaixonado por aprender novos idiomas e explorar diferentes culturas. Desenvolvi proficiência profissional em persa, inglês, turco e português, enquanto continuo estudando alemão e planejo aprender espanhol e árabe futuramente.',
                    ],
                    'es' => [
                        'name' => 'Aprendizaje de Idiomas',
                        'description' => 'Apasionado por aprender nuevos idiomas y explorar diferentes culturas. He desarrollado competencia profesional en persa, inglés, turco y portugués, mientras continúo estudiando alemán y planeo aprender español y árabe en el futuro.',
                    ],
                    'de' => [
                        'name' => 'Sprachen Lernen',
                        'description' => 'Leidenschaft für das Erlernen neuer Sprachen und das Entdecken verschiedener Kulturen. Berufliche Sprachkenntnisse wurden in Persisch, Englisch, Türkisch und Portugiesisch entwickelt, während ich weiterhin Deutsch lerne und künftig Spanisch und Arabisch erlernen möchte.',
                    ],
                    'tr' => [
                        'name' => 'Dil Öğrenimi',
                        'description' => 'Yeni diller öğrenmeye ve farklı kültürleri keşfetmeye büyük ilgi duyuyorum. Farsça, İngilizce, Türkçe ve Portekizcede profesyonel yeterlilik kazandım; Almanca öğrenmeye devam ediyor, gelecekte ise İspanyolca ve Arapça öğrenmeyi planlıyorum.',
                    ],
                    'fa' => [
                        'name' => 'یادگیری زبان‌ها',
                        'description' => 'علاقه زیادی به یادگیری زبان‌های جدید و آشنایی با فرهنگ‌های مختلف دارم. در زبان‌های فارسی، انگلیسی، ترکی و پرتغالی به سطح حرفه‌ای رسیده‌ام، همچنان در حال یادگیری آلمانی هستم و قصد دارم در آینده اسپانیایی و عربی را نیز بیاموزم.',
                    ],
                    'ar' => [
                        'name' => 'تعلم اللغات',
                        'description' => 'شغوف بتعلم اللغات الجديدة واستكشاف الثقافات المختلفة. طورت مستوى احترافيًا في الفارسية والإنجليزية والتركية والبرتغالية، وأواصل دراسة الألمانية مع التخطيط لتعلم الإسبانية والعربية مستقبلًا.',
                    ],
                ],
            ],
            [
                'slug' => 'persian-history',
                'icon' => 'mosque',
                'featured' => false,
                'order' => 6,
                'translations' => [
                    'en' => [
                        'name' => 'Persian History',
                        'description' => 'Passionate about the history of ancient Persia, its civilizations, empires, and cultural heritage, with particular interest in Zoroastrianism and its influence on Persian philosophy, identity, and the development of early civilizations.',
                    ],
                    'pt' => [
                        'name' => 'História da Pérsia',
                        'description' => 'Apaixonado pela história da antiga Pérsia, suas civilizações, impérios e patrimônio cultural, com interesse especial no Zoroastrismo e em sua influência sobre a filosofia, a identidade persa e o desenvolvimento das primeiras civilizações.',
                    ],
                    'es' => [
                        'name' => 'Historia de Persia',
                        'description' => 'Apasionado por la historia de la antigua Persia, sus civilizaciones, imperios y patrimonio cultural, con especial interés en el zoroastrismo y su influencia en la filosofía, la identidad persa y el desarrollo de las primeras civilizaciones.',
                    ],
                    'de' => [
                        'name' => 'Persische Geschichte',
                        'description' => 'Leidenschaft für die Geschichte des antiken Persiens, seiner Zivilisationen, Reiche und seines kulturellen Erbes, mit besonderem Interesse am Zoroastrismus und seinem Einfluss auf die persische Philosophie, Identität und die Entwicklung früher Zivilisationen.',
                    ],
                    'tr' => [
                        'name' => 'Pers Tarihi',
                        'description' => 'Antik Pers tarihi, uygarlıkları, imparatorlukları ve kültürel mirasıyla yakından ilgileniyorum. Özellikle Zerdüştlük ve onun Pers felsefesi, kimliği ve ilk uygarlıkların gelişimi üzerindeki etkisini araştırmayı seviyorum.',
                    ],
                    'fa' => [
                        'name' => 'تاریخ ایران باستان',
                        'description' => 'علاقه‌مند به تاریخ ایران باستان، تمدن‌ها، امپراتوری‌ها و میراث فرهنگی آن هستم و به‌ویژه به آیین زرتشت و تأثیر آن بر فلسفه، هویت ایرانی و شکل‌گیری تمدن‌های نخستین علاقه دارم.',
                    ],
                    'ar' => [
                        'name' => 'تاريخ فارس',
                        'description' => 'شغوف بتاريخ بلاد فارس القديمة وحضاراتها وإمبراطورياتها وتراثها الثقافي، مع اهتمام خاص بالزرادشتية وتأثيرها في الفلسفة والهوية الفارسية وتطور الحضارات المبكرة.',
                    ],
                ],
            ],
            [
                'slug' => 'strategy-games',
                'icon' => 'sports_esports',
                'featured' => false,
                'order' => 7,
                'translations' => [
                    'en' => [
                        'name' => 'Strategy Games',
                        'description' => 'Enjoy playing historically inspired real-time strategy games such as Age of Empires and Age of Mythology, appreciating their blend of strategic planning, resource management, historical settings, and tactical decision-making.',
                    ],
                    'pt' => [
                        'name' => 'Jogos de Estratégia',
                        'description' => 'Gosto de jogar jogos de estratégia em tempo real inspirados na história, como Age of Empires e Age of Mythology, valorizando a combinação de planejamento estratégico, gerenciamento de recursos, cenários históricos e tomada de decisões táticas.',
                    ],
                    'es' => [
                        'name' => 'Juegos de Estrategia',
                        'description' => 'Disfruto jugando juegos de estrategia en tiempo real inspirados en la historia, como Age of Empires y Age of Mythology, apreciando su combinación de planificación estratégica, gestión de recursos, escenarios históricos y toma de decisiones tácticas.',
                    ],
                    'de' => [
                        'name' => 'Strategiespiele',
                        'description' => 'Ich spiele gerne historisch inspirierte Echtzeit-Strategiespiele wie Age of Empires und Age of Mythology und schätze die Kombination aus strategischer Planung, Ressourcenmanagement, historischen Schauplätzen und taktischen Entscheidungen.',
                    ],
                    'tr' => [
                        'name' => 'Strateji Oyunları',
                        'description' => 'Age of Empires ve Age of Mythology gibi tarihten ilham alan gerçek zamanlı strateji oyunlarını oynamaktan keyif alıyorum. Bu oyunların stratejik planlama, kaynak yönetimi, tarihî atmosfer ve taktiksel karar verme unsurlarını özellikle seviyorum.',
                    ],
                    'fa' => [
                        'name' => 'بازی‌های استراتژیک',
                        'description' => 'از انجام بازی‌های استراتژی هم‌زمان با محوریت تاریخ، مانند Age of Empires و Age of Mythology، لذت می‌برم و ترکیب برنامه‌ریزی راهبردی، مدیریت منابع، فضای تاریخی و تصمیم‌گیری تاکتیکی را ارزشمند می‌دانم.',
                    ],
                    'ar' => [
                        'name' => 'ألعاب الإستراتيجية',
                        'description' => 'أستمتع بلعب ألعاب الإستراتيجية الفورية المستوحاة من التاريخ مثل Age of Empires وAge of Mythology، لما تجمعه من التخطيط الإستراتيجي وإدارة الموارد والأجواء التاريخية واتخاذ القرارات التكتيكية.',
                    ],
                ],
            ],
            [
                'slug' => 'ai-animation',
                'icon' => 'animation',
                'featured' => false,
                'order' => 8,
                'translations' => [
                    'en' => [
                        'name' => 'AI Animation',
                        'description' => 'Enjoy creating AI-assisted animations and cinematic visual content using Google Flow, exploring storytelling, scene composition, visual effects, and emerging generative AI technologies.',
                    ],
                    'pt' => [
                        'name' => 'Animação com IA',
                        'description' => 'Gosto de criar animações assistidas por IA e conteúdo visual cinematográfico utilizando o Google Flow, explorando narrativa, composição de cenas, efeitos visuais e tecnologias emergentes de IA generativa.',
                    ],
                    'es' => [
                        'name' => 'Animación con IA',
                        'description' => 'Disfruto creando animaciones asistidas por IA y contenido visual cinematográfico utilizando Google Flow, explorando la narrativa, la composición de escenas, los efectos visuales y las tecnologías emergentes de IA generativa.',
                    ],
                    'de' => [
                        'name' => 'KI-Animation',
                        'description' => 'Ich erstelle gerne KI-gestützte Animationen und filmische visuelle Inhalte mit Google Flow und beschäftige mich dabei mit Storytelling, Szenenkomposition, visuellen Effekten und modernen generativen KI-Technologien.',
                    ],
                    'tr' => [
                        'name' => 'Yapay Zekâ Animasyonu',
                        'description' => 'Google Flow kullanarak yapay zekâ destekli animasyonlar ve sinematik görsel içerikler üretmekten keyif alıyorum. Hikâye anlatımı, sahne kompozisyonu, görsel efektler ve üretken yapay zekâ teknolojilerini keşfediyorum.',
                    ],
                    'fa' => [
                        'name' => 'انیمیشن با هوش مصنوعی',
                        'description' => 'از تولید انیمیشن‌های مبتنی بر هوش مصنوعی و محتوای تصویری سینمایی با استفاده از Google Flow لذت می‌برم و به داستان‌سرایی، ترکیب‌بندی صحنه‌ها، جلوه‌های بصری و فناوری‌های نوین هوش مصنوعی مولد علاقه‌مند هستم.',
                    ],
                    'ar' => [
                        'name' => 'الرسوم المتحركة بالذكاء الاصطناعي',
                        'description' => 'أستمتع بإنشاء الرسوم المتحركة والمحتوى البصري السينمائي بمساعدة الذكاء الاصطناعي باستخدام Google Flow، مع استكشاف السرد القصصي وتكوين المشاهد والمؤثرات البصرية وتقنيات الذكاء الاصطناعي التوليدي الحديثة.',
                    ],
                ],
            ],

            [
                'slug' => 'adventure-sports',
                'icon' => 'paragliding',
                'featured' => true,
                'order' => 9,
                'translations' => [
                    'en' => [
                        'name' => 'Adventure Sports',
                        'description' => 'Passionate about experiencing adrenaline-filled activities and exploring new challenges through adventure sports, including paragliding, skydiving, parasailing, scuba diving, skiing, bungee jumping, karting, ATV riding, and other outdoor experiences.',
                    ],
                    'pt' => [
                        'name' => 'Esportes de Aventura',
                        'description' => 'Apaixonado por experiências cheias de adrenalina e novos desafios por meio de esportes de aventura, incluindo parapente, paraquedismo, parasailing, mergulho, esqui, salto de bungee jump, kart, passeios de ATV e outras atividades ao ar livre.',
                    ],
                    'es' => [
                        'name' => 'Deportes de Aventura',
                        'description' => 'Apasionado por experiencias llenas de adrenalina y nuevos desafíos a través de deportes de aventura, incluyendo parapente, paracaidismo, parasailing, buceo, esquí, puenting, karting, conducción de ATV y otras actividades al aire libre.',
                    ],
                    'de' => [
                        'name' => 'Abenteuersport',
                        'description' => 'Begeistert von aufregenden Aktivitäten und neuen Herausforderungen durch Abenteuersportarten wie Gleitschirmfliegen, Fallschirmspringen, Parasailing, Tauchen, Skifahren, Bungee-Jumping, Kartfahren, ATV-Fahren und andere Outdoor-Erlebnisse.',
                    ],
                    'tr' => [
                        'name' => 'Macera Sporları',
                        'description' => 'Yamaç paraşütü, paraşütle atlama, parasailing, dalış, kayak, bungee jumping, karting, ATV sürüşü ve diğer açık hava aktiviteleri dahil olmak üzere macera sporlarıyla yeni deneyimler ve heyecan verici zorluklar yaşamaktan keyif alıyorum.',
                    ],
                    'fa' => [
                        'name' => 'ورزش‌های ماجراجویانه',
                        'description' => 'علاقه‌مند به تجربه فعالیت‌های هیجان‌انگیز و چالش‌های جدید از طریق ورزش‌های ماجراجویانه مانند پاراگلایدر، سقوط آزاد، پاراسل، غواصی، اسکی، بانجی جامپینگ، کارتینگ، موتور چهارچرخ و دیگر فعالیت‌های فضای باز هستم.',
                    ],
                    'ar' => [
                        'name' => 'رياضات المغامرة',
                        'description' => 'شغوف بتجربة الأنشطة المليئة بالإثارة والتحديات الجديدة من خلال رياضات المغامرة مثل الطيران الشراعي، القفز بالمظلات، الباراسيل، الغوص، التزلج، القفز بالحبال، سباقات الكارت، قيادة مركبات الدفع الرباعي وغيرها من الأنشطة الخارجية.',
                    ],
                ],
            ],
        ];

        foreach ($hobbies as $item) {

            $translations = $item['translations'];
            unset($item['translations']);

            $hobby = Hobby::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );

            foreach ($translations as $locale => $data) {

                $language = Language::where('code', $locale)->first();

                if (! $language) {
                    continue;
                }

                $hobby->translations()->updateOrCreate(
                    ['language_id' => $language->id],
                    $data
                );
            }
        }
    }
}
