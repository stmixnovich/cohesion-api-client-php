<?php

namespace Acquia\Cohesion\Api\Middleware;

use Psr\Http\Message\RequestInterface;

/**
 * A Guzzle middleware that obtains a X-AUTH-USER and X-AUTH-TOKEN and adds it
 * to the authorization header.
 */
class GuzzleAuthUserTokenMiddleware
{

    /**
     * The auth user.
     *
     * @var string|null
     */
    protected $AuthUser = null;


    /**
     * The user access token.
     *
     * @var string|null
     */
    protected $AuthToken = null;


    /**
     * Constructor.
     *
     * @param string $user
     *   The auth user.
     * @param string $token
     *   The user access token.
     */
    public function __construct($user, $token)
    {
        $this->AuthUser = $user;
        $this->AuthToken = $token;
    }

    /**
     * Called when the middleware is handled.
     *
     * @param callable $handler
     *   An handler that will be called.
     *
     * @return \Closure
     */
    public function __invoke(callable $handler)
    {

        return function ($request, array $options) use ($handler) {
            if ($this->AuthUser) {
                $request = $this->addAuthorizationHeaders($request, 'X-AUTH-USER', $this->AuthUser);
            }

            if ($this->AuthToken) {
              $request = $this->addAuthorizationHeaders($request, 'X-AUTH-TOKEN', $this->AuthToken);
            }

            return $handler($request, $options);
        };
    }

    /**
     * Adds the authorization headers to the request.
     *
     * @param RequestInterface $request
     *   The request being signed.
     * @param string $header
     *   The header name.
     * @param string $value
     *   The header value.
     *
     * @return RequestInterface
     *   The request with the added Authorization params.
     */
    protected function addAuthorizationHeaders(RequestInterface $request, $header, $value)
    {
        return $request->withHeader($header, $value);
    }
}
