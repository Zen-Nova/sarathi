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
        $police = Department::where('slug', 'nepal-police')->first();
$ird = Department::where('slug', 'inland-revenue-department')->first();

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

// 5. Nepal Police Services
if ($police) {
    Service::updateOrCreate(
        ['slug' => 'police-clearance-certificate'],
        [
            'department_id' => $police->id,
            'name_en' => 'Police Clearance Certificate',
            'name_np' => 'प्रहरी चारित्रिक प्रमाणपत्र',
            'desc_en' => 'Guidance for applying police clearance certificate for visa, study, employment, migration or official use.',
            'desc_ne' => 'भिसा, अध्ययन, रोजगारी, आप्रवासन वा आधिकारिक प्रयोजनका लागि प्रहरी चारित्रिक प्रमाणपत्र आवेदन प्रक्रिया।',
            'est_en' => '20–40 mins',
            'est_ne' => '२०–४० मिनेट',
            'is_active' => true,
        ]
    );

    Service::updateOrCreate(
        ['slug' => 'lost-document-report'],
        [
            'department_id' => $police->id,
            'name_en' => 'Lost Document Report',
            'name_np' => 'हराएको कागजात प्रतिवेदन',
            'desc_en' => 'Report lost citizenship, license, passport, academic certificate or other important documents.',
            'desc_ne' => 'नागरिकता, लाइसेन्स, राहदानी, शैक्षिक प्रमाणपत्र वा अन्य महत्वपूर्ण कागजात हराएको प्रतिवेदन दर्ता गर्ने प्रक्रिया।',
            'est_en' => '15–30 mins',
            'est_ne' => '१५–३० मिनेट',
            'is_active' => true,
        ]
    );

    Service::updateOrCreate(
        ['slug' => 'cyber-crime-complaint'],
        [
            'department_id' => $police->id,
            'name_en' => 'Cyber Crime Complaint',
            'name_np' => 'साइबर अपराध उजुरी',
            'desc_en' => 'Complaint process for online fraud, hacked accounts, fake profiles, digital threats and cyber abuse.',
            'desc_ne' => 'अनलाइन ठगी, ह्याक भएको खाता, नक्कली प्रोफाइल, डिजिटल धम्की तथा साइबर दुर्व्यवहार सम्बन्धी उजुरी प्रक्रिया।',
            'est_en' => '30–60 mins',
            'est_ne' => '३०–६० मिनेट',
            'is_active' => true,
        ]
    );
}

// 6. Inland Revenue Department Services
if ($ird) {
    Service::updateOrCreate(
        ['slug' => 'personal-pan-registration'],
        [
            'department_id' => $ird->id,
            'name_en' => 'Personal PAN Registration',
            'name_np' => 'व्यक्तिगत स्थायी लेखा नम्बर दर्ता',
            'desc_en' => 'Registration process for individuals to obtain Permanent Account Number for salary, banking and tax purposes.',
            'desc_ne' => 'तलब, बैंकिङ तथा कर प्रयोजनका लागि व्यक्तिले स्थायी लेखा नम्बर प्राप्त गर्ने प्रक्रिया।',
            'est_en' => '20–40 mins',
            'est_ne' => '२०–४० मिनेट',
            'is_active' => true,
        ]
    );

    Service::updateOrCreate(
        ['slug' => 'business-pan-registration'],
        [
            'department_id' => $ird->id,
            'name_en' => 'Business PAN Registration',
            'name_np' => 'व्यवसायिक स्थायी लेखा नम्बर दर्ता',
            'desc_en' => 'PAN registration process for firms, companies, shops, startups and business taxpayers.',
            'desc_ne' => 'फर्म, कम्पनी, पसल, स्टार्टअप तथा व्यवसायिक करदाताका लागि PAN दर्ता प्रक्रिया।',
            'est_en' => '30–60 mins',
            'est_ne' => '३०–६० मिनेट',
            'is_active' => true,
        ]
    );

    Service::updateOrCreate(
        ['slug' => 'vat-registration'],
        [
            'department_id' => $ird->id,
            'name_en' => 'VAT Registration',
            'name_np' => 'मूल्य अभिवृद्धि कर दर्ता',
            'desc_en' => 'Registration or tax-type update process for businesses required to register under VAT.',
            'desc_ne' => 'मूल्य अभिवृद्धि करमा दर्ता हुनुपर्ने व्यवसायका लागि VAT दर्ता वा कर प्रकार अद्यावधिक प्रक्रिया।',
            'est_en' => '30–60 mins',
            'est_ne' => '३०–६० मिनेट',
            'is_active' => true,
        ]
    );

    Service::updateOrCreate(
        ['slug' => 'tax-clearance-certificate'],
        [
            'department_id' => $ird->id,
            'name_en' => 'Tax Clearance Certificate',
            'name_np' => 'कर चुक्ता प्रमाणपत्र',
            'desc_en' => 'Process to obtain certificate showing that tax liabilities are cleared for the selected fiscal year.',
            'desc_ne' => 'सम्बन्धित आर्थिक वर्षको कर दायित्व चुक्ता भएको प्रमाणपत्र प्राप्त गर्ने प्रक्रिया।',
            'est_en' => '30–90 mins',
            'est_ne' => '३०–९० मिनेट',
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