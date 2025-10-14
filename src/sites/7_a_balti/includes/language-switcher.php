<?php
// Include this file to get language switcher HTML
global $lang;
?>
<div class="language-switcher">
    <button class="language-toggle" aria-label="<?php echo t('language_switch'); ?>" title="<?php echo t('language_switch'); ?>">
        <span class="current-lang"><?php echo $lang->getCurrentLang(); ?></span>
        <i class="fas fa-chevron-down"></i>
    </button>
    <ul class="language-menu">
        <?php foreach ($lang->getAvailableLanguages() as $langCode): ?>
            <li>
                <a href="<?php echo $lang->getLanguageUrl($langCode); ?>" 
                   class="language-option <?php echo $langCode === $lang->getCurrentLang() ? 'active' : ''; ?>"
                   data-lang="<?php echo $langCode; ?>">
                    <span class="lang-name"><?php echo $lang->getLanguageName($langCode); ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
