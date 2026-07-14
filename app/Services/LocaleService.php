<?php

namespace App\Services;

class LocaleService
{
    /**
     * Supported application languages.
     *
     * @var array<int, string>
     */
    protected const LANGUAGES = [
        'en',
        'es',
        'pt',
        'fa',
        'tr',
        'ar',
        'de',
    ];


    /**
     * Country language mapping.
     *
     * @var array<string, string>
     */
    protected array $countries = [
        'US' => 'en',
        'GB' => 'en',

        'ES' => 'es',
        'MX' => 'es',

        'BR' => 'pt',
        'PT' => 'pt',

        'IR' => 'fa',

        'TR' => 'tr',

        'AE' => 'ar',
        'SA' => 'ar',
        'QA' => 'ar',

        'DE' => 'de',
        'AT' => 'de',
        'CH' => 'de',
    ];


    /**
     * Detects application language by country.
     *
     * @param string|null $country
     *
     * @return string
     */
    public function detect(?string $country): string
    {
        $language = $this->countries[$country] ?? 'en';


        return $this->supports($language)
            ? $language
            : 'en';
    }


    /**
     * Checks if language is supported.
     *
     * @param string|null $language
     *
     * @return bool
     */
    public function supports(?string $language): bool
    {
        return in_array(
            $language,
            self::LANGUAGES,
            true
        );
    }


    /**
     * Returns supported application languages.
     *
     * @return array<int, string>
     */
    public function languages(): array
    {
        return self::LANGUAGES;
    }
}