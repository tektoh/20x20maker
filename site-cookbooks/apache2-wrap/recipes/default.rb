#
# Cookbook Name:: apache2-wrap
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

directory node['apache']['log_dir'] do
  mode '0777'
  recursive true
end

include_recipe 'apache2'
include_recipe 'apache2::mod_ssl'
include_recipe 'apache2::mod_rewrite'
include_recipe 'apache2::mod_deflate'
include_recipe 'apache2::mod_headers'

web_app "20x20maker" do
    server_name node['hostname']
    server_aliases node['fqdn']
    docroot "/vagrant/app/webroot"
    allow_override "All"
end
