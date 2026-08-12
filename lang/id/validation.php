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

    'accepted' => 'The :attribute harus diterima.',
    'active_url' => 'The :attribute bukan URL yang valid.',
    'after' => 'The :attribute harus tanggal setelah :date.',
    'after_or_equal' => 'The :attribute harus tanggal setelah atau sama dengan :date.',
    'alpha' => 'The :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'The :attribute hanya boleh berisi huruf, angka, dan tanda hubung.',
    'alpha_num' => 'The :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'The :attribute harus berupa array.',
    'before' => 'The :attribute harus tanggal sebelum :date.',
    'before_or_equal' => 'The :attribute harus tanggal sebelum atau sama dengan :date.',
    'between' => [
        'numeric' => 'The :attribute harus antara :min dan :max.',
        'file' => 'The :attribute harus antara :min dan :max kilobytes.',
        'string' => 'The :attribute harus antara :min dan :max karakter.',
        'array' => 'The :attribute harus antara :min dan :max item.',
    ],
    'boolean' => 'The :attribute harus true atau false.',
    'confirmed' => 'The :attribute konfirmasi tidak cocok.',
    'current_password' => 'Password salah.',
    'date' => 'The :attribute bukan tanggal yang valid.',
    'date_equals' => 'The :attribute harus tanggal yang sama dengan :date.',
    'date_format' => 'The :attribute tidak cocok dengan format :format.',
    'different' => 'The :attribute dan :other harus berbeda.',
    'digits' => 'The :attribute harus :digits digit.',
    'digits_between' => 'The :attribute harus antara :min dan :max digit.',
    'dimensions' => 'The :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'The :attribute memiliki nilai yang duplikat.',
    'email' => 'The :attribute harus berupa email yang valid.',
    'ends_with' => 'The :attribute harus diakhiri dengan salah satu dari: :values.',
    'exists' => 'The :attribute yang dipilih tidak valid.',
    'file' => 'The :attribute harus berupa file.',
    'filled' => 'The :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'The :attribute harus lebih besar dari :value.',
        'file' => 'The :attribute harus lebih besar dari :value kilobytes.',
        'string' => 'The :attribute harus lebih besar dari :value karakter.',
        'array' => 'The :attribute harus lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => 'The :attribute harus lebih besar atau sama dengan :value.',
        'file' => 'The :attribute harus lebih besar atau sama dengan :value kilobytes.',
        'string' => 'The :attribute harus lebih besar atau sama dengan :value karakter.',
        'array' => 'The :attribute harus lebih dari atau sama dengan :value item.',
    ],
    'image' => 'The :attribute harus berupa gambar.',
    'in' => 'The :attribute yang dipilih tidak valid.',
    'in_array' => 'The :attribute tidak ada dalam :other.',
    'integer' => 'The :attribute harus berupa integer.',
    'ip' => 'The :attribute harus berupa alamat IP yang valid.',
    'ipv4' => 'The :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'The :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'The :attribute harus berupa string JSON yang valid.',
    'lt' => [
        'numeric' => 'The :attribute harus kurang dari :value.',
        'file' => 'The :attribute harus kurang dari :value kilobytes.',
        'string' => 'The :attribute harus kurang dari :value karakter.',
        'array' => 'The :attribute harus kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => 'The :attribute harus kurang dari atau sama dengan :value.',
        'file' => 'The :attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string' => 'The :attribute harus kurang dari atau sama dengan :value karakter.',
        'array' => 'The :attribute harus kurang dari atau sama dengan :value item.',
    ],
    'max' => [
        'numeric' => 'The :attribute tidak boleh lebih dari :max.',
        'file' => 'The :attribute tidak boleh lebih dari :max kilobytes.',
        'string' => 'The :attribute tidak boleh lebih dari :max karakter.',
        'array' => 'The :attribute tidak boleh lebih dari :max item.',
    ],
    'mimes' => 'The :attribute harus berupa file tipe: :values.',
    'mimetypes' => 'The :attribute harus berupa file tipe: :values.',
    'min' => [
        'numeric' => 'The :attribute harus minimal :min.',
        'file' => 'The :attribute harus minimal :min kilobytes.',
        'string' => 'The :attribute harus minimal :min karakter.',
        'array' => 'The :attribute harus minimal :min item.',
    ],
    'not_in' => 'The :attribute yang dipilih tidak valid.',
    'not_regex' => 'The :attribute format tidak valid.',
    'numeric' => 'The :attribute harus berupa angka.',
    'password' => 'Password salah.',
    'present' => 'The :attribute harus ada.',
    'regex' => 'The :attribute format tidak valid.',
    'required' => 'The :attribute wajib diisi.',
    'required_if' => 'The :attribute wajib diisi ketika :other adalah :value.',
    'required_unless' => 'The :attribute wajib diisi kecuali :other ada dalam :values.',
    'required_with' => 'The :attribute wajib diisi ketika :values ada.',
    'required_with_all' => 'The :attribute wajib diisi ketika :values ada.',
    'required_without' => 'The :attribute wajib diisi ketika :values tidak ada.',
    'required_without_all' => 'The :attribute wajib diisi ketika tidak ada :values.',
    'same' => 'The :attribute dan :other harus sama.',
    'size' => [
        'numeric' => 'The :attribute harus :size.',
        'file' => 'The :attribute harus :size kilobytes.',
        'string' => 'The :attribute harus :size karakter.',
        'array' => 'The :attribute harus :size item.',
    ],
    'starts_with' => 'The :attribute harus diawali dengan salah satu dari: :values.',
    'string' => 'The :attribute harus berupa string.',
    'timezone' => 'The :attribute harus berupa zona waktu yang valid.',
    'unique' => 'The :attribute sudah ada.',
    'uploaded' => 'The :attribute gagal diunggah.',
    'url' => 'The :attribute format tidak valid.',
    'uuid' => 'The :attribute harus berupa UUID yang valid.',

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