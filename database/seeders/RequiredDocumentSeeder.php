<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\RequiredDocument;
use Illuminate\Database\Seeder;

class RequiredDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $docsMap = [
            // Passport services
            'new-passport' => [
                [
                    'title_en' => 'National Identity Card (NID) Number',
                    'title_np' => 'राष्ट्रिय परिचयपत्र (NID) नम्बर',
                    'description_en' => 'Original NID card or the barcoded confirmation sheet containing the NID validation number.',
                    'description_np' => 'राष्ट्रिय परिचयपत्रको सक्कल कार्ड वा व्यक्तिगत जैविक विवरण संकलन पछि प्राप्त भएको रुजु नम्बर भएको पाना (NID confirmation sheet)।',
                    'is_required' => true
                ],
                [
                    'title_en' => 'Original Nepali Citizenship',
                    'title_np' => 'सक्कल नेपाली नागरिकता प्रमाणपत्र',
                    'description_en' => 'Original Nepali citizenship certificate. All information, stamp and signatures must be clearly legible.',
                    'description_np' => 'सक्कल नेपाली नागरिकताको प्रमाणपत्र। फोटो, हस्ताक्षर र जारी गर्ने अधिकृतको छाप स्पष्ट बुझिने हुनुपर्नेछ।',
                    'is_required' => true
                ],
                [
                    'title_en' => 'Online Application Form Printout',
                    'title_np' => 'अनलाइन आवेदन फारम (Printout)',
                    'description_en' => 'The printed copy of the e-Passport pre-enrollment form submitted online through the passport portal.',
                    'description_np' => 'राहदानी विभागको अनलाइन प्रणालीबाट भरिएको र सफलतापुर्वक पेश गरिएको फारमको प्रिन्ट।',
                    'is_required' => true
                ]
            ],
            'passport-renewal' => [
                [
                    'title_en' => 'National Identity Card (NID) Number',
                    'title_np' => 'राष्ट्रिय परिचयपत्र (NID) नम्बर',
                    'description_en' => 'Original NID card or the barcoded confirmation sheet containing the NID validation number.',
                    'description_np' => 'राष्ट्रिय परिचयपत्रको सक्कल कार्ड वा व्यक्तिगत जैविक विवरण संकलन पछि प्राप्त भएको रुजु नम्बर भएको पाना (NID confirmation sheet)।',
                    'is_required' => true
                ],
                [
                    'title_en' => 'Original Nepali Citizenship',
                    'title_np' => 'सक्कल नेपाली नागरिकता प्रमाणपत्र',
                    'description_en' => 'Original Nepali citizenship certificate. All information, stamp and signatures must be clearly legible.',
                    'description_np' => 'सक्कल नेपाली नागरिकताको प्रमाणपत्र। फोटो, हस्ताक्षर र जारी गर्ने अधिकृतको छाप स्पष्ट बुझिने हुनुपर्नेछ।',
                    'is_required' => true
                ],
                [
                    'title_en' => 'Old Passport (For Renewals)',
                    'title_np' => 'पुरानो राहदानी (नवीकरणको हकमा)',
                    'description_en' => 'If renewing or replacement, bring the original previous passport and photocopies of its main pages.',
                    'description_np' => 'नवीकरण वा प्रतिस्थापन गर्ने भएमा पहिलेको राहदानीको सक्कल र मुख्य पृष्ठहरूको प्रतिलिपि।',
                    'is_required' => true
                ]
            ],
            'urgent-passport' => [
                [
                    'title_en' => 'National Identity Card (NID) Number',
                    'title_np' => 'राष्ट्रिय परिचयपत्र (NID) नम्बर',
                    'description_en' => 'Original NID card or the barcoded confirmation sheet containing the NID validation number.',
                    'description_np' => 'राष्ट्रिय परिचयपत्रको सक्कल कार्ड वा व्यक्तिगत जैविक विवरण संकलन पछि प्राप्त भएको रुजु नम्बर भएको पाना (NID confirmation sheet)।',
                    'is_required' => true
                ],
                [
                    'title_en' => 'Original Nepali Citizenship',
                    'title_np' => 'सक्कल नेपाली नागरिकता प्रमाणपत्र',
                    'description_en' => 'Original Nepali citizenship certificate. All information, stamp and signatures must be clearly legible.',
                    'description_np' => 'सक्कल नेपाली नागरिकताको प्रमाणपत्र। फोटो, हस्ताक्षर र जारी गर्ने अधिकृतको छाप स्पष्ट बुझिने हुनुपर्नेछ।',
                    'is_required' => true
                ],
                [
                    'title_en' => 'Fast-Track Revenue Receipt',
                    'title_np' => 'द्रुत राजस्व रसिद',
                    'description_en' => 'Official proof of payment for the express priority processing fee.',
                    'description_np' => 'द्रुत राहदानी सेवाको लागि बुझाएको राजस्व दस्तुरको आधिकारिक रसिद।',
                    'is_required' => true
                ]
            ],
            // Citizenship services
            'new-citizenship' => [
                [
                    'title_en' => 'Local Ward Office Recommendation',
                    'title_np' => 'स्थानीय वडा कार्यालयको सिफारिस',
                    'description_en' => 'Original official recommendation letter signed by the local ward authority recommending citizenship issuance.',
                    'description_np' => 'सम्बन्धित स्थानीय तह (वडा कार्यालय) बाट नागरिकता जारी गर्नका लागि प्रमाणित गरिएको सक्कल सिफारिस पत्र।',
                    'is_required' => true
                ],
                [
                    'title_en' => 'Birth Registration Certificate',
                    'title_np' => 'जन्म दर्ता प्रमाणपत्र',
                    'description_en' => 'Original birth registration certificate issued by the local registrar or ward office.',
                    'description_np' => 'स्थानीय पञ्जिकाधिकारीको कार्यालयबाट जारी भएको जन्म दर्ताको सक्कल प्रमाणपत्र।',
                    'is_required' => true
                ],
                [
                    'title_en' => "Father or Mother's Citizenship Certificate",
                    'title_np' => 'बाबु वा आमाको नागरिकता प्रमाणपत्र',
                    'description_en' => 'Original citizenship certificate of either father or mother, along with 1 photocopy for relationship verification.',
                    'description_np' => 'बाबु वा आमाको सक्कल नेपाली नागरिकता प्रमाणपत्र र सोको प्रतिलिपि। नाता प्रमाणितका लागि यो अनिवार्य छ।',
                    'is_required' => true
                ]
            ],
            // NID services
            'new-nid' => [
                [
                    'title_en' => 'Original Nepali Citizenship',
                    'title_np' => 'सक्कल नेपाली नागरिकता प्रमाणपत्र',
                    'description_en' => 'Original Nepali citizenship certificate. It is the primary credential required for biometric validation.',
                    'description_np' => 'राष्ट्रिय परिचयपत्र अनलाइन दर्ता र रुजुका लागि नेपाली नागरिकताको सक्कल प्रमाणपत्र अनिवार्य छ।',
                    'is_required' => true
                ],
                [
                    'title_en' => 'Pre-Enrollment Form & Barcode',
                    'title_np' => 'अनलाइन प्रि-एनरोलमेन्ट फारम र बारकोड',
                    'description_en' => 'Printed confirmation copy of the pre-enrollment form containing the registration date and barcode.',
                    'description_np' => 'राष्ट्रिय परिचयपत्रको अनलाइन पोर्टलमा विवरण भरेर प्राप्त भएको अनलाइन दर्ता आवेदन रसिदको प्रिन्ट।',
                    'is_required' => true
                ]
            ],
            // License services
            'new-license' => [
                [
                    'title_en' => 'Online Application Form Printout',
                    'title_np' => 'अनलाइन आवेदन फारम प्रिन्ट',
                    'description_en' => 'Printed copy of the online driving license application registration receipt.',
                    'description_np' => 'यातायात व्यवस्था विभागको अनलाइन लाइसेन्स दर्ता प्रणालीबाट भरेको आवेदन फारमको प्रिन्ट।',
                    'is_required' => true
                ],
                [
                    'title_en' => 'Original Nepali Citizenship',
                    'title_np' => 'सक्कल नेपाली नागरिकता प्रमाणपत्र',
                    'description_en' => 'Original Nepali citizenship certificate (or valid passport) along with 1 photocopy.',
                    'description_np' => 'सक्कल नागरिकता प्रमाणपत्र र सोको स्पष्ट देखिने १ प्रति फोटोकपी।',
                    'is_required' => true
                ],
                [
                    'title_en' => 'Medical Fitness Certificate',
                    'title_np' => 'निरोगिताको प्रमाणपत्र (Medical Report)',
                    'description_en' => 'Official physical fitness certificate certifying color-blindness check and blood group confirmation.',
                    'description_np' => 'स्वीकृत सरकारी वा तोकिएको चिकित्सकबाट आँखा परीक्षण र रगत समूह (Blood Group) प्रमाणित गरिएको रिपोर्ट।',
                    'is_required' => true
                ]
            ]
        ];

        foreach ($docsMap as $serviceSlug => $docs) {
            $service = Service::where('slug', $serviceSlug)->first();
            if ($service) {
                foreach ($docs as $doc) {
                    RequiredDocument::create([
                        'service_id' => $service->id,
                        'title_en' => $doc['title_en'],
                        'title_np' => $doc['title_np'],
                        'description_en' => $doc['description_en'],
                        'description_np' => $doc['description_np'],
                        'is_required' => $doc['is_required']
                    ]);
                }
            }
        }
    }
}
