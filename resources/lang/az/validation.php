<?php



return array(
    /*
      |--------------------------------------------------------------------------
      | Validation Language Lines
      |--------------------------------------------------------------------------
      |
      | The following language lines contain the default error messages used by
      | the validator class. Some of these rules have multiple versions such
      | such as the size rules. Feel free to tweak each of these messages.
      |
     */

    "accepted" => ":atribut qəbul edilməlidir.",
    "active_url" => ":atribut etibarlı URL olmalıdır.",
    "after" => ":atribut older tarix olmalıdır: Tarix.",
    "alpha" => ":atributu yalnız hərflərdən ibarət olmalıdır.",
    "alpha_dash" => ":atribut yalnız məktublar, nömrələri və tire ibarət olmalıdır.",
    "alpha_num" => ":atributu yalnız məktublar və nömrələr olmalıdır.",
    "array" => ":atribut bir sıra olmalıdır.",
    "before" => ":atribut older tarix olmalıdır: Tarix.",
    "between" => array(
        "numeric" => ":atributu arasında olmalıdır: min -: max.",
        "file" => ":atribut arasında kilobayt dəyər olmalıdır: min -: max.",
        "string" => ":atributu ibarət olmalıdır: min -: max simvol.",
        "array" => ":Atributu arasında bir obyekt olmalıdır: min -: max."
    ),
    "distinct" => ":Atribut təkrarlanan məlumatlar olmamalıdır.",
    "confirmed" => ":atributu təkrarlaması uyğun gəlmir.",
    "date" => ":atribut etibarlı tarixi olmalıdır.",
    "date_format" => ":atribut: format formatla uyğun gəlmir.",
    "different" => ":attribut və: digəri bir -birindən fərqli olmalıdır.",
    "digits" => ":attribut: rəqəmlər rəqəm olmalıdır.",
    "digits_between" => ":attribut: min və: max arasındakı rəqəm olmalıdır.",
    "email" => ":atribut formatı etibarsızdır.",
    "exists" => "Seçilmiş: atributu etibarlıdır.",
    "image" => ":Atribut sahəsində bir şəkil faylı olmalıdır.",
    "in" => ":atribut dəyəri etibarsızdır.",
    "integer" => ":Atribut rəqəm olmalıdır.",
    "ip" => ":atributu etibarlı IP ünvanı olmalıdır.",
    "max" => array(
        "numeric" => ":attribut dəyəri: max -den az olmalıdır.",
        "file" => ":atribut dəyəri az olmalıdır: maksimum kilobayt.",
        "string" => ":atribut dəyəri: maksimum simvol dəyərindən az olmalıdır.",
        "array" => ":atribut dəyəri az olmalıdır: obyektlərin maksimum sayı."
    ),
    "mimes" => ":atributu fayl formatı olmalıdır: dəyərlər.",
    "min" => array(
        "numeric" => ":atribut dəyəri daha böyük olmalıdır: min.",
        "file" => ":atribut dəyəri daha çox olmalıdır: minimum kilobayt.",
        "string" => ":atribut dəyəri daha böyük olmalıdır: simvolun minimum dəyəri.",
        "array" => ":atributu ən azı olmalıdır: minimum obyekt."
    ),
    "not_in" => "Seçilmiş: atributu etibarsızdır.",
    "numeric" => ":Atribut rəqəm olmalıdır.",
    "regex" => ":atribut formatı etibarsızdır.",
    'not_regex' => ':Uyğun olmayan simvollar ehtiva edən atribut (ı, ş, ü vb.)',
    "required" => ":attribut sahəsi tələb olunur.",
    "required_if" => ":Atribut sahəsində: digər: dəyər olduqda tələb olunur.",
    "required_with" => ":Attribut sahəsi: dəyərlər olduqda tələb olunur.",
    "required_with_all" => ":Tələb əgər atribut sahəsində: dəyərlər.",
    "required_without" => ":Tələb əgər atribut sahəsində: heç bir dəyəri yoxdur.",
    "required_without_all" => ":Tələb əgər atribut sahəsində: heç bir dəyəri yoxdur.",
    "same" => ":atribut uyğun olmalıdır: digər.",
    "size" => array(
        "numeric" => ":atribut: ölçüsü olmalıdır.",
        "file" => ":atribut: ölçüsü kilobayt olmalıdır.",
        "string" => ":atribut: ölçü bir xarakter olmalıdır.",
        "array" => ":atribut: ölçüsü obyekt olmalıdır."
    ),
    "unique" => ":atribut artıq qeydə alınıb.",
    "url" => ":atribut formatı etibarsızdır.",
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
    'custom' => array(),
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
    'attributes' => array(),
);