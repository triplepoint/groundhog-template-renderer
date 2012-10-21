<?php

namespace Groundhog\TemplateRenderer;

interface TemplateRendererInterface
{
    /**
     * Add a new helper to the collection of available helpers
     *
     * @param string              $index  The index under which the helper will be accessed
     * @param ViewHelperInterface $helper The helper object
     */
    public function registerHelper($index, ViewHelperInterface $helper);

    /**
     * Render the view.
     *
     * @param string $file_name which view file to render
     * @param array  $data      a key/value set of values that may or may not be useful to the view file
     *
     * @return string the rendered view, appropriate for returning
     */
    public function render($file_name, array $data = array());
}