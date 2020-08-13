<?php

namespace Acquia\c\Api;

/**
 * A base class for client factories.
 */
abstract class AbstractClientFactory
{

    /**
     * The Cohesion API base URI.
     */
    public const BASE_URI = 'http://localhost';

    /**
     * Defines the default timeout for HTTP operations, in seconds.
     *
     * @var int
     */
    public const DEFAULT_TIMEOUT = 120;

    /**
     * Returns the default Guzzle client configuration options.
     *
     * @return array
     */
    public static function getClientDefaults()
    {
        return [
            'base_uri' => static::BASE_URI,
            'connect_timeout' => static::DEFAULT_TIMEOUT,
            'timeout' => static::DEFAULT_TIMEOUT,
            'read_timeout' => static::DEFAULT_TIMEOUT,
        ];
    }
}
