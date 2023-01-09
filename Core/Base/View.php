<?php

namespace Core\Base;

/** Include php-html template */
class View
{
    /**
     * view the html, header and footer
     *
     * @param string $view
     * @param array $data
     */
    public function __construct(string $view, array $data = array())
    {

        $view = \str_replace('.', '/', $view);
        $data = (object) $data;

        $header = 'header';
        $footer = 'footer';


        include_once \dirname(__DIR__, 2) . "/resources/views/partials/$header.php";
        include_once \dirname(__DIR__, 2) . "/resources/views/$view.php";
        include_once \dirname(__DIR__, 2) . "/resources/views/partials/$footer.php";

    }
}
