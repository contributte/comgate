<?php declare(strict_types = 1);

namespace Contributte\Comgate\Http;

use GuzzleHttp\Psr7\Query;
use Psr\Http\Message\ResponseInterface;

class Response
{

	protected ResponseInterface $origin;

	/** @var mixed[] */
	protected array $parsed = [];

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
		if ($this->parsed === []) {
			$body = $this->origin->getBody();
			$body->rewind();

			$content = $body->getContents();

			$this->parsed = Query::parse($content);
		}

		return $this->parsed;
	}

}
