<?php declare(strict_types = 1);

namespace Contributte\Comgate\Http;

use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\parse_query;

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

	public function isOk(): bool
	{
		return ($this->getParsedBody()['code'] ?? -1) === '0';
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

			$this->parsed = parse_query($content);
		}

		return $this->parsed;
	}

}
