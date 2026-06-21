<?php

declare(strict_types=1);

function cms_default_settings(): array
{
    return [
        'contact_name' => 'Maylyn Grace Uraca',
        'phone' => '+63 9185305683',
        'email' => 'uracarealty@gmail.com',
        'address' => 'Davao City, Philippines',
        'facebook_url' => '#',
        'whatsapp_url' => 'https://wa.me/639185305683',
        'instagram_url' => '#',
        'newsletter_text' => '<em>Subscribe</em> to receive high-potential investment properties, market analysis, and expert recommendations..',
        'map_embed_url' => 'https://maps.google.com/maps?width=100%25&height=600&hl=en&q=Davao%20City,%20Philippines&t=&z=14&ie=UTF8&iwloc=B&output=embed',
    ];
}

function cms_default_pages(): array
{
    return [
        'home' => [
            'title' => 'Home',
            'meta_title' => 'Uraca Realty PH | Buy, Sell & Invest in Premium Properties in the Philippines',
            'meta_description' => 'Find your ideal home with Uraca Realty. Explore premium properties, house & lot, condos, and real estate investment opportunities in the Philippines. Trusted guidance. Smart decisions.',
            'social_image' => 'images/preview.jpg',
            'hero_title' => 'More Than Real Estate',
            'hero_subtitle' => 'Premium residential and commercial properties tailored to your lifestyle and investment goals.',
        ],
        'about' => [
            'title' => 'About Us',
            'meta_title' => 'About Uraca Realty PH',
            'meta_description' => 'Learn about Uraca Realty PH and our professional real estate services in Davao City and the Philippines.',
            'social_image' => 'images/preview.jpg',
            'hero_title' => 'About Us',
            'hero_subtitle' => 'Guiding smart property decisions with local market expertise.',
        ],
        'services' => [
            'title' => 'Services',
            'meta_title' => 'Real Estate Services | Uraca Realty PH',
            'meta_description' => 'Explore Uraca Realty services for buying, selling, rentals, leasing, and property investment consulting.',
            'social_image' => 'images/preview.jpg',
            'hero_title' => 'Services',
            'hero_subtitle' => 'Professional services designed for your property goals.',
        ],
        'contact' => [
            'title' => 'Contact Us',
            'meta_title' => 'Contact Uraca Realty PH',
            'meta_description' => 'Contact Uraca Realty PH for property inquiries, buying, selling, rentals, and investment guidance.',
            'social_image' => 'images/preview.jpg',
            'hero_title' => 'Contact Us',
            'hero_subtitle' => 'Get in touch with our real estate experts.',
        ],
    ];
}

function cms_default_sections(): array
{
    return [
        ['home', 'about_intro', 'about us', 'Guiding Smart Property Decisions', 'We are a professional real estate business dedicated to helping clients buy, sell, and invest in properties with confidence. Our team combines local market knowledge, verified listings, and transparent guidance.', 'More About Us', 'page-about.php', 'images/resource/about-1-1.jpg', 1, 10],
        ['home', 'services_intro', 'our services', 'Professional Services designed for your property goals', '', '', '', '', 1, 20],
        ['home', 'featured_intro', 'featured', 'Featured Properties', 'Explore selected listings handpicked by Uraca Realty.', 'Browse Properties', 'page-projects.php', '', 1, 30],
        ['home', 'testimonials_intro', 'testimonial', 'Proven Results through client satisfaction', '', '', '', '', 1, 40],
        ['home', 'contact_intro', 'Contact', 'Get in Touch With our experts', '', 'Send Message', 'contact-submit.php', 'images/resource/contact-1-1.jpg', 1, 50],
        ['about', 'about_intro', 'about us', 'Guiding Smart Property Decisions', 'We help clients buy, sell, and invest in properties with confidence through verified listings, transparent guidance, and local market expertise.', 'More About Us', 'page-about.php', 'images/resource/about-2-1.jpg', 1, 10],
        ['about', 'mission', 'mission', 'Our Mission', 'To deliver excellent real estate services by understanding our clients needs and guiding them toward smart, secure property decisions.', '', '', '', 1, 20],
        ['about', 'vision', 'vision', 'Our Vision', 'To be a trusted real estate partner known for professionalism, transparency, and strong client relationships.', '', '', '', 1, 30],
        ['services', 'services_intro', 'services', 'Professional Real Estate Services', 'Practical support for buying, selling, leasing, and investing in real estate.', '', '', 'images/resource/service-details.jpg', 1, 10],
        ['contact', 'contact_intro', 'contact', 'Let us help with your next property move', 'Send your inquiry and our team will review your message from the admin panel.', 'Send Message', 'contact-submit.php', 'images/resource/contact-1-1.jpg', 1, 10],
    ];
}

function cms_default_services(): array
{
    return [
        ['Property Buying Assistance', 'Helping clients find the right property based on budget, location, and lifestyle.', 'From search to documentation, Uraca Realty helps buyers compare verified options and make confident property decisions.', 'flaticon-set-agreement', 'images/resource/service-d1.jpg', 'page-service-details.php', 1, 10],
        ['Property Selling Services', 'Strategic pricing, marketing, and negotiation to sell faster at the best price.', 'We support sellers with pricing guidance, listing presentation, buyer screening, and negotiation assistance.', 'flaticon-set-property', 'images/resource/service-d2.jpg', 'page-service-details.php', 1, 20],
        ['Construction & Design-Build', 'Guided residential design and construction solutions for custom homes, duplexes, and investment builds.', "Uraca Realty helps landowners move from initial concept to a practical construction plan through design coordination, budgeting guidance, and managed project support.\nOur construction and design-build service can accommodate modern homes, duplex concepts, phased developments, and investment-focused residential projects based on the lot, goals, and target budget.", 'flaticon-set-building-plan', 'images/Categories/Construction.png', 'page-service-details.php', 1, 30],
        ['Rental & Leasing Solutions', 'Residential and commercial rental services with verified tenants.', 'We help owners and tenants find practical rental matches with clear terms and professional coordination.', 'flaticon-set-building-plan', 'images/resource/service-details.jpg', 'page-service-details.php', 1, 40],
        ['Investment Consulting Services', 'Data-driven advice for high-return property investments.', 'We help investors understand location, demand, property type, and long-term value before making a move.', 'flaticon-set-investment-2', 'images/resource/service-d1.jpg', 'page-service-details.php', 1, 50],
    ];
}

function cms_default_testimonials(): array
{
    return [
        ['Warm, patient guidance from inquiry to turnover', 'Uraca Realty helped our family compare homes around Davao City without pressure. Maylyn explained the documents clearly, scheduled viewings around our work hours, and guided us until we felt confident with our decision.', 'Ana', 'First-time Home Buyer, Davao City', 'images/resource/testimonial-ana.jpg', 5, 1, 10],
        ['Local market advice that made the sale smoother', 'We wanted to sell our property in Buhangin but were unsure about pricing and buyer screening. Uraca Realty gave practical market advice, handled inquiries professionally, and helped us move forward with a serious buyer.', 'Ramon', 'Property Seller, Buhangin', 'images/resource/testimonial-ramon.jpg', 5, 1, 20],
    ];
}

function cms_table_ready(string $table): bool
{
    static $ready = [];
    if (array_key_exists($table, $ready)) {
        return $ready[$table];
    }

    try {
        $stmt = db()->prepare('SELECT COUNT(*)
            FROM INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table_name');
        $stmt->execute(['table_name' => $table]);
        $ready[$table] = (int) $stmt->fetchColumn() > 0;
    } catch (Throwable) {
        $ready[$table] = false;
    }

    return $ready[$table];
}

function cms_column_ready(string $table, string $column): bool
{
    static $ready = [];
    $key = $table . '.' . $column;
    if (array_key_exists($key, $ready)) {
        return $ready[$key];
    }

    try {
        $stmt = db()->prepare('SELECT COUNT(*)
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table_name AND COLUMN_NAME = :column_name');
        $stmt->execute(['table_name' => $table, 'column_name' => $column]);
        $ready[$key] = (int) $stmt->fetchColumn() > 0;
    } catch (Throwable) {
        $ready[$key] = false;
    }

    return $ready[$key];
}

function cms_unique_service_slug(string $title, ?int $serviceId = null): string
{
    $base = slugify($title);
    $slug = $base;
    $suffix = 2;
    $stmt = db()->prepare('SELECT id FROM cms_services WHERE slug = :slug LIMIT 1');

    while (true) {
        $stmt->execute(['slug' => $slug]);
        $existingId = $stmt->fetchColumn();
        if (!$existingId || ($serviceId !== null && (int) $existingId === $serviceId)) {
            return $slug;
        }
        $slug = $base . '-' . $suffix;
        $suffix++;
    }
}

function cms_settings(): array
{
    $settings = cms_default_settings();
    if (!cms_table_ready('site_settings')) {
        return $settings;
    }

    foreach (db()->query('SELECT setting_key, setting_value FROM site_settings') as $row) {
        $settings[$row['setting_key']] = (string) $row['setting_value'];
    }

    return $settings;
}

function cms_setting(string $key, ?string $fallback = null): string
{
    $settings = cms_settings();
    return (string) ($settings[$key] ?? $fallback ?? '');
}

function cms_save_settings(array $settings): void
{
    $stmt = db()->prepare('INSERT INTO site_settings (setting_key, setting_value) VALUES (:setting_key, :setting_value)
        ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)');
    foreach ($settings as $key => $value) {
        $value = match ($key) {
            'email' => filter_var((string) $value, FILTER_VALIDATE_EMAIL) ? (string) $value : cms_default_settings()['email'],
            'phone', 'address', 'contact_name' => limit_text((string) $value, 190),
            'facebook_url', 'whatsapp_url', 'instagram_url' => validate_public_url((string) $value, '#', false),
            'map_embed_url' => validate_embed_url((string) $value, cms_default_settings()['map_embed_url']),
            'newsletter_text' => sanitize_html_fragment((string) $value),
            default => limit_text((string) $value, 500),
        };
        $stmt->execute(['setting_key' => $key, 'setting_value' => $value]);
    }
}

function cms_page(string $slug): array
{
    $defaults = cms_default_pages();
    $page = $defaults[$slug] ?? [
        'title' => ucfirst($slug),
        'meta_title' => ucfirst($slug) . ' | Uraca Realty PH',
        'meta_description' => 'Uraca Realty PH page.',
        'social_image' => 'images/preview.jpg',
        'hero_title' => ucfirst($slug),
        'hero_subtitle' => '',
    ];
    $page['slug'] = $slug;

    if (!cms_table_ready('cms_pages')) {
        return $page;
    }

    $stmt = db()->prepare('SELECT * FROM cms_pages WHERE slug = :slug LIMIT 1');
    $stmt->execute(['slug' => $slug]);
    $row = $stmt->fetch();

    return $row ? array_merge($page, $row) : $page;
}

function cms_save_page(string $slug, array $data): void
{
    $stmt = db()->prepare('INSERT INTO cms_pages (slug, title, meta_title, meta_description, social_image, hero_title, hero_subtitle)
        VALUES (:slug, :title, :meta_title, :meta_description, :social_image, :hero_title, :hero_subtitle)
        ON DUPLICATE KEY UPDATE
            title = VALUES(title),
            meta_title = VALUES(meta_title),
            meta_description = VALUES(meta_description),
            social_image = VALUES(social_image),
            hero_title = VALUES(hero_title),
            hero_subtitle = VALUES(hero_subtitle)');
    $stmt->execute([
        'slug' => $slug,
        'title' => limit_text($data['title'] ?? ucfirst($slug), 220),
        'meta_title' => limit_text($data['meta_title'] ?? '', 220),
        'meta_description' => limit_text($data['meta_description'] ?? '', 500),
        'social_image' => validate_asset_path($data['social_image'] ?? '', 'images/preview.jpg'),
        'hero_title' => limit_text($data['hero_title'] ?? '', 220),
        'hero_subtitle' => limit_text($data['hero_subtitle'] ?? '', 500),
    ]);
}

function cms_section(string $pageSlug, string $sectionKey): array
{
    $section = [
        'page_slug' => $pageSlug,
        'section_key' => $sectionKey,
        'eyebrow' => '',
        'title' => '',
        'body' => '',
        'button_label' => '',
        'button_url' => '',
        'image_path' => '',
        'is_enabled' => 1,
        'sort_order' => 0,
    ];

    foreach (cms_default_sections() as $default) {
        if ($default[0] === $pageSlug && $default[1] === $sectionKey) {
            $section = [
                'page_slug' => $default[0],
                'section_key' => $default[1],
                'eyebrow' => $default[2],
                'title' => $default[3],
                'body' => $default[4],
                'button_label' => $default[5],
                'button_url' => $default[6],
                'image_path' => $default[7],
                'is_enabled' => $default[8],
                'sort_order' => $default[9],
            ];
            break;
        }
    }

    if (!cms_table_ready('cms_sections')) {
        return $section;
    }

    $stmt = db()->prepare('SELECT * FROM cms_sections WHERE page_slug = :page_slug AND section_key = :section_key LIMIT 1');
    $stmt->execute(['page_slug' => $pageSlug, 'section_key' => $sectionKey]);
    $row = $stmt->fetch();

    return $row ? array_merge($section, $row) : $section;
}

function cms_save_section(string $pageSlug, string $sectionKey, array $data): void
{
    $stmt = db()->prepare('INSERT INTO cms_sections
        (page_slug, section_key, eyebrow, title, body, button_label, button_url, image_path, is_enabled, sort_order)
        VALUES
        (:page_slug, :section_key, :eyebrow, :title, :body, :button_label, :button_url, :image_path, :is_enabled, :sort_order)
        ON DUPLICATE KEY UPDATE
            eyebrow = VALUES(eyebrow),
            title = VALUES(title),
            body = VALUES(body),
            button_label = VALUES(button_label),
            button_url = VALUES(button_url),
            image_path = VALUES(image_path),
            is_enabled = VALUES(is_enabled),
            sort_order = VALUES(sort_order)');
    $stmt->execute([
        'page_slug' => $pageSlug,
        'section_key' => $sectionKey,
        'eyebrow' => limit_text($data['eyebrow'] ?? '', 160),
        'title' => limit_text($data['title'] ?? '', 255),
        'body' => limit_text($data['body'] ?? '', 5000),
        'button_label' => limit_text($data['button_label'] ?? '', 160),
        'button_url' => validate_public_url($data['button_url'] ?? '', ''),
        'image_path' => validate_asset_path($data['image_path'] ?? '', ''),
        'is_enabled' => !empty($data['is_enabled']) ? 1 : 0,
        'sort_order' => (int) ($data['sort_order'] ?? 0),
    ]);
}

function cms_services(bool $enabledOnly = true, string $status = 'active'): array
{
    if (!cms_table_ready('cms_services')) {
        return array_map(static fn ($item) => [
            'slug' => slugify($item[0]),
            'title' => $item[0],
            'summary' => $item[1],
            'body' => $item[2],
            'icon_class' => $item[3],
            'image_path' => $item[4],
            'detail_url' => $item[5],
            'is_enabled' => $item[6],
            'sort_order' => $item[7],
        ], cms_default_services());
    }

    $conditions = [];
    if ($enabledOnly) {
        $conditions[] = 'is_enabled = 1';
    }
    if (cms_column_ready('cms_services', 'deleted_at')) {
        if ($status === 'archived') {
            $conditions[] = 'deleted_at IS NOT NULL';
        } elseif ($status !== 'all') {
            $conditions[] = 'deleted_at IS NULL';
        }
    }
    $sql = 'SELECT * FROM cms_services';
    if ($conditions) {
        $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }
    $sql .= ' ORDER BY sort_order ASC, id ASC';

    return db()->query($sql)->fetchAll();
}

function cms_service(?int $id, bool $includeArchived = false): ?array
{
    if ($id === null) {
        return null;
    }
    $sql = 'SELECT * FROM cms_services WHERE id = :id';
    if (!$includeArchived && cms_column_ready('cms_services', 'deleted_at')) {
        $sql .= ' AND deleted_at IS NULL';
    }
    $sql .= ' LIMIT 1';
    $stmt = db()->prepare($sql);
    $stmt->execute(['id' => $id]);
    $service = $stmt->fetch();
    return $service ?: null;
}

function cms_service_by_slug(string $slug, bool $includeArchived = false): ?array
{
    $slug = slugify($slug);
    if ($slug === '') {
        return null;
    }

    if (!cms_column_ready('cms_services', 'slug')) {
        return null;
    }

    $sql = 'SELECT * FROM cms_services WHERE slug = :slug';
    if (!$includeArchived && cms_column_ready('cms_services', 'deleted_at')) {
        $sql .= ' AND deleted_at IS NULL';
    }
    $sql .= ' LIMIT 1';
    $stmt = db()->prepare($sql);
    $stmt->execute(['slug' => $slug]);
    $service = $stmt->fetch();

    return $service ?: null;
}

function cms_save_service(array $data, ?int $id = null): int
{
    if ($id === null) {
        $stmt = db()->prepare('INSERT INTO cms_services (slug, title, summary, body, icon_class, image_path, detail_url, is_enabled, sort_order)
            VALUES (:slug, :title, :summary, :body, :icon_class, :image_path, :detail_url, :is_enabled, :sort_order)');
    } else {
        $stmt = db()->prepare('UPDATE cms_services SET slug = :slug, title = :title, summary = :summary, body = :body, icon_class = :icon_class,
            image_path = :image_path, detail_url = :detail_url, is_enabled = :is_enabled, sort_order = :sort_order WHERE id = :id');
    }

    $title = limit_text($data['title'], 180);
    $currentSlug = '';
    if ($id !== null && cms_column_ready('cms_services', 'slug')) {
        $existing = cms_service($id, true);
        $currentSlug = trim((string) ($existing['slug'] ?? ''));
    }
    $slug = $currentSlug !== '' ? $currentSlug : cms_unique_service_slug($title, $id);
    $params = [
        'slug' => $slug,
        'title' => $title,
        'summary' => limit_text($data['summary'] ?? '', 1000),
        'body' => limit_text($data['body'] ?? '', 5000),
        'icon_class' => preg_match('/^[a-z0-9 _-]+$/i', (string) ($data['icon_class'] ?? '')) ? limit_text($data['icon_class'], 120) : 'flaticon-set-agreement',
        'image_path' => validate_asset_path($data['image_path'] ?? '', ''),
        'detail_url' => validate_public_url($data['detail_url'] ?? 'page-service-details.php', 'page-service-details.php'),
        'is_enabled' => !empty($data['is_enabled']) ? 1 : 0,
        'sort_order' => (int) ($data['sort_order'] ?? 0),
    ];
    if ($id !== null) {
        $params['id'] = $id;
    }
    $stmt->execute($params);

    return $id ?? (int) db()->lastInsertId();
}

function cms_delete_service(int $id): void
{
    if (cms_column_ready('cms_services', 'deleted_at')) {
        $stmt = db()->prepare('UPDATE cms_services SET deleted_at = CURRENT_TIMESTAMP, is_enabled = 0 WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return;
    }
    $stmt = db()->prepare('DELETE FROM cms_services WHERE id = :id');
    $stmt->execute(['id' => $id]);
}

function cms_restore_service(int $id): void
{
    if (!cms_column_ready('cms_services', 'deleted_at')) {
        return;
    }
    $stmt = db()->prepare('UPDATE cms_services SET deleted_at = NULL WHERE id = :id');
    $stmt->execute(['id' => $id]);
}

function cms_testimonials(bool $enabledOnly = true, string $status = 'active'): array
{
    if (!cms_table_ready('cms_testimonials')) {
        return array_map(static fn ($item) => [
            'headline' => $item[0],
            'quote' => $item[1],
            'client_name' => $item[2],
            'client_role' => $item[3],
            'image_path' => $item[4],
            'rating' => $item[5],
            'is_enabled' => $item[6],
            'sort_order' => $item[7],
        ], cms_default_testimonials());
    }

    $conditions = [];
    if ($enabledOnly) {
        $conditions[] = 'is_enabled = 1';
    }
    if (cms_column_ready('cms_testimonials', 'deleted_at')) {
        if ($status === 'archived') {
            $conditions[] = 'deleted_at IS NOT NULL';
        } elseif ($status !== 'all') {
            $conditions[] = 'deleted_at IS NULL';
        }
    }
    $sql = 'SELECT * FROM cms_testimonials';
    if ($conditions) {
        $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }
    $sql .= ' ORDER BY sort_order ASC, id ASC';

    return db()->query($sql)->fetchAll();
}

function cms_testimonial(?int $id, bool $includeArchived = false): ?array
{
    if ($id === null) {
        return null;
    }
    $sql = 'SELECT * FROM cms_testimonials WHERE id = :id';
    if (!$includeArchived && cms_column_ready('cms_testimonials', 'deleted_at')) {
        $sql .= ' AND deleted_at IS NULL';
    }
    $sql .= ' LIMIT 1';
    $stmt = db()->prepare($sql);
    $stmt->execute(['id' => $id]);
    $testimonial = $stmt->fetch();
    return $testimonial ?: null;
}

function cms_save_testimonial(array $data, ?int $id = null): int
{
    if ($id === null) {
        $stmt = db()->prepare('INSERT INTO cms_testimonials (headline, quote, client_name, client_role, image_path, rating, is_enabled, sort_order)
            VALUES (:headline, :quote, :client_name, :client_role, :image_path, :rating, :is_enabled, :sort_order)');
    } else {
        $stmt = db()->prepare('UPDATE cms_testimonials SET headline = :headline, quote = :quote, client_name = :client_name,
            client_role = :client_role, image_path = :image_path, rating = :rating, is_enabled = :is_enabled, sort_order = :sort_order WHERE id = :id');
    }

    $params = [
        'headline' => limit_text($data['headline'] ?? '', 220),
        'quote' => limit_text($data['quote'], 5000),
        'client_name' => limit_text($data['client_name'], 160),
        'client_role' => limit_text($data['client_role'] ?? '', 160),
        'image_path' => validate_asset_path($data['image_path'] ?? '', ''),
        'rating' => max(1, min(5, (int) ($data['rating'] ?? 5))),
        'is_enabled' => !empty($data['is_enabled']) ? 1 : 0,
        'sort_order' => (int) ($data['sort_order'] ?? 0),
    ];
    if ($id !== null) {
        $params['id'] = $id;
    }
    $stmt->execute($params);

    return $id ?? (int) db()->lastInsertId();
}

function cms_delete_testimonial(int $id): void
{
    if (cms_column_ready('cms_testimonials', 'deleted_at')) {
        $stmt = db()->prepare('UPDATE cms_testimonials SET deleted_at = CURRENT_TIMESTAMP, is_enabled = 0 WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return;
    }
    $stmt = db()->prepare('DELETE FROM cms_testimonials WHERE id = :id');
    $stmt->execute(['id' => $id]);
}

function cms_restore_testimonial(int $id): void
{
    if (!cms_column_ready('cms_testimonials', 'deleted_at')) {
        return;
    }
    $stmt = db()->prepare('UPDATE cms_testimonials SET deleted_at = NULL WHERE id = :id');
    $stmt->execute(['id' => $id]);
}

function cms_featured_properties(int $limit = 3): array
{
    if (!cms_table_ready('cms_featured_listings')) {
        return [];
    }

    $stmt = db()->prepare('SELECT p.*, c.name AS category_name, c.slug AS category_slug, f.sort_order AS featured_sort_order
        FROM cms_featured_listings f
        INNER JOIN properties p ON p.id = f.property_id
        INNER JOIN categories c ON c.id = p.category_id
        WHERE p.is_published = 1
        ORDER BY f.sort_order ASC, p.updated_at DESC
        LIMIT :limit_count');
    $stmt->bindValue(':limit_count', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}

function cms_save_featured_listings(array $featured): void
{
    $ownsTransaction = !db()->inTransaction();
    if ($ownsTransaction) {
        db()->beginTransaction();
    }
    try {
        db()->exec('DELETE FROM cms_featured_listings');
        $stmt = db()->prepare('INSERT INTO cms_featured_listings (property_id, sort_order)
            SELECT id, :sort_order FROM properties WHERE id = :property_id AND is_published = 1');
        foreach ($featured as $propertyId => $sortOrder) {
            if ((int) $propertyId > 0) {
                $stmt->execute(['property_id' => (int) $propertyId, 'sort_order' => (int) $sortOrder]);
            }
        }
        if ($ownsTransaction) {
            db()->commit();
        }
    } catch (Throwable $exception) {
        if ($ownsTransaction) {
            db()->rollBack();
        }
        throw $exception;
    }
}

function cms_save_inquiry(array $data): int
{
    $params = [
        'name' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'] ?? null,
        'subject' => $data['subject'] ?? null,
        'message' => $data['message'],
        'source_page' => $data['source_page'] ?? null,
    ];

    if (cms_column_ready('contact_inquiries', 'property_id')) {
        $params['property_id'] = !empty($data['property_id']) ? (int) $data['property_id'] : null;
        $stmt = db()->prepare('INSERT INTO contact_inquiries
            (property_id, name, email, phone, subject, message, source_page)
            VALUES (:property_id, :name, :email, :phone, :subject, :message, :source_page)');
    } else {
        $stmt = db()->prepare('INSERT INTO contact_inquiries (name, email, phone, subject, message, source_page)
            VALUES (:name, :email, :phone, :subject, :message, :source_page)');
    }

    $stmt->execute($params);

    return (int) db()->lastInsertId();
}

function cms_inquiries(): array
{
    if (cms_column_ready('contact_inquiries', 'property_id')) {
        return db()->query('SELECT ci.*, p.name AS property_name, p.slug AS property_slug
            FROM contact_inquiries ci
            LEFT JOIN properties p ON p.id = ci.property_id
            ORDER BY ci.created_at DESC, ci.id DESC')->fetchAll();
    }

    return db()->query('SELECT ci.*, NULL AS property_name, NULL AS property_slug
        FROM contact_inquiries ci ORDER BY ci.created_at DESC, ci.id DESC')->fetchAll();
}

function cms_mark_inquiry_read(int $id, bool $isRead): void
{
    $stmt = db()->prepare('UPDATE contact_inquiries SET is_read = :is_read WHERE id = :id');
    $stmt->execute(['is_read' => $isRead ? 1 : 0, 'id' => $id]);
}

function cms_seed_defaults(): void
{
    cms_save_settings(cms_default_settings());
    foreach (cms_default_pages() as $slug => $page) {
        cms_save_page($slug, $page);
    }
    foreach (cms_default_sections() as $section) {
        cms_save_section($section[0], $section[1], [
            'eyebrow' => $section[2],
            'title' => $section[3],
            'body' => $section[4],
            'button_label' => $section[5],
            'button_url' => $section[6],
            'image_path' => $section[7],
            'is_enabled' => $section[8],
            'sort_order' => $section[9],
        ]);
    }

    if ((int) db()->query('SELECT COUNT(*) FROM cms_services')->fetchColumn() === 0) {
        foreach (cms_default_services() as $service) {
            cms_save_service([
                'title' => $service[0],
                'summary' => $service[1],
                'body' => $service[2],
                'icon_class' => $service[3],
                'image_path' => $service[4],
                'detail_url' => $service[5],
                'is_enabled' => $service[6],
                'sort_order' => $service[7],
            ]);
        }
    }

    if ((int) db()->query('SELECT COUNT(*) FROM cms_testimonials')->fetchColumn() === 0) {
        foreach (cms_default_testimonials() as $testimonial) {
            cms_save_testimonial([
                'headline' => $testimonial[0],
                'quote' => $testimonial[1],
                'client_name' => $testimonial[2],
                'client_role' => $testimonial[3],
                'image_path' => $testimonial[4],
                'rating' => $testimonial[5],
                'is_enabled' => $testimonial[6],
                'sort_order' => $testimonial[7],
            ]);
        }
    }

    if (cms_table_ready('cms_featured_listings') && (int) db()->query('SELECT COUNT(*) FROM cms_featured_listings')->fetchColumn() === 0) {
        $slugs = ['luxury-house-ladislawa-davao', 'newly-built-house-ilumina-buhangin', 'multi-house-property-juna-subdivision-matina'];
        $stmt = db()->prepare('SELECT id FROM properties WHERE slug = :slug LIMIT 1');
        $featured = [];
        foreach ($slugs as $index => $slug) {
            $stmt->execute(['slug' => $slug]);
            $propertyId = $stmt->fetchColumn();
            if ($propertyId) {
                $featured[(int) $propertyId] = ($index + 1) * 10;
            }
        }
        cms_save_featured_listings($featured);
    }
}
