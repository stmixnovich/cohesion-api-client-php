<?php

namespace Acquia\c\Api;

use Acquia\Cohesion\Api\Middleware\GuzzleAuthUserTokenMiddleware;
use GuzzleHttp\HandlerStack;

/**
 * A factory for creating Cohesion API clients using user token grants.
 */
class AuthUserTokenClientFactory extends AbstractClientFactory
{

    /**
     * Create an instance of a Cohesion API client using user tokens credentials flow.
     *
     * @param string $user
     *   The auth user.
     * @param string $token
     *   The user access token.
     * @param array $config
     *   An associative array of configuration values for a Guzzle client.
     *
     * @return Client
     *   The configured Cohesion API client.
     */
    public static function createUsingUserToken($user, $token, array $config = [])
    {

        $middleware = new GuzzleAuthUserTokenMiddleware($user, $token);
        $stack      = HandlerStack::create();
        $stack->push($middleware);

        $config['handler'] = $stack;
        $config            = $config + static::getClientDefaults();

        return new Client($config);
    }
}
