<?php declare(strict_types = 1);

namespace Contributte\Comgate\Http;

use GuzzleHttp\Psr7\Query;
use Psr\Http\Message\ResponseInterface;

class Response
{

	/** @var ResponseInterface */
	protected $origin;

	/** @var mixed[] */
	protected $parsed;

	public function __construct(ResponseInterface $origin)
	{
		$this->origin = $origin;
	}

	public function getOrigin(): ResponseInterface
	{
		return $this->origin;
	}

	public function getStatusCode(): int
	{
		return $this->origin->getStatusCode();
	}

	/**
	 * @return mixed[]
	 */
	public function getData(): array
	{
		return $this->getParsedBody();
	}

	/**
	 * @return mixed[]
	 */
	protected function getParsedBody(): array
	{
		if ($this->parsed === null) {
			$body = $this->origin->getBody();
			$body->rewind();

			$content = $body->getContents();

			$this->parsed = Query::parse($content);
		}

		return $this->parsed;
	}

}
