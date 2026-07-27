<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact = Contact::updateOrCreate(
            ['id' => 1],
            [
                'email' => 'nima.javascript@gmail.com',
                'whatsapp' => null,
                'google_maps_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2064.0333822662774!2d-52.09900123878426!3d-23.543178812897853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ed277eda260f9b%3A0x55dd40afaa7c57df!2sCTec%20-%20Centro%20T%C3%A9cnico%20da%20Uni%C3%A3o%20Sul%20Brasileira%20da%20IASD!5e0!3m2!1sen!2sbr!4v1785154255936!5m2!1sen!2sbr',
                'available' => true,
            ]
        );

        $translations = [
            'en' => [
                'description' => 'Feel free to contact me for collaboration opportunities, projects, or any questions.',
                'address' => 'Gleba Paiçandu, 80',
                'city' => 'Ivatuba',
                'state' => 'Paraná',
                'country' => 'Brazil',
                'postal_code' => '87130-000',
                'working_hours' => 'Monday - Friday, 09:00 - 18:00',
            ],

            'pt' => [
                'description' => 'Sinta-se à vontade para entrar em contato comigo para oportunidades de colaboração, projetos ou qualquer dúvida.',
                'address' => 'Gleba Paiçandu, 80',
                'city' => 'Ivatuba',
                'state' => 'Paraná',
                'country' => 'Brasil',
                'postal_code' => '87130-000',
                'working_hours' => 'Segunda-feira - Sexta-feira, 09:00 - 18:00',
            ],

            'es' => [
                'description' => 'No dudes en ponerte en contacto conmigo para oportunidades de colaboración, proyectos o cualquier consulta.',
                'address' => 'Gleba Paiçandu, 80',
                'city' => 'Ivatuba',
                'state' => 'Paraná',
                'country' => 'Brasil',
                'postal_code' => '87130-000',
                'working_hours' => 'Lunes - Viernes, 09:00 - 18:00',
            ],

            'de' => [
                'description' => 'Kontaktieren Sie mich gerne für Zusammenarbeit, Projekte oder Fragen.',
                'address' => 'Gleba Paiçandu, 80',
                'city' => 'Ivatuba',
                'state' => 'Paraná',
                'country' => 'Brasilien',
                'postal_code' => '87130-000',
                'working_hours' => 'Montag - Freitag, 09:00 - 18:00',
            ],

            'tr' => [
                'description' => 'İş birlikleri, projeler veya sorularınız için benimimle iletişime geçmekten çekinmeyin.',
                'address' => 'Gleba Paiçandu, 80',
                'city' => 'Ivatuba',
                'state' => 'Paraná',
                'country' => 'Brezilya',
                'postal_code' => '87130-000',
                'working_hours' => 'Pazartesi - Cuma, 09:00 - 18:00',
            ],

            'fa' => [
                'description' => 'برای فرصت‌های همکاری، پروژه‌ها یا هرگونه سؤال، خوشحال می‌شوم با من در ارتباط باشید.',
                'address' => 'گلبا پایساندو، ۸۰',
                'city' => 'ایواتوبا',
                'state' => 'پارانا',
                'country' => 'برزیل',
                'postal_code' => '۸۷۱۳۰-۰۰۰',
                'working_hours' => 'دوشنبه تا جمعه، ۰۹:۰۰ تا ۱۸:۰۰',
            ],

            'ar' => [
                'description' => 'لا تتردد في التواصل معي بخصوص فرص التعاون أو المشاريع أو أي استفسارات.',
                'address' => 'غليبا بايساندو، 80',
                'city' => 'إيفاتوبا',
                'state' => 'بارانا',
                'country' => 'البرازيل',
                'postal_code' => '87130-000',
                'working_hours' => 'الاثنين - الجمعة، 09:00 - 18:00',
            ],
        ];

        foreach ($translations as $locale => $data) {
            $language = Language::where('code', $locale)->first();

            if (! $language) {
                continue;
            }

            $contact->translations()->updateOrCreate(
                [
                    'language_id' => $language->id,
                ],
                $data
            );
        }
    }
}
