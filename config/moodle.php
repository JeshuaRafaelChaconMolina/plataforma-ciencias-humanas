<?php

return [
    // URL base del aula, sin / al final. Ej: http://aula.impulsovirtual.com
    'base_url' => rtrim((string) env('MOODLE_BASE_URL', ''), '/'),

    // Token del servicio web REST creado en Moodle para el usuario admin.
    // No se comparte por chat; se pone directo en el .env del VPS.
    'api_token' => (string) env('MOODLE_API_TOKEN', ''),

    // Categoría de Moodle donde se crean los cursos (1 = Misc / Miscelánea por defecto).
    'category_id' => (int) env('MOODLE_CATEGORY_ID', 1),

    'sso_enabled' => filter_var(env('MOODLE_SSO_ENABLED', false), FILTER_VALIDATE_BOOLEAN),
];
