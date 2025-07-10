<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('petitions_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('petitions_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('petitions_page_title'); ?></title>
    <link rel="icon" href="images/logo.ico" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="petition-form.css" rel="stylesheet">
</head>
<body>
    <!-- Loading overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <!-- Accessibility improvements -->
    <div class="skip-links">
        <a href="#main-content" class="skip-link"><?php echo t('skip_to_content'); ?></a>
    </div>

    <?php include 'includes/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content" id="main-content">
        <section class="page-header">
            <div class="container">
                <h1><?php echo t('petitions_header_title'); ?></h1>
                <p><?php echo t('petitions_header_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="petition-info">
                        <h2><?php echo t('petitions_system_title'); ?></h2>
                        <p><?php echo t('petitions_system_description'); ?></p>
                        
                        <div class="requirements-box">
                            <h3><i class="fas fa-info-circle"></i> <?php echo t('petitions_requirements_title'); ?></h3>
                            <ul>
                                <li><strong><?php echo t('petitions_req_format'); ?></strong></li>
                                <li><strong><?php echo t('petitions_req_signature'); ?></strong></li>
                                <li><strong><?php echo t('petitions_req_size'); ?></strong></li>
                                <li><strong><?php echo t('petitions_req_files'); ?></strong></li>
                            </ul>
                        </div>
                    </div>

                    <form class="petition-form" id="petitionForm">
                        <h3><?php echo t('petition_form_title'); ?></h3>
                        
                        <!-- Entity Type Selection -->
                        <div class="form-group">
                            <label class="form-label required"><?php echo t('petition_entity_type'); ?></label>
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="entity_type" value="individual" required>
                                    <span class="radio-custom"></span>
                                    <span class="radio-text"><?php echo t('petition_individual'); ?></span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="entity_type" value="legal" required>
                                    <span class="radio-custom"></span>
                                    <span class="radio-text"><?php echo t('petition_legal'); ?></span>
                                </label>
                            </div>
                        </div>

                        <!-- Legal Entity Fields -->
                        <div class="form-row" id="legalEntityFields" style="display: none;">
                            <div class="form-group">
                                <label for="idno" class="form-label"><?php echo t('petition_idno_label'); ?></label>
                                <input type="text" id="idno" name="idno" class="form-input" placeholder="<?php echo t('petition_idno_placeholder'); ?>">
                                <small class="form-hint"><?php echo t('petition_idno_hint'); ?></small>
                            </div>
                            
                            <div class="form-group">
                                <label for="company_name" class="form-label"><?php echo t('petition_company_label'); ?></label>
                                <input type="text" id="company_name" name="company_name" class="form-input" placeholder="<?php echo t('petition_company_placeholder'); ?>">
                            </div>
                        </div>

                        <!-- Individual Fields -->
                        <div class="form-row" id="individualFields" style="display: none;">
                            <div class="form-group">
                                <label for="idnp" class="form-label"><?php echo t('petition_idnp_label'); ?></label>
                                <input type="text" id="idnp" name="idnp" class="form-input" placeholder="<?php echo t('petition_idnp_placeholder'); ?>">
                                <small class="form-hint"><?php echo t('petition_idnp_hint'); ?></small>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="last_name" class="form-label required"><?php echo t('petition_last_name_label'); ?></label>
                                <input type="text" id="last_name" name="last_name" class="form-input" required placeholder="<?php echo t('petition_last_name_placeholder'); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="first_name" class="form-label required"><?php echo t('petition_first_name_label'); ?></label>
                                <input type="text" id="first_name" name="first_name" class="form-input" required placeholder="<?php echo t('petition_first_name_placeholder'); ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone" class="form-label required"><?php echo t('petition_phone_label'); ?></label>
                                <input type="tel" id="phone" name="phone" class="form-input" required placeholder="<?php echo t('petition_phone_placeholder'); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="form-label required"><?php echo t('petition_email_label'); ?></label>
                                <input type="email" id="email" name="email" class="form-input" required placeholder="<?php echo t('petition_email_placeholder'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label required"><?php echo t('petition_address_label'); ?></label>
                            <textarea id="address" name="address" class="form-textarea" required placeholder="<?php echo t('petition_address_placeholder'); ?>"></textarea>
                        </div>

                        <!-- Petition Details -->
                        <div class="form-group">
                            <label for="subject" class="form-label required"><?php echo t('petition_subject_label'); ?></label>
                            <input type="text" id="subject" name="subject" class="form-input" required placeholder="<?php echo t('petition_subject_placeholder'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label required"><?php echo t('petition_message_label'); ?></label>
                            <textarea id="message" name="message" class="form-textarea large" required placeholder="<?php echo t('petition_message_placeholder'); ?>"></textarea>
                        </div>

                        <!-- File Uploads -->
                        <div class="form-group">
                            <label for="petition_file" class="form-label required"><?php echo t('petition_file_label'); ?></label>
                            <div class="file-upload-wrapper">
                                <input type="file" id="petition_file" name="petition_file" class="form-file" accept=".pdf" required>
                                <div class="file-upload-info">
                                    <i class="fas fa-file-pdf"></i>
                                    <span><?php echo t('petition_file_choose'); ?></span>
                                </div>
                            </div>
                            <small class="form-hint"><?php echo t('petition_file_hint'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="additional_files" class="form-label"><?php echo t('petition_additional_files_label'); ?></label>
                            <div class="file-upload-wrapper">
                                <input type="file" id="additional_files" name="additional_files[]" class="form-file" accept=".pdf,.doc,.docx,.zip" multiple>
                                <div class="file-upload-info">
                                    <i class="fas fa-paperclip"></i>
                                    <span><?php echo t('petition_additional_files_choose'); ?></span>
                                </div>
                            </div>
                            <small class="form-hint"><?php echo t('petition_additional_files_hint'); ?></small>
                        </div>

                        <!-- Consent Checkboxes -->
                        <div class="consent-section">
                            <div class="form-group checkbox-group">
                                <label class="checkbox-option">
                                    <input type="checkbox" name="data_consent" required>
                                    <span class="checkbox-custom"></span>
                                    <span class="checkbox-text">
                                        <?php echo t('petition_data_consent'); ?>
                                    </span>
                                </label>
                            </div>

                            <div class="form-group checkbox-group">
                                <label class="checkbox-option">
                                    <input type="checkbox" name="data_accuracy" required>
                                    <span class="checkbox-custom"></span>
                                    <span class="checkbox-text">
                                        <?php echo t('petition_data_accuracy'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-actions">
                            <button type="submit" class="submit-btn">
                                <i class="fas fa-paper-plane"></i>
                                <?php echo t('petition_submit_btn'); ?>
                            </button>
                            <button type="reset" class="reset-btn">
                                <i class="fas fa-undo"></i>
                                <?php echo t('petition_reset_btn'); ?>
                            </button>
                        </div>

                        <div class="form-footer">
                            <p><i class="fas fa-info-circle"></i> <?php echo t('petition_footer_info'); ?></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

       <?php include 'includes/footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>