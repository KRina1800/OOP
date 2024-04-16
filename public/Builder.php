<?php
interface IAppConfigBuilder
{
    public function setEnvironment(string $environment): IAppConfigBuilder;
    public function setDatabaseConfig(array $databaseConfig): IAppConfigBuilder;
    public function setCacheEnabled(bool $cacheEnabled): IAppConfigBuilder;
    public function build(): IAppConfig;
}
class WebAppConfigBuilder implements IAppConfigBuilder
{
    private string $environment;
    private array $databaseConfig;
    private bool $cacheEnabled;

    public function setEnvironment(string $environment): IAppConfigBuilder
    {
        $this->environment = $environment;
        return $this;
    }

    public function setDatabaseConfig(array $databaseConfig): IAppConfigBuilder
    {
        $this->databaseConfig = $databaseConfig;
        return $this;
    }

    public function setCacheEnabled(bool $cacheEnabled): IAppConfigBuilder
    {
        $this->cacheEnabled = $cacheEnabled;
        return $this;
    }

    public function build(): IAppConfig
    {
        return new WebAppConfig(
            $this->environment,
            $this->databaseConfig,
            $this->cacheEnabled
        );
    }
}
interface IAppConfig
{
    public function configInfo(): string;
}
class WebAppConfig implements IAppConfig
{
    private string $environment;
    private array $databaseConfig;
    private bool $cacheEnabled;

    public function __construct(string $environment, array $databaseConfig, bool $cacheEnabled)
    {
        $this->environment = $environment;
        $this->databaseConfig = $databaseConfig;
        $this->cacheEnabled = $cacheEnabled;
    }

    public function configInfo(): string
    {
        return json_encode([
            'environment' => $this->environment,
            'databaseConfig' => $this->databaseConfig,
            'cacheEnabled' => $this->cacheEnabled
        ]);
    }
}

$configBuilder = new WebAppConfigBuilder();
$webAppConfig = $configBuilder
    ->setEnvironment('production')
    ->setDatabaseConfig(['host' => 'localhost', 'username' => 'root', 'password' => 'secret'])
    ->setCacheEnabled(true)
    ->build();
print_r($webAppConfig->configInfo());
