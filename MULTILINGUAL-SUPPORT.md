# Multilingual Support Documentation

## Overview

Librava now has comprehensive multilingual (i18n) support for English and Persian (Farsi). The system automatically detects and switches between languages based on user preference, with full RTL/LTR layout support.

## Language Support

### Supported Languages
- **English (en)** - LTR (Left-to-Right)
- **Persian/Farsi (fa)** - RTL (Right-to-Left)

### Language Detection Priority
1. URL query parameter: `?lang=en` or `?lang=fa`
2. Session variable: `$_SESSION['lang']`
3. Default from environment: `DEFAULT_LANG` env variable (defaults to 'en')

## File Structure

### Translation Files
```
resources/lang/
├── en.php          # English translations (80+ keys)
└── fa.php          # Persian translations (80+ keys)
```

### Translation Keys Organization

#### Navigation (7 keys)
- `nav.home` - Home link
- `nav.books` - Books link
- `nav.about` - About link
- `nav.contact` - Contact link
- `nav.creator` - Creator link
- `nav.api` - API link
- `nav.language` - Language label

#### Home Page (14 keys)
- `home.title` - Page title
- `home.subtitle` - Page subtitle
- `home.browse_books` - Button text
- `home.learn_more` - Button text
- `home.features` - Section title
- `home.multilingual` - Feature title
- `home.multilingual_desc` - Feature description
- `home.mobile_ready` - Feature title
- `home.mobile_ready_desc` - Feature description
- `home.secure` - Feature title
- `home.secure_desc` - Feature description
- `home.fast` - Feature title
- `home.fast_desc` - Feature description
- `home.books_collection` - Stat label
- `home.active_members` - Stat label
- `home.api_endpoints` - Stat label
- `home.featured_books` - Section title
- `home.view_all_books` - Button text
- `home.ready_to_start` - CTA title
- `home.join_community` - CTA subtitle

#### About Page (7 keys)
- `about.title` - Page title
- `about.subtitle` - Page subtitle
- `about.mission` - Section title
- `about.mission_desc` - Section description
- `about.key_stats` - Card title
- `about.why_choose` - Section title
- `about.our_team` - Section title
- `about.tech_stack` - Section title

#### Contact Page (12 keys)
- `contact.title` - Page title
- `contact.subtitle` - Page subtitle
- `contact.send_message` - Form title
- `contact.full_name` - Form label
- `contact.email` - Form label
- `contact.subject` - Form label
- `contact.message` - Form label
- `contact.send` - Button text
- `contact.address` - Info section
- `contact.phone` - Info section
- `contact.business_hours` - Info section
- `contact.follow_us` - Social section

#### Books Page (11 keys)
- `books.title` - Page title
- `books.subtitle` - Page subtitle
- `books.search_placeholder` - Input placeholder
- `books.all_years` - Filter option
- `books.search_btn` - Button text
- `books.popular_categories` - Section title
- `books.fiction` - Category
- `books.science` - Category
- `books.education` - Category
- `books.view_details` - Button text
- `books.author` - Label
- `books.published` - Label
- `books.rating` - Label

#### Creator Page (13 keys)
- `creator.title` - Page title
- `creator.subtitle` - Page subtitle
- `creator.about` - Section title
- `creator.skills` - Section title
- `creator.journey` - Section title
- `creator.team` - Section title
- `creator.development` - Role
- `creator.design` - Role
- `creator.qa` - Role
- `creator.documentation` - Role
- `creator.community` - Role
- `creator.innovation` - Role
- `creator.our_journey` - Section title
- `creator.open_source` - Topic
- `creator.get_in_touch` - CTA

#### Footer (6 keys)
- `footer.company` - Section title
- `footer.about_librava` - Description
- `footer.quick_links` - Section title
- `footer.follow` - Section title
- `footer.copyright` - Copyright text
- `footer.privacy` - Link text
- `footer.terms` - Link text

## Helper Functions

### `getCurrentLang()`
Returns the current language code.
```php
$lang = getCurrentLang(); // Returns 'en' or 'fa'
```

### `getDirection($lang = null)`
Returns the text direction for the specified language.
```php
$dir = getDirection(); // Returns 'ltr' for English, 'rtl' for Persian
```

### `trans($key, $lang = null, $default = null)`
Retrieves translated string by key. Falls back to English if key not found.
```php
$text = trans('home.title');
$text = trans('home.title', 'fa');
```

### `t($key, $lang = null, $default = null)`
Shorthand for `trans()` that echoes the result directly.
```php
<?php t('home.title'); ?>
```

## Language Switcher

The language switcher is integrated into the main navigation bar as a dropdown menu showing:
- Current language name
- Flag or globe icon
- Options to switch to English or Persian

### Location
- File: `app/views/layout.php`
- Position: Right side of navigation bar, before API button
- Behavior: Clicking a language option adds `?lang=en` or `?lang=fa` to current URL

### HTML Structure
```html
<li class="nav-item dropdown ms-2">
    <a class="nav-link dropdown-toggle" href="#" id="navbarLanguage">
        <i class="fas fa-globe me-1"></i><?php echo $lang === 'fa' ? 'فارسی' : 'English'; ?>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="?lang=en">English</a></li>
        <li><a class="dropdown-item" href="?lang=fa">فارسی</a></li>
    </ul>
</li>
```

## Layout Direction

The main layout (`app/views/layout.php`) automatically applies RTL/LTR styling based on language:
```html
<html lang="<?= htmlentities($lang ?? 'en') ?>" dir="<?= htmlentities($dir ?? 'ltr') ?>">
```

## Using Translations in Views

### Basic Usage
```php
<?php t('home.title'); ?>
```

### With Variables
```php
$title = trans('home.title');
echo htmlentities($title);
```

### With Custom Default
```php
$text = trans('custom.key', null, 'Default text');
?>
```

## Adding New Translations

1. **Edit Language Files**
   - Add keys to `resources/lang/en.php`
   - Add corresponding Persian translations to `resources/lang/fa.php`

2. **Use in Views**
   - Replace hardcoded text with `<?php t('key.name'); ?>`
   - Ensure keys match between both language files

3. **Example:**
   ```php
   // en.php
   'new_feature' => 'New Feature Name',
   
   // fa.php
   'new_feature' => 'نام ویژگی جدید',
   
   // In view
   <?php t('new_feature'); ?>
   ```

## Persistence

Currently, language preference persists via URL parameter (`?lang=en`). Future enhancements can add:
- **localStorage**: Browser-based persistence across sessions
- **Cookies**: Server-side persistence for returning visitors
- **Database**: User-specific language preference for authenticated users

## RTL/LTR Support

### Automatic Direction
The system automatically applies RTL layout when Persian is selected:
- Text direction switches to right-to-left
- Margins and padding automatically flip
- Navigation and UI elements reposition

### CSS Classes
Bootstrap utilities can be used for directional styling:
```html
<!-- Only applies in RTL mode -->
<div class="ms-2"> <!-- Margin-start (right margin in RTL) -->
  Content
</div>
```

## Testing Languages

### Test English
1. Visit: `http://localhost:8000/?lang=en`
2. Verify all English text appears
3. Verify LTR layout

### Test Persian
1. Visit: `http://localhost:8000/?lang=fa`
2. Verify all Persian text appears (Unicode handling)
3. Verify RTL layout
4. Check navigation flows from right to left

## Browser Compatibility

- All modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile browsers (iOS Safari, Chrome Mobile)
- Unicode support required for Persian characters

## Future Enhancements

1. **Client-Side Persistence**
   - localStorage for cross-session language preference
   - Modal reminder for first-time Persian users

2. **Auto-Detection**
   - Browser language preference detection
   - GeoIP-based language suggestion

3. **Additional Languages**
   - Arabic (ar) - RTL
   - Urdu (ur) - RTL
   - Russian (ru) - LTR
   - Spanish (es) - LTR

4. **Translation Management**
   - Translation admin panel
   - Import/export functionality
   - Translation progress dashboard

5. **SEO**
   - hreflang tags for multi-language pages
   - Language-specific sitemaps
   - URL structure: `/en/books`, `/fa/books` (vs current `?lang=` param)

## Troubleshooting

### Missing Translations
- Check key exists in both `en.php` and `fa.php`
- Verify key naming matches exactly (case-sensitive)
- Check for typos in view files

### RTL Not Applying
- Clear browser cache
- Verify `dir="rtl"` attribute on HTML element
- Check CSS for hardcoded directions

### Language Not Switching
- Check URL has `?lang=en` or `?lang=fa`
- Verify `lang` and `dir` variables passed to layout
- Check language file exists and is readable

## Migration from Hardcoded Text

All page views have been updated to use translation keys:
- `app/views/home.php` ✓
- `app/views/about.php` ✓
- `app/views/contact.php` ✓
- `app/views/books.php` ✓
- `app/views/creator.php` ✓
- `app/views/layout.php` ✓

Headers, footers, and navigation all now use translation keys for full multilingual support.
