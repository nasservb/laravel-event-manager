[Unit]
Description=Made in Iran Queue Worker Service
Requires=php-fpm.service redis.service
After=php-fpm.service redis.service

[Service]
User=root
Type=simple
TimeoutSec=0
PIDFile=/var/run/mix_worker_php.pid
ExecStart=/bin/sh -c '/usr/bin/php -f /var/www/html/mix/artisan  queue:work  2>&1 > /var/log/mix_worker.log'
KillMode=mixed

Restart=on-failure
RestartSec=22s

[Install]
WantedBy=default.target
