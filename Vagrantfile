VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
	config.vm.box = "ubuntu/xenial64"
	config.vm.network "forwarded_port", guest: 80, host: 80
	config.vm.network "forwarded_port", guest: 27017, host: 27017
	config.vm.provision "shell", path: "provisioner.sh"
end
