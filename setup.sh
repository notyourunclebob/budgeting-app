#!/bin/bash

# Ask for the username
read -p "Enter the username to use for the setup: " USERNAME

# Update package list
sudo apt update

# Install Nginx
sudo apt install -y nginx

# Install MySQL
sudo apt install -y mysql-server
#sudo mysql_secure_installation

# Configure MySQL root user
sudo mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'secret';"
sudo mysql -e "FLUSH PRIVILEGES;"

# Install PHP and Composer
sudo add-apt-repository -y ppa:ondrej/php
sudo apt update
sudo apt install -y php8.4-fpm php8.4-mysql php8.4-mbstring php8.4-xml php8.4-bcmath
sudo apt install -y composer

# Update default server block
NGINX_CONF="/etc/nginx/sites-available/default"
sudo bash -c "cat > $NGINX_CONF" <<EOL
server {
    listen 80 default_server;
    listen [::]:80 default_server;
    server_name _;
    root /var/www/html/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ ^/index\.php(/|\$) {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOL

# Add symlink to sites-enabled
sudo ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/

# Test and reload Nginx
sudo nginx -t && sudo systemctl reload nginx

# Generate SSH deployment key
sudo ssh-keygen -t ed25519 -N "" -f /home/$USERNAME/.ssh/id_ed25519 <<< y
sudo chown -R $USERNAME:$USERNAME /home/$USERNAME/.ssh
echo -e "\e[32mSSH deploy key generated successfully!\e[0m"
echo "******Here is the public key:*****"
sudo cat /home/$USERNAME/.ssh/id_ed25519.pub
echo "*****End of public key*****"

# Instructions to add the key to the repository
echo "Copy the above deploy key and add it to your repository's deployment keys."

# Pause and ask for confirmation
read -p "Have you added the deploy key to your repository's deployment keys? (y/n) " confirm
while [[ $confirm != "y" ]]; do
    echo "Please add the deploy key to your repository's deployment keys."
    read -p "Have you added the deploy key to your repository's deployment keys? (y/n) " confirm
done

# Update permissions and remove default Nginx page
cd /var/www
sudo chown -R $USERNAME:$USERNAME html
cd html
sudo rm index.nginx-debian.html

# Ask for the repository ssh url
read -p "Enter your repository ssh url: " REPO_URL

# Deploy the application
sudo -u $USERNAME git clone ${REPO_URL} .

# Update permissions
sudo chown -R $USERNAME:$USERNAME /var/www/html
sudo chown -R $USERNAME:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Create and update .env file
sudo cp .env.example .env
sudo chown $USERNAME:$USERNAME .env
sed -i 's/^#\?DB_CONNECTION=.*/DB_CONNECTION=mysql/' .env
sed -i 's/^# DB_HOST=.*/DB_HOST=127.0.0.1/' .env
sed -i 's/^# DB_PORT=.*/DB_PORT=3306/' .env
sed -i 's/^# DB_DATABASE=.*/DB_DATABASE=laravel/' .env
sed -i 's/^# DB_USERNAME=.*/DB_USERNAME=root/' .env
sed -i 's/^# DB_PASSWORD=.*/DB_PASSWORD=secret/' .env

# Install dependencies and generate key
sudo -u $USERNAME composer install --no-dev --optimize-autoloader --no-interaction
sudo -u $USERNAME php artisan key:generate

# Migrate db
sudo -u $USERNAME php artisan migrate --force

echo -e "\e[32mLaravel application deployed successfully!\e[0m"

# generate actions SSH_PRIVATE_KEY
echo "Generate SSH_PRIVATE_KEY for Github Actions"
sudo ssh-keygen -t ed25519 -N "" -f /home/$USERNAME/.ssh/id_ed25519_actions <<< y
sudo chown -R $USERNAME:$USERNAME /home/$USERNAME/.ssh
# pipe contents of public key into the authorized_keys file
sudo cat /home/$USERNAME/.ssh/id_ed25519_actions.pub >> /home/$USERNAME/.ssh/authorized_keys
echo -e "\e[32mSSH_PRIVATE_KEY generated successfully!\e[0m"
echo "******Here is the private key:*****"
sudo cat /home/$USERNAME/.ssh/id_ed25519_actions
echo "*****End of private key*****"
echo "Copy the above private key and add it to your Github repository's secrets. Name the secret SSH_PRIVATE_KEY"

# Script completed
echo -e "\e[32mSetup completed successfully!\e[0m"