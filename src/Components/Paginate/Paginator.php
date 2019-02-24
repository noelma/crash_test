<?php

namespace Soosyze\Components\Paginate;

class Paginator
{
    /**
     * Nombre d'item à afficher au maximum.
     *
     * @var int
     */
    protected $limit;

    /**
     * @var type
     */
    protected $offset;

    /**
     * Clé dans le lien à incrémenter ou décrémenter.
     *
     * @var string
     */
    protected $key_page = ':key';

    /**
     * Label à afficher pour passer à l'item précédent.
     *
     * @var string
     */
    protected $label_previous = '&lsaquo;';

    /**
     * Label à afficher pour passer à l'item suivant.
     * @var type
     */
    protected $label_next = '&rsaquo;';

    /**
     * Label à afficher pour passer a la première page.
     * @var type
     */
    protected $label_first = '&laquo;';

    /**
     * Label à afficher pour passer à la dernière pase.
     *
     * @var type
     */
    protected $label_last = '&raquo;';

    /**
     * Les règles d'affichage pour la pagination.
     *
     * @var array
     */
    protected $display = [
        'previous',
        'next',
        'first',
        'last',
        'start',
        'middle',
        'end',
    ];

    protected $rules;

    private $nb_page;

    public function __construct($link, $count, $limit = 25, $offset = 0)
    {
        $this->link    = $link;
        $this->count   = $count;
        $this->limit   = $limit;
        $this->offset  = $offset;
        $this->nb_page = (int) (($count / $limit) + 1);
    }

    public function __toString()
    {
        return $this->render();
    }

    public function getPageNext()
    {
        return $this->offset + 1;
    }

    public function getPagePreviouse()
    {
        return $this->offset - 1;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    public function setRule($rules)
    {
        $this->rules = $rules;

        return $this;
    }

    public function render()
    {
        $output = '<ul class="pagination">';
        $output .= $this->renderFirst();
        $output .= $this->renderPrevious();
        $output .= $this->renderStart();
        $output .= $this->renderMiddle();
        $output .= $this->renderEnd();
        $output .= $this->renderNext();
        $output .= $this->renderLast();
        $output .= '</ul>';

        return $output;
    }

    public function isActive($key)
    {
        return $this->offset == $key
            ? 'active'
            : '';
    }
    
    protected function parseRules()
    {
    }

    protected function renderStart()
    {
        $output ='';
        for ($i = 1; $i < $this->nb_page; $i++) {
            $link   = str_replace($this->key_page, $i, $this->link);
            $output .= '<li class="' . $this->isActive($i) . '">';
            $output .= '<a href="' . $link . '"/>' . $i . '</a>';
            $output .= '</li>';
        }

        return $output;
    }

    protected function renderMiddle()
    {
        return '';
    }

    protected function renderEnd()
    {
        return '';
    }

    protected function renderFirst()
    {
        if ($this->offset == 1) {
            return '';
        }
        $link = str_replace($this->key_page, 1, $this->link);

        return '<li><a href="' . $link . '"/>' . $this->label_first . '</a></li>';
    }

    protected function renderLast()
    {
        if ($this->offset == $this->nb_page - 1) {
            return '';
        }
        $link = str_replace($this->key_page, $this->nb_page - 1, $this->link);

        return '<li><a href="' . $link . '"/>' . $this->label_last . '</a></li>';
    }

    protected function renderPrevious()
    {
        if (0 >= $this->getPagePreviouse()) {
            return '';
        }
        $link = str_replace($this->key_page, $this->getPagePreviouse(), $this->link);

        return '<li><a href="' . $link . '"/>' . $this->label_previous . '</a></li>';
    }

    protected function renderNext()
    {
        if ($this->nb_page <= $this->getPageNext()) {
            return '';
        }
        $link = str_replace($this->key_page, $this->getPageNext(), $this->link);

        return '<li><a href="' . $link . '"/>' . $this->label_next . '</a></li>';
    }
}
