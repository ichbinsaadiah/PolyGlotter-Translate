# 🌐 PolyGlotter

PolyGlotter is a beautifully styled, responsive web app that allows users to translate text between multiple languages using a free translation API. Featuring session-based login, translation history, and dark/light mode, it's a fast and accessible tool for multilingual communication.

---

## 🚀 Features

* 🔒 **User Authentication**: Register and login securely
* 🌍 **Offline Translation** – Uses [Argos Translate](https://www.argosopentech.com/) for local translation with no API costs  
* 🎙️ **Voice Input** – Dictate text using Web Speech API  
* 💾 **My Translations View**: Track recent translations with search, pagination, delete, and multi-select support
* 🌗 **Dark/Light Mode**: Seamlessly toggle based on system theme or manually
* 🖌️ **Custom Spinner** – Earth image-based loading animation for translation  
* 🎨 **Modern UI** – Fully responsive layout with Bootstrap 5 + custom styles  
* 🧠 **Session-Based History** – Translations saved per user account  
* 🔐 **Secure Login/Register** – With MySQLi and PHP  
* 📁 **Modular Codebase** – Easy to maintain and extend  

---

## 🛠️ Tech Stack

* **Frontend**: HTML5, Bootstrap 5, JavaScript (AJAX)
* **Backend**: PHP (MySQLi)
* **Database**: MySQL (`language_platform`)
* **API**: LibreTranslate or RapidAPI fallback for multilingual support

---

## 📁 Folder Structure

```
PolyGlotter/
├── assets/
│ ├── css/
│ │ └── theme-toggle.css
│ │ └── my-translations.css
│ └── js/
│ └── translate.js
│ └── my-translations.js
├── assets/img/
│ └── earth.png
├── includes/
│ └── db.php
├── config.php
├── register.php / register_process.php
├── login.php / login_process.php
├── dashboard.php
├── translate.php
├── fetch_translations.php
├── my_translations.php
├── test_api.php
├── language_platform.sql ✅ (structure only)
└── README.md
```

---

## 📦 Database Schema

### `users`

| id | username | email | password | created\_at |
| -- | -------- | ----- | -------- | ----------- |

### `translations`

| id | user\_id | source\_text | translated\_text | source\_language | target\_language | created\_at |
| -- | -------- | ------------ | ---------------- | ---------------- | ---------------- | ----------- |

---

## 🧪 Setup Instructions

1. Clone the repo:

   ```bash
   git clone https://github.com/your-username/polyglotter.git
   ```
2. Import `language_platform.sql` into MySQL using phpMyAdmin (structure only, no data)
3. Place the project in `htdocs` if using XAMPP
4. Open and edit `config.php` to match your local MySQL credentials
5. Visit `http://localhost/PolyGlotter/` in your browser

---

## 🤝 Contributing

Got ideas or found an issue? Fork this project, make changes, and submit a pull request. Contributions welcome!

---

## 📌 TODO (Future Enhancements)

| Feature                                     | Priority | Status        |
| ------------------------------------------- | -------- | ------------- |
| 🔊 Text-to-Speech (read aloud translation)  | Medium   | ❌ Not started |
| 🍪 Cookie preferences (save theme/language) | Medium   | ❌ Not started |
| 📤 Export or download history as CSV        | Low      | ❌ Not started    |
| 🔐 Password reset or Google Login           | Low/Adv  | ❌ Not started    |

---

## 🏅 Credits

Designed and developed by **Saadiah Khan**.

---

## 🌟 Show Your Support

If this project helped you, please give it a ⭐ on GitHub and share with other developers!
