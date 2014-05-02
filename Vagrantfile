# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "centos64_ja"
  config.vm.box_url = "https://dl.dropboxusercontent.com/u/3657281/centos64_ja.box"
  config.vm.network :private_network, ip: "192.168.33.10"
  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end
  config.vm.synced_folder ".", "/vagrant", \
        create: true, owner: 'vagrant', group: 'vagrant', \
        mount_options: ['dmode=777,fmode=666']

  config.omnibus.chef_version = :latest
  config.vm.provision :chef_solo do |chef|
    chef.cookbooks_path = ["./cookbooks", "./site-cookbooks"]
    chef.run_list = [
      "yum-epel",
      "yum-repoforge",
      "yum-remi",
      "yum-update",
      "devtools",
      "selinux::disabled",
      "iptables::disabled",
      "git",
      "php-wrap",
      "apache2-wrap",
      "composer"
    ]
    chef.json = {
      "yum" => {
        "rpmforge-extras" => {
          "enabled" => false
        }
      },
      "apache" => {
        "log_dir" => "/vagrant/app/tmp/logs",
        "default_site_enabled" => false
      }
    }
  end
  config.vm.provision :shell, :path => "script.sh"
end
