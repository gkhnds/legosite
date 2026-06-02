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

    "accepted" => ":attribut muss akzeptiert werden.",
    "active_url" => ":Attribut muss eine gültige URL sein.",
    "after" => ":attribut muss ein Datum älter sein als: Datum.",
    "alpha" => ":attribut muss nur aus Buchstaben bestehen.",
    "alpha_dash" => ":attribut darf nur aus Buchstaben, Zahlen und Bindestrichen bestehen.",
    "alpha_num" => ":attribut darf nur Buchstaben und Zahlen enthalten.",
    "array" => ":Attribut muss ein array sein.",
    "before" => ":attribut muss ein Datum älter sein als: Datum.",
    "between" => array(
        "numeric" => ":attribut sollte zwischen: min -: max.",
        "file" => ":Attribut muss ein kilobyte Wert zwischen :min - :max.",
        "string" => ":Attribut muss bestehen aus :min - :max Zeichen.",
        "array" => ":Attribut muss Objekt zwischen :min - :max."
    ),
    "distinct" => ":attribut darf keine doppelten Daten sein.",
    "confirmed" => ":attribut repeat stimmt nicht überein.",
    "date" => ":Attribut muss ein gültiges Datum sein.",
    "date_format" => ":attribut: Format stimmt nicht mit dem Format überein.",
    "different" => ":attribut und: andere müssen sich voneinander unterscheiden.",
    "digits" => ":attribut: Ziffern müssen Ziffern sein.",
    "digits_between" => ":Attribut muss eine Ziffer zwischen :min und :max.",
    "email" => ":Attribut-format ist ungültig.",
    "exists" => "Das Attribut selected :ist ungültig.",
    "image" => ":Das Attributfeld muss eine Bilddatei sein.",
    "in" => ":attributwert ist ungültig.",
    "integer" => ":Das Attribut muss eine Ziffer sein.",
    "ip" => ":Attribut muss eine gültige IP-Adresse.",
    "max" => array(
        "numeric" => ":attributwert muss kleiner sein als: max.",
        "file" => ":attributwert muss kleiner sein als: max Kilobyte.",
        "string" => ":attributwert muss kleiner sein als: max Zeichenwert.",
        "array" => ":attributwert muss kleiner sein als: maximale Anzahl von Objekten."
    ),
    "mimes" => ":Attributdateiformat muss sein: Werte.",
    "min" => array(
        "numeric" => ":attributwert muss größer sein als: min.",
        "file" => ":attributwert muss größer sein als: min Kilobyte.",
        "string" => ":attributwert muss größer sein als: min Zeichenwert.",
        "array" => ":attribut muss mindestens haben: min Objekt."
    ),
    "not_in" => "Das Attribut selected :ist ungültig.",
    "numeric" => ":Das Attribut muss eine Ziffer sein.",
    "regex" => ":Attribut-format ist ungültig.",
    'not_regex' => ':attribut Enthält inkompatible Zeichen (ı, ş, ü vb.)',
    "required" => ":attributfeld ist erforderlich.",
    "required_if" => ":Erforderlich, wenn Attributfeld hat: andere: Wert.",
    "required_with" => ":Erforderlich, wenn Attributfeld: Werte.",
    "required_with_all" => ":Erforderlich, wenn Attributfeld: Werte.",
    "required_without" => ":Erforderlich, wenn das Attributfeld: values nicht vorhanden ist.",
    "required_without_all" => ":Erforderlich, wenn das Attributfeld: values nicht vorhanden ist",
    "same" => ":attribut muss übereinstimmen: andere.",
    "size" => array(
        "numeric" => ":attribut sollte sein: Größe.",
        "file" => ":attribut: Größe muss Kilobyte sein.",
        "string" => ":attribut: Größe muss ein Zeichen sein.",
        "array" => ":attribut :muss Größe Objekt haben."
    ),
    "unique" => ":attribut wurde bereits registriert.",
    "url" => ":Attribut-format ist ungültig.",
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