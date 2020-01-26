  # Validator

## À propos

À travers 54 règles et 8 filtres, le composant `Validator` permet de valider des données et retourner les erreurs sous forme de messages. 
Supporte les implémentations [PSR-7]().

## Sommaire

* [Installation](#installation)
* [Simple exemple](#simple-exemple)
* [Utilisation](#utilisation)
  * [Utiliser les champs](#utiliser-les-champs)
  * [Utiliser les règles](#utiliser-les-règles)
  * [Utiliser les labels](#utiliser-les-label)
  * [Valider les données](#valider-les-données)
  * [Retour d'erreurs](#retour-d-erreurs)
  * [Personnalisation globale des messages d'erreurs](#retour-d-erreurs)
  * [Personnalisation spécifique des messages d'erreurs](#retour-d-erreurs)
* [Règles de validation disponibles](#règles-de-validations)
* [Règles de filtrages disponibles](#règles-de-filtrages)
* [Spécifications des règles](#spécifications-des-règles)
  * [Négation](#négation)
  * [Bytes](#bytes)
  * [Fichiers et images](#fichiers-et-images)
  * [Between, Max, Min](#between-max-min)
* [Créer une règle personnelle]()

## Installation

Pour installer le composant :

`php composer.phar required soosyze/validator`

## Simple exemple

```php
require __DIR__ . '/vendor/autoload.php';

use Soosyze\Components\Validator\Validator;

$password_policy = '/(?=.*\d){1,}(?=.*[a-z])(?=.*\W){1,}(?=.*[A-Z]){1,}.{8,}/';

$validator = (new Validator)
    ->setInputs($_POST)
    ->setRules([
        'email'        => 'required|email',
        'name'         => 'required|string|max:255|htmlsc',
        'firstname'    => '!required|string|max:255|htmlsc',
        'picture'      => '!required|image:png,jpeg,jpg|max:1Mb',
        'birthday'     => '!required|dateformat:d-m-y',
        'pass'         => '!required|string|regex:' . $password_policy,
        'pass_confirm' => 'required_with:pass|string|equals:@password',
        'crsf'         => 'token'
    ])
    ->setLabels([
        'email'        => 'Email',
        'name'         => 'Name',
        'firstname'    => 'Firstname',
        'picture'      => 'Profile Photo',
        'birthday'     => 'Birthday',
        'pass'         => 'Password',
        'pass_confirm' => 'Confirm password'
    ]);
    
if( $validator->isValid() ) {
    echo 'Les données sont ok';
} else {
    foreach( $validator->getErrors() as $errors ) {
        echo $errors . "<br>";
    }
}
```

## Utilisation

### Manipuler les champs

```php
/* Déclaration des champs. */
$validator->addInputs([
    'keyInput1' => 'Value1',
    'keyInput2' => 'Value2'
]);

/* Ajout d’un champ. */
$validator->addInput('keyInput3', 'Value3');

/* Ajout de champs. */
$validator->addInputs([
    'keyInput4' => 'Value4',
    'keyInput5' => 'Value5'
]);

/* Si un champ existe. */
$validator->hasInput('keyInput1'); 
// = true

/* Retourne la valeur d'un champ. */
$validator->getInput('keyInput1'); 
// = 'Value1'

/* Retourne un tableau de champs. */
$validator->getInputs();
// = [ 'keyInput1' => 'Value1',... ]
```

### Manipuler les règles

```php
/* Déclaration des règles. */
$validator->setRules([
    'keyInput1' => 'rule1|rule2|rule3',
    'keyInput2' => 'rules'
]);

/* Ajout d’une règle. */
$validator->addRule('keyInput3', 'rule1|rule2');

/* Ajout de règles. */
$validator->addRules([
    'keyInput4' => 'rule1|rule2|rule3',
    'keyInput5' => 'rules'
]);
```

### Manipuler les labels

Par défaut les messages d'erreurs utilisent la clé des champs pour préciser quels champs sont en erreurs.
Pour rendre les messages plus claires vous pouvez préciser le label de chaque champ.

```php
/* Déclaration des labels. */
$validator->setLabel([
    'keyInput1' => 'Name',
    'keyInput2' => 'First name'
]);

/* Déclaration d'un label. */
$validator->addLabel('keyInput3', 'Age');
```


### Valider les données

```php
/* Retourne TRUE si les règles sont respectées sinon FALSE. */
$validator->isValide();
```

### Retour d'erreurs

```php
$validator->addRule('keyInput1', 'required|string|min:20');
          ->addInput('keyInput1', 1)
          ->addLabel('keyInput1', 'Name')
          ->isValid();

/* Retourne une erreur à partir de sa clé. */
$validator->getError('keyInput1');
// = 

/* Retourne la liste de toutes les erreurs. */
$validator->getErrors();
/* = [
    'keyInput1.required' => "Le champ Name est requis"
    'keyInput1.string'   => "Le champ Name doit-être une chaine de caractère"
] */

/* Retourne la liste de la concaténation des clés des champs et erreurs. */
$validator->getKeyErrors();
// = [ 'keyInput1.required', 'keyInput1.string' ];

/* Retourne la liste des clés des champs pour lesquels il y a une erreur. */
$validator->getKeyUniqueErrors();
// = [ 'keyInput1' ];
```

### Personnalisation globale des messages d'erreurs

### Personnalisation spécifique des messages d'erreurs

## Règles de validations

* [accepted](#accepted)
* [alph_anum](#alphanum)
* [alpha_num_text](#alphanumtext)
* [array](#array)
* [base64](#base64)
* [between:_min,max_](#between-min-max)
* [between_numeric:_min,max_](#between_numeric-min-max)
* [bool](#bool)
* [colorhex:_format_](#colorhex-format)
* [date](#date)
* [date_after:_date_](#date_after-date)
* [date_after_or_equal:_date_](#date_after_or_equal-date)
* [date_before:_date_](#date_before-date)
* [date_before_or_equal:_date_](#date_after_or_equal-date-date)
* [date_format:_format_](#date_format-format)
* [dir](#dir)
* [email](#email)
* [equal:_value_](#equal-value)
* [equal_scritc:_value_](#equal-value)
* [file](#file)
* [file_extensions:_ext,…_](#file_extensions-ext)
* [file_mimes:_mime,…_](#file_mimes-mime)
* [file_mimetypes:_ext,…_](#file_mimetypes-ext)
* [float](#float)
* [fontawesome:_font_](#fontawesome-font)
* [image:_ext,…_](#image-ext)
* [image_dimensions_height:_min,max_](#image_dimensions_height-min-max)
* [image_dimensions_width:_min,max_](#image_dimensions_width-min-max)
* [inarray:_value,…_](#inarray-value)
* [instanceof:_namespace_](#instanceof-namespace)
* [int](#int) 
* [ip:format](#ip-format)
* [iterable](#iterable)
* [json](#json)
* [max:_value_](#max-value)
* [max_numeric:_value_](#max_numeric-value)
* [min:_value_](#min-value)
* [min_numeric:_value_](#min_numeric-value)
* [null](#null)
* [numeric](#numeric)
* [rexeg:_expr_](#rexeg-expr)
* [required](#required)
* [required_with:_field,…_](#required_with-field)
* [required_with_all:_field,…_](#required_with-field)
* [required_without:_field,…_](#required_without-field)
* [required_without_all:_field,…_](#required_without-field)
* [ressource](#ressource)
* [slug](#slug)
* [string](#string)
* [token:_time_](#token-time)
* [url](#url)
* [uuid](#uuid)
* [version]()

### accepted

Test si la valeur est vraie :
* Sont considérées comme vraies, les valeurs suivantes : `true`, `'true'`, `1`, `'1'`, `'on'` et `'yes'`,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/AcceptedTest.php)

### alpha_num

Test si la valeur est alphanumérique `[a-zA-Z0-9]` :
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/AlphaNumTest.php).

### alpha_num_text

Test si la valeur est alphanumérique et possède des caractères textuels `[a-zA-Z0-9 .!?,;:_-]` :
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/AlphaNumTest.php).

### array

Test si la valeur est de type array :
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/ArrayTest.php).

### base64

Test si une valeur est une chaine de caractères au format base64 :
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/Base64Test.php).

### between:_min,max_

Test si une valeur est entre 2 valeurs :
* **min** (_numeric|bytes_) Valeur minimum de comparaison,
* **max** (_numeric|bytes_) Valeur maximum de comparaison (**max** > **min**),
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/BetweenTest.php).

### between_numeric:_min,max_

Test si une **valeur numérique** est entre 2 valeurs :
* **min** (_numeric|bytes_) Valeur minimum de comparaison,
* **max** (_numeric|bytes_) Valeur maximum de comparaison (**max** > **min**),
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/BetweenTest.php).

### bool

Test si une valeur est de type boolean :
* Sont considérées comme boolean, les valeurs suivantes : `true`, `'true'`, `false`, `'false'`, `1`, `'1'`, `0`, `'0'`, `'on'`, `'off'`, `'yes'`, `'no'` et `''`,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/BoolTest.php).

### colorhex:_format_

Test si une valeur est une couleur au format hexadécimale :
* **format** (_numeric_) 3 ou 6, laisser vide pour les 2 formats,
* Exemple : 3 pour la couleur `#F0F` et 6 pour la couleur `#FF00FF`,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/ColorHexTest.php).

### date

Test si une valeur est une date :
* Sont considérées comme des dates les formats suivants : `'YYYY-MM-DD'`, `'m/d/y'` et `'d-m-y'`,
* Voir la documentation sur la fonction [strtotime()](https://www.php.net/manual/fr/function.strtotime.php),
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/DateTest.php).

### date_after:_date_

Test si une date est antérieur à la date de comparaison :
* **date** (_string_) Valeur temporelle de compraison,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/DateTest.php).

### date_after_or_equal:_date_

Test si une date est antérieur ou égale à la date de comparaison :
* **date** (_string_) Valeur temporelle de compraison,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/DateTest.php).

### date_before:_date_

Test si une date est postérieur à la date de comparaison :
* **date** (_string_) Valeur temporelle de compraison,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/DateTest.php).

### date_before_or_equal:_date_

Test si une date est postérieur ou égale à la date de comparaison :
* **date** (_string_) Valeur temporelle de compraison,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/DateTest.php).

### date_format:_format_

Test si une date correspond à un format :
* **format** (_string_) Format de comparraison,
* Voir la documentation sur les [formats de dates en PHP](https://www.php.net/manual/fr/function.date.php),
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/DateTest.php).

### dir

Test si une valeur est un répertoire existant sur le serveur :
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/DirTest.php).

### email

Test si une valeur est une adresse de courriel selon la syntaxe définie par la [RFC 822](https://www.w3.org/Protocols/rfc822/).
Dans une adresse de type `local@domaine.extension` :
* La partie `local` peu être de 64 caractères maximum,
* Le `domaine` de 65 caractères maximum,
* Et l'`extension` de 64 caractères maximum.

Pour un total de 195 caractères (`@` et `.` compris).
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/EmailTest.php).

### equal:_value_

Test si 2 valeurs sont égales :
* **value** (_string|@reference_) Valeur ou référence d'un champ en y précisant sa clé suffixé d'un arobase,
* Exemple : `@clé_de_input`,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/EqualsTest.php).

### equal_strict:_value_

Test si 2 valeurs sont **strictement** égales :
* **value** (_string|@reference_) Valeur ou référence d'un champ en y précisant sa clé suffixé d'un arobase,
* Exemple : `@clé_de_input`,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/EqualsTest.php).

### file

Test si la valeur est un fichier valide :
* Sont considérées comme fichier, les objets implémentant l'interface [UploadedFileInterface](https://www.php-fig.org/psr/psr-7/#16-uploaded-files) sans [erreurs](https://www.php.net/manual/fr/features.file-upload.errors.php).

### file_extensions:_ext,…_

Test si une valeur correspond à un fichier qui possède l'une des extensions précisées en paramètres :
* **ext** (_string_) Liste d'extensions séparées par une virgule sans point,
* Exemple : `'jpg,pdf,xls'`.

### file_mimes:_mime,…_

Test si une valeur correspond à un fichier qui possède l'un des type MIME précisées en paramètres :
* **mime** (_string_) Liste de type MIME séparées par une virgule,
* Exemple : `'image/jpeg,application/pdf,application/vnd.ms-excel'`.

### file_mimetypes:_ext,…_

Test si une valeur correspond à un type MIME en fonction de son extension :
* **ext** (_string_) Liste d'extensions séparées par une virgule sans point,
* Exemple : `'jpg,pdf,xls'`.

### float

Test si un champ est de type ou valeur numérique flottante (aussi connus comme "floats", "doubles", ou "real numbers") :
* Sont considérées comme type ou valeur numérique flottante, les valeurs suivantes :
  * `1`, `'1'` (nombre décimal flottant),
  * `1.0`, `'1.0'` (avec précision),
  * `1e1`, `'1e1'`, `1e-1`, `'1e-1'` (avec exposant),
  * `1.0e1`, `'1.0e1'`, `1.0e-1`, `'1.0e-1'` (avec précision et exposant),
  * Toutes les valeurs non comprises entre [PHP_INT_MIN](https://www.php.net/manual/fr/reserved.constants.php) et [PHP_INT_MAX](https://www.php.net/manual/fr/reserved.constants.php).
* Voir la documentation sur les [Nombres à virgules flottantes en PHP](https://www.php.net/manual/fr/language.types.float.php),
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/FloatTest.php).

**L'exposant est insensible à la case.**

### fontawesome:_font_

Test si une valeur est un style de polices de caractères [FontAwesome](fontawesome) :
* **font** (_string_) Style de fontawesome acceptés, laisser vide pour tous les styles,
* Sont considérées comme style, les valeurs suivantes : `b` Brands, `s` Solid, `r` Regular, `l` Light, `d` Duotone.
* Exemple : `b,s`,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/FontAwesomeTest.php).

### image:_ext,…_

Test si la valeur est une image valide :
* **ext** (_string_) Liste d'extensions séparées par une virgule sans point,
* Sont considérées comme image, les objets implémentant l'interface [UploadedFileInterface](https://www.php-fig.org/psr/psr-7/#16-uploaded-files) sans [erreurs](https://www.php.net/manual/fr/features.file-upload.errors.php) avec une extension correspondant à un type MIME `image/*`.

### image_dimensions_height:_min,max_

Test la hauteur d'une image en quantité de pixel :
* **min** (_numeric|bytes_) Valeur minimum de comparaison,
* **max** (_numeric|bytes_) Valeur maximum de comparaison (**max** > **min**).

### image_dimensions_width:_min,max_

Test la largeur d'une image en quantité de pixel :
* **min** (_numeric|bytes_) Valeur minimum de comparaison,
* **max** (_numeric|bytes_) Valeur maximum de comparaison (**max** > **min**).

### inarray:_value,…_

Test si une valeur est contenu dans un tableau :
* **value** (_string_) Liste de valeur séparées par une virgule,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/InArrayTest.php).

### instanceof:_namespace_

Test si un champ contient un type d'instance :
* **value** (_string_) Le namespace d'une classe,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/InstanceTest.php).

### int

Test si un champ est de type ou valeur numérique entière :
* Sont considérées comme type ou valeur numérique flotante, les valeurs suivantes : 
  * `1`, `'1'`, (nombre décimal entier et sa représentation en chaine de caractères),
  * `0123` (nombre octal),
  * `0x1A` (nombre binaire),
  * `0b11111111` (nombre binaire),
  * Toutes les valeurs comprises entre [PHP_INT_MIN](https://www.php.net/manual/fr/reserved.constants.php) et [PHP_INT_MAX](https://www.php.net/manual/fr/reserved.constants.php).
* Voir la documentation sur les [nombres entiers en PHP](https://www.php.net/manual/fr/language.types.integer.php),
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/IntTest.php).

### ip:_format_

Test si une valeur est une adresse IP :
* **format** (_numeric_) `4` ou `6`, laisser vide pour les 2 formats,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/IpTest.php).

### iterable

Test si la valeur est un objet itérable :
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/IterableTest.php).

### json

Test si la valeur et de type json :
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/JsonTest.php).

### max:_value_

Test si une valeur est plus grande que la valeur de comparaison :
* **value** (_numeric|bytes_) Valeur maximum de comparaison,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/MaxTest.php).

### max_numeric:_value_

Test si une **valeur numérique** est plus grande que la valeur de comparaison :
* **value** (_numeric|bytes_) Valeur maximum de comparaison,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/MaxTest.php).

### min:_value_

Test si une valeur est plus petite que la valeur de comparaison :
* **value** (_numeric|bytes_) Valeur minimum de comparaison,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/MinTest.php).

### min_numeric:_value_

Test si une **valeur numérique** est plus petite que la valeur de comparaison :
* **value** (_numeric|bytes_) Valeur minimum de comparaison,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/MinTest.php).

### null

Test si une valeur est strictement égale à `null` :
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/NullTest.php).

### numeric

Test si une valeur est de type numérique :
* Voir la documentation sur la fonction [is_numeric()](https://www.php.net/manual/fr/function.is-numeric.php),
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/NumericTest.php).

### rexeg:_expr_

Test si une valeur est égale à une expression régulière :
* **expr** (_string_) Expression régulière de comparaison,
* Exemple : `'\w+\'`,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/RegexTest.php).

### required

Test si une valeur est requise :
* Sont considérées comme valeur requises, les valeurs différentes d'une chaine vide.

### required_with:_field,…_

Test si une valeur est requise en présence d'un champ :
* **field** (_reference_) référence d'un champ,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/RequiredWithTest.php).

### required_with_all:_field,…_

Test si une valeur est requise en présence de tous les champs :
* **field** (_reference_) référence d'un champ,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/RequiredWithAllTest.php).

### required_without:_field,…_

Test si une valeur est requise en l'absence d'un champ :
* **field** (_reference_) référence d'un champ,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/RequiredWithoutTest.php).

### required_without:_field,…_

Test si une valeur est requise en l'absence de tous les champs :
* **field** (_reference_) référence d'un champ,
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/RequiredWithoutAllTest.php).

### ressource

Test si une valeur est une ressource :
* Voir la documentation sur la fonction [is_resource()](https://www.php.net/manual/fr/function.is-resource.php),
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/RessourceTest.php).

### slug

Test si la valeur correspond à une chaîne de caractères alpha numérique (underscores et tirets autorisés) :
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/SlugTest.php).

### string

Test si la valeur est une chaîne de caractères :
* Sont considérées comme valeur requises, les valeurs chaînes de caractères avec simple quotes, double quote et utilisation la syntaxe herdoc,
* Voir la documentation sur la fonction [is_string()](https://www.php.net/manual/fr/function.is-string.php),
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/StringTest.php).

### token:_time_

Test si la variable `$_SESSION['token']` est ègale à la valeur et que la varaible `$_SESSION['token_time']` est inférieur à 900 seconde par rapport au temps système :
* **time** (_numeric|bytes_) Valeur temporelle de comparaison en seconde (par défaut `900`),
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/TokenTest.php).

### url

Test si une valeur est une URL :
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/UrlTest.php).

### uuid

Test si une valeur est au format UUID v4.

### version

Test si une valeur est une chaine de caractères représentant une gestion sémantique de version.
* Sont considérées comme gestion sémantique de version les chaines de caractères qui suivent le modèle `'Majeur.Mineur.Correctif-Pre_Delivery+Meta_data'`
* Voir la documentation sur la spécification [semver](https://semver.org/lang/fr/),
* [Voir les tests](https://github.com/soosyze/validator/blob/master/tests/Rules/VersionTest.php).

Ce test est basé par la spécification écrite par Tom Preston-Werner.

## Règles de filtrages

* [to_bool](#to_bool)
* [to_float](#to_float)
* [to_htmlsc](#to_int)
* [to_ltrim](#to_ltrim)
* [to_rtrim](#to_rtrim)
* [to_striptags:_tags_](#to_striptags)
* [to_trim](#to_trim)

### to_bool

Quelques soit la valeur boolean du champ, le champ sera filtré pour être de type boolean (`true` ou `false`).

### to_float

Quelques soit la valeur numérique flottante, le champ sera filtré pour être de type flottante décimale.

### to_htmlsc

Filtre un champ avec la méthode [htmlspecialchars()](http://php.net/manual/fr/function.htmlspecialchars.php).

### to_int

Quelques soit la valeur numérique entière, le champ sera filtré pour être de type entière décimale.

### to_striptags:_tags_
Filtre les balises autorisées dans un champ avec la fonction [strip_tags()](http://php.net/manual/fr/function.strip-tags.php) :
* **tags**(_string_) Liste de balise HTML séparé par une virgule,
* Exemple : `'<b><i><u><a><p><img>'`

## Spécifications des règles

### Négation

À noter que vous pouvez inverser le fonctionnement des fonctions avec le caractère `!` en préfixe.
* Exemple : `!alphaNum` Test si la valeur n'est pas alphanumérique (différent de [a-zA-Z0-9]).

**IMPORTANT** 
Quand un champ n'est pas requis, son absence de valeur stope ses tests suivants :
* `!required` le champ n'est pas requis,
* `!required_with` le champs n'est pas requis avec uns des champs listés, 
* `!required_with_all` le champ n'est pas requis avec tous les champs listés, 
* `!required_without` le champs n'est pas requis sans un des champs listés,
* Et `!required_without_all` le champs n'est pas requis sans tous les champs listés.

### Référence à une valeur

Vous pouvez vous passer la valeur d'un autre champ en y précisant sa clé suffixé d'un arobase :
```php
$validator->setRules([
        'rule1' => 'string|max:@'
    ])
    ->setInput([
    
    ]);
```

### Bytes

Les paramètres acceptant _bytes_ utilisent un préfixe pour spécifier l'unité : `b`, `kb`, `mb`, `gb`, `tb`, `pb`, `eb`, `zb`, `yb`.
* Exemple : `min:1kb` spécifie que la valeur attendue soit au minimum d'un kilo bytes à savoir une valeur de `1024`.

### Fichiers et images

Les règles `file_*` et `image_*` utilise l'interface [UploadFile de la recommandation PSR-7](https://www.php-fig.org/psr/psr-7/#36-psrhttpmessageuploadedfileinterface).

### Between, Max, Min

Les règles `between`, `max`, `min`  fonctionnent pour les types de données suivants :
* Int (!=numéric),
* Float (!=numéric),
* String,
* Objet utilisant la méthode [__toString()](https://www.php.net/manual/en/language.oop5.magic.php#object.tostring),
* Fichier utilisant [UploadedFileInterface](https://www.php-fig.org/psr/psr-7/#36-psrhttpmessageuploadedfileinterface),
* Ressource.

Les règles `between_numeric`, `max_numeric`, `min_numeric` fonctionnent pour les types de données numeriques uniquement :
* Voir la documentation de la fonction [is_numeric()](https://www.php.net/manual/fr/function.is-numeric.php).
