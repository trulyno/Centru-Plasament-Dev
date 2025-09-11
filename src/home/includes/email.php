<?php
/**
 * Email Configuration and Utility Class
 * Handles email sending for contact forms and petitions
 */

class EmailManager {
    
    private static $config = null;
    
    /**
     * Load email configuration
     */
    private static function loadConfig() {
        if (self::$config === null) {
            // Check if running in Docker environment
            $isDocker = file_exists('/.dockerenv') || getenv('DOCKER_ENV') === 'true';
            
            if ($isDocker) {
                $configFile = __DIR__ . '/../config/email-docker.php';
            } else {
                $configFile = __DIR__ . '/../config/email.php';
            }
            
            if (file_exists($configFile)) {
                self::$config = include $configFile;
            } else {
                // Fallback configuration
                self::$config = [
                    'smtp' => ['enabled' => false],
                    'addresses' => [
                        'from_email' => 'noreply@cprcvf.md',
                        'from_name' => 'Centrul de Plasament și Reabilitare',
                        'admin_email' => 'centru_plasament@agssi.md',
                        'reply_to' => 'centru_plasament@agssi.md',
                    ],
                    'settings' => [
                        'charset' => 'utf-8',
                        'content_type' => 'text/html',
                        'enable_debug' => false,
                    ]
                ];
            }
        }
        return self::$config;
    }
    
    /**
     * Send email using PHP's built-in mail() function
     */
    public static function sendEmail($to, $subject, $message, $headers = '') {
        $config = self::loadConfig();
        
        if (empty($headers)) {
            $headers = self::getDefaultHeaders();
        }
        
        // Debug information for Docker environment
        if ($config['settings']['enable_debug']) {
            error_log("Email Debug - To: $to, Subject: $subject");
            error_log("Email Debug - Headers: $headers");
        }
        
        $result = mail($to, $subject, $message, $headers);
        
        if ($config['settings']['enable_debug']) {
            error_log("Email Debug - Send result: " . ($result ? 'SUCCESS' : 'FAILED'));
            if (!$result) {
                $lastError = error_get_last();
                $errorMessage = $lastError ? $lastError['message'] : 'Unknown error';
                error_log("Email Debug - Last error: " . $errorMessage);
            }
        }
        
        return $result;
    }
    
    /**
     * Send email using SMTP (requires PHPMailer or similar)
     * For now, we'll use the basic mail() function
     */
    public static function sendSMTPEmail($to, $subject, $message) {
        // This would require PHPMailer library
        // For now, fallback to basic mail
        return self::sendEmail($to, $subject, $message);
    }
    
    /**
     * Get default email headers
     */
    private static function getDefaultHeaders() {
        $config = self::loadConfig();
        $headers = [];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: ' . $config['settings']['content_type'] . '; charset=' . $config['settings']['charset'];
        $headers[] = 'From: ' . $config['addresses']['from_name'] . ' <' . $config['addresses']['from_email'] . '>';
        $headers[] = 'Reply-To: ' . $config['addresses']['reply_to'];
        $headers[] = 'X-Mailer: PHP/' . phpversion();
        
        return implode("\r\n", $headers);
    }
    
    /**
     * Send contact form notification
     */
    public static function sendContactFormNotification($formData) {
        $config = self::loadConfig();
        $subject = '[Contact Form] ' . $formData['subject'];
        
        $message = self::getContactFormTemplate($formData);
        
        // Send to admin
        $adminSent = self::sendEmail($config['addresses']['admin_email'], $subject, $message);
        
        // Send confirmation to user
        $confirmationSent = self::sendContactFormConfirmation($formData);
        
        return $adminSent && $confirmationSent;
    }
    
    /**
     * Send petition form notification
     */
    public static function sendPetitionFormNotification($formData) {
        $config = self::loadConfig();
        $subject = '[Petiție] ' . $formData['subject'];
        
        $message = self::getPetitionFormTemplate($formData);
        
        // Send to admin
        $adminSent = self::sendEmail($config['addresses']['admin_email'], $subject, $message);
        
        // Send confirmation to user
        $confirmationSent = self::sendPetitionFormConfirmation($formData);
        
        return $adminSent && $confirmationSent;
    }
    
    /**
     * Send confirmation email to contact form submitter
     */
    private static function sendContactFormConfirmation($formData) {
        $subject = 'Confirmarea primirii mesajului - Centrul de Plasament și Reabilitare';
        
        $message = self::getContactFormConfirmationTemplate($formData);
        
        return self::sendEmail($formData['email'], $subject, $message);
    }
    
    /**
     * Send confirmation email to petition form submitter
     */
    private static function sendPetitionFormConfirmation($formData) {
        $subject = 'Confirmarea primirii petiției - Centrul de Plasament și Reabilitare';
        
        $message = self::getPetitionFormConfirmationTemplate($formData);
        
        return self::sendEmail($formData['email'], $subject, $message);
    }
    
    /**
     * Contact form email template for admin
     */
    private static function getContactFormTemplate($data) {
        $html = '
        <!DOCTYPE html>
        <html lang="ro">
        <head>
            <meta charset="UTF-8">
            <title>Mesaj nou din formularul de contact</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #2c3e50; color: white; padding: 20px; text-align: center; }
                .content { background-color: #f9f9f9; padding: 20px; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #2c3e50; }
                .value { margin-top: 5px; padding: 10px; background-color: white; border-left: 3px solid #3498db; }
                .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Mesaj nou din formularul de contact</h1>
                </div>
                <div class="content">
                    <div class="field">
                        <div class="label">Nume:</div>
                        <div class="value">' . htmlspecialchars($data['name']) . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Email:</div>
                        <div class="value">' . htmlspecialchars($data['email']) . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Telefon:</div>
                        <div class="value">' . htmlspecialchars($data['phone'] ?? 'Nu a fost specificat') . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Subiect:</div>
                        <div class="value">' . htmlspecialchars($data['subject']) . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Mesaj:</div>
                        <div class="value">' . nl2br(htmlspecialchars($data['message'])) . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Data și ora:</div>
                        <div class="value">' . htmlspecialchars($data['timestamp']) . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Adresa IP:</div>
                        <div class="value">' . htmlspecialchars($data['ip_address']) . '</div>
                    </div>
                </div>
                <div class="footer">
                    <p>Acest email a fost generat automat de sistemul de contact al Centrului de Plasament și Reabilitare.</p>
                </div>
            </div>
        </body>
        </html>';
        
        return $html;
    }
    
    /**
     * Contact form confirmation template for user
     */
    private static function getContactFormConfirmationTemplate($data) {
        $html = '
        <!DOCTYPE html>
        <html lang="ro">
        <head>
            <meta charset="UTF-8">
            <title>Confirmarea primirii mesajului</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #27ae60; color: white; padding: 20px; text-align: center; }
                .content { background-color: #f9f9f9; padding: 20px; }
                .message { background-color: white; padding: 15px; border-left: 3px solid #27ae60; margin: 15px 0; }
                .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
                .contact-info { background-color: #ecf0f1; padding: 15px; margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Vă mulțumim pentru mesaj!</h1>
                </div>
                <div class="content">
                    <p>Stimate/Stimată <strong>' . htmlspecialchars($data['name']) . '</strong>,</p>
                    
                    <div class="message">
                        <p>Am primit mesajul dumneavoastră cu subiectul "<strong>' . htmlspecialchars($data['subject']) . '</strong>" și vă mulțumim pentru că ne-ați contactat.</p>
                        
                        <p>Echipa noastră va analiza cererea dumneavoastră și vă va contacta în cel mai scurt timp posibil la adresa de email: <strong>' . htmlspecialchars($data['email']) . '</strong></p>
                    </div>
                    
                    <p>În cazul în care aveți o urgență, vă rugăm să ne contactați direct la numerele de telefon de mai jos.</p>
                    
                    <div class="contact-info">
                        <h3>Informații de contact:</h3>
                        <p><strong>Telefon:</strong> 022 737 027</p>
                        <p><strong>Email:</strong> centru_plasament@agssi.md</p>
                        <p><strong>Adresa:</strong> str. Gh. Asachi 67, Chișinău, Moldova</p>
                        <p><strong>Program:</strong> Luni - Vineri, 08:00 - 17:00</p>
                    </div>
                </div>
                <div class="footer">
                    <p>Cu respect,<br>Echipa Centrului de Plasament și Reabilitare a Copiilor Mici</p>
                    <p>Acest email a fost generat automat. Vă rugăm să nu răspundeți la acest mesaj.</p>
                </div>
            </div>
        </body>
        </html>';
        
        return $html;
    }
    
    /**
     * Petition form email template for admin
     */
    private static function getPetitionFormTemplate($data) {
        $entityType = $data['entity_type'] === 'individual' ? 'Persoană fizică' : 'Persoană juridică';
        
        $html = '
        <!DOCTYPE html>
        <html lang="ro">
        <head>
            <meta charset="UTF-8">
            <title>Petiție nouă primită</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #e74c3c; color: white; padding: 20px; text-align: center; }
                .content { background-color: #f9f9f9; padding: 20px; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #2c3e50; }
                .value { margin-top: 5px; padding: 10px; background-color: white; border-left: 3px solid #e74c3c; }
                .files { background-color: #fff3cd; padding: 15px; margin: 15px 0; border-left: 3px solid #ffc107; }
                .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Petiție nouă primită</h1>
                </div>
                <div class="content">
                    <div class="field">
                        <div class="label">Tip entitate:</div>
                        <div class="value">' . $entityType . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Nume:</div>
                        <div class="value">' . htmlspecialchars($data['first_name'] . ' ' . $data['last_name']) . '</div>
                    </div>';
                    
        if ($data['entity_type'] === 'legal') {
            $html .= '
                    <div class="field">
                        <div class="label">Organizația:</div>
                        <div class="value">' . htmlspecialchars($data['organization_name'] ?? 'Nu a fost specificată') . '</div>
                    </div>
                    <div class="field">
                        <div class="label">IDNO:</div>
                        <div class="value">' . htmlspecialchars($data['idno'] ?? 'Nu a fost specificat') . '</div>
                    </div>';
        } else {
            $html .= '
                    <div class="field">
                        <div class="label">IDNP:</div>
                        <div class="value">' . htmlspecialchars($data['idnp'] ?? 'Nu a fost specificat') . '</div>
                    </div>';
        }
        
        $html .= '
                    <div class="field">
                        <div class="label">Email:</div>
                        <div class="value">' . htmlspecialchars($data['email']) . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Telefon:</div>
                        <div class="value">' . htmlspecialchars($data['phone']) . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Adresa:</div>
                        <div class="value">' . htmlspecialchars($data['address']) . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Subiect:</div>
                        <div class="value">' . htmlspecialchars($data['subject']) . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Mesaj:</div>
                        <div class="value">' . nl2br(htmlspecialchars($data['message'])) . '</div>
                    </div>';
                    
        if (!empty($data['files'])) {
            $html .= '<div class="files"><h3>Fișiere atașate:</h3>';
            if (isset($data['files']['petition_file'])) {
                $html .= '<p><strong>Fișier petiție:</strong> ' . htmlspecialchars($data['files']['petition_file']) . '</p>';
            }
            if (isset($data['files']['additional_files'])) {
                $html .= '<p><strong>Fișiere suplimentare:</strong></p><ul>';
                foreach ($data['files']['additional_files'] as $file) {
                    $html .= '<li>' . htmlspecialchars($file['original_name']) . ' (' . round($file['size']/1024, 2) . ' KB)</li>';
                }
                $html .= '</ul>';
            }
            $html .= '</div>';
        }
        
        $html .= '
                    <div class="field">
                        <div class="label">Data și ora:</div>
                        <div class="value">' . htmlspecialchars($data['timestamp']) . '</div>
                    </div>
                    <div class="field">
                        <div class="label">Adresa IP:</div>
                        <div class="value">' . htmlspecialchars($data['ip_address']) . '</div>
                    </div>
                </div>
                <div class="footer">
                    <p>Această petiție a fost trimisă prin sistemul online al Centrului de Plasament și Reabilitare.</p>
                </div>
            </div>
        </body>
        </html>';
        
        return $html;
    }
    
    /**
     * Petition form confirmation template for user
     */
    private static function getPetitionFormConfirmationTemplate($data) {
        $html = '
        <!DOCTYPE html>
        <html lang="ro">
        <head>
            <meta charset="UTF-8">
            <title>Confirmarea primirii petiției</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #27ae60; color: white; padding: 20px; text-align: center; }
                .content { background-color: #f9f9f9; padding: 20px; }
                .message { background-color: white; padding: 15px; border-left: 3px solid #27ae60; margin: 15px 0; }
                .important { background-color: #fff3cd; padding: 15px; margin: 15px 0; border-left: 3px solid #ffc107; }
                .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
                .contact-info { background-color: #ecf0f1; padding: 15px; margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Confirmarea primirii petiției</h1>
                </div>
                <div class="content">
                    <p>Stimate/Stimată <strong>' . htmlspecialchars($data['first_name'] . ' ' . $data['last_name']) . '</strong>,</p>
                    
                    <div class="message">
                        <p>Am primit petiția dumneavoastră cu subiectul "<strong>' . htmlspecialchars($data['subject']) . '</strong>" și vă mulțumim pentru încrederea acordată.</p>
                        
                        <p>Petiția dumneavoastră a fost înregistrată în data de <strong>' . htmlspecialchars($data['timestamp']) . '</strong> și va fi analizată conform legislației în vigoare.</p>
                    </div>
                    
                    <div class="important">
                        <h3>Informații importante:</h3>
                        <ul>
                            <li>Conform Legii nr. 190/2017 privind petițiile, termenul de examinare este de 30 de zile calendaristice</li>
                            <li>Veți fi contactat/ă la adresa de email: <strong>' . htmlspecialchars($data['email']) . '</strong></li>
                            <li>În cazul unor clarificări suplimentare, vă vom contacta la numărul de telefon: <strong>' . htmlspecialchars($data['phone']) . '</strong></li>
                        </ul>
                    </div>
                    
                    <div class="contact-info">
                        <h3>Pentru informații suplimentare:</h3>
                        <p><strong>Telefon:</strong> 022 737 027</p>
                        <p><strong>Email:</strong> centru_plasament@agssi.md</p>
                        <p><strong>Adresa:</strong> str. Gh. Asachi 67, Chișinău, Moldova</p>
                        <p><strong>Program:</strong> Luni - Vineri, 08:00 - 17:00</p>
                    </div>
                </div>
                <div class="footer">
                    <p>Cu respect,<br>Echipa Centrului de Plasament și Reabilitare a Copiilor Mici</p>
                    <p>Acest email a fost generat automat. Vă rugăm să nu răspundeți la acest mesaj.</p>
                </div>
            </div>
        </body>
        </html>';
        
        return $html;
    }
}
?>
