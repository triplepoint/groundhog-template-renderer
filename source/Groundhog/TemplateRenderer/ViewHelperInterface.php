<?php

namespace Groundhog\TemplateRenderer;

/**
 * Classes that implement this interface can have any number of public method for setting and manipulating data,
 * however all the public methods except for render() should return $this, in order to support chainability.
 *
 */
interface ViewHelperInterface
{
    /**
     * Print the output of this view helper
     *
     * @return void
     */
    public function render();
}
