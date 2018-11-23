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

    'accepted'        => 'O :attribute deve ser aceito.',
    'active_url'      => 'O :attribute não é uma URL válida.',
    'after'           => 'O :attribute deve ser uma data depois de :date.',
    'after_or_equal'  => 'O :attribute deve ser uma data depois ou igual a :date.',
    'alpha'           => 'O :attribute pode conter apenas letras.',
    'alpha_dash'      => 'O :attribute pode conter apenas letras, números e traços.',
    'alpha_num'       => 'O :attribute pode conter apenas letras e números.',
    'array'           => 'O :attribute deve ser um array.',
    'before'          => 'O :attribute deve ser uma data antes de :date.',
    'before_or_equal' => 'O :attribute deve ser uma data antes ou igual a :date.',
    'between'         =>
    [
        'array'   => 'O :attribute deve ter entre :min e :max itens.',
        'file'    => 'O :attribute deve ter entre :min e :max kilobytes.',
        'numeric' => 'O :attribute deve ser entre :min e :max.',
        'string'  => 'O :attribute deve ter entre :min e :max caracteres.',
    ],
    'boolean'   => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed' => 'O :attribute de confirmação não coincide.',
    'custom'    =>
    [
        'attribute-name' =>
        [
            'rule-name' => 'mensagem-personalizada',
        ],
    ],
    'date'           => 'O :attribute não é uma data válida.',
    'date_format'    => 'O :attribute não coincide com o formato :format.',
    'different'      => 'O atributo :attribute e :other devem ser diferentes.',
    'digits'         => 'O :attribute deve ter :digits digitos.',
    'digits_between' => 'O :attribute deve ter entre :min e :max digitos.',
    'dimensions'     => 'O :attribute tem dimensões de imagem inválidas.',
    'distinct'       => 'O campo :attribute tem um valor duplicado.',
    'email'          => 'O :attribute deve ser um endereço de e-mail válido.',
    'exists'         => 'O :attribute selecionado é inválido.',
    'file'           => 'O :attribute deve ser um arquivo.',
    'filled'         => 'O campo :attribute deve ter um valor.',
    'image'          => 'O :attribute deve ser uma imagem.',
    'in'             => 'O :attribute selecionado é inválido.',
    'in_array'       => 'O campo :attribute não existe em :other.',
    'integer'        => 'O :attribute deve ser um número inteiro.',
    'ip'             => 'O :attribute deve ser um endereço de IP válido.',
    'ipv4'           => 'O :attribute deve ser um endereço de IPv4 válido.',
    'ipv6'           => 'O :attribute deve ser um endereço de IPv6 válido.',
    'json'           => 'O :attribute deve ser uma linha JSON válida.',
    'max'            =>
    [
        'array'   => 'O :attribute não deve ter mais do que :max itens.',
        'file'    => 'O :attribute não deve ser maior que :max kilobytes.',
        'numeric' => 'O :attribute não deve ser maior que :max.',
        'string'  => 'O :attribute não deve ser maior que :max caracteres.',
    ],
    'mimes'     => 'O :attribute deve ser um arquivo do tipo :values.',
    'mimetypes' => 'O :attribute deve ser um arquivo do tipo :values.',
    'min'       =>
    [
        'array'   => 'O :attribute deve ter no mínimo :min itens.',
        'file'    => 'O :attribute deve ter no mínimo :min kilobytes.',
        'numeric' => 'O :attribute deve ter no mínimo :min.',
        'string'  => 'O :attribute deve ter no mínimo :min caracteres.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'numeric'              => 'O :attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar present.',
    'regex'                => 'O formato do :attribute é inválido.',
    'required'             => 'O :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatório a não ser que :other seja :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não estão presentes.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos valores :values estão presentes.',
    'same'                 => 'O :attribute e :other devem ser iguais.',
    'size'                 =>
    [
        'array'   => 'O :attribute deve conter :size itens.',
        'file'    => 'O :attribute deve ter :size kilobytes.',
        'numeric' => 'O :attribute deve ter :size.',
        'string'  => 'O :attribute deve ter :size caracteres.',
    ],
    'string'   => 'O :attribute deve ser texto.',
    'timezone' => 'O :attribute deve ser uma zona válida.',
    'unique'   => 'O :attribute já está sendo utilizado.',
    'uploaded' => 'O :attribute falhou durante o upload.',
    'url'      => 'O formato do :attribute é inválido.',

];
