# 🏛️ Sarathi (सारथी) - Citizen Workflow Navigation & Accountability System

Sarathi is a minimalist, mobile-first web ecosystem designed for Nepalese government offices (starting with the Department of Passports / राहदानी विभाग). It serves as a digital "indoor GPS tracker paired with a real-time accountability monitor" that requires **zero application installation** for the citizen—just a simple QR scan at entry and exit gates.

---

## 🗺️ The Core Architecture (How it Works)

The system operates on a smart two-scan loop (`Scan 1: Check-in & Guide` ➔ `Scan 2: Check-out & Feedback/Complaint`):

[ Citizen arrives at Main Gate ]
│
▼
📷 SCAN 1: Entry Point QR
│
▼
🌐 Opens Mobile Site (Auto-detects active branch context)
│
▼
📝 Citizen Selects Service (e.g., New Passport, Renewal)
│
▼
🗺️ SYSTEM GENERATES ROUTE (Dynamic Indoor Map)
"Go to Counter 3 (Verification) ➔ Then Room 12 (Biometrics) ➔ Counter 1 (Payment)"
(Shows checklist of required documents: Citizenship, Old Passport, National ID)
│
▼
🚶‍♂️ Citizen physically completes tasks inside the building...
│
▼
📷 SCAN 2: Exit Point QR (Same QR, but system detects citizen has an active tracking session)
│
▼
❓ "Did your work get completed today?"
├── 👍 YES ➔ 💬 Feedback Form (Star rating, behavior, queue time)
└── 👎 NO  ➔ ⚠️ Complaint Form
├── "Officer told me to come another day"
├── "System/Server down"
└── "Missing documents / Rejected"


---

## ✨ Features

### 👤 Citizen Interface (Mobile-First)
* **Zero App Install:** Operates entirely inside any mobile browser via instant QR capture.
* **Dual-Language Support (`en`/`ne`):** Simple toggle at the top using clear, accessible, and non-complex Nepali phrasing.
* **Dynamic Indoor Routing:** Generates a clean step-by-step room and counter milestone map depending on the selected track (New Passport vs. Renewal).
* **Smart Session Lifecycle:** Generates a secure, temporary tracking token (`NEP-XXXX-123`) to measure operational performance without violating user privacy.

### 📊 Admin Panel & Analytics Dashboard
* **Department Health Score:** Analyzes live deltas between entry and exit timestamps to monitor average queue wait times.
* **Success vs. Rejection Rates:** Interactive charts showing how many citizens completed their work versus how many were turned away.
* **Bottleneck Detection:** Highlights specific desks, counters, or issues (e.g., "Server Down", "Officer Missing") triggering failures.
* **Actionable Complaint Ledger:** Live feed for administrative supervisors to track public service pain points immediately.

---

## 🛠️ Tech Stack

* **Backend Framework:** Laravel 13.x
* **Runtime Environment:** PHP 8.4.x
* **Frontend Layer:** Blade Templating Engine, Tailwind CSS, Livewire
* **Database Platform:** SQLite / PostgreSQL

---

## 🚀 Installation & Local Setup

Follow these simple steps to set up the environment locally using Laravel Herd or standard web servers:

### 1. Clone the Repository
```bash
git clone [https://github.com/your-username/sarathi.git](https://github.com/your-username/sarathi.git)
cd sarathi
2. Install Project Dependencies
Bash
composer install
npm install && npm run build
3. Environment Configuration
Copy the default environment configuration file and generate your secure application cryptography key:

Bash
cp .env.example .env
php artisan key:generate
4. Setup Database Parameters
Create a default SQLite database or configure your local database parameters inside .env, then run migrations:

Bash
touch database/database.sqlite
php artisan migrate
5. Clear Configuration & Fire up Server
Bash
php artisan optimize:clear
php artisan serve
Open your web browser and visit: http://127.0.0.1:8000 (or http://sarathi.test if you are utilizing Laravel Herd / Valet directories).

📁 Core Directory Map
Plaintext
resources/
├── lang/
│   └── ne/
│       └── messages.php        # Nepali translation dictionary mappings
└── views/
    ├── citizen/                # Step-by-step mobile navigation screens
    │   ├── active-guide.blade  # Live target building counter sequence
    │   ├── checkout.blade      # Yes/No status evaluation gateway
    │   ├── select-service.blade# Core Track Selector UI
    │   └── thank-you.blade     # Success milestone completion receipt
    ├── layouts/
    │   └── citizen.blade.php   # Responsive master wrapper structure
    └── home.blade.php          # Public welcome dashboard interface
routes/
└── web.php                     # Complete simulation routing matrix engine
🇳🇵 Target Context Vision
This project intends to solve manual navigation friction, drop wait times, and eliminate administrative opacity within municipal circles, immigration desks, and transport hubs across the Government of Nepal ecosystem.
