<?php

namespace Database\Seeders;

use App\Models\ContactForm;
use Illuminate\Database\Seeder;

class ContactFormSeeder extends Seeder
{
    /**
     * Seed dummy contact forms.
     *
     * @return void
     */
    public function run()
    {
        ContactForm::factory()->count(5)->create();
    }
}
