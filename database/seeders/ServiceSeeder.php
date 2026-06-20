<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $passport = Department::where('slug', 'passport-visa')->first();
        $admin = Department::where('slug', 'administration')->first();
        $nid = Department::where('slug', 'national-id')->first();
        $transport = Department::where('slug', 'transport')->first();

        // 1. Passport Services
        if ($passport) {
            Service::updateOrCreate(
                ['slug' => 'new-passport'],
                [
                    'department_id' => $passport->id,
                    'name_en' => 'New e-Passport Application',
                    'name_np' => 'नयाँ ई-राहदानी दरखास्त दर्ता',
                    'desc_en' => 'Step-by-step guidance for first-time biometric passport applications, verification desks, and fees.',
                    'desc_ne' => 'पहिलो पटक राहदानी बनाउन आवश्यक कागजात, दस्तुर र झ्यालगत विवरण सहितको चरणबद्ध मार्गदर्शन।',
                    'est_en' => '45–60 mins',
                    'est_ne' => '४५–६० मिनेट',
                    'is_active' => true,
                ]
            );

            Service::updateOrCreate(
                ['slug' => 'passport-renewal'],
                [
                    'department_id' => $passport->id,
                    'name_en' => 'Passport Renewal / Replacement',
                    'name_np' => 'राहदानी नवीकरण वा नयाँ प्रतिस्थापन',
                    'desc_en' => 'Official replacement sequence for expired, fully-stamped, or physically damaged passports.',
                    'desc_ne' => 'म्याद सकिएको, पाना सकिएको, वा बिग्रिएको राहदानीको नवीकरण/प्रतिस्थापन प्रक्रिया।',
                    'est_en' => '30–45 mins',
                    'est_ne' => '३०–४५ मिनेट',
                    'is_active' => true,
                ]
            );

            Service::updateOrCreate(
                ['slug' => 'urgent-passport'],
                [
                    'department_id' => $passport->id,
                    'name_en' => 'Urgent Passport / Fast Track',
                    'name_np' => 'द्रुत सेवा राहदानी (Fast Track)',
                    'desc_en' => 'Priority operational fast-track passport processing engineered for time-critical travel needs.',
                    'desc_ne' => 'विशेष वा अत्यावश्यक कामका लागि द्रुत गतिमा राहदानी जारी गर्ने प्राथमिकता प्रक्रिया।',
                    'est_en' => '20–35 mins',
                    'est_ne' => '२०–३५ मिनेट',
                    'is_active' => true,
                ]
            );
        }

        // 2. Administration / Citizenship Services
        if ($admin) {
            Service::updateOrCreate(
                ['slug' => 'new-citizenship'],
                [
                    'department_id' => $admin->id,
                    'name_en' => 'New Citizenship Certificate',
                    'name_np' => 'नयाँ नागरिकता प्रमाणपत्र प्राप्ति',
                    'desc_en' => 'Detailed routing sequence for acquiring your first citizenship documentation.',
                    'desc_ne' => 'पहिलो पटक नेपाली नागरिकताको प्रमाणपत्र प्राप्त गर्ने सम्बन्धी सम्पूर्ण प्रक्रिया।',
                    'est_en' => '60–90 mins',
                    'est_ne' => '६०–९० मिनेट',
                    'is_active' => true,
                ]
            );

            Service::updateOrCreate(
                ['slug' => 'general-inquiry'],
                [
                    'department_id' => $admin->id,
                    'name_en' => 'General Inquiry',
                    'name_np' => 'साधारण सोधपुछ',
                    'desc_en' => 'Get general information and support for administrative operations.',
                    'desc_ne' => 'प्रशासनिक कार्यहरू सम्बन्धी सामान्य जानकारी तथा सहयोग कक्ष।',
                    'est_en' => '10–15 mins',
                    'est_ne' => '१०–१५ मिनेट',
                    'is_active' => true,
                ]
            );
        }

        // 3. National ID Services
        if ($nid) {
            Service::updateOrCreate(
                ['slug' => 'new-nid'],
                [
                    'department_id' => $nid->id,
                    'name_en' => 'New National ID Card',
                    'name_np' => 'नयाँ राष्ट्रिय परिचयपत्र दर्ता',
                    'desc_en' => 'Biometric collection and registration processes for National ID.',
                    'desc_ne' => 'राष्ट्रिय परिचयपत्रका लागि जैविक (Biometric) विवरण संकलन तथा दर्ता प्रक्रिया।',
                    'est_en' => '30–50 mins',
                    'est_ne' => '३०–५० मिनेट',
                    'is_active' => true,
                ]
            );
        }

        // 4. Transport / License Services
        if ($transport) {
            Service::updateOrCreate(
                ['slug' => 'new-license'],
                [
                    'department_id' => $transport->id,
                    'name_en' => 'New Driving License',
                    'name_np' => 'नयाँ सवारी चालक अनुमति पत्र',
                    'desc_en' => 'Step-by-step guidance for driving license applications and biometric checks.',
                    'desc_ne' => 'नयाँ सवारी चालक अनुमति पत्रको आवेदन, बायोमेट्रिक्स र परीक्षा मार्गदर्शन।',
                    'est_en' => '40–60 mins',
                    'est_ne' => '४०–६० मिनेट',
                    'is_active' => true,
                ]
            );
        }
    }
}