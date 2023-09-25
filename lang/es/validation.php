<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Debe aceptar :attribute.',
    'accepted_if' => 'Debe aceptar :attribute cuando :other sea :value.',
    'active_url' => 'La :attribute no es una URL válida.',
    'after' => 'La :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'La :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'La :attribute debe contener solo letras.',
    'alpha_dash' => 'La :attribute debe contener solo letras, números, guiones y guiones bajos.',
    'alpha_num' => 'La :attribute debe contener solo letras y números.',
    'array' => 'La :attribute debe ser una matriz.',
    'ascii' => 'La :attribute debe contener solo caracteres alfanuméricos y símbolos de un solo byte.',
    'before' => 'La :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'La :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'array' => 'La :attribute debe contener entre :min y :max elementos.',
        'file' => 'La :attribute debe tener entre :min y :max kilobytes.',
        'numeric' => 'La :attribute debe estar entre :min y :max.',
        'string' => 'La :attribute debe tener entre :min y :max caracteres.',
    ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'La :attribute no es una fecha válida.',
    'date_equals' => 'La :attribute debe ser una fecha igual a :date.',
    'date_format' => 'La :attribute no coincide con el formato :format.',
    'decimal' => 'La :attribute debe tener :decimal lugares decimales.',
    'declined' => 'Debe declinar :attribute.',
    'declined_if' => 'Debe declinar :attribute cuando :other sea :value.',
    'different' => ':attribute y :other deben ser diferentes.',
    'digits' => 'La :attribute debe tener :digits dígitos.',
    'digits_between' => 'La :attribute debe tener entre :min y :max dígitos.',
    'dimensions' => 'La :attribute tiene dimensiones de imagen no válidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'doesnt_end_with' => 'La :attribute no puede terminar con ninguno de los siguientes valores: :values.',
    'doesnt_start_with' => 'La :attribute no puede comenzar con ninguno de los siguientes valores: :values.',
    'email' => 'La :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'La :attribute debe terminar con uno de los siguientes valores: :values.',
    'enum' => 'El :attribute seleccionado es inválido.',
    'exists' => 'El :attribute seleccionado es inválido.',
    'file' => 'La :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'array' => 'La :attribute debe tener más de :value elementos.',
        'file' => 'La :attribute debe ser mayor que :value kilobytes.',
        'numeric' => 'La :attribute debe ser mayor que :value.',
        'string' => 'La :attribute debe tener más de :value caracteres.',
    ],
    'gte' => [
        'array' => 'La :attribute debe tener :value elementos o más.',
        'file' => 'La :attribute debe ser mayor o igual que :value kilobytes.',
        'numeric' => 'La :attribute debe ser mayor o igual que :value.',
        'string' => 'La :attribute debe ser mayor o igual que :value caracteres.',
    ],
    'image' => 'La :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado es inválido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'La :attribute debe ser un número entero.',
    'ip' => 'La :attribute debe ser una dirección IP válida.',
    'ipv4' => 'La :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => 'La :attribute debe ser una dirección IPv6 válida.',
    'json' => 'La :attribute debe ser una cadena JSON válida.',
    'lowercase' => 'La :attribute debe estar en minúsculas.',
    'lt' => [
        'array' => 'La :attribute debe tener menos de :value elementos.',
        'file' => 'La :attribute debe ser menor que :value kilobytes.',
        'numeric' => 'La :attribute debe ser menor que :value.',
        'string' => 'La :attribute debe tener menos de :value caracteres.',
    ],
    'lte' => [
        'array' => 'La :attribute no debe tener más de :value elementos.',
        'file' => 'La :attribute debe ser menor o igual que :value kilobytes.',
        'numeric' => 'La :attribute debe ser menor o igual que :value.',
        'string' => 'La :attribute debe ser menor o igual que :value caracteres.',
    ],
    'mac_address' => 'La :attribute debe ser una dirección MAC válida.',
    'max' => [
        'array' => 'La :attribute no debe tener más de :max elementos.',
        'file' => 'La :attribute no debe ser mayor que :max kilobytes.',
        'numeric' => 'La :attribute no debe ser mayor que :max.',
        'string' => 'La :attribute no debe ser mayor que :max caracteres.',
    ],
    'max_digits' => 'La :attribute no debe tener más de :max dígitos.',
    'mimes' => 'La :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'La :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'array' => 'La :attribute debe tener al menos :min elementos.',
        'file' => 'La :attribute debe tener al menos :min kilobytes.',
        'numeric' => 'La :attribute debe ser al menos :min.',
        'string' => 'La :attribute debe tener al menos :min caracteres.',
    ],
    'min_digits' => 'La :attribute debe tener al menos :min dígitos.',
    'missing' => 'El campo :attribute debe estar ausente.',
    'missing_if' => 'El campo :attribute debe estar ausente cuando :other es :value.',
    'missing_unless' => 'El campo :attribute debe estar ausente a menos que :other sea :value.',
    'missing_with' => 'El campo :attribute debe estar ausente cuando :values está presente.',
    'missing_with_all' => 'El campo :attribute debe estar ausente cuando :values están presentes.',
    'multiple_of' => 'La :attribute debe ser un múltiplo de :value.',
    'not_in' => 'El :attribute seleccionado es inválido.',
    'not_regex' => 'El formato de :attribute es inválido.',
    'numeric' => 'La :attribute debe ser un número.',
    'password' => [
        'letters' => 'La :attribute debe contener al menos una letra.',
        'mixed' => 'La :attribute debe contener al menos una letra mayúscula y una letra minúscula.',
        'numbers' => 'La :attribute debe contener al menos un número.',
        'symbols' => 'La :attribute debe contener al menos un símbolo.',
        'uncompromised' => 'El :attribute proporcionado ha aparecido en una filtración de datos. Por favor, elija un :attribute diferente.',
    ],
    'present' => 'El campo :attribute debe estar presente.',
    'prohibited' => 'El campo :attribute está prohibido.',
    'prohibited_if' => 'El campo :attribute está prohibido cuando :other es :value.',
    'prohibited_unless' => 'El campo :attribute está prohibido a menos que :other esté en :values.',
    'prohibits' => 'El campo :attribute prohíbe que :other esté presente.',
    'regex' => 'El formato de :attribute es inválido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_array_keys' => 'El campo :attribute debe contener entradas para: :values.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_if_accepted' => 'El campo :attribute es obligatorio cuando :other es aceptado.',
    'required_unless' => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values están presentes.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values está presente.',
    'same' => 'La :attribute y :other deben coincidir.',
    'size' => [
        'array' => 'La :attribute debe contener :size elementos.',
        'file' => 'La :attribute debe ser :size kilobytes.',
        'numeric' => 'La :attribute debe ser :size.',
        'string' => 'La :attribute debe tener :size caracteres.',
    ],
    'starts_with' => 'La :attribute debe empezar con uno de los siguientes valores: :values.',
    'string' => 'La :attribute debe ser una cadena de texto.',
    'timezone' => 'La :attribute debe ser una zona horaria válida.',
    'unique' => 'La :attribute ya ha sido tomada.',
    'uploaded' => 'La :attribute no se pudo subir.',
    'uppercase' => 'La :attribute debe estar en mayúsculas.',
    'url' => 'La :attribute debe ser una URL válida.',
    'ulid' => 'La :attribute debe ser un ULID válido.',
    'uuid' => 'La :attribute debe ser un UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
