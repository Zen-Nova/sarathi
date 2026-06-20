<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceStep;
use Illuminate\Database\Seeder;

class ServiceStepSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            'new-passport' => [
                [
                    'step_number' => 1,
                    'room_number' => 'Counter No. 1',
                    'counter_number' => 'Main Entrance Gate',
                    'title_en' => 'Token Gate & Form Pre-check',
                    'title_np' => 'टोकन गेट तथा फारम रुजु',
                    'instructions_en' => 'Verify online application printout, original Nepali citizenship certificate and NID number printout.',
                    'instructions_np' => 'अनलाइन आवेदन फारमको प्रिन्ट, नागरिकताको प्रमाणपत्र र राष्ट्रिय परिचयपत्र नम्बर रुजु गराउनुहोस्।',
                    'requirements_en' => ['Online application form printout', 'Original Nepali citizenship certificate', 'National Identity Number printout'],
                    'requirements_ne' => ['अनलाइन आवेदन फारम प्रिन्ट', 'नागरिकताको सक्कल प्रमाणपत्र', 'राष्ट्रिय परिचयपत्र नम्बर प्रिन्ट'],
                ],
                [
                    'step_number' => 2,
                    'room_number' => 'Room No. 102',
                    'counter_number' => 'First Floor',
                    'title_en' => 'Biometrics & Photography',
                    'title_np' => 'बायोमेट्रिक्स तथा फोटो',
                    'instructions_en' => 'Capture digital passport photo, fingerprints and digital signature.',
                    'instructions_np' => 'डिजिटल फोटो, औंठाछाप र डिजिटल दस्तखत रेकर्ड गराउनुहोस्।',
                    'requirements_en' => ['Token card', 'Checked application file'],
                    'requirements_ne' => ['टोकन कार्ड', 'रुजु भएको आवेदन फाइल'],
                ],
                [
                    'step_number' => 3,
                    'room_number' => 'Counter A-3',
                    'counter_number' => 'West Wing',
                    'title_en' => 'Original Document Verification',
                    'title_np' => 'सक्कल कागजात प्रमाणीकरण',
                    'instructions_en' => 'Officer verifies citizenship, NID and biometric slip before final approval.',
                    'instructions_np' => 'अधिकृतले नागरिकता, राष्ट्रिय परिचयपत्र र बायोमेट्रिक स्लिप भिडाएर अन्तिम स्वीकृति दिनुहुन्छ।',
                    'requirements_en' => ['Original citizenship certificate', 'Biometric confirmation slip'],
                    'requirements_ne' => ['सक्कल नागरिकता प्रमाणपत्र', 'बायोमेट्रिक स्लिप'],
                ],
                [
                    'step_number' => 4,
                    'room_number' => 'Counter No. 14',
                    'counter_number' => 'Collection Window',
                    'title_en' => 'Final Receipt & Collection Date',
                    'title_np' => 'अन्तिम रसिद तथा संकलन मिति',
                    'instructions_en' => 'Confirm final records and collect the passport collection-date slip.',
                    'instructions_np' => 'प्रणालीमा अन्तिम विवरण मिलान गरी राहदानी संकलन गर्ने मिति सहितको रसिद लिनुहोस्।',
                    'requirements_en' => ['Bank voucher / ConnectIPS receipt', 'Officer-approved dossier'],
                    'requirements_ne' => ['बैंक भौचर / कनेक्ट आईपीएस रसिद', 'अधिकृत स्वीकृत फाइल'],
                ]
            ],
            'passport-renewal' => [
                [
                    'step_number' => 1,
                    'room_number' => 'Counter No. 4',
                    'counter_number' => 'Central Hall',
                    'title_en' => 'Previous Passport Check',
                    'title_np' => 'पुरानो राहदानी जाँच',
                    'instructions_en' => 'Verify old passport, bio-page copy and NID copy.',
                    'instructions_np' => 'पुरानो राहदानी, विवरण पाना र राष्ट्रिय परिचयपत्र प्रतिलिपि रुजु गराउनुहोस्।',
                    'requirements_en' => ['Old/damaged passport', 'Passport bio-page photocopy', 'NID copy'],
                    'requirements_ne' => ['पुरानो/बिग्रिएको राहदानी', 'राहदानी विवरण पानाको प्रतिलिपि', 'राष्ट्रिय परिचयपत्र प्रतिलिपि'],
                ],
                [
                    'step_number' => 2,
                    'room_number' => 'Room No. 105',
                    'counter_number' => 'First Floor',
                    'title_en' => 'Biometrics Update',
                    'title_np' => 'बायोमेट्रिक्स अद्यावधिक',
                    'instructions_en' => 'Update new photo, fingerprints and signature.',
                    'instructions_np' => 'नयाँ फोटो, औंठाछाप र दस्तखत अद्यावधिक गराउनुहोस्।',
                    'requirements_en' => ['Token card', 'Verification slip'],
                    'requirements_ne' => ['टोकन कार्ड', 'रुजु भौचर'],
                ],
                [
                    'step_number' => 3,
                    'room_number' => 'Counter No. 9',
                    'counter_number' => 'East Wing',
                    'title_en' => 'Receipt & Collection Date',
                    'title_np' => 'रसिद तथा संकलन मिति',
                    'instructions_en' => 'Confirm renewal approval and collect the barcoded collection slip.',
                    'instructions_np' => 'नवीकरण स्वीकृत गराई संकलन मिति सहितको बारकोड रसिद लिनुहोस्।',
                    'requirements_en' => ['Biometric slip', 'Old passport for cancellation'],
                    'requirements_ne' => ['बायोमेट्रिक भौचर', 'रद्द गर्न पुरानो राहदानी'],
                ]
            ],
            'urgent-passport' => [
                [
                    'step_number' => 1,
                    'room_number' => 'Counter No. 11',
                    'counter_number' => 'Priority Desk',
                    'title_en' => 'Priority Screening Desk',
                    'title_np' => 'विशेष प्राथमिकता जाँच',
                    'instructions_en' => 'Verify fast-track payment and urgency justification documents.',
                    'instructions_np' => 'द्रुत सेवा शुल्क र अत्यावश्यकता प्रमाणित गर्ने कागजात रुजु गराउनुहोस्।',
                    'requirements_en' => ['Fast-track voucher', 'Urgency justification document', 'Original citizenship'],
                    'requirements_ne' => ['द्रुत सेवा भौचर', 'अत्यावश्यकताको प्रमाण', 'सक्कल नागरिकता'],
                ],
                [
                    'step_number' => 2,
                    'room_number' => 'Express Booth 7A',
                    'counter_number' => 'Ground Floor',
                    'title_en' => 'Express Biometrics',
                    'title_np' => 'एक्सप्रेस बायोमेट्रिक्स',
                    'instructions_en' => 'Use the priority queue to capture photo, fingerprint and signature.',
                    'instructions_np' => 'द्रुत लाइनबाट फोटो, औंठाछाप र दस्तखत रेकर्ड गराउनुहोस्।',
                    'requirements_en' => ['Priority token'],
                    'requirements_ne' => ['प्राथमिकता टोकन'],
                ],
                [
                    'step_number' => 3,
                    'room_number' => 'Counter No. 12',
                    'counter_number' => 'Express Dispatch Hub',
                    'title_en' => 'Final Approval & Dispatch Slip',
                    'title_np' => 'अन्तिम स्वीकृति तथा रसिद',
                    'instructions_en' => 'After officer approval, collect same-day/next-day dispatch slip.',
                    'instructions_np' => 'अधिकृत स्वीकृति पछि सोही दिन वा अर्को दिन संकलन मिति सहितको रसिद लिनुहोस्।',
                    'requirements_en' => ['Fast-track approved dossier'],
                    'requirements_ne' => ['द्रुत प्रक्रिया स्वीकृत फाइल'],
                ]
            ],
            'new-citizenship' => [
                [
                    'step_number' => 1,
                    'room_number' => 'Counter No. 2',
                    'counter_number' => 'General Branch',
                    'title_en' => 'Application Form & Recommendation',
                    'title_np' => 'स्थानीय वडा सिफारिस तथा फारम दर्ता',
                    'instructions_en' => 'Submit ward recommendation letter, birth certificate and photos.',
                    'instructions_np' => 'वडाको सिफारिस पत्र, जन्म दर्ता र फोटो बुझाउनुहोस्।',
                    'requirements_en' => ['Ward recommendation', 'Birth registration', '3 Passport-size photos'],
                    'requirements_ne' => ['वडाको सिफारिस', 'जन्म दर्ता प्रमाणपत्र', '३ प्रति पासपोर्ट साइज फोटो'],
                ],
                [
                    'step_number' => 2,
                    'room_number' => 'Room No. 15',
                    'counter_number' => 'Administrative Officer',
                    'title_en' => 'Officer Interview & Witness Verification',
                    'title_np' => 'सनाखत तथा अधिकृत जाँच',
                    'instructions_en' => 'Witness must authenticate relationship status.',
                    'instructions_np' => 'सनाखत गर्ने संरक्षक (आमा/बुबा/नजिकको नातेदार) को उपस्थितिमा सनाखत गराउनुहोस्।',
                    'requirements_en' => ['Parent citizenship certificate', 'Relationship verification document'],
                    'requirements_ne' => ['आमा/बुबाको नागरिकता', 'नाता प्रमाणित प्रमाणपत्र'],
                ],
                [
                    'step_number' => 3,
                    'room_number' => 'Counter No. 5',
                    'counter_number' => 'Citizenship Window',
                    'title_en' => 'Citizenship Issuance & Registering',
                    'title_np' => 'नागरिकता वितरण तथा दर्ता',
                    'instructions_en' => 'Get citizenship certificate signed by Assistant Chief District Officer.',
                    'instructions_np' => 'सहायक प्रमुख जिल्ला अधिकारीबाट स्वीकृत नागरिकताको प्रमाणपत्र बुझिलिनुहोस्।',
                    'requirements_en' => ['Verified application file'],
                    'requirements_ne' => ['रुजु भएको आवेदन फाइल'],
                ]
            ],
            'general-inquiry' => [
                [
                    'step_number' => 1,
                    'room_number' => 'Front Desk',
                    'counter_number' => 'Inquiry Desk',
                    'title_en' => 'Front Desk Support',
                    'title_np' => 'सोधपुछ कक्ष सहायता',
                    'instructions_en' => 'Ask for general guidance and help sheets.',
                    'instructions_np' => 'कार्यालयको काम सम्बन्धी जानकारी र फारमहरू लिनुहोस्।',
                    'requirements_en' => ['None'],
                    'requirements_ne' => ['कुनै पनि छैन'],
                ]
            ],
            'new-nid' => [
                [
                    'step_number' => 1,
                    'room_number' => 'Counter No. 7',
                    'counter_number' => 'National ID Wing',
                    'title_en' => 'Verification & Pre-enrollment Check',
                    'title_np' => 'प्रारम्भिक रुजु तथा दर्ता जाँच',
                    'instructions_en' => 'Check pre-enrollment form barcode.',
                    'instructions_np' => 'अनलाइन भरेको प्रि-एनरोलमेन्ट फारम र बारकोड रुजु गराउनुहोस्।',
                    'requirements_en' => ['Pre-enrollment receipt', 'Original Nepali citizenship'],
                    'requirements_ne' => ['प्रि-एनरोलमेन्ट रसिद', 'सक्कल नागरिकता प्रमाणपत्र'],
                ],
                [
                    'step_number' => 2,
                    'room_number' => 'Room No. 104',
                    'counter_number' => 'Biometric Suite',
                    'title_en' => 'Biometric Enrollment Desk',
                    'title_np' => 'बायोमेट्रिक विवरण कक्ष',
                    'instructions_en' => 'Complete fingerprint, photo, and iris scan.',
                    'instructions_np' => 'औंठाछाप, फोटो र आँखाको नानीको जैविक विवरण दर्ता गराउनुहोस्।',
                    'requirements_en' => ['Verified barcode slip'],
                    'requirements_ne' => ['रुजु गरिएको बारकोड पाना'],
                ]
            ],
            'new-license' => [
                [
                    'step_number' => 1,
                    'room_number' => 'Medical Branch',
                    'counter_number' => 'Ground Floor',
                    'title_en' => 'Medical Fitness Desk',
                    'title_np' => 'स्वास्थ्य तथा निरोगिता जाँच',
                    'instructions_en' => 'Submit blood group report and visual check sheet.',
                    'instructions_np' => 'रक्त समूह र आँखा परीक्षण रिपोर्ट प्रमाणित गराउनुहोस्।',
                    'requirements_en' => ['Medical fitness slip', 'Original citizenship certificate'],
                    'requirements_ne' => ['निरोगिताको प्रमाणपत्र', 'सक्कल नागरिकता प्रमाणपत्र'],
                ],
                [
                    'step_number' => 2,
                    'room_number' => 'Exam Hall',
                    'counter_number' => 'Second Floor',
                    'title_en' => 'Written Examination',
                    'title_np' => 'लिखित परीक्षा कक्ष',
                    'instructions_en' => 'Complete the written license exam sheet.',
                    'instructions_np' => 'सवारी चालक अनुमति पत्रको लिखित परीक्षा उत्तीर्ण गर्नुहोस्।',
                    'requirements_en' => ['Exam admit card'],
                    'requirements_ne' => ['परीक्षा प्रवेश पत्र'],
                ]
            ]
        ];

        foreach ($services as $serviceSlug => $steps) {
            $service = Service::where('slug', $serviceSlug)->first();
            if ($service) {
                foreach ($steps as $step) {
                    ServiceStep::updateOrCreate(
                        [
                            'service_id' => $service->id,
                            'step_number' => $step['step_number']
                        ],
                        [
                            'room_number' => $step['room_number'],
                            'counter_number' => $step['counter_number'],
                            'title_en' => $step['title_en'],
                            'title_np' => $step['title_np'],
                            'instructions_en' => $step['instructions_en'],
                            'instructions_np' => $step['instructions_np'],
                            'requirements_en' => $step['requirements_en'],
                            'requirements_ne' => $step['requirements_ne']
                        ]
                    );
                }
            }
        }
    }
}