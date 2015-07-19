# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

#set this on your Windows host file 
ip_address = "10.0.0.101"
host_name = "pinoycubers.dev"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  
  config.vm.define :virtualbox do |v|
    v.vm.box = "ubuntu-14.04-x64"
	v.vm.box_url = "https://cloud-images.ubuntu.com/vagrant/trusty/current/trusty-server-cloudimg-amd64-vagrant-disk1.box"

	v.ssh.forward_agent = true
	
	# This will give the machine a static IP uncomment to enable
    v.vm.network :private_network, ip: ip_address
    v.vm.network :forwarded_port, guest: 80, host: 8081, auto_correct: true
	v.vm.network :forwarded_port, guest: 3306, host: 3308, auto_correct: true
	v.vm.host_name = host_name

	v.vm.provision :shell do |shell|
		shell.path = "bootstrap.sh"
    end
  end
  
  # block for configuring virtualbox
  config.vm.provider :virtualbox do |v|
	v.name = host_name
	v.cpus = 1
	v.memory = 1680
  end
end