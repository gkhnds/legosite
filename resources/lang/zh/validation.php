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

    "accepted" => ":属性必须被接受。",
    "active_url" => ":属性必须是有效的 网址。",
    "after" => ":属性必须是早于 : 日期的日期。",
    "alpha" => ":属性必须仅由字母组成。",
    "alpha_dash" => ":属性只能由字母，数字和破折号组成。",
    "alpha_num" => ":属性必须仅包含字母和数字。",
    "array" => ":属性必须是数组。",
    "before" => ":属性必须是早于 : 日期的日期。",
    "between" => array(
        "numeric" => ":此属性应介于：最小值-：最大值之间",
        "file" => ":属性必须是介于：最小值-：最大值之间的千字节值。",
        "string" => ":属性必须包括：最小值-：最大值。 人物。",
        "array" => ":此属性必须是 :最小值-：最大值 之间的千字节值。"
    ),
    "distinct" => ":属性不能是重复数据。",
    "confirmed" => ":属性重复不匹配。",
    "date" => ":属性必须是有效日期。",
    "date_format" => ":属性：格式与格式不匹配。",
    "different" => ":属性和：其他必须彼此不同。",
    "digits" => ":属性：数字必须是数字。",
    "digits_between" => ":属性必须是介于：最小值和：最大值之间的数字。",
    "email" => ":属性格式无效。",
    "exists" => "选定的 : 属性无效。",
    "image" => ":属性字段必须是图像文件。",
    "in" => ":属性值无效。",
    "integer" => ":该属性必须是数字。",
    "ip" => ":该属性必须是有效的互联网协议。",
    "max" => array(
        "numeric" => ":属性值必须小于：最大值。",
        "file" => ":属性值必须小于：最大千字节。",
        "string" => ":属性值必须小于：最大字符值。",
        "array" => ":属性值必须少于：最大数量的对象。"
    ),
    "mimes" => ":属性文件格式必须是：值。",
    "min" => array(
        "numeric" => ":属性值必须大于：最小值。",
        "file" => ":属性值必须大于：最小千字节。",
        "string" => ":属性值必须大于：最小字符值。",
        "array" => ":属性必须至少有：最小对象。"
    ),
    "not_in" => "选定的 : 属性无效。",
    "numeric" => ":该属性必须是数字。",
    "regex" => ":属性格式无效。",
    'not_regex' => ':属性包含不兼容的字符 (ı,ş,ü vb.)',
    "required" => ":属性字段是必需的。",
    "required_if" => ":当属性字段具有：其他：价值 时为必需。",
    "required_with" => ":属性字段：值时为必填项。",
    "required_with_all" => ":属性字段：值时为必填项。",
    "required_without" => ":属性字段：值不存在时为必需。",
    "required_without_all" => ":属性字段：值不存在时为必需。",
    "same" => ":属性必须匹配：其他。",
    "size" => array(
        "numeric" => ":属性应该是：大小。",
        "file" => ":属性：大小必须是千字节。",
        "string" => ":属性：大小必须是一个字符。",
        "array" => ":属性：必须有大小对象。"
    ),
    "unique" => ":属性已经注册。",
    "url" => ":属性格式无效。",
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