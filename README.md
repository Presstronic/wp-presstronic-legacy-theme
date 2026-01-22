# Presstronic Legacy — WordPress Theme

A fast, dependency-free WordPress theme that recreates the classic 2015 Presstronic one-page layout:
hero (with background image), About, Services, and Contact — including the “transparent nav on top,
solid nav on scroll” behavior and smooth-scrolling anchor navigation.

## Goals

- **Lightweight & fast**: no Bootstrap, no jQuery, no icon fonts.
- **SEO-friendly**: semantic HTML, proper headings, clean page templates for future pages.
- **Yours**: simple PHP + CSS + vanilla JS, easy to extend, perfect for GitHub.

## What's Included

- `front-page.php` one-page homepage layout (anchors: `#about`, `#services`, `#contact`)
- Simple content templates for future pages/posts:
  - `page.php`, `single.php`, `index.php`
- Customizer options:
  - Hero background image, title, paragraph, button text
  - About title/paragraph/button text
  - Services title
  - Contact title/paragraph + twitter/email
- Assets:
  - `assets/css/main.css`
  - `assets/js/main.js`
  - `assets/img/hero.jpg` (default hero image)

## Install

### Option A — Upload via WordPress Admin
1. In WP Admin: **Appearance → Themes → Add New → Upload Theme**
2. Upload the zip: `presstronic-legacy-theme.zip`
3. Click **Install Now**, then **Activate**

### Option B — Install via Filesystem
1. Unzip into: `wp-content/themes/`
   - You should end up with: `wp-content/themes/presstronic-legacy/`
2. In WP Admin: **Appearance → Themes**
3. Activate **Presstronic Legacy**

## Configure the Homepage

This theme uses `front-page.php`. To ensure WordPress uses it:

1. In WP Admin: **Settings → Reading**
2. Under “Your homepage displays”, select **A static page**
3. Create/select a page named **Home**
4. Set **Homepage: Home**
5. Save changes

> If you prefer “Latest posts” as the homepage, WordPress may not use `front-page.php`
> the way you expect. The static page approach is recommended.

## Customize Text + Images (Customizer)

1. WP Admin: **Appearance → Customize**
2. Update:
   - **Homepage**: hero image + hero/about/services text
   - **Contact**: contact copy + twitter/email
3. Publish

## Hero Image

Default image: `assets/img/hero.jpg`

You can replace it in two ways:
- **Customizer** (recommended): Appearance → Customize → Homepage → Hero Background Image
- Replace the file directly: `assets/img/hero.jpg`

## Development Notes

- Main styles: `assets/css/main.css`
- Behavior: `assets/js/main.js` (nav state + active link + smooth-scroll offset)
- No heavy dependencies: no Bootstrap/jQuery/WOW/etc.

## GitHub Workflow

Recommended structure:
- Put the theme folder (`presstronic-legacy`) into your repo
- Tag releases when you deploy

Example:
```bash
git init
git add .
git commit -m "Initial Presstronic Legacy theme"
```

## License

GPL v2 or later (standard for WordPress themes).
