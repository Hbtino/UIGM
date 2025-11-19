# 🚀 Deployment & Maintenance Guide

## 📋 Panduan Lengkap Deployment dan Maintenance Sistem

---

## 🎯 Overview

Dokumen ini berisi panduan lengkap untuk:
- Deployment sistem ke production
- Maintenance rutin
- Backup & restore
- Monitoring & troubleshooting
- Security best practices

---

## 🔧 Pre-deployment Checklist

### System Requirements

#### Server Requirements
- **OS:** Linux (Ubuntu 20.04+ recommended) atau Windows Server
- **Web Server:** Apache 2.4+ atau Nginx 1.18+
- **PHP:** 8.1 atau lebih tinggi
- **Database:** MySQL 5.7+ atau MariaDB 10.3+
- **Storage:** Minimum 10GB (recommended 50GB+)
- **RAM:** Minimum 2GB (recommended 4GB+)
- **CPU:** 2 cores minimum

#### PHP Extensions Required
```bash
php -m | grep -E 'intl|mbstring|json|mysqlnd|xml|curl|gd|zip'
```

Required extensions:
- intl
- mbstring
- json
- mysqlnd
- xml
- curl
- gd
- zip

#### Software Requirements
- Composer 2.x
- Git (optional, for version control)
- SSL Certificate (for HTTPS)

---

## 📦 Deployment Steps

### 1. Prepare Server

#### Ubuntu/Linux
```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install Apache
sudo apt install apache2 -y

# Install PHP 8.1
sudo apt install php8.1 php8.1-cli php8.1-fpm php8.1-mysql \
  php8.1-xml php8.1-mbstring php8.1-curl php8.1-gd \
  php8.1-intl php8.1-zip -y

# Install MySQL
sudo apt install mysql-server -y

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### Windows Server
1. Install XAMPP atau WAMP
2. Install Composer dari https://getcomposer.org
3. Pastikan PHP 8.1+ aktif

---

### 2. Upload Project Files

#### Via FTP/SFTP
```bash
# Upload semua files ke server
# Lokasi: /var/www/html/greenmetric (Linux)
# atau C:\xampp\htdocs\greenmetric (Windows)
```

#### Via Git
```bash
cd /var/www/html
git clone https://github.com/your-repo/greenmetric.git
cd greenmetric
```

---

### 3. Install Dependencies

```bash
cd /var/www/html/greenmetric
composer install --no-dev --optimize-autoloader
```

**Note:** `--no-dev` untuk production (tidak install dev dependencies)

---

### 4. Configure Environment

```bash
# Copy environment file
cp env .env

# Edit .env file
nano .env
```

#### Production .env Configuration

```ini
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------
CI_ENVIRONMENT = production

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------
app.baseURL = 'https://greenmetric.polban.ac.id/'
app.indexPage = ''
app.forceGlobalSecureRequests = true

#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------
database.default.hostname = localhost
database.default.database = capaian_kinerja
database.default.username = db_user
database.default.password = strong_password_here
database.default.DBDriver = MySQLi
database.default.DBPrefix = 
database.default.port = 3306

#--------------------------------------------------------------------
# SECURITY
#--------------------------------------------------------------------
encryption.key = your-32-character-encryption-key-here

#--------------------------------------------------------------------
# SESSION
#--------------------------------------------------------------------
session.driver = 'CodeIgniter\Session\Handlers\FileHandler'
session.cookieName = 'ci_session'
session.expiration = 7200
session.savePath = null
session.matchIP = false
session.timeToUpdate = 300
session.regenerateDestroy = false

#--------------------------------------------------------------------
# LOGGER
#--------------------------------------------------------------------
logger.threshold = 4
```

#### Generate Encryption Key
```bash
php spark key:generate
```

---

### 5. Setup Database

```bash
# Login to MySQL
mysql -u root -p

# Create database
CREATE DATABASE capaian_kinerja CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

# Create user
CREATE USER 'db_user'@'localhost' IDENTIFIED BY 'strong_password_here';

# Grant privileges
GRANT ALL PRIVILEGES ON capaian_kinerja.* TO 'db_user'@'localhost';
FLUSH PRIVILEGES;

exit;
```

#### Run Migrations
```bash
php spark migrate
```

#### Create Admin User
```bash
# Via spark command (if available)
php spark db:seed AdminSeeder

# Or via MySQL
mysql -u db_user -p capaian_kinerja

INSERT INTO users (name, email, password, role, approval_status, created_at) 
VALUES (
  'Administrator', 
  'admin@polban.ac.id', 
  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
  'admin', 
  'approved', 
  NOW()
);
```

**Default Password:** `password` (change immediately!)

---

### 6. Set File Permissions

#### Linux
```bash
# Set ownership
sudo chown -R www-data:www-data /var/www/html/greenmetric

# Set directory permissions
sudo find /var/www/html/greenmetric -type d -exec chmod 755 {} \;

# Set file permissions
sudo find /var/www/html/greenmetric -type f -exec chmod 644 {} \;

# Writable directories
sudo chmod -R 775 /var/www/html/greenmetric/writable
sudo chmod -R 775 /var/www/html/greenmetric/public/uploads
```

#### Windows
```
Right-click folder → Properties → Security
Give IUSR and IIS_IUSRS full control on:
- writable/
- public/uploads/
```

---

### 7. Configure Web Server

#### Apache Configuration

Create VirtualHost:
```bash
sudo nano /etc/apache2/sites-available/greenmetric.conf
```

```apache
<VirtualHost *:80>
    ServerName greenmetric.polban.ac.id
    ServerAdmin admin@polban.ac.id
    DocumentRoot /var/www/html/greenmetric/public

    <Directory /var/www/html/greenmetric/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/greenmetric-error.log
    CustomLog ${APACHE_LOG_DIR}/greenmetric-access.log combined
</VirtualHost>
```

Enable site and modules:
```bash
sudo a2ensite greenmetric.conf
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### Nginx Configuration

```bash
sudo nano /etc/nginx/sites-available/greenmetric
```

```nginx
server {
    listen 80;
    server_name greenmetric.polban.ac.id;
    root /var/www/html/greenmetric/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

Enable site:
```bash
sudo ln -s /etc/nginx/sites-available/greenmetric /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

---

### 8. Setup SSL Certificate

#### Using Let's Encrypt (Free)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-apache -y

# Get certificate
sudo certbot --apache -d greenmetric.polban.ac.id

# Auto-renewal
sudo certbot renew --dry-run
```

#### Manual SSL Certificate

```apache
<VirtualHost *:443>
    ServerName greenmetric.polban.ac.id
    DocumentRoot /var/www/html/greenmetric/public

    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
    SSLCertificateChainFile /path/to/ca_bundle.crt

    # ... rest of configuration
</VirtualHost>
```

---

### 9. Test Deployment

#### Checklist
- [ ] Website accessible via browser
- [ ] HTTPS working (green padlock)
- [ ] Login page loads
- [ ] Can login with admin account
- [ ] Dashboard loads correctly
- [ ] Can create test data
- [ ] File upload works
- [ ] Database connection OK
- [ ] No errors in logs

#### Test URLs
```
https://greenmetric.polban.ac.id/
https://greenmetric.polban.ac.id/login
https://greenmetric.polban.ac.id/dashboard
https://greenmetric.polban.ac.id/transportation
```

---

## 🔄 Maintenance Tasks

### Daily Tasks

#### 1. Check System Health
```bash
# Check disk space
df -h

# Check memory usage
free -m

# Check Apache/Nginx status
sudo systemctl status apache2
# or
sudo systemctl status nginx

# Check MySQL status
sudo systemctl status mysql
```

#### 2. Monitor Error Logs
```bash
# Application logs
tail -f /var/www/html/greenmetric/writable/logs/log-*.php

# Apache logs
tail -f /var/log/apache2/greenmetric-error.log

# MySQL logs
tail -f /var/log/mysql/error.log
```

#### 3. Backup Database
```bash
# Daily backup script
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backups/database"
DB_NAME="capaian_kinerja"
DB_USER="db_user"
DB_PASS="password"

mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_DIR/backup_$DATE.sql.gz

# Keep only last 7 days
find $BACKUP_DIR -name "backup_*.sql.gz" -mtime +7 -delete
```

Save as `/usr/local/bin/backup-db.sh` and add to crontab:
```bash
chmod +x /usr/local/bin/backup-db.sh
crontab -e

# Add line:
0 2 * * * /usr/local/bin/backup-db.sh
```

---

### Weekly Tasks

#### 1. Update System
```bash
sudo apt update
sudo apt upgrade -y
```

#### 2. Optimize Database
```bash
mysql -u root -p

USE capaian_kinerja;
OPTIMIZE TABLE transportation, setting_infrastructure, 
  energy_climate, water_management, waste_management, education_research;
ANALYZE TABLE transportation, setting_infrastructure;
```

#### 3. Clean Old Files
```bash
# Clean old logs (older than 30 days)
find /var/www/html/greenmetric/writable/logs -name "log-*.php" -mtime +30 -delete

# Clean old sessions
find /var/www/html/greenmetric/writable/session -mtime +7 -delete

# Clean temp files
find /tmp -name "ci_session*" -mtime +7 -delete
```

#### 4. Review User Activities
```sql
-- Check recent activities
SELECT u.name, a.action, a.created_at 
FROM activities a
JOIN users u ON a.user_id = u.id
WHERE a.created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
ORDER BY a.created_at DESC
LIMIT 100;
```

---

### Monthly Tasks

#### 1. Security Audit
```bash
# Check for security updates
sudo apt list --upgradable

# Review user accounts
mysql -u root -p -e "SELECT id, name, email, role, approval_status FROM capaian_kinerja.users;"

# Check file permissions
find /var/www/html/greenmetric -type f -perm 777
find /var/www/html/greenmetric -type d -perm 777
```

#### 2. Performance Review
```sql
-- Check database size
SELECT 
  table_name AS 'Table',
  ROUND(((data_length + index_length) / 1024 / 1024), 2) AS 'Size (MB)'
FROM information_schema.TABLES
WHERE table_schema = 'capaian_kinerja'
ORDER BY (data_length + index_length) DESC;

-- Check slow queries
SHOW VARIABLES LIKE 'slow_query_log';
```

#### 3. Backup Verification
```bash
# Test restore from backup
gunzip < /backups/database/backup_latest.sql.gz | mysql -u root -p test_restore_db
```

#### 4. Update Documentation
- Review and update system documentation
- Document any configuration changes
- Update user guides if needed

---

## 💾 Backup & Restore

### Full Backup Strategy

#### 1. Database Backup
```bash
# Full backup
mysqldump -u root -p --single-transaction --routines --triggers \
  capaian_kinerja > backup_full_$(date +%Y%m%d).sql

# Compressed backup
mysqldump -u root -p capaian_kinerja | gzip > backup_$(date +%Y%m%d).sql.gz
```

#### 2. Files Backup
```bash
# Backup uploaded files
tar -czf uploads_backup_$(date +%Y%m%d).tar.gz \
  /var/www/html/greenmetric/writable/uploads/

# Backup entire application
tar -czf app_backup_$(date +%Y%m%d).tar.gz \
  --exclude='writable/logs' \
  --exclude='writable/cache' \
  /var/www/html/greenmetric/
```

#### 3. Configuration Backup
```bash
# Backup .env and configs
cp /var/www/html/greenmetric/.env /backups/config/env_$(date +%Y%m%d)
cp /etc/apache2/sites-available/greenmetric.conf /backups/config/
```

### Automated Backup Script

```bash
#!/bin/bash
# /usr/local/bin/full-backup.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_ROOT="/backups"
APP_DIR="/var/www/html/greenmetric"
DB_NAME="capaian_kinerja"
DB_USER="db_user"
DB_PASS="password"

# Create backup directory
mkdir -p $BACKUP_ROOT/$DATE

# Database backup
echo "Backing up database..."
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_ROOT/$DATE/database.sql.gz

# Files backup
echo "Backing up files..."
tar -czf $BACKUP_ROOT/$DATE/uploads.tar.gz $APP_DIR/writable/uploads/

# Config backup
echo "Backing up config..."
cp $APP_DIR/.env $BACKUP_ROOT/$DATE/

# Create checksum
cd $BACKUP_ROOT/$DATE
sha256sum * > checksums.txt

echo "Backup completed: $BACKUP_ROOT/$DATE"

# Clean old backups (keep 30 days)
find $BACKUP_ROOT -maxdepth 1 -type d -mtime +30 -exec rm -rf {} \;
```

### Restore Procedures

#### Restore Database
```bash
# Decompress and restore
gunzip < backup_20251114.sql.gz | mysql -u root -p capaian_kinerja

# Or from uncompressed
mysql -u root -p capaian_kinerja < backup_20251114.sql
```

#### Restore Files
```bash
# Restore uploads
tar -xzf uploads_backup_20251114.tar.gz -C /

# Restore application
tar -xzf app_backup_20251114.tar.gz -C /var/www/html/
```

#### Verify Restore
```bash
# Check database
mysql -u root -p -e "USE capaian_kinerja; SHOW TABLES;"

# Check files
ls -la /var/www/html/greenmetric/writable/uploads/

# Test application
curl -I https://greenmetric.polban.ac.id/
```

---

## 📊 Monitoring

### System Monitoring

#### CPU & Memory
```bash
# Install htop
sudo apt install htop -y

# Monitor
htop

# Or use top
top
```

#### Disk Usage
```bash
# Check disk space
df -h

# Check directory sizes
du -sh /var/www/html/greenmetric/*

# Find large files
find /var/www/html/greenmetric -type f -size +10M -exec ls -lh {} \;
```

#### Network
```bash
# Check connections
netstat -tuln | grep :80
netstat -tuln | grep :443

# Monitor bandwidth
sudo apt install iftop -y
sudo iftop
```

### Application Monitoring

#### Error Logs
```bash
# Real-time monitoring
tail -f /var/www/html/greenmetric/writable/logs/log-$(date +%Y-%m-%d).php

# Search for errors
grep -i "error" /var/www/html/greenmetric/writable/logs/log-*.php

# Count errors
grep -c "ERROR" /var/www/html/greenmetric/writable/logs/log-*.php
```

#### Database Monitoring
```sql
-- Active connections
SHOW PROCESSLIST;

-- Database size
SELECT 
  SUM(data_length + index_length) / 1024 / 1024 AS 'Size (MB)'
FROM information_schema.TABLES
WHERE table_schema = 'capaian_kinerja';

-- Table statistics
SHOW TABLE STATUS FROM capaian_kinerja;
```

### Performance Monitoring

#### Apache Performance
```bash
# Enable status module
sudo a2enmod status

# Check status
curl http://localhost/server-status
```

#### MySQL Performance
```sql
-- Show variables
SHOW VARIABLES LIKE '%cache%';
SHOW VARIABLES LIKE '%buffer%';

-- Show status
SHOW STATUS LIKE '%thread%';
SHOW STATUS LIKE '%connection%';
```

---

## 🔐 Security Best Practices

### 1. Regular Updates
```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Update Composer dependencies
cd /var/www/html/greenmetric
composer update
```

### 2. Strong Passwords
- Use strong passwords (min 12 characters)
- Mix uppercase, lowercase, numbers, symbols
- Change default passwords immediately
- Use password manager

### 3. File Permissions
```bash
# Correct permissions
sudo chown -R www-data:www-data /var/www/html/greenmetric
sudo find /var/www/html/greenmetric -type d -exec chmod 755 {} \;
sudo find /var/www/html/greenmetric -type f -exec chmod 644 {} \;
sudo chmod -R 775 /var/www/html/greenmetric/writable
```

### 4. Firewall Configuration
```bash
# Install UFW
sudo apt install ufw -y

# Configure firewall
sudo ufw default deny incoming
sudo ufw default allow outgoing
sudo ufw allow ssh
sudo ufw allow http
sudo ufw allow https
sudo ufw enable
```

### 5. Disable Directory Listing
```apache
# In Apache config
Options -Indexes
```

### 6. Hide PHP Version
```ini
# In php.ini
expose_php = Off
```

### 7. Secure MySQL
```bash
sudo mysql_secure_installation
```

### 8. Regular Security Audits
```bash
# Check for rootkits
sudo apt install rkhunter -y
sudo rkhunter --check

# Check for malware
sudo apt install clamav -y
sudo freshclam
sudo clamscan -r /var/www/html/greenmetric
```

---

## 🚨 Troubleshooting

### Common Issues

#### 1. 500 Internal Server Error
```bash
# Check Apache error log
tail -f /var/log/apache2/greenmetric-error.log

# Check PHP error log
tail -f /var/log/php8.1-fpm.log

# Check application log
tail -f /var/www/html/greenmetric/writable/logs/log-*.php

# Common causes:
# - Wrong file permissions
# - PHP syntax error
# - Missing .htaccess
# - Incorrect .env configuration
```

#### 2. Database Connection Error
```bash
# Test MySQL connection
mysql -u db_user -p capaian_kinerja

# Check MySQL status
sudo systemctl status mysql

# Check .env configuration
cat /var/www/html/greenmetric/.env | grep database

# Restart MySQL
sudo systemctl restart mysql
```

#### 3. File Upload Fails
```bash
# Check upload directory permissions
ls -la /var/www/html/greenmetric/writable/uploads/

# Check PHP upload settings
php -i | grep upload

# Increase limits in php.ini
upload_max_filesize = 10M
post_max_size = 10M
```

#### 4. Slow Performance
```bash
# Enable PHP OPcache
# In php.ini:
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000

# Restart PHP-FPM
sudo systemctl restart php8.1-fpm

# Optimize MySQL
mysql -u root -p
OPTIMIZE TABLE transportation;
```

---

## 📞 Support & Escalation

### Level 1: Self-service
- Check documentation
- Review error logs
- Search online resources

### Level 2: Team Support
- Contact: support@polban.ac.id
- Response time: 1-2 business days

### Level 3: Emergency
- Contact: admin@polban.ac.id
- Phone: +62-22-1234567
- Response time: 4 hours

---

**Last Updated:** 2025-11-14  
**Version:** 1.0.0
