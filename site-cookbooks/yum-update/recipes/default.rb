#
# Cookbook Name:: yum-update
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

package "yum-fastestmirror"

execute "yum-update" do
  user "root"
  command "yum -y update"
  action :run
end