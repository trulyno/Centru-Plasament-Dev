# Admin Panel pentru CPRCVF

## Descriere
Sistem de administrare pentru site-ul Centrului de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă.

## Funcționalități Implementate
- **Autentificare sigură** cu credențiale hardcodate
- **Dashboard principal** cu statistici și acțiuni rapide
- **Gestionare servicii** - editare, adăugare, ștergere servicii
- **Gestionare pagina principală** - Hero section, Despre noi, Statistici, Galerie, Testimoniale
- **Sistem de backup** automat și manual
- **Gestionare setări** generale și de securitate
- **Jurnalizare activități** pentru urmărirea modificărilor
- **Interface responsive** pentru toate dispozitivele

## Credențiale de Acces

**Utilizator:** `admin`
**Parolă:** `cprcvf2025!`

⚠️ **IMPORTANT:** Schimbați parola după prima autentificare prin modificarea fișierului `config/admin_config.php`!

## Gestionare Conținut Pagina Principală

Panoul de administrare permite gestionarea completă a conținutului paginii principale:

### 1. Hero Section
- **Slide-uri multiple** cu titlu, descriere, buton și imagine
- **Link-uri personalizabile** pentru butoane
- **Gestionare imagini** din galeria existentă

### 2. Secțiunea Despre Noi
- **Titlu principal** editabil
- **Trei paragrafe** de conținut editabile
- **Text formatat** cu suport HTML

### 3. Statistici
- **Patru statistici** cu valori numerice și etichete
- **Validare automată** pentru valori numerice
- **Actualizare în timp real**

### 4. Galerie Preview
- **Cinci imagini** selectabile din galeria existentă
- **Titluri și descrieri** personalizabile pentru fiecare imagine
- **Navigare automată** între imagini

### 5. Testimoniale
- **Testimoniale multiple** cu citate, autori și roluri
- **Gestionare completă** a conținutului testimonialelor
- **Format consistent** pentru afișare

## Structura Fișierelor

```
admin/
├── index.php              # Pagina de login
├── dashboard.php          # Dashboard principal
├── manage.php             # Gestionare conținut
├── backups.php            # Gestionare backup-uri
├── settings.php           # Setări sistem
├── logout.php             # Deconectare
├── includes/
│   ├── auth.php           # Funcționalități autentificare
│   └── content_manager.php # Gestionare conținut
└── assets/
    ├── admin.css          # Stiluri admin (cu suport pentru tab-uri)
    └── admin.js           # JavaScript admin (cu funcționalitate tab-uri)

config/
└── admin_config.php       # Configurare admin

info/
└── ro_md.txt             # Fișier de configurare cu toate datele site-ului

logs/                      # Jurnale activități
backups/                   # Backup-uri automate
```

## Funcționalități Tehnice

### Tab Navigation
Panoul pentru pagina principală folosește un sistem de tab-uri pentru organizarea secțiunilor:
- **Tab-uri interactive** cu JavaScript
- **Stilizare modernă** cu CSS3
- **Responsive design** pentru mobile

### Validare Date
- **Validare server-side** pentru toate modificările
- **Verificare imagini** - confirmă existența fișierelor
- **Validare numerică** pentru statistici
- **Protecție XSS** prin htmlspecialchars

### Backup Automat
- **Backup înainte de modificări** pentru siguranță
- **Istoric complet** al modificărilor
- **Restaurare rapidă** din backup-uri anterioare

## Cum să Folosești

### 1. Accesarea Panoulului
1. Navigați la `/admin/`
2. Autentificați-vă cu credențialele de mai sus
3. Selectați "Pagina Principală" din meniu

### 2. Gestionarea Conținutului
1. **Selectați tab-ul** pentru secțiunea dorită
2. **Editați conținutul** în formularele disponibile
3. **Salvați modificările** cu butonul corespunzător
4. **Verificați rezultatul** pe pagina principală

### 3. Gestionarea Imaginilor
- Imaginile sunt selectate din galeria existentă (`/images/`)
- Pentru a adăuga imagini noi, încărcați-le în directorul `/images/`
- Formatele suportate: JPG, JPEG, PNG, GIF, WEBP

## Securitate

- **Sesiuni sigure** cu timeout de 2 ore
- **Validare completă** a datelor de intrare
- **Jurnalizare** a tuturor activităților
- **Backup automat** pentru protecție date

## Suport și Dezvoltare

Pentru extinderea funcționalităților:

1. **Adăugați noua pagină** în `$ADMIN_PAGES` din `admin_config.php`
2. **Creați logica** în `manage.php`
3. **Implementați validarea** în `ContentManager`
4. **Adăugați stilurile** în `admin.css`

## Versioning

**Versiunea 1.0** - Funcționalitate completă pentru gestionarea paginii principale
- Hero section management
- About section management  
- Statistics management
- Gallery management
- Testimonials management
- Services management (existent)

---

*Dezvoltat pentru CPRCVF Chișinău - Iunie 2025*
