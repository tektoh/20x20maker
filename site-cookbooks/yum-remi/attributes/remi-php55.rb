default['yum']['remi-php55']['repositoryid'] = 'remi-php55'

default['yum']['remi-php55']['description'] = 'Les RPM de remi-php-55 pour Enterprise Linux 6 - $basearch'
default['yum']['remi-php55']['mirrorlist'] = 'http://rpms.famillecollet.com/enterprise/6/php55/mirror'
default['yum']['remi-php55']['gpgkey'] = 'http://rpms.famillecollet.com/RPM-GPG-KEY-remi'
default['yum']['remi-php55']['failovermethod'] = 'priority'
default['yum']['remi-php55']['enabled'] = true
default['yum']['remi-php55']['gpgcheck'] = true