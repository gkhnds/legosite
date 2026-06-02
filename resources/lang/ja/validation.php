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

    "accepted" => ":属性を受け入れる必要があります。",
    "active_url" => ":属性は有効なユニフォームリソースロケータである必要があります。",
    "after" => ":属性は：日付より古い日付である必要があります。",
    "alpha" => ":属性は文字のみで構成されている必要があります。",
    "alpha_dash" => ":属性は、文字、数字、ダッシュのみで構成する必要があります。",
    "alpha_num" => ":属性には、文字と数字のみを含める必要があります。",
    "array" => ":属性は配列でなければなりません。",
    "before" => ":属性は：日にち より古い日付でなければなりません。",
    "between" => array(
        "numeric" => ":属性は：最小-：最大の間にする必要があります。",
        "file" => ":属性は、：最小-：最大の間のキロバイト値でなければなりません。",
        "string" => ":属性は、：最小-：最大文字で構成する必要があります.",
        "array" => ":属性は、：最小-：最大の間のオブジェクトを持つ必要があります。"
    ),
    "distinct" => ":属性は重複したデータであってはなりません。",
    "confirmed" => ":属性の繰り返しが一致しません。",
    "date" => ":属性は有効な日付である必要があります。",
    "date_format" => ":属性：フォーマットがフォーマットと一致しません。",
    "different" => ":属性と：その他は互いに異なっている必要があります。",
    "digits" => ":属性：数字は数字でなければなりません。",
    "digits_between" => ":属性は：最小-：最大の間の数字でなければなりません。",
    "email" => ":属性形式が無効です。",
    "exists" => "選択した：属性が無効です。",
    "image" => ":属性フィールドは画像ファイルである必要があります。",
    "in" => ":属性値が無効です。",
    "integer" => ":属性は数字でなければなりません。",
    "ip" => ":属性は有効なインターネットプロトコルアドレスである必要があります。",
    "max" => array(
        "numeric" => ":属性値は：マックスより小さくする必要があります。",
        "file" => ":属性値は：マックスキロバイト未満である必要があります。",
        "string" => ":属性値は：マックス文字値未満である必要があります。",
        "array" => ":属性値のオブジェクト数は：マックス未満である必要があります。"
    ),
    "mimes" => ":属性ファイルの形式は：価値である必要があります。",
    "min" => array(
        "numeric" => ":属性値は：最小より大きい必要があります。",
        "file" => ":属性の値は、：最小 キロバイトより大きい必要があります。",
        "string" => ":属性値は、：最小 文字値より大きくする必要があります。",
        "array" => ":属性は、少なくとも：最小を持っている必要があります オブジェクト。"
    ),
    "not_in" => "選択した：属性が無効です。",
    "numeric" => ":属性は数字でなければなりません。",
    "regex" => ":属性形式が無効です。",
    'not_regex' => ':属性に互換性のない文字が含まれています（ı、ş、üvb。）',
    "required" => ":属性フィールドは必須です。",
    "required_if" => ":属性フィールドに：その他：値 がある場合に必要です。",
    "required_with" => ":属性フィールド：値の場合に必要です。",
    "required_with_all" => ":属性フィールド:値の場合に必要です。",
    "required_without" => ":属性フィールド:値が存在しない場合に必要です。",
    "required_without_all" => ":属性フィールド：値が存在しない場合に必要です。",
    "same" => ":属性は一致する必要があります：その他。",
    "size" => array(
        "numeric" => ":属性は： サイズ にする必要があります。",
        "file" => ":attribute :size must be kilobytes.",
        "string" => ":属性： サイズ は文字でなければなりません。",
        "array" => ":属性： サイズ オブジェクトを持つ必要があります。"
    ),
    "unique" => ":属性はすでに登録されています。",
    "url" => ":属性形式が無効です。",
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