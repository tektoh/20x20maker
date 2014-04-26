#
# Cookbook Name:: centos-devtools
# Recipe:: default
#
# Copyright 2013, Shinichi Segawa
#

execute "devtools" do
  user "root"
  command 'yum -y groupinstall "Development Tools"'
  action :run
end

node['devtools']['packages'].each do |pkg|
  package pkg
end