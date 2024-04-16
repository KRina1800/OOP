<?php
```java
// Интерфейс для объекта конфигурации
public interface WebAppConfigurationBuilder {
    void setAppName(String appName);

    void setPort(int port);

    void setMaxConnections(int maxConnections);

    void setDatabaseConfiguration(DatabaseConfiguration databaseConfiguration);

    WebAppConfiguration build();
}

// Класс для объекта конфигурации
public class WebAppConfiguration {
    private String appName;
    private int port;
    private int maxConnections;
    private DatabaseConfiguration databaseConfiguration;

    public WebAppConfiguration(String appName, int port, int maxConnections, DatabaseConfiguration databaseConfiguration) {
        this.appName = appName;
        this.port = port;
        this.maxConnections = maxConnections;
        this.databaseConfiguration = databaseConfiguration;
    }

    // методы для получения значений свойств
}

// Интерфейс для объекта конфигурации базы данных
public interface DatabaseConfigurationBuilder {
    void setDatabaseName(String databaseName);

    void setServer(String server);

    void setPort(int port);

    void setUsername(String username);

    void setPassword(String password);

    DatabaseConfiguration build();
}

// Класс для объекта конфигурации базы данных
public class DatabaseConfiguration {
    private String databaseName;
    private String server;
    private int port;
    private String username;
    private String password;

    public DatabaseConfiguration(String databaseName, String server, int port, String username, String password) {
        this.databaseName = databaseName;
        this.server = server;
        this.port = port;
        this.username = username;
        this.password = password;
    }

    // методы для получения значений свойств
}

// Класс для построения объекта конфигурации веб-приложения
public class WebAppConfigurationBuilderImpl implements WebAppConfigurationBuilder {
    private String appName;
    private int port;
    private int maxConnections;
    private DatabaseConfiguration databaseConfiguration;

    @Override
    public void setAppName(String appName) {
        this.appName = appName;
    }

    @Override
    public void setPort(int port) {
        this.port = port;
    }

    @Override
    public void setMaxConnections(int maxConnections) {
        this.maxConnections = maxConnections;
    }

    @Override
    public void setDatabaseConfiguration(DatabaseConfiguration databaseConfiguration) {
        this.databaseConfiguration = databaseConfiguration;
    }

    @Override
    public WebAppConfiguration build() {
        return new WebAppConfiguration(appName, port, maxConnections, databaseConfiguration);
    }
}

// Класс для построения объекта конфигурации базы данных
public class DatabaseConfigurationBuilderImpl implements DatabaseConfigurationBuilder {
    private String databaseName;
    private String server;
    private int port;
    private String username;
    private String password;

    @Override
    public void setDatabaseName(String databaseName) {
        this.databaseName = databaseName;
    }

    @Override
    public void setServer(String server) {
        this.server = server;
    }

    @Override
    public void setPort(int port) {
        this.port = port;
    }

    @Override
    public void setUsername(String username) {
        this.username = username;
    }

    @Override
    public void setPassword(String password) {
        this.password = password;
    }

    @Override
    public DatabaseConfiguration build() {
        return new DatabaseConfiguration(databaseName, server, port, username, password);
    }
}
```