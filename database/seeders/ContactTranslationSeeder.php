<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact = Contact::first();
 
        if (!$contact) {
            return;
        }

        $languages = Language::pluck('id', 'code');

        $translations = [
            'en' => [
                'description' => 'Feel free to contact me for collaboration opportunities, projects, or any questions.',
                'address' => '123 Main Street',
                'city' => 'New York',
                'state' => 'New York',
                'country' => 'United States',
                'postal_code' => '10001',
                'working_hours' => 'Monday - Friday, 09:00 - 18:00',
            ],
            'pt' => [
                'description' => 'Sinta-se à vontade para entrar em contato comigo para oportunidades de colaboração, projetos ou dúvidas.',
                'address' => 'Rua Principal, 123',
                'city' => 'São Paulo',
                'state' => 'São Paulo',
                'country' => 'Brasil',
                'postal_code' => '01000-000',
                'working_hours' => 'Segunda - Sexta, 09:00 - 18:00',
            ],
            'es' => [
                'description' => 'No dudes en contactarme para oportunidades de colaboración, proyectos o cualquier consulta.',
                'address' => 'Calle Principal, 123',
                'city' => 'Madrid',
                'state' => 'Madrid',
                'country' => 'España',
                'postal_code' => '28001',
                'working_hours' => 'Lunes - Viernes, 09:00 - 18:00',
            ],
            'de' => [
                'description' => 'Kontaktieren Sie mich gerne für Zusammenarbeit, Projekte oder Fragen.',
                'address' => 'Hauptstraße 123',
                'city' => 'Berlin',
                'state' => 'Berlin',
                'country' => 'Deutschland',
                'postal_code' => '10115',
                'working_hours' => 'Montag - Freitag, 09:00 - 18:00',
            ],
            'tr' => [
                'description' => 'İş birlikleri, projeler veya sorularınız için benimle iletişime geçebilirsiniz.',
                'address' => 'Ana Cadde 123',
                'city' => 'İstanbul',
                'state' => 'İstanbul',
                'country' => 'Türkiye',
                'postal_code' => '34000',
                'working_hours' => 'Pazartesi - Cuma, 09:00 - 18:00',
            ],
            'fa' => [
                'description' => 'برای همکاری، پروژه‌ها یا هرگونه سوال می‌توانید با من در ارتباط باشید.',
                'address' => 'خیابان اصلی، پلاک ۱۲۳',
                'city' => 'تهران',
                'state' => 'تهران',
                'country' => 'ایران',
                'postal_code' => '۱۰۰۰۰',
                'working_hours' => 'شنبه - چهارشنبه، ۰۹:۰۰ - ۱۸:۰۰',
            ],
            'ar' => [
                'description' => 'يمكنك التواصل معي من أجل فرص التعاون أو المشاريع أو أي استفسارات.',
                'address' => 'الشارع الرئيسي 123',
                'city' => 'دبي',
                'state' => 'دبي',
                'country' => 'الإمارات العربية المتحدة',
                'postal_code' => '00000',
                'working_hours' => 'الإثنين - الجمعة، 09:00 - 18:00',
            ],
        ];

        foreach ($translations as $code => $data) {
            $contact->translations()->updateOrCreate(
                [
                    'language_id' => $languages[$code],
                ],
                $data
            );
        }
    }
}
