!/bin/sh -e

#create non-root user
useradd pentest
passwd pentest
echo "pentest  ALL=(ALL:ALL) ALL" >> /etc/sudoers

#autostart configuration
cat head -n -1 /etc/rc.local > /etc/rc.local
echo "service ssh start" >> /etc/rc.local
echo "service postgresql start" >> /etc/rc.local
echo "exit 0" >> /etc/rc.local

#services start
service ssh start
service postgresql start

#metasploit initialization
msfdb init
echo "db_status" > /tmp/msf_config
echo "db_rebuild_cache" >> /tmp/msf_config
msfconsole -r /tmp/msf_config &
sleep 1m
rm /tmp/msf_config

#openvas configuration
#TODO

#create upgrade file
echo "apt-get -y update && apt-get -y upgrade && apt-get -y dist-upgrade && apt-get -y autoremove && apt-get -y autoclean" > update.sh
echo "openvas-scapdata-sync && openvas-nvt-sync" >> update.sh
chmod +x update.sh

#perform upgrade
./update.sh

#toolset import
mkdir /tools
cd /tools
git clone https://github.com/deltaxflux/fluxion.git
