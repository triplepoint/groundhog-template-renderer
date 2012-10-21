<?php
namespace Groundhog\TemplateRenderer;

class TemplateRendererPhp
{
    /**
     * Data visible to the view when its rendered
     *
     * @var array
     */
    protected $data;

    /**
     * A collection of helper objects that are accessible from within the template files.
     *
     * @var ViewHelperInterface[]
     */
    protected $helper;

    /**
     * Add a new helper to the collection of available helpers
     *
     * @param string              $index  The index under which the helper will be accessed
     * @param ViewHelperInterface $helper The helper object
     */
    public function registerHelper($index, ViewHelperInterface $helper)
    {
        $this->helper[$index] = $helper;
    }

    /**
     * Render the view.
     *
     * @param string $file_name which view file to render
     * @param array  $data      a key/value set of values that may or may not be useful to the view file
     *
     * @return string the rendered view, appropriate for returning
     */
    public function render($file_name, array $data = array())
    {
        try {
            $this->data = $data;

            ob_start();
            require $file_name;
            $return = ob_get_contents();
            ob_end_clean();

            return $return;

        } catch ( \Exception $e ) {
            ob_end_clean();
            throw $e;

        }
    }

    /**
     * Shortcut method used in a template to evaluate another template and return the contents.
     *
     * @param string $file_name
     * @param array  $data
     *
     * @return string
     */
    protected function partial($file_name, array $data = array())
    {
        $partial = new self();
        return $partial->render($file_name, $data);
    }

    /**
     * Wrap the content of the current template with the given template file.
     *
     * Esentially, this is clearing the output buffer and refilling it with a wrapped
     * version of what was previously in the output buffer.
     *
     * @param string $file_name
     * @param array  $data
     *
     * @return void
     */
    protected function wrap($file_name, array $data = array())
    {
        $data['wrapped_content'] = ob_get_contents();
        ob_end_clean();

        ob_start();
        $wrapper = new self();
        echo $wrapper->render($file_name, $data);
    }
}