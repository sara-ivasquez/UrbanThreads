<?php

return [
    'success' => [
        'product_created' => '¡Producto creado exitosamente!',
        'product_updated' => '¡Producto actualizado exitosamente!',
        'product_disabled' => 'Producto deshabilitado exitosamente.',
        'product_enabled' => 'Producto habilitado exitosamente.',
        'user_updated' => '¡Usuario actualizado exitosamente!',
        'user_disabled' => 'Usuario deshabilitado exitosamente.',
        'user_enabled' => 'Usuario habilitado exitosamente.',
        'review_created' => 'La reseña fue creada correctamente.',
    ],

    'error' => [
        'insufficient_funds' => 'Fondos insuficientes. Tu presupuesto es $:budget, pero el costo total es $:total',
        'stock_not_available' => 'No hay suficiente stock disponible para el producto seleccionado.',
    ],

    'review' => [
        'validation' => [
            'qualification_required' => 'La calificación es obligatoria.',
            'qualification_integer' => 'La calificación debe ser un número entero.',
            'qualification_min' => 'La calificación mínima es 1.',
            'qualification_max' => 'La calificación máxima es 5.',
            'description_required' => 'La descripción es obligatoria.',
            'description_max' => 'La descripción no puede superar los 1000 caracteres.',
            'product_required' => 'El producto es obligatorio.',
            'product_exists' => 'El producto seleccionado no existe.',
        ],
    ],

    'welcome_user' => 'Bienvenido, :name',
];

