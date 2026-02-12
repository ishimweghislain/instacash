# INSTACASH WEBSITE - SETUP INSTRUCTIONS

## ✅ IMPORTANT: HOW TO VIEW THE WEBSITE

### Option 1: OPEN DIRECTLY IN YOUR BROWSER (Works Now!)

1. Navigate to `c:\Users\user\instacash\`
2. **Double-click `index.html`** - This will open in your browser
3. All pages work: Home, Services, Requirements, Contact, Apply

**All .HTML files work immediately!** No setup needed.

---

## ⚠️ WHY ARE .PHP FILES DOWNLOADING?

**This is NORMAL behavior on Windows!**

- `.php` files CANNOT run by double-clicking them
- They NEED a web server (like Apache) to execute
- When you click `apply.php` or `admin/index.php`, Windows thinks it's a download because your computer doesn't have PHP installed

---

## 🔧 TO MAKE PHP FILES WORK, YOU HAVE 2 OPTIONS:

### Option A: Upload to Your cPanel Hosting (RECOMMENDED)

1. Login to your cPanel hosting
2. Go to **File Manager** → `public_html`
3. Upload the entire `instacash` folder
4. Go to **phpMyAdmin** 
5. Click **Import** and select `database.sql`
6. Edit `includes/db.php` with your database credentials:
   ```php
   $host = 'localhost';
   $db   = 'instacash';  // Your database name
   $user = 'your_username';  // From cPanel
   $pass = 'your_password';  // From cPanel
   ```
7. Visit `https://yourwebsite.com/instacash/`

**Now the PHP forms will work!**

---

### Option B: Install XAMPP on Your Computer (For Testing)

1. Download XAMPP from: https://www.apachefriends.org/
2. Install XAMPP
3. **Move** `c:\Users\user\instacash\` to `c:\xampp\htdocs\instacash\`
4. Open XAMPP Control Panel
5. Click **Start** for Apache and MySQL
6. Open browser and go to: `http://localhost/phpmyadmin`
7. Click **Import** → Select `database.sql`
8. Visit: `http://localhost/instacash/`

**Now everything works on your computer!**

---

## 📂 FILE STRUCTURE

```
instacash/
├── index.html          ← HOME page (works now!)
├── services.html       ← SERVICES page (works now!)
├── requirements.html   ← REQUIREMENTS page (works now!)
├── contact.html        ← CONTACT page (works now!)
├── apply.html          ← APPLY form (works now!)
├── apply.php           ← APPLY with database (needs server)
├── contact.php         ← CONTACT with database (needs server)
├── database.sql        ← SQL file to import
├── logoofinstacash.png
├── css/
│   └── style.css
├── includes/
│   └── db.php          ← Database connection
└── admin/
    ├── index.php       ← Admin login (needs server)
    ├── dashboard.php   ← View applications
    └── inquiries.php   ← View messages
```

---

## 🔐 ADMIN LOGIN CREDENTIALS

**Username:** `instacash@2026`  
**Password:** `instacashpin2026`

*(Only works after uploading to cPanel or setting up XAMPP)*

---

## 🎨 WHAT'S INCLUDED

✅ Modern Dark Blue & Gold design  
✅ Fully responsive (mobile, tablet, desktop)  
✅ Bottom navigation for mobile  
✅ Service cards with images  
✅ Contact form  
✅ Loan application form  
✅ Admin dashboard to view applications  
✅ Database structure (ready to import)  

---

## 📞 NEED HELP?

If you're still having issues, please:
1. Tell me if you want to upload to **cPanel** or test with **XAMPP**
2. I'll provide specific step-by-step instructions

---

**START HERE:** Just open `index.html` by double-clicking it!
