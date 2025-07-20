#!/bin/bash

# Script to add GDPR compliance to all PHP pages
# This script updates all PHP files to include GDPR components

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"
SRC_DIR="$SCRIPT_DIR"

echo "Adding GDPR compliance to PHP pages..."

# List of files to update (excluding admin and handler files)
files=(
    "administratia.php"
    "achizitii.php"
    "acte-internationale.php"
    "acte-interne.php"
    "acte-nationale.php"
    "codul-deontologic.php"
    "functii-vacante.php"
    "galerie.php"
    "ghiduri.php"
    "intrebari-frecvente.php"
    "invitatii-participare.php"
    "metodologii.php"
    "organigrama.php"
    "planuri-achizitii.php"
    "proiecte.php"
    "rapoarte-achizitii.php"
    "rapoarte.php"
    "registru-cadouri.php"
    "sectia-asistenta-medicala.php"
    "sectia-asistenta-psihopedagogica.php"
    "sectia-criza-reintegrare-familiala.php"
    "sectia-de-zi.php"
    "sectia-maternala.php"
    "sectia-reabilitare.php"
    "sectia-respiro.php"
    "sectia-zi-4luni-3ani.php"
)

for file in "${files[@]}"; do
    if [ -f "$SRC_DIR/$file" ]; then
        echo "Processing $file..."
        
        # Check if GDPR includes are already present
        if ! grep -q "includes/gdpr.php" "$SRC_DIR/$file"; then
            # Add GDPR includes after lang.php include
            sed -i '/require_once.*includes\/lang\.php/a require_once __DIR__ . '\''/includes/gdpr.php'\'';\nrequire_once __DIR__ . '\''/includes/analytics.php'\'';' "$SRC_DIR/$file"
        fi
        
        # Check if GDPR CSS is already included
        if ! grep -q "gdpr-styles.css" "$SRC_DIR/$file"; then
            # Add GDPR CSS after style.css
            sed -i '/href="style\.css"/a \    <link href="gdpr-styles.css" rel="stylesheet">' "$SRC_DIR/$file"
        fi
        
        # Check if GDPR components are already included
        if ! grep -q "GDPRManager::renderConsentBanner" "$SRC_DIR/$file"; then
            # Add GDPR components before script includes
            sed -i '/    <script src="script\.js"><\/script>/i \    <!-- GDPR Compliance Components -->\n    <?php echo GDPRManager::renderConsentBanner(); ?>\n    <?php echo GDPRManager::renderConsentModal(); ?>\n' "$SRC_DIR/$file"
            
            # Add GDPR script after script.js
            sed -i '/    <script src="script\.js"><\/script>/a \    <script src="gdpr-script.js"></script>' "$SRC_DIR/$file"
        fi
        
        echo "✓ Updated $file"
    else
        echo "⚠ File $file not found"
    fi
done

echo "GDPR compliance update complete!"
echo ""
echo "Summary of changes made:"
echo "- Added GDPR and Analytics includes"
echo "- Added GDPR CSS stylesheet"
echo "- Added GDPR consent banner and modal"
echo "- Added GDPR JavaScript functionality"
echo ""
echo "Please test the website to ensure everything works correctly."
