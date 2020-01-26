<?php

namespace Soosyze\Components\Filter;

class FilterHTML
{
    public static $allowed_tags = [
        /* Lien et conteneurs. */
        '<a>', '<p>', '<span>', '<div>',
        /* Titre */
        '<h2>', '<h3>', '<h4>',
        /* Média. */
        '<img>', '<map>', '<area>',
        /* Séparateurs. */
        '<hr>', '<br>',
        /* Listes. */
        '<ul>', '<ol>', '<li>', '<dl>', '<dt>', '<dd>',
        /* Tableau. */
        '<table>', '<caption>',
        '<tbody>', '<thead>', '<tfoot>',
        '<th>', '<tr>', '<td>',
        /* Typographie. */
        '<em>', '<b>', '<u>', '<i>', '<strong>', '<del>', '<ins>', '<sub>', '<sup>',
        '<quote>', '<blockquote>', '<pre>', '<address>', '<code>', '<cite>', '<strike>'
    ];

    /**
     * @param type $html
     * @param type $allowed_tags Répertoriez les balises que vous souhaitez autoriser
     *
     * @return string
     */
    public function filter_html(
        $html,
        $allowed_tags = [ 'b', 'br', 'em', 'hr', 'i', 'li', 'ol',
        'p', 's', 'span', 'table', 'tr', 'td', 'u', 'ul' ]
    ) {
        $xml            = new DOMDocument();
        $xml->encoding  = 'UTF-8';
        /* Suppress warnings: proper error handling is beyond scope of example */
        libxml_use_internal_errors(true);
        $allowed_tags[] = 'html';
        /* List the attributes you want to allow here */
        $allowed_attrs  = [ 'class', 'id', 'style' ];
        if (!strlen($html)) {
            return '';
        }
        $html = str_replace([ '<html>', '</html>' ], '', $html);
        if ($xml->loadHTML('<html>' . $html . '</html>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD)) {
            foreach ($xml->getElementsByTagName('*') as $node) {
                echo "tag {$node->tagName} value {$node->nodeValue} content {$node->textContent}<br>\n\t";
                if (strlen(trim($node->nodeValue)) == 0) { // que des espaces
                    $node->parentNode->removeChild($node);
                    echo "supprime<br>\n\t";
                }
                if (!in_array($node->tagName, $allowed_tags)) {
                    echo 'supprime<br>';
                    $node->parentNode->removeChild($node);
                } else {
                    foreach ($node->attributes as $attr) {
//                    var_dump($attr->nodeName);
                        if (!in_array($attr->nodeName, $allowed_attrs)) {
                            echo "supprime<br>\n\t";
                            $node->removeAttribute($attr->nodeName);
                        }
                    }
                }
            }
        }

        return str_replace([ '<html>', '</html>' ], '', $xml->saveHTML());
    }
}
