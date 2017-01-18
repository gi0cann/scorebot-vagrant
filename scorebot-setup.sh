debconf-set-selections <<< 'mysql-server mysql-server/root_password password abcd1234'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password abcd1234'

apt-get update
apt-get upgrade -y
apt-get install -y python-dnspython python-rrdtool apache2 php5 php5-mysql python-pymongo python-dns python-mysqldb wget curl git mongodb mysql-server mysql-client python-pip
pip install jaraco.modb bottle paste requests

cp -rf /home/vagrant/dev/sts/ /var/www/html

git clone https://github.com/dichotomy/scorebot /home/vagrant/dev/scorebot

mysql -u root -pabcd1234 < /home/vagrant/dev/db.sql
mysql -u scorebot -ppassword sts < /home/vagrant/dev/sts/config/sts.sql

service apache2 restart
