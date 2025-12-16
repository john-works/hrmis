# Custom HRMIS Styles Integration Guide

## Overview
Your custom CSS styles from the old HR project have been successfully integrated into the Laravel application using SCSS for better maintainability and performance.

---

## What Was Done

### 1. **Created SCSS Variables** (`resources/sass/_variables.scss`)
- Added custom color variables matching your existing CSS:
  - `$psc-blue: #0a4a7a` - Primary brand color
  - `$psc-dark: #1a3d54` - Dark variant
  - `$psc-light-blue: #d1ecf1` - Light variant
  - `$psc-accent: #ff6b35` - Accent/orange color
  - Additional utility colors (success, warning, danger, etc.)

### 2. **Created Custom SCSS File** (`resources/sass/custom.scss`)
- Migrated all custom styles from `public/css/styles.css`
- Removed duplicate CSS rules
- Converted to SCSS with:
  - Nested selectors for better organization
  - Variable references instead of hardcoded colors
  - Responsive breakpoints organized by device type

### 3. **Updated App SCSS** (`resources/sass/app.scss`)
- Added import for the new custom styles: `@import 'custom';`
- Now combines Bootstrap + custom styles into one compiled CSS file

### 4. **Updated App Layout** (`resources/views/layouts/app.blade.php`)
- Changed from static CSS link to Vite asset pipeline
- Uses `@vite(['resources/sass/app.scss', 'resources/js/app.js'])`
- Ensures proper cache busting and hot reload during development

---

## File Structure

```
resources/
├── sass/
│   ├── _variables.scss      (Color & typography variables)
│   ├── app.scss             (Main SCSS - imports Bootstrap + custom)
│   └── custom.scss          (All custom HRMIS styles)
├── views/
│   ├── layouts/
│   │   └── app.blade.php    (Updated to use Vite)
└── ...

public/css/
└── styles.css               (Original - can be removed later)
```

---

## Building & Development

### Development Mode
```bash
npm run dev
```
- Enables HMR (Hot Module Reload)
- SCSS compiles on save
- Styles automatically reload in browser

### Production Build
```bash
npm run build
```
- Minifies and optimizes all CSS
- Removes unused styles (with proper configuration)
- Generates source maps for debugging

---

## Color System

The application uses a consistent color system:

| Variable | Color | Usage |
|----------|-------|-------|
| `--psc-blue` / `$psc-blue` | `#0a4a7a` | Primary brand color, nav, sidebars |
| `--psc-dark` / `$psc-dark` | `#1a3d54` | Headers, footers, gradients |
| `--psc-light-blue` / `$psc-light-blue` | `#d1ecf1` | Highlights, backgrounds |
| `--psc-accent` / `$psc-accent` | `#ff6b35` | Buttons, accents, alerts |

### CSS Custom Properties (CSS Variables)
Located at the `:root` level, these can be used directly in CSS:
```css
background-color: var(--primary-color);
color: var(--psc-blue);
```

### SCSS Variables
Located in `_variables.scss`, used during compilation:
```scss
background: $primary-color;
color: $psc-blue;
```

---

## Key Style Components

### 1. **Navigation & Header** (`#mainNavbar`, `.psc-header`)
- Sticky navigation with primary color background
- Responsive logo and title styling

### 2. **Sidebar** (`.sidebar`)
- 75vh minimum height on desktop
- Blue background with white text
- Hover effects on nav links
- Active link highlighting

### 3. **Cards & Sections** (`.card`, `.main-content`)
- Shadow-based elevation
- Border-radius: 12px (consistent throughout)
- Hover animations

### 4. **Forms** (`#formPersonalDetails`, `.form-control-custom`)
- Custom input styling with focus states
- Blue border on focus
- Smooth transitions

### 5. **Tables** (`.data-table`, `#jobTable`)
- Header with gradient background
- Hover effects on rows
- Responsive overflow on mobile

### 6. **OTP Input** (`.otp-input`)
- Individual input fields for codes
- Focus scaling animation
- Success state styling

### 7. **Buttons**
- `.btn-primary` - Blue gradient
- `.btn-psc` - Full width with gradient
- `.btn-success` - Maps to primary blue
- Hover lift animations (translateY -2px)

### 8. **Responsive Classes**
- `.d-mobile-none`, `.d-mobile-block` - Hide/show on mobile
- `.d-tablet-none`, `.d-tablet-block` - Hide/show on tablet
- `.d-desktop-none`, `.d-desktop-block` - Hide/show on desktop
- `.text-mobile-center`, `.text-tablet-center`, `.text-desktop-left` - Text alignment utilities

---

## Responsive Breakpoints

| Device | Width | Breakpoint |
|--------|-------|-----------|
| Mobile | ≤767px | Phone optimizations |
| Tablet | 768-991px | Tablet optimizations |
| Desktop | ≥992px | Full desktop layout |

### Key Changes by Device:
- **Mobile**: Single column layouts, reduced padding, smaller fonts
- **Tablet**: Medium padding, adjusted sizing
- **Desktop**: Full layouts, enhanced hover effects, larger spacing

---

## Customization Guide

### Change Primary Color
1. Open `resources/sass/_variables.scss`
2. Update `$psc-blue: #0a4a7a;` to your desired color
3. Run `npm run dev`

### Add New Styles
1. Add to `resources/sass/custom.scss`
2. Use SCSS variables: `$psc-blue`, `$psc-dark`, etc.
3. Styles automatically compile

### Extend Bootstrap
- Bootstrap variables are available in `custom.scss`
- Override Bootstrap classes by adding new rules in `custom.scss`

---

## Migration Notes

### Old vs New
| Aspect | Old | New |
|--------|-----|-----|
| CSS Location | `public/css/styles.css` | `resources/sass/custom.scss` |
| Variables | CSS custom properties only | SCSS + CSS custom properties |
| Build | Manual/static | Vite pipeline |
| Compilation | Static file | Auto-compiled SCSS |
| Performance | Larger file size | Optimized, tree-shaken |

### Files to Remove (Optional)
- `public/css/styles.css` - Now replaced by compiled SCSS
- You can keep it for backup or reference

---

## Testing Styles

### Test Responsiveness
```bash
npm run dev
# Visit: http://localhost:5173
# Use Chrome DevTools to test different viewport sizes
```

### Build for Production
```bash
npm run build
# Check: public/build/ for compiled assets
```

---

## Troubleshooting

### Styles not applying?
1. Clear browser cache: `Ctrl+Shift+Del` (Chrome)
2. Restart dev server: `Ctrl+C` then `npm run dev`
3. Check if Vite is running (look for terminal output)

### Colors look different?
- Check `resources/sass/_variables.scss` for variable definitions
- Ensure `:root` CSS variables match SCSS variables
- Verify no conflicting Bootstrap styles

### Mobile styles not working?
- Check viewport meta tag in `app.blade.php` ✅ (already included)
- Verify breakpoints in `custom.scss` match your testing resolution

---

## Next Steps

1. ✅ **Verify all pages use the new layout**: Check that all Blade templates extend `layouts.app`
2. ✅ **Test responsive behavior**: Use Chrome DevTools to test each breakpoint
3. ✅ **Build for production**: Run `npm run build` before deployment
4. 📝 **Document any custom implementations** that use these styles
5. 🎨 **Consider consolidating** duplicate styles if found

---

## Support & References

- **SCSS Documentation**: https://sass-lang.com/documentation
- **Vite Documentation**: https://vitejs.dev/
- **Bootstrap SCSS**: https://getbootstrap.com/docs/5.0/customize/sass/
- **CSS Custom Properties**: https://developer.mozilla.org/en-US/docs/Web/CSS/--*

---

## Summary of Colors Used

### Primary Colors
- **Primary Blue**: `#0a4a7a` - Used for navigation, buttons, accents
- **Dark Blue**: `#1a3d54` - Used for footers, gradients, dark sections
- **Light Blue**: `#d1ecf1` - Used for highlights, alternate backgrounds

### Secondary Colors
- **Accent Orange**: `#ff6b35` - Used for highlights, special alerts
- **Success Green**: `#0a4a7a` (remapped to primary blue in this app)
- **Warning Yellow**: `#ffc107` - Used for warning notifications
- **Danger Red**: `#dc3545` - Used for error states

---

**Last Updated**: December 16, 2025  
**Version**: 1.0 (Initial Integration)
