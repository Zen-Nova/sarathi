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
// Nepal Police services
'police-clearance-certificate' => [
    [
        'title_en' => 'Citizenship Certificate or National ID',
        'title_np' => 'नागरिकता प्रमाणपत्र वा राष्ट्रिय परिचयपत्र',
        'description_en' => 'Clear copy of Nepali citizenship certificate or National ID for identity verification.',
        'description_np' => 'परिचय रुजुका लागि नेपाली नागरिकता प्रमाणपत्र वा राष्ट्रिय परिचयपत्रको स्पष्ट प्रतिलिपि।',
        'is_required' => true
    ],
    [
        'title_en' => 'Passport Copy',
        'title_np' => 'राहदानी प्रतिलिपि',
        'description_en' => 'Required if the certificate is needed for visa, study, migration or foreign employment purpose.',
        'description_np' => 'भिसा, अध्ययन, आप्रवासन वा वैदेशिक रोजगारी प्रयोजन भए राहदानीको प्रतिलिपि आवश्यक पर्छ।',
        'is_required' => true
    ],
    [
        'title_en' => 'Recent Passport Size Photo',
        'title_np' => 'हालसालै खिचिएको पासपोर्ट साइज फोटो',
        'description_en' => 'Recent clear photo for certificate profile verification.',
        'description_np' => 'प्रमाणपत्र प्रोफाइल रुजुका लागि हालसालै खिचिएको स्पष्ट फोटो।',
        'is_required' => true
    ],
    [
        'title_en' => 'Valid Email and Mobile Number',
        'title_np' => 'मान्य इमेल र मोबाइल नम्बर',
        'description_en' => 'Used for login, application update and certificate status notification.',
        'description_np' => 'लगइन, आवेदन अपडेट र प्रमाणपत्र स्थिति जानकारीका लागि प्रयोग हुन्छ।',
        'is_required' => true
    ]
],

'lost-document-report' => [
    [
        'title_en' => 'Applicant Identity Document',
        'title_np' => 'निवेदकको परिचय कागजात',
        'description_en' => 'Citizenship, passport, license or any valid ID copy to verify applicant identity.',
        'description_np' => 'निवेदकको परिचय रुजुका लागि नागरिकता, राहदानी, लाइसेन्स वा अन्य मान्य परिचयपत्र प्रतिलिपि।',
        'is_required' => true
    ],
    [
        'title_en' => 'Lost Document Details',
        'title_np' => 'हराएको कागजातको विवरण',
        'description_en' => 'Document number, issued office, issued date or other available details of the lost document.',
        'description_np' => 'हराएको कागजातको नम्बर, जारी कार्यालय, जारी मिति वा उपलब्ध अन्य विवरण।',
        'is_required' => true
    ],
    [
        'title_en' => 'Applicant Contact Details',
        'title_np' => 'निवेदकको सम्पर्क विवरण',
        'description_en' => 'Mobile number, address and email if available for application follow-up.',
        'description_np' => 'आवेदन फलोअपका लागि मोबाइल नम्बर, ठेगाना र उपलब्ध भए इमेल।',
        'is_required' => true
    ]
],

'cyber-crime-complaint' => [
    [
        'title_en' => 'Written Complaint Application',
        'title_np' => 'लिखित उजुरी निवेदन',
        'description_en' => 'A clear written complaint explaining the cyber incident, involved account, date, platform and damage caused.',
        'description_np' => 'साइबर घटनाको विवरण, सम्बन्धित खाता, मिति, प्लेटफर्म र भएको क्षति खुल्ने स्पष्ट लिखित उजुरी।',
        'is_required' => true
    ],
    [
        'title_en' => 'Citizenship or Valid Identity Document',
        'title_np' => 'नागरिकता वा मान्य परिचयपत्र',
        'description_en' => 'Copy of citizenship, National ID, passport, license or other valid identity document.',
        'description_np' => 'नागरिकता, राष्ट्रिय परिचयपत्र, राहदानी, लाइसेन्स वा अन्य मान्य परिचयपत्रको प्रतिलिपि।',
        'is_required' => true
    ],
    [
        'title_en' => 'Screenshots and Digital Evidence',
        'title_np' => 'स्क्रीनसट तथा डिजिटल प्रमाण',
        'description_en' => 'Screenshots of messages, fake profile, fraud conversation, threats, posts or other digital proof.',
        'description_np' => 'म्यासेज, नक्कली प्रोफाइल, ठगी कुराकानी, धम्की, पोस्ट वा अन्य डिजिटल प्रमाणका स्क्रीनसटहरू।',
        'is_required' => true
    ],
    [
        'title_en' => 'Links, URLs or Account Details',
        'title_np' => 'लिंक, URL वा खाता विवरण',
        'description_en' => 'Profile links, website URLs, phone numbers, email addresses or account usernames related to the case.',
        'description_np' => 'मुद्दासँग सम्बन्धित प्रोफाइल लिंक, वेबसाइट URL, फोन नम्बर, इमेल वा प्रयोगकर्ता नाम।',
        'is_required' => true
    ],
    [
        'title_en' => 'Transaction Proof',
        'title_np' => 'कारोबार प्रमाण',
        'description_en' => 'Bank slip, wallet transaction, QR payment receipt or other payment proof if online fraud is involved.',
        'description_np' => 'अनलाइन ठगी भए बैंक स्लिप, वालेट कारोबार, QR भुक्तानी रसिद वा अन्य भुक्तानी प्रमाण।',
        'is_required' => false
    ]
],

// Inland Revenue Department services
'personal-pan-registration' => [
    [
        'title_en' => 'Original Citizenship Certificate',
        'title_np' => 'सक्कल नागरिकता प्रमाणपत्र',
        'description_en' => 'Original Nepali citizenship certificate with clear personal details for identity verification.',
        'description_np' => 'परिचय रुजुका लागि व्यक्तिगत विवरण स्पष्ट देखिने सक्कल नेपाली नागरिकता प्रमाणपत्र।',
        'is_required' => true
    ],
    [
        'title_en' => 'Recent Passport Size Photo',
        'title_np' => 'हालसालै खिचिएको पासपोर्ट साइज फोटो',
        'description_en' => 'Recent photo may be required for taxpayer profile record.',
        'description_np' => 'करदाता प्रोफाइल अभिलेखका लागि हालसालै खिचिएको फोटो आवश्यक पर्न सक्छ।',
        'is_required' => true
    ],
    [
        'title_en' => 'Mobile Number and Email',
        'title_np' => 'मोबाइल नम्बर र इमेल',
        'description_en' => 'Required for taxpayer portal login, verification and future tax communication.',
        'description_np' => 'करदाता पोर्टल लगइन, प्रमाणीकरण र भविष्यको कर सम्बन्धी जानकारीका लागि आवश्यक।',
        'is_required' => true
    ]
],

'business-pan-registration' => [
    [
        'title_en' => 'Business Registration Certificate',
        'title_np' => 'व्यवसाय दर्ता प्रमाणपत्र',
        'description_en' => 'Company, firm, shop or business registration certificate issued by the concerned authority.',
        'description_np' => 'सम्बन्धित निकायबाट जारी कम्पनी, फर्म, पसल वा व्यवसाय दर्ता प्रमाणपत्र।',
        'is_required' => true
    ],
    [
        'title_en' => 'Owner or Director Citizenship Certificate',
        'title_np' => 'सञ्चालक वा प्रोप्राइटरको नागरिकता',
        'description_en' => 'Citizenship certificate copy of proprietor, partner or company directors.',
        'description_np' => 'प्रोप्राइटर, साझेदार वा कम्पनी सञ्चालकहरूको नागरिकता प्रमाणपत्र प्रतिलिपि।',
        'is_required' => true
    ],
    [
        'title_en' => 'Rental Agreement or Ownership Proof',
        'title_np' => 'भाडा सम्झौता वा स्वामित्व प्रमाण',
        'description_en' => 'Proof of business location such as rental agreement, land ownership document or house owner consent.',
        'description_np' => 'व्यवसाय स्थान प्रमाणित गर्ने भाडा सम्झौता, जग्गा/घर स्वामित्व प्रमाण वा घरधनी सहमति।',
        'is_required' => true
    ],
    [
        'title_en' => 'Ward or Municipality Registration',
        'title_np' => 'वडा वा नगरपालिका दर्ता',
        'description_en' => 'Local level business registration or recommendation if applicable.',
        'description_np' => 'लागू भए स्थानीय तहको व्यवसाय दर्ता वा सिफारिस।',
        'is_required' => false
    ]
],

'vat-registration' => [
    [
        'title_en' => 'Business PAN Certificate',
        'title_np' => 'व्यवसायिक PAN प्रमाणपत्र',
        'description_en' => 'Existing business PAN certificate is required to register or update VAT tax type.',
        'description_np' => 'VAT दर्ता वा कर प्रकार अद्यावधिक गर्न विद्यमान व्यवसायिक PAN प्रमाणपत्र आवश्यक हुन्छ।',
        'is_required' => true
    ],
    [
        'title_en' => 'Business Registration Certificate',
        'title_np' => 'व्यवसाय दर्ता प्रमाणपत्र',
        'description_en' => 'Official company, firm or business registration certificate.',
        'description_np' => 'कम्पनी, फर्म वा व्यवसायको आधिकारिक दर्ता प्रमाणपत्र।',
        'is_required' => true
    ],
    [
        'title_en' => 'Turnover or Transaction Details',
        'title_np' => 'टर्नओभर वा कारोबार विवरण',
        'description_en' => 'Estimated or actual business transaction details required for VAT eligibility verification.',
        'description_np' => 'VAT योग्यता रुजुका लागि अनुमानित वा वास्तविक व्यवसायिक कारोबार विवरण।',
        'is_required' => true
    ],
    [
        'title_en' => 'Business Location Proof',
        'title_np' => 'व्यवसाय स्थान प्रमाण',
        'description_en' => 'Rental agreement, ownership proof or other document showing business operating location.',
        'description_np' => 'व्यवसाय सञ्चालन स्थान देखाउने भाडा सम्झौता, स्वामित्व प्रमाण वा अन्य कागजात।',
        'is_required' => true
    ]
],

'tax-clearance-certificate' => [
    [
        'title_en' => 'PAN Certificate or PAN Number',
        'title_np' => 'PAN प्रमाणपत्र वा PAN नम्बर',
        'description_en' => 'PAN details are required to check taxpayer record and fiscal year tax status.',
        'description_np' => 'करदाता अभिलेख र आर्थिक वर्षको कर स्थिति जाँचका लागि PAN विवरण आवश्यक हुन्छ।',
        'is_required' => true
    ],
    [
        'title_en' => 'Tax Returns',
        'title_np' => 'कर विवरण',
        'description_en' => 'Filed tax returns of the requested fiscal year and any pending previous year if applicable.',
        'description_np' => 'माग गरिएको आर्थिक वर्ष र लागू भए अघिल्ला बाँकी वर्षका पेश गरिएका कर विवरण।',
        'is_required' => true
    ],
    [
        'title_en' => 'Tax Payment Vouchers',
        'title_np' => 'कर भुक्तानी भौचर',
        'description_en' => 'Payment receipts or vouchers showing tax dues have been paid.',
        'description_np' => 'तिर्नुपर्ने कर भुक्तानी भएको देखाउने रसिद वा भौचर।',
        'is_required' => true
    ],
    [
        'title_en' => 'Financial Statement or Audit Report',
        'title_np' => 'वित्तीय विवरण वा अडिट रिपोर्ट',
        'description_en' => 'Required for business taxpayers if applicable according to taxpayer type and fiscal year.',
        'description_np' => 'व्यवसायिक करदाताको हकमा करदाता प्रकार र आर्थिक वर्ष अनुसार लागू भए आवश्यक।',
        'is_required' => false
    ]
],

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
