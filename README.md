# 安装

composer install

# 要求

- PHP >= 8.0
- 其他要求
    - Swoole PHP extension >= 4.5，with `swoole.use_shortname` set to `Off` in your `php.ini`
    - Swow PHP extension (Beta)
- JSON PHP extension
- Pcntl PHP extension
- OpenSSL PHP extension （If you need to use the HTTPS）
- PDO PHP extension （If you need to use the MySQL Client）
- Redis PHP extension （If you need to use the Redis Client）
- Protobuf PHP extension （If you need to use the gRPC Server or Client）

# 启动

$ `cd path/to/install`

$ `php bin/hyperf.php start`

# 异常

1.如果无法登录的时候执行以下命令

```bash

# php bin/hyperf.php gen:auth-env

```

