<?php

namespace Acquia\Cohesion\Api;

use GuzzleHttp\Client as HttpClient;

/**
 * The Cohesion API HTTP client.
 */
class Client extends HttpClient
{

    /**
     * Client constructor.
     *
     * @param array $config
     *   Client configuration settings.
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * Returns all keys.
     *
     * @return array
     *   Array of the keys.
     *
     * @throws \InvalidArgumentException
     *   Thrown when the request method is invalid.
     * @throws \GuzzleHttp\Exception\GuzzleException
     *   A Guzzle exception.
     */
    public function getKeys()
    {

        return $this->executeRequest('GET', 'keys');

    }

    /**
     * Helper method to execute a HTTP request, returning the output as an
     * object.
     *
     * Sub-classing clients should use this to standardize error handling and
     * responses.
     *
     * For valid options to pass to the request, see the
     * GuzzleHttp\Client::applyOptions() method.
     *
     * @see https://github.com/guzzle/guzzle/blob/6.0.1/src/Client.php#L280
     *
     * @param string $method
     *   The HTTP method to use.
     * @param string $path
     *   The path to call.
     * @param array $options
     *   An associative array of request options.
     *
     * @return string|array
     *   The body content.
     *
     * @throws \InvalidArgumentException
     *   Thrown when the request method is invalid.
     * @throws \GuzzleHttp\Exception\GuzzleException
     *   A Guzzle exception.
     */
    protected function executeRequest($method, $path, array $options = [])
    {

        $uri = 'api/' . $path;
        $response = parent::request($method, $uri, $options);
        $content_type = $response->getHeaderLine('Content-Type');
        $is_json = preg_match('/^application\/(?:(?:.+)\+){0,1}json$/i', $content_type) != false;
        $body = (string) $response->getBody();
        $content = $is_json ? json_decode($body, true) : $body;

        return $content;

    }
}
