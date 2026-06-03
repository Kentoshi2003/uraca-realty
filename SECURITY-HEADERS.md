# Production Security Headers

Configure these headers in the hosting panel, CDN, or static-host config for `uracarealtyph.com`.

```text
Strict-Transport-Security: max-age=31536000; includeSubDomains; preload
X-Content-Type-Options: nosniff
Referrer-Policy: strict-origin-when-cross-origin
Permissions-Policy: camera=(), microphone=(), geolocation=()
Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com data:; img-src 'self' data: https://uracarealtyph.com; connect-src 'self'; frame-ancestors 'self'; base-uri 'self'; form-action 'self' mailto:
```

Notes:
- Keep HTTPS enabled before adding HSTS preload.
- The current static template still uses inline styles and local inline event-free scripts, so the CSP allows `'unsafe-inline'` for styles/scripts. Tighten this after refactoring inline CSS and template scripts.
- If the site is deployed behind Cloudflare, Netlify, Vercel, or Apache/LiteSpeed, add the equivalent header rules in that platform instead of committing secrets or backend config.
