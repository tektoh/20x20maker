#
# Cookbook Name:: php-wrapper
# Recipe:: default
#
# Copyright 2013, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

include_recipe 'php::default'

node['php']['extends']['packages'].each do |pkg|
  package pkg do
    action :install
    notifies :reload, "service[apache2]", :delayed
  end
end
