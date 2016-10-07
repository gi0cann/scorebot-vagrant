# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
  config.vm.provider "virtualbox" do |vb|
    vb.name = "scorebot-dev"
  end
  config.vm.box = "ubuntu/trusty64"
  config.vm.synced_folder "dev/", "/home/vagrant/dev"
  config.vm.provision "shell", path: "scorebot-setup.sh"
  config.vm.network "forwarded_port", guest: 80, host: 8888
  config.vm.network "forwarded_port", guest: 50007, host: 50007
  config.vm.network "forwarded_port", guest: 8090, host: 8090
  config.vm.network "forwarded_port", guest: 8080, host: 8091
end
