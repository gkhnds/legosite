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

    "accepted" => ":atributul trebuie acceptat.",
    "active_url" => ":atributul trebuie să fie o adresă URL validă.",
    "after" => ":atributul trebuie să fie o dată mai veche decât :data.",
    "alpha" => ":atributul trebuie să fie format numai din litere.",
    "alpha_dash" => ":atributul trebuie să fie format numai din litere, numere și liniuțe.",
    "alpha_num" => ":attribute must contain only letters and numbers.",
    "array" => ":atributul trebuie să fie o matrice.",
    "before" => ":atributul trebuie să fie o dată mai veche decât :data.",
    "between" => array(
        "numeric" => ":atributul trebuie să fie între: min -: max.",
        "file" => ":atributul trebuie să fie o valoare kilobyte între :min - :max.",
        "string" => ":atributul trebuie să fie format din :min -: caractere max.",
        "array" => ":Atribut trebuie să aibă obiect între: min -: max."
    ),
    "distinct" => ":atributul nu trebuie să fie duplicat de date.",
    "confirmed" => ":repetarea atributului nu se potrivește.",
    "date" => ":atributul trebuie să fie o dată validă.",
    "date_format" => ":atribut: formatul nu se potrivește cu formatul.",
    "different" => ":atribut și: altele trebuie să fie diferite unele de altele.",
    "digits" => ":atribut: cifrele trebuie să fie cifre.",
    "digits_between" => ":atributul trebuie să fie o cifră între: min și: max.",
    "email" => ":formatul atributului este nevalid.",
    "exists" => "Atributul selectat: este nevalid.",
    "image" => ":Câmpul atribut trebuie să fie un fișier imagine.",
    "in" => ":valoarea atributului este nevalidă.",
    "integer" => ":Atributul trebuie să fie o cifră.",
    "ip" => ":atributul trebuie să fie o adresă IP validă.",
    "max" => array(
        "numeric" => ":valoarea atributului trebuie să fie mai mică de: max.",
        "file" => ":valoarea atributului trebuie să fie mai mică de: max kilobytes.",
        "string" => ":valoarea atributului trebuie să fie mai mică de: valoarea maximă a caracterului.",
        "array" => ":valoarea atributului trebuie să aibă mai puțin de: numărul maxim de obiecte."
    ),
    "mimes" => ":formatul fișierului atribut trebuie să fie: valori.",
    "min" => array(
        "numeric" => ":valoarea atributului trebuie să fie mai mare de: min.",
        "file" => ":valoarea atributului trebuie să fie mai mare de: min kilobytes.",
        "string" => ":valoarea atributului trebuie să fie mai mare de: valoarea min de caractere.",
        "array" => ":atribut trebuie să aibă cel puțin :min obiect."
    ),
    "not_in" => "Atributul selectat: este nevalid.",
    "numeric" => ":Atributul trebuie să fie o cifră.",
    "regex" => ":formatul atributului este nevalid.",
    'not_regex' => ':atributul conține caractere incompatibile (ı, ș, ü vb.)',
    "required" => ":câmp atribut este necesar.",
    "required_if" => ":Necesar atunci când câmpul atribut are :Altele :valoare.",
    "required_with" => ":Necesar atunci când atribut câmp: valori.",
    "required_with_all" => ":Necesar atunci când atribut câmp: valori.",
    "required_without" => ":Necesar atunci când câmpul atribut :valori nu există.",
    "required_without_all" => ":Necesar atunci când câmpul atribut :valori nu există.",
    "same" => ":atributul trebuie să se potrivească: altele.",
    "size" => array(
        "numeric" => ":atributul ar trebui să fie:Dimensiune.",
        "file" => ":atribut: dimensiunea trebuie să fie kilobytes.",
        "string" => ":atribut: dimensiunea trebuie să fie un caracter.",
        "array" => ":atribut: trebuie să aibă obiect Dimensiune."
    ),
    "unique" => ":atributul a fost deja înregistrat.",
    "url" => ":formatul atributului este nevalid.",
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