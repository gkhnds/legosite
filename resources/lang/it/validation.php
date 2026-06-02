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

    "accepted" => ":l'attributo deve essere accettato.",
    "active_url" => ":l'attributo deve essere un URL valido.",
    "after" => ":l'attributo deve essere una data precedente a: data.",
    "alpha" => ":l'attributo deve essere composto solo da lettere.",
    "alpha_dash" => ":l'attributo deve essere composto solo da lettere, numeri e trattini.",
    "alpha_num" => ":l'attributo deve contenere solo lettere e numeri.",
    "array" => ":l'attributo deve essere un array.",
    "before" => ":l'attributo deve essere una data precedente a :data",
    "between" => array(
        "numeric" => ":l'attributo dovrebbe essere compreso tra :minimo - :massimo.",
        "file" => ":l'attributo deve essere un valore in kilobyte compreso tra :minimo - :massimo.",
        "string" => ":l'attributo deve essere composto da :minimo - :massimo caratteri.",
        "array" => ":L'attributo deve avere un oggetto tra :minimo - :massimo."
    ),
    "distinct" => ":l'attributo non deve essere un dato duplicato.",
    "confirmed" => ":la ripetizione dell'attributo non corrisponde.",
    "date" => ":l'attributo deve essere una data valida.",
    "date_format" => ":attributo: il formato non corrisponde al formato.",
    "different" => ":attributo e :altro devono essere diversi l'uno dall'altro.",
    "digits" => ":attributo: le cifre devono essere cifre.",
    "digits_between" => ":l'attributo deve essere una cifra tra :minimo - :massimo.",
    "email" => ":il formato dell'attributo non è valido.",
    "exists" => "L'attributo :selezionato non è valido.",
    "image" => ":Il campo dell'attributo deve essere un file di immagine.",
    "in" => ":il valore dell'attributo non è valido.",
    "integer" => ":L'attributo deve essere una cifra.",
    "ip" => ":l'attributo deve essere un indirizzo di protocollo Internet valido.",
    "max" => array(
        "numeric" => ":il valore dell'attributo deve essere inferiore a :massimo.",
        "file" => ":il valore dell'attributo deve essere inferiore a :massimo kilobyte.",
        "string" => ":il valore dell'attributo deve essere inferiore al valore del carattere :massimo.",
        "array" => ":il valore dell'attributo deve avere meno di: numero massimo di oggetti."
    ),
    "mimes" => ":il formato del file degli attributi deve essere: valori.",
    "min" => array(
        "numeric" => ":il valore dell'attributo deve essere maggiore di :minimo.",
        "file" => ":il valore dell'attributo deve essere maggiore di :minimo kilobyte.",
        "string" => ":il valore dell'attributo deve essere maggiore di :valore del carattere minimo.",
        "array" => ":l'attributo deve avere almeno: oggetto minimo."
    ),
    "not_in" => "L'attributo :selezionato non è valido.",
    "numeric" => ":L'attributo deve essere una cifra.",
    "regex" => ":il formato dell'attributo non è valido.",
    'not_regex' => ':attributo Contiene caratteri incompatibili (ı,ş,ü vb.)',
    "required" => ":campo attributo è obbligatorio.",
    "required_if" => ":Richiesto quando il campo dell'attributo ha: altro: valore.",
    "required_with" => ":Obbligatorio quando campo attributo: valori.",
    "required_with_all" => ":Obbligatorio quando campo attributo: valori.",
    "required_without" => ":Obbligatorio quando il campo attributo: valori non esiste.",
    "required_without_all" => ":Obbligatorio quando il campo attributo: valori non esiste.",
    "same" => ":l'attributo deve corrispondere a: altro.",
    "size" => array(
        "numeric" => ":l'attributo dovrebbe essere: dimensione.",
        "file" => ":attributo: la dimensione deve essere in kilobyte.",
        "string" => ":attributo :dimensione deve essere un carattere.",
        "array" => ":attributo: deve avere la dimensione dell'oggetto."
    ),
    "unique" => ":l'attributo è già stato registrato.",
    "url" => ":il formato dell'attributo non è valido.",
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