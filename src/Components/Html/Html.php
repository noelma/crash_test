<?php
namespace Soosyze\Components\Html;

class Html
{
    protected $balise;

    /**
     * Attributs CSS.
     *
     * @var string[]
     */
    protected $attributesCss = [
        'id', 'class', 'style'
    ];

    protected $attributes = [];

    /**
     * Fusionne 2 tableaux sans écrasement de données si l'un des 2 est vide.
     *
     * @param array|null $tab1
     * @param array|null $tab2
     * @param bool       $crushed
     *
     * @return array Fusion des 2 tableaux.
     */
    protected function merge_attr(
    array $tab1 = null,
        array $tab2 = null,
        $crushed = false
    ) {
        if ($tab1 == null && $tab2 != null) {
            return $tab2;
        }
        if ($tab1 != null && $tab2 == null) {
            return $tab1;
        }
        if ($tab1 != null && $tab2 != null) {
            $intersect = array_intersect_key($tab1, $tab2);
            if ($intersect && !$crushed) {
                foreach ($intersect as $key => $value) {
                    $tab2[ $key ] .= ' ' . $value;
                }
            }

            return array_merge($tab1, $tab2);
        } else {
            return [];
        }
    }

    /**
     * Met en forme les attributs CSS pour les balises.
     *
     * @param array $attr Listes des attributs enregistrés.
     *
     * @return string
     */
    protected function getAttributesCSS(array $attr)
    {
        $output = [];
        foreach ($attr as $key => $values) {
            if (in_array($key, $this->attributesCss) && $values !== '') {
                $output[] = $key . '="' . $values . '"';
            }
        }
        $implode = implode(' ', $output);

        return $implode
            ? " $implode"
            : '';
    }

    /**
     * Met en forme les attributs pour les balises inputs standards.
     *
     * @param array $attr Listes des attributs enregistrés.
     *
     * @return string
     */
    protected function getAttributesInput(array $attr)
    {
        $output = [];
        foreach ($attr as $key => $values) {
            if (empty($values)) {
                continue;
            }
            if (in_array($key, $this->attributesUnique)) {
                $output[] = $key;
            } elseif (!in_array($key, $this->attributesCss) && $key !== 'selected') {
                $output[] = $key . '="' . $values . '"';
            }
        }
        $implode = implode(' ', $output);

        return $implode
            ? " $implode"
            : '';
    }

    /**
     * Recherche récursive d'un élément du formulaire à partir de sa clé
     * et lui ajoute une liste des attributs.
     *
     * @param string $key  Clé unique.
     * @param array  $attr Liste des attributs à ajouter.
     *
     * @return bool
     */
    protected function addAttrRecurses($key, array $attr)
    {
        if (isset($this->form[ $key ])) {
            $this->form[ $key ][ 'attr' ] = $this->merge_attr($this->form[ $key ][ 'attr' ], $attr);

            return true;
        }

        foreach ($this->form as $input) {
            if ($input[ 'type' ] != 'group') {
                continue;
            }

            if ($input[ 'subform' ]->addAttrRecurses($key, $attr)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Recherche récursive d'un élément du formulaire à partir de sa clé.
     *
     * @param string $key Clé unique.
     *
     * @return array|null Les données de l'élément recherché.
     */
    protected function searchItem($key)
    {
        if (isset($this->form[ $key ])) {
            return $this->form[ $key ];
        }

        foreach ($this->form as $input) {
            if ($input[ 'type' ] != 'group') {
                continue;
            }

            if (($subform = $input[ 'subform' ]->searchItem($key)) !== null) {
                return $subform;
            }
        }

        return null;
    }

    /**
     * Fonction PHP array_slice() pour tableau associatif.
     *
     * @see http://php.net/manual/fr/function.array-slice.php
     *
     * @param array      $input       Tableau associatif.
     * @param int|string $offset
     * @param int|string $length
     * @param array      $replacement
     * @param bool       $after       Si le tableau de remplacement doit être intègré après.
     */
    private function array_splice_assoc(
    array &$input,
        $offset,
        $length,
        array $replacement,
        $after = false
    ) {
        $key_indices = array_flip(array_keys($input));

        if (isset($input[ $offset ]) && is_string($offset)) {
            $offset = $key_indices[ $offset ];
        }
        if (isset($input[ $length ]) && is_string($length)) {
            $length = $key_indices[ $length ] - $offset;
        }

        $input = array_slice($input, 0, $offset + ($after
                ? 1
                : 0), true) + $replacement + array_slice($input, $offset + $length, null, true);
    }

    /**
     * Ajoute un nouvel élément de formulaire avant ou après un élément existant.
     *
     * @param string   $key      Clé unique.
     * @param callable $callback Fonction de création du sous-formulaire.
     * @param bool     $after    Si l'item doit être placé après l'élément représenter par la clé.
     *
     * @return bool
     */
    private function addItem($key, callable $callback, $after = false)
    {
        if (isset($this->form[ $key ])) {
            $form = new FormBuilder([]);
            call_user_func_array($callback, [ &$form ]);
            $this->array_splice_assoc($this->form, $key, ($after
                    ? $key
                    : 0), $form->getForm(), $after);

            return true;
        }

        foreach ($this->form as $input) {
            if ($input[ 'type' ] != 'group') {
                continue;
            }

            if ($input[ 'subform' ]->addBefore($key, $callback)) {
                return true;
            }
        }

        return false;
    }
}
