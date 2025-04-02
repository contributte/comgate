<?php declare(strict_types = 1);

namespace Contributte\Comgate\DI;

use Contributte\Comgate\Comgate;
use Contributte\Comgate\Gateway\PaymentService;
use Contributte\Comgate\Http\HttpClient;
use GuzzleHttp\Client;
use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\Statement;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use stdClass;

/**
 * @property-read stdClass $config
 */
class ComgateExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'gateway' => Expect::string()->default('https://payments.comgate.cz/v1.0/'),
			'merchant' => Expect::string()->dynamic()->required(),
			'secret' => Expect::string()->dynamic()->required(),
			'test' => Expect::bool()->default(true),
		]);
	}

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('comgate'))
			->setFactory(Comgate::class, [
				$this->config->merchant,
				$this->config->secret,
				$this->config->test,
			])->setAutowired(false);

		$builder->addDefinition($this->prefix('http.client'))
			->setFactory(HttpClient::class, [
				new Statement(Client::class, [
					[
						'base_uri' => $this->config->gateway,
					],
				]),
				$this->prefix('@comgate'),
			]);

		$builder->addDefinition($this->prefix('gateway.payment'))
			->setFactory(PaymentService::class, [
				$this->prefix('@http.client'),
			]);
	}

}
