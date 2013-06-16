<?php

namespace DbEtreeOrg\View\Strategy;

use BjyAuthorize\View\RedirectionStrategy;

use BjyAuthorize\Exception\UnAuthorizedException;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Http\Response;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use BjyAuthorize\Guard\Route;
use BjyAuthorize\Guard\Controller;

/**
 * Use with
     'bjyauthorize' => array(
        'unauthorized_strategy' => 'AppleConnect\View\Strategy\Redirection',
 */
class Redirection extends RedirectionStrategy
{
    protected $redirectRoute = 'zfcuser/login';

    /**
     * Handles redirects in case of dispatch errors caused by unauthorized access
     *
     * @param \Zend\Mvc\MvcEvent $event
     */
    public function onDispatchError(MvcEvent $event)
    {
        // Do nothing if the result is a response object
        $result     = $event->getResult();
        $routeMatch = $event->getRouteMatch();
        $response   = $event->getResponse();
        $router     = $event->getRouter();
        $error      = $event->getError();
        $url        = $this->redirectUri;

        if (
            $result instanceof Response
            || ! $routeMatch
            || ($response && ! $response instanceof Response)
            || ! (
                Route::ERROR === $error
                || Controller::ERROR === $error
                || (
                    Application::ERROR_EXCEPTION === $error
                    && ($event->getParam('exception') instanceof UnAuthorizedException)
                )
            )
        ) {
            return;
        }

        $url = $router->assemble(array(), array('name' => $this->redirectRoute));

        $response = $response ?: new Response();

        $response->getHeaders()->addHeaderLine('Location', $url);
        $response->setStatusCode(302);

        $event->setResponse($response);
    }
}
