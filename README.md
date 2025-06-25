<p align="center">
  <img src="assets/img/logo.png" alt="PolyGlotter Cover" width="100%">
</p>


# 🌐 PolyGlotter

PolyGlotter is a beautifully styled, responsive web app that allows users to translate text between multiple languages using a free translation API. Featuring session-based login, translation history, and dark/light mode, it's a fast and accessible tool for multilingual communication.

---

## 🚀 Features

* 🔒 **User Authentication**: Register and login securely
* 🔑 **Google Login (OAuth2)** – Sign in quickly using your Google account
* 🌍 **Offline Translation** – Uses [Argos Translate](https://www.argosopentech.com/) for local translation with no API costs
* 🔊 **Text-to-Speech** – Read aloud translated text with pause/resume/cancel
* 🎙️ **Voice Input** – Dictate text using Web Speech API
* 💾 **My Translations View**: Track recent translations with search, pagination, delete, and multi-select support
* 📤 **Export as CSV** – Download translation history
* 🌗 **Dark/Light Mode**: Seamlessly toggle based on system theme or manually
* 🍪 **Cookie Preferences** – Remembers selected theme and languages
* 🖌️ **Custom Spinner** – Earth image-based loading animation for translation
* 🎨 **Modern UI** – Fully responsive layout with Bootstrap 5 + custom styles
* 🧠 **Session-Based History** – Translations saved per user account
* 📁 **Modular Codebase** – Easy to maintain and extend  
* 🔐 **Secure Login/Register** – With MySQLi and PHP
* 🛠️ **Fully Offline Mode** – No third-party translation APIs used

---

## 🛠️ Tech Stack

* **Frontend**: HTML5, Bootstrap 5, JavaScript (AJAX)
* **Backend**: PHP (MySQLi)
* **Database**: MySQL (`language_platform`)
* **Translation Engine**: Argos Translate (offline model-based)
* **OAuth**: Google OAuth 2.0 via Google API SDK
* **Offline**: Python + Argos Translate (via CLI and installed models)
* **Flags:** flag-icons.min.css + local SVGs

---

## 📁 Folder Structure

```
PolyGlotter/
├── assets/
│ ├── css/
│ │ ├── theme-toggle.css
│ │ ├── my-translations.css
│ │ └── flag-icons.min.css
│ ├── js/
│ │ ├── translate.js
│ │ ├── my-translations.js
│ │ └── flags.js
│ ├── img/
│ │ └── earth.png
│ └── flags/
│ ├── 1x1/.svg
│ └── 4x3/.svg
├── includes/
│ └── db.php
├── vendor/
│ └── autoload.php
├── composer.json
├── composer.lock
├── config.php
├── register.php / register_process.php
├── login.php / login_process.php
├── dashboard.php
├── forgot_password.php / reset_password.php
├── google_login.php / google_callback.php
├── translate.php
├── fetch_translations.php
├── my_translations.php
├── export_csv.php
├── language_platform.sql ✅ (structure only)
└── README.md
```

---

## 📦 Database Schema

### `users`

### `users`
| id | username | email | password | created_at |
|----|----------|-------|----------|------------|

### `translations`
| id | user_id | source_text | translated_text | source_language | target_language | created_at |
|----|---------|-------------|-----------------|------------------|------------------|------------|

### `password_resets`
| id | email | token | expires_at |
|----|-------|--------|-------------|

---

## 🧪 Setup Instructions

1. Clone the repo:
   git clone https://github.com/your-username/polyglotter.git

2. Import `language_platform.sql` into MySQL (structure only)

3. Move the project into `htdocs` if using XAMPP

4. Edit `config.php` to match your MySQL credentials

5. Install PHP dependencies:
   composer install

6. (Optional) Install Argos Translate and language models:
   pip install argostranslate
   argos-translate-cli --install translate-en_es
   argos-translate-cli --install translate-ar_en

---

## 🔐 OAuth Setup (Google Login)

1. Go to https://console.cloud.google.com/

2. Create OAuth credentials and set:
   Authorized redirect URI:
   http://localhost/polyglotter/google_callback.php

3. Add your Client ID and Secret in:
   - google_login.php
   - google_callback.php

---

## ✅ All Implemented Features
| Feature                                  | Status |
| ---------------------------------------- | ------ |
| 🔊 Text-to-Speech                        | ✅ Done |
| 🎙️ Voice Input                          |  ✅ Done |
| 🍪 Cookie Preferences                    | ✅ Done |
| 📤 Export History as CSV                 | ✅ Done |
| 🔐 Password Reset                        | ✅ Done |
| 🔑 Google Login                          | ✅ Done |
| 🌍 Offline Translation (Argos Translate) | ✅ Done |

---

## 🤝 Contributing

Got ideas or found an issue? Fork this project, make changes, and submit a pull request. Contributions welcome!

---

## 🏅 Credits

Designed and developed by **Saadiah Khan**.

---

## 🌟 Show Your Support

If this project helped you, please give it a ⭐ on GitHub and share with other developers!