<?php declare(strict_types = 1);

namespace Contributte\Comgate\Http;

use Contributte\Comgate\Comgate;
use GuzzleHttp\ClientInterface;

class HttpClient
{

	/** @var ClientInterface */
	protected $client;

	/** @var Comgate */
	protected $comgate;

	public function __construct(ClientInterface $client, Comgate $comgate)
	{
		$this->client = $client;
		$this->comgate = $comgate;
	}

	/**
	 * @param mixed[] $query
	 * @param mixed[] $options
	 */
	public function get(string $uri, array $query, array $options = []): Response
	{
		$query = array_merge([
			'merchant' => $this->comgate->getMerchant(),
			'secret' => $this->comgate->getSecret(),
			'test' => $this->comgate->isTest() ? 'true' : 'false',
		], $query);

		$options = array_merge($options, [
			'query' => $query,
		]);

		$res = $this->client->request('GET', $uri, $options);

		return new Response($res);
	}

	/**
	 * @param mixed[] $data
	 * @param mixed[] $options
	 */
	public function post(string $uri, array $data, array $options = []): Response
	{
		$data = array_merge([
			'merchant' => $this->comgate->getMerchant(),
			'secret' => $this->comgate->getSecret(),
			'test' => $this->comgate->isTest() ? 'true' : 'false',
		], $data);

		$options = array_merge($options, [
			'form_params' => $data,
		]);

		$res = $this->client->request('POST', $uri, $options);

		return new Response($res);
	}

}
