#!/bin/bash

# Script to automatically convert HTML files to PHP templates
# Usage: ./convert_html_to_php.sh

SOURCE_DIR="/home/trulyno/Projects/PHP Server/site"
DEST_DIR="/home/trulyno/Projects/PHP Server/php_site/templates/pages"

# Create page-template.php template for each HTML file
process_file() {
    local html_file="$1"
    local base_name=$(basename "$html_file" .html)
    local php_file="$DEST_DIR/$base_name.php"
    
    # Skip if already converted or if it's a special file
    if [[ -f "$php_file" ]] || [[ "$base_name" == "style" ]] || [[ "$base_name" == "script" ]]; then
        echo "Skipping $base_name (already exists or is a special file)"
        return
    fi
    
    # Create PHP template
    echo "Converting $base_name.html to $base_name.php"
    
    # Extract page title from HTML
    local title=$(grep -oP '(?<=<title>).*?(?= - )' "$html_file" || echo "$base_name")
    
    # Create PHP file with basic template
    cat > "$php_file" << EOF
<?php
/**
 * $title page template
 */

// Page-specific metadata
\$pageDescription = '$title';
\$pageKeywords = '${base_name//-/, }, centru plasament, copii';
?>

<!-- Main Content -->
<section class="page-header">
    <div class="container">
        <h1>$title</h1>
    </div>
</section>

<section class="content-section">
    <div class="container">
        <div class="content-wrapper">
            <!-- Replace this content with specific content from the HTML file -->
            <div class="service-hero">
                <div class="service-hero-content">
                    <h2>Despre $title</h2>
                    <p>Acest conținut trebuie actualizat cu informațiile specifice din pagina HTML originală.</p>
                </div>
            </div>
            
            <!-- Content here -->
            
        </div>
    </div>
</section>
EOF
    
    echo "Created template for $base_name.php"
}

# Process all HTML files except special ones
find "$SOURCE_DIR" -name "*.html" | while read html_file; do
    process_file "$html_file"
done

echo "Conversion complete. Please manually update the content for each page from the original HTML files."
