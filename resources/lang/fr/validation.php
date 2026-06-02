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

    "accepted" => ":l'attribut doit être accepté.",
    "active_url" => ":L'attribut doit être une URL valide.",
    "after" => ":l'attribut doit être une date antérieure à :date.",
    "alpha" => ":L'attribut doit être composé uniquement de lettres.",
    "alpha_dash" => ":L'attribut ne doit être composé que de lettres, de chiffres et de tirets.",
    "alpha_num" => ":L'attribut ne doit contenir que des lettres et des chiffres.",
    "array" => ":l'attribut doit être un tableau.",
    "before" => ":l'attribut doit être une date antérieure à: date.",
    "between" => array(
        "numeric" => ":l'attribut doit être compris entre: min -: max.",
        "file" => ":l'attribut doit être une valeur de kilo-octet comprise entre: min -: max.",
        "string" => ":l'attribut doit être composé de caractères: min -: max.",
        "array" => ":L'attribut doit avoir un objet entre: min -: max."
    ),
    "distinct" => ":l'attribut ne doit pas être des données en double.",
    "confirmed" => ":La répétition de l'attribut ne correspond pas.",
    "date" => ":L'attribut doit être une date valide.",
    "date_format" => ":attribut :format ne correspond pas au format.",
    "different" => ":l'attribut et :autre doivent être différents l'un de l'autre.",
    "digits" => ":attribut : les chiffres doivent être des chiffres.",
    "digits_between" => ":l'attribut doit être un chiffre entre :min et :max.",
    "email" => ":le format d'attribut n'est pas valide.",
    "exists" => "L'attribut : sélectionné est valide.",
    "image" => ":Le champ d'attribut doit être un fichier image.",
    "in" => ":la valeur de l'attribut n'est pas valide.",
    "integer" => ":L'attribut doit être un chiffre.",
    "ip" => ":l'attribut doit être une adresse de protocole Internet valide..",
    "max" => array(
        "numeric" => ":la valeur de l'attribut doit être inférieure à: max.",
        "file" => ":la valeur de l'attribut doit être inférieure à: kilo-octets max.",
        "string" => ":la valeur de l'attribut doit être inférieure à: valeur maximale du caractère.",
        "array" => ":la valeur de l'attribut doit avoir moins de: nombre maximum d'objets."
    ),
    "mimes" => ":le format du fichier d'attribut doit être: valeurs.",
    "min" => array(
        "numeric" => ":la valeur de l'attribut doit être supérieure à: min.",
        "file" => ":la valeur de l'attribut doit être supérieure à :min kilo-octets.",
        "string" => ": la valeur de l'attribut doit être supérieure à: valeur de caractère min.",
        "array" => ":l'attribut doit avoir au moins :objet min."
    ),
    "not_in" => "Le :attribut sélectionné n'est pas valide.",
    "numeric" => ":L'attribut doit être un chiffre.",
    "regex" => ":le format d'attribut n'est pas valide.",
    'not_regex' => ':attribut Contient Des Caractères Incompatibles ( ı, ş, ü v.b)',
    "required" => ":le champ attribut est requis.",
    "required_if" => ":Obligatoire lorsque le champ d'attribut a :autre :valeur.",
    "required_with" => ":Obligatoire lorsque champ d'attribut : valeurs.",
    "required_with_all" => ":Obligatoire lorsque champ d'attribut : valeurs.",
    "required_without" => ":Obligatoire lorsque le champ d'attribut: valeurs n'existe pas.",
    "required_without_all" => ":Obligatoire lorsque le champ d'attribut :valeurs n'existe pas.",
    "same" => ":l'attribut doit correspondre à: autre.",
    "size" => array(
        "numeric" => ":l'attribut doit être: taille.",
        "file" => ":l'attribut doit être: taille.",
        "string" => ":attribut: la taille doit être un caractère.",
        "array" => ":attribut: doit avoir un objet de taille."
    ),
    "unique" => ":l'attribut a déjà été enregistré.",
    "url" => ":le format d'attribut n'est pas valide.",
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