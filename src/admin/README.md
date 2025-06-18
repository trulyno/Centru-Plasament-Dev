# Admin Panel pentru CPRCVF

## Descriere
Sistem de administrare pentru site-ul Centrului de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă.

## Funcționalități
- **Autentificare sigură** cu credențiale hardcodate
- **Dashboard principal** cu statistici și acțiuni rapide
- **Gestionare servicii** - editare, adăugare, ștergere servicii
- **Sistem de backup** automat și manual
- **Gestionare setări** generale și de securitate
- **Jurnalizare activități** pentru urmărirea modificărilor
- **Interface responsive** pentru toate dispozitivele

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
    ├── admin.css          # Stiluri admin
    └── admin.js           # JavaScript admin

config/
└── admin_config.php       # Configurare admin

logs/                      # Jurnale activități
backups/                   # Backup-uri automate
```

## Credențiale Implicite

**Utilizator:** `admin`
**Parolă:** `cprcvf2024!`

⚠️ **IMPORTANT:** Schimbați parola după prima autentificare!

## Instalare

1. Copiați folderul `admin/` și `config/` în directorul principal al site-ului
2. Asigurați-vă că directoarele `logs/` și `backups/` au permisiuni de scriere
3. Accesați `/admin/` pentru a vă autentifica

## Securitate

- Sesiunile expiră după 2 ore de inactivitate
- Backup automat înainte de fiecare modificare
- Jurnalizare completă a activităților
- Validare pe server pentru toate modificările

## Gestionare Servicii

Sistemul permite:
- Editarea serviciilor existente
- Adăugarea de servicii noi
- Ștergerea serviciilor
- Gestionarea imaginilor asociate
- Validarea datelor înainte de salvare

## Backup-uri

- Backup automat la fiecare modificare
- Backup manual din panoul de administrare
- Restaurare rapidă din backup-uri anterioare
- Descărcare backup-uri pentru arhivare locală

## Extindere

Pentru a adăuga noi funcționalități:

1. Adăugați noua pagină în `$ADMIN_PAGES` din `admin_config.php`
2. Creați logica de gestionare în `manage.php`
3. Implementați validarea în `ContentManager`
4. Adăugați stilurile necesare în `admin.css`

## Suport Tehnic

Pentru probleme tehnice sau întrebări despre funcționarea sistemului, contactați administratorul site-ului.

---

*Versiunea 1.0 - Dezvoltat pentru CPRCVF Chișinău*
