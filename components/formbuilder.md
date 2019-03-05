# FormeBuilder

La class `FormeBuilder` sert à générrer des formulaire dynamique en PHP.

## Initialisation

Pour initialiser le générateur de formulaire une simple déclaration de class sufit.

```php
use Soosyze\Components\Form\FormBuilder;

$form = new FormBuilder();
```

## Déclarer les champs du formulaire

Les fonctions servant à déclarer les champs du formulaire utilise le desing pattern Fluent. Vous pouvez donc chaîner les fonctions.

```php
$form->function1()
     ->function2()
     [ ... ]
     ->functionN();
```

### Inputs standards

Vous pouvez créer tous type de champs standard avec la fonction suivante

```php
$form->inputBasic('type', 'name', 'id', array $attributes = []);
```

* Le type d’input (text, number, date...)
* Le nom du champ est aussi utilisé comme clé unique dans Formbuilder pour la manipulaion des champs,
* l’id du champ est le selecteur CSS 'id',
* Les attributs (class, placeholder, require, value...) peuvent être fournient dans un tableau associatif.

Le plus simple pour ce type d’input est d’utiliser directement les alias de fonctions par type pour avoir une meilleur visibilité dans votre code.

```php
$form->button('name', 'id', array $attributes = []);
$form->checkbox('name', 'id', array $attributes = []);
$form->color('name', 'id', array $attributes = []);
$form->date('name', 'id', array $attributes = []);
$form->datetime-local('name', 'id', array $attributes = []);
$form->email('name', 'id', array $attributes = []);
$form->file('name', 'id', array $attributes = []);
$form->hidden('name', 'id', array $attributes = []);
$form->image('name', 'id', array $attributes = []);
$form->month('name', 'id', array $attributes = []);
$form->number('name', 'id', array $attributes = []);
$form->password('name', 'id', array $attributes = []);
$form->radio('name', 'id', array $attributes = []);
$form->range('name', 'id', array $attributes = []);
$form->reset('name', 'id', array $attributes = []);
$form->search('name', 'id', array $attributes = []);
$form->tel('name', 'id', array $attributes = []);
$form->text('name', 'id', array $attributes = []);
$form->time('name', 'id', array $attributes = []);
$form->url('name', 'id', array $attributes = []);
$form->week('name', 'id', array $attributes = []);
```

### Label

```php
$form->label( $name, $label, array $attributes = [] );
```

* Le nom du label est utilisé comme clé unique dans Formbuilder pour la manipulaion des champs,
* Le label est le text affiché dans la balise,
* Les attributs (class, placeholder, require, value...) peuvent être fournient dans un tableau associatif.

Si dans ce tableau l’attribut `for` représente un champs existant un asthèrisque en code HTML sera injecté automatique à la suite du label

```php
$form->label( 'label-input1', 'text_label', ['for'=>'input1'])
     ->text('input1', 'id_input1');
```

```html
<label for="input1">text_label <span class="required">*</span></label>
<input name="input1" type="text" id="id_input1" >
```

### Submit

La valeur $value correspond au text à afficher dans le boutton.

```php
$form->submit( 'name', $value, array $attributes = [] );
```

### Textarea

```php
$form->textarea( $name, $content = '', array $attr = null );
```

### Select

```php
$form->select( $name, $options = [], array $attr = null );
```

### Legend

```php
$form->legend( $name, $legend, array $attr = null );
```

### Group

```php
$form->group( $name, $balise, $callback, $attr = null );
```

## Générrer le formulaire
