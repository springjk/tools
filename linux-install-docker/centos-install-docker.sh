# 安装 Docker
curl -sSL https://get.daocloud.io/docker | sh

# 安装 Docker Compose
curl -L https://get.daocloud.io/docker/compose/releases/download/1.9.0/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose

# 设置加速器
curl -sSL https://get.daocloud.io/daotools/set_mirror.sh | sh -s http://hub-mirror.c.163.com

# 设置开启启动并重启
systemctl enable docker.service
sudo systemctl restart docker

# 设置 CHINA 源
wget -O /etc/yum.repos.d/CentOS-Base.repo http://mirrors.aliyun.com/repo/Centos-7.repo

yum makecache

# 安装工具
yum install -y git vim wget curl
