# Validator

La class `Validator` sert à valider les types de données et de gérrer le retour sous forme de message.

## Fonctions

### Fonctions de validations

* `alphanum` Test si la valeur est Alpha numérique [a-zA-Z0-9],
* `alphanumtext` Test si la valeur est alpha numérique et possède des caractères textueles [a-zA-Z0-9 .!?,;:_-],
* `array` Test si la valeur est de type array,
* `between:min,max` Test si une valeur est entre 2 valeur,
  * @param numeric `min` Valeur minimum de comparaison,
  * @param numeric `max` Valeur maximum de comparaison (`max` > `min`),
* `bool` Test si une valeur est de type boolean,
* `date` Test si une valeur est une date,
* `date_after:date` Test si une date est antérieur à la date de comparaison,
  *  @param string `date` Valeur temporelle de compraison,
* `date_after_or_equal`
* `date_before:date` Test si une date est postérieur à la date de comparaison,
  *  @param string `date` Valeur temporelle de compraison,
* `date_before_or_equal`
* `date_format:format` Test si une date correspond à un format,
  *  @param string `date` Valeur temporelle de compraison,
* `dir` Test si une valeur est un répértoire existant sur le serveur,
* `equal:value` Test si 2 valeurs de test sont identiques (prend en paramètre `value`. Peu faire référence à la valeur d’un input en y métant sa clé précédé d’un arobase : `@clé_de_input`),
* `email` Test si une valeur est un mail,
* `file` Test si la valeur est un fichier,
* `file_extensions`
* `file_mimes`
* `file_mimetypes`
* `float` Test si une valeur est de type numerique flotant,
* `image`
* `image_dimensions_height`
* `image_dimensions_width`
* `inarray:value1[,...]` Test si une valeur est contenu dans un tableau (prend en paramètre une liste de valeur séparé par une virgule),
* `int` Test si une valeur est de type entier.
* `ip` Test si une valeur est une adresse IP.
* `json` Test si la valeur et de type json.
* `max:number` Test si une valeur est plus grande que la valeur de comparaison,
  * @param numeric `number` Valeur maximum de comparaison,
* `min:number` Test si une valeur est plus petite que la valeur de comparaison,
  * @param numeric `number` Valeur minimum de comparaison,
* `rexeg:expr` Test si une valeur est égale à une expression régulière,
  * @param string `expr` Expression régulière de comparaison,
* `required` Test si une valeur est requise.
* `required_with`
* `required_without`
* `slug` Test si la valeur correspond à une chaîne de caractère alapha numérique (underscore et tiret autorisé).
* `string` Test si la valeur est une chaîne de charactère.
* `token:time` Test si la variable `$_SESSION['token']` est ègale à la valeur et que la varaible `$_SESSION['token_time']` est inférieur à 900 seconde par rapport au temps système.
  * @param numeric `time` Valeur temporelle de comparaison en seconde (par défaut 900),
* `url` Test si une valeur est une url.

A noté que vous pouvez invérser le fonctionnement des fonction avec le caractère `!` en prèfixe. Exemple:

* `!alphaNum` Test si la valeur n’est pas Alpha numérique (déférent de [a-zA-Z0-9]).

### Fonctions de filtrages

* `htmlsc` Filtre un input avec la méthode [htmlspecialchars](http://php.net/manual/fr/function.htmlspecialchars.php).
* `striptags:tags` Filtre les balises autorisées dans un input avec la fonction [strip_tags](http://php.net/manual/fr/function.strip-tags.php) (prend en paramètre `tags` une liste de balise html spéparé par une virugle).

## Initialisation

Pour initialiser le validateur une simple déclaration de class sufit.

```php
use Soosyze\Components\Validator\Validator;

$validator = new Validator();
```

## Fonctions

### Les inputs

```php
/* Déclaration d’un input */
$validator->addInput('keyInput', 'value');

/* Déclaration de plusieurs inputs */
$validator->addInputs([
    'keyInput1' => 'Value1',
    'keyInput2' => 'Value2'
]);

/* Si un input existe */
$validator->hasInput('keyInput');

/* Retourn la valeur de l’input */
$validator->getInput('keyInput');

/* Retourne un array d’inputs */
$validator->getInputs();
```

### Les règles

```php
/* Déclaration d’une règle */
$validator->addRule('keyInput', 'rules');

/* Déclaration de plusieurs règles */
$validator->addRules([
    'keyInput1' => 'rules',
    'keyInput2' => 'rules'
]);
```

### La validation

```php
/* Retourne true si les règles sont respectées ou flase en cas d’erreures */
$validator->isValide();
```

### Les erreurs

```php
/* Retourne une erreur à partir de son nom. */
$validator->getError();

/* Retourne la liste de toutes les erreurs. */
$validator->getErrors();

/* Retourne la liste de la concaténation des noms de champs et erreurs. */
$validator->getKeyErrors();

/* Retourne la liste des noms de champ pour lesquels il y a une erreur. */
$validator->getKeyUniqueErrors();
```

## Exemple d’utilisation

### AlphaNum

```php
$validator->addInputs([
    'field_alpha_num'             =>"hello2000",
    'field_not_alpha_num'         =>'hello&2000@',
    'field_alpha_num_require'     =>"hello2000",
    'field_alpha_num_not_require' =>""
])->addRules([
    'field_alpha_num'             =>'alphaNum',
    'field_not_alpha_num'         =>'!alphaNum',
    'field_alpha_num_require'     =>'require|alphaNum',
    'field_alpha_num_not_require' =>'!require|alphaNum'
]);

$validator->isValid(); // true
```

### Between

```php
$validator->setInputs([
    /* Text */
    'field_text_between_min'           => 'Lorem',
    'field_text_between_max'           => 'Lorem ipsum doe',
    'field_not_text_between'           => 'Lore',
    'field_text_between_required'      => 'Lorem ipsum',
    'field_text_between_not_required'  => '',
    /* Numeric */
    'field_int_between_min'            => 5,
    'field_int_between_max'            => 15,
    'field_not_int_between'            => 16,
    'field_int_between_min_required'   => 5,
    'field_int_between_max_required'   => 15,
    'field_int_between_not_required'   => '',
    /* Array */
    'field_array_between_min'          => [ 1, 2, 3, 4, 5 ],
    'field_array_between_max'          => [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ],
    'field_not_array_between'          => [ 1, 2, 3, 4 ],
    'field_array_between_min_required' => [ 1, 2, 3, 4, 5 ],
    'field_array_between_max_required' => [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ],
    'field_array_between_not_required' => ''
])->setRules([
    /* Text */
    'field_text_between_min'           => 'between:5,15',
    'field_text_between_max'           => 'between:5,15',
    'field_not_text_between'           => '!between:5,15',
    'field_text_between_required'      => 'required|between:5,15',
    'field_text_between_not_required'  => '!required|between:5,15',
    /* Numeric */
    'field_int_between_min'            => 'between:5,15',
    'field_int_between_max'            => 'between:5,15',
    'field_not_int_between'            => '!between:5,15',
    'field_int_between_min_required'   => 'required|between:5,15',
    'field_int_between_max_required'   => 'required|between:5,15',
    'field_int_between_not_required'   => '!required|between:5,15',
    /* Numeric */
    'field_array_between_min'          => 'between:5,10',
    'field_array_between_max'          => 'between:5,10',
    'field_not_array_between'          => '!between:5,10',
    'field_array_between_min_required' => 'required|between:5,15',
    'field_array_between_max_required' => 'required|between:5,15',
    'field_array_between_not_required' => '!required|between:5,15'
]);

$validator->isValid(); // true
```

### Equals

```php
$validator->setInputs([
    'field_equals'              => 'hello',
    'field_not_equals'          => 'not hello',
    'field_equals_required'     => 'hello',
    'field_equals_not_required' => '',
    'field_equals_ref'          => 'hello'
])->setRules([
    'field_equals'              => 'equal:hello',
    'field_not_equals'          => '!equal:hello',
    'field_equals_required'     => 'required|equal:hello',
    'field_equals_not_required' => '!required|equal:hello',
    'field_equals_ref'          => 'equal:@field_equals'
]);

$validator->isValid(); // true
```

### Token

```php
$_SESSION[ 'token' ]      = 'Lorem ipsum dolor sit amet';
$_SESSION[ 'token_time' ] = time();

$validator->setInputs([
    'field_token'              => 'Lorem ipsum dolor sit amet',
    'field_token_required'     => 'Lorem ipsum dolor sit amet',
    'field_token_not_required' => ''
])->setRules([
    'field_token'              => 'token',
    'field_token_required'     => 'required|token',
    'field_token_not_required' => '!required|token'
]);

$validator->isValid(); // true
```

## Exemple d’utilisation des erreurs

### getKeyUniqueErrors

```php
$validator->addRule('input', 'required|string|max:255');
          ->setInput('input', 1);

if ($validator->isValid())
{
    /* return [ 'input.required', 'input.string', 'input.max' ]; */
    return $validator->getKeyErrors();
}
```
