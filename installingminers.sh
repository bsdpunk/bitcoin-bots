cd ~
mkdir Build
cd Build
git clone https://github.com/ckolivas/cgminer.git
cd cgminer
./autogen.sh
./configure --enable-scrypt
sudo make install
