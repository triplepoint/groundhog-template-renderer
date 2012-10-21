<?php

namespace Groundhog\TemplateRenderer;

class RequestRootUri implements ViewHelperInterface
{
    /**
     * The http request object to which to delegate the URI construction
     *
     * @var RequestInterface
     */
    protected $http_request;

    /**
     * When set, this value is substituted in the URI's scheme for the next render().
     *
     * @var string|null
     */
    protected $scheme;

    /**
     * Set the http request object
     *
     * @param RequestInterface $http_request
     */
    public function __construct(RequestInterface $http_request)
    {
        $this->http_request = $http_request;
    }

    /**
     * Set the sceme for the next render.
     *
     * Note that this scheme will get reset to the default after each render call.
     *
     * @param string $scheme
     *
     * @return \Groundhog\TemplateRenderer\RequestRootUri
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;

        return $this;
    }

    /**
     * Assemble a base path for this page request.
     * For whatever reason, php doesn't include this concept natively.
     *
     * @return string
     */
    public function render()
    {
        $return = $this->http_request->getUriForPath('/');

        if (!is_null($this->scheme)) {
            $return = $this->scheme . substr($return, strpos($return, ':'));
        }

        $this->scheme = null;

        return $return;
    }
}
