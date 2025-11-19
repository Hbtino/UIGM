# Deployment Checklist - Transportation CRUD System

## 📋 Pre-Deployment Checklist

### 1. Code Review
- [ ] All files committed to version control
- [ ] No debug code or console.log statements
- [ ] No hardcoded credentials
- [ ] Code follows coding standards
- [ ] Comments are clear and helpful

### 2. Database
- [ ] Migration files tested
- [ ] Database backup created
- [ ] Migration rollback tested
- [ ] Indexes created for performance
- [ ] Foreign keys properly set

### 3. Security
- [ ] CSRF protection enabled
- [ ] XSS prevention implemented
- [ ] SQL injection prevention verified
- [ ] File upload validation working
- [ ] Role-based access control tested
- [ ] Session security configured

### 4. Testing
- [ ] All CRUD operations tested
- [ ] File upload/download tested
- [ ] Verification workflow tested
- [ ] Revision request workflow tested
- [ ] Role-based access tested
- [ ] Error handling tested
- [ ] Edge cases covered

### 5. Performance
- [ ] Database queries optimized
- [ ] File upload size limits set
- [ ] Page load time acceptable
- [ ] No N+1 query problems
- [ ] Caching strategy implemented (if needed)

## 🚀 Deployment Steps

### Step 1: Backup Current System
```bash
# Backup database
mysqldump -u username -p database_name > backup_$(date +%Y%m%d).sql

# Backup files
tar -czf backup_files_$(date +%Y%m%d).tar.gz /path/to/project

# Backup uploads folder
tar -czf backup_uploads_$(date +%Y%m%d).tar.gz writable/uploads/
```

### Step 2: Update Code
```bash
# Pull latest code
git pull origin main

# Or upload files via FTP/SFTP
# Upload all changed files to server
```

### Step 3: Install Dependencies
```bash
# If using Composer
composer install --no-dev --optimize-autoloader

# Clear cache
php spark cache:clear
```

### Step 4: Run Migrations
```bash
# Run migrations
php spark migrate

# Verify migrations
php spark migrate:status
```

### Step 5: Set Permissions
```bash
# Windows
icacls writable /grant Users:F /T
icacls writable\uploads\transportation /grant Users:F /T

# Linux/Mac
chmod -R 755 writable/
chmod -R 777 writable/uploads/transportation/
chown -R www-data:www-data writable/
```

### Step 6: Configure Environment
```bash
# Copy environment file
cp env .env

# Edit .env file
nano .env
```

Required .env settings:
```ini
CI_ENVIRONMENT = production

database.default.hostname = localhost
database.default.database = your_database
database.default.username = your_username
database.default.password = your_password

app.baseURL = 'https://yourdomain.com/'
```

### Step 7: Create Initial Users
```sql
-- Create admin user
INSERT INTO users (name, email, password, role, created_at) 
VALUES ('Admin', 'admin@polban.ac.id', '$2y$10$...', 'admin', NOW());

-- Create reviewer user
INSERT INTO users (name, email, password, role, created_at) 
VALUES ('Reviewer', 'reviewer@polban.ac.id', '$2y$10$...', 'reviewer', NOW());
```

### Step 8: Test Deployment
- [ ] Access homepage
- [ ] Login as admin
- [ ] Login as reviewer
- [ ] Login as kaprodi
- [ ] Test create data
- [ ] Test file upload
- [ ] Test verification
- [ ] Test revision request
- [ ] Test all major features

### Step 9: Monitor
- [ ] Check error logs
- [ ] Monitor server resources
- [ ] Check database performance
- [ ] Verify file uploads working
- [ ] Test from different browsers

## 🔧 Post-Deployment Configuration

### 1. Web Server Configuration

#### Apache (.htaccess)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>

# Security Headers
<IfModule mod_headers.c>
    Header set X-Content-Type-Options "nosniff"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-XSS-Protection "1; mode=block"
</IfModule>

# File Upload Limits
php_value upload_max_filesize 2M
php_value post_max_size 2M
```

#### Nginx
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/project/public;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    # Security
    add_header X-Content-Type-Options "nosniff";
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    
    # File Upload
    client_max_body_size 2M;
}
```

### 2. PHP Configuration
```ini
# php.ini
upload_max_filesize = 2M
post_max_size = 2M
max_execution_time = 300
memory_limit = 256M
```

### 3. Database Optimization
```sql
-- Add indexes for better performance
CREATE INDEX idx_tahun ON transportation(tahun);
CREATE INDEX idx_status ON transportation(status_verifikasi);
CREATE INDEX idx_created_by ON transportation(created_by);
CREATE INDEX idx_transportation_id ON transportation_revisions(transportation_id);
CREATE INDEX idx_revision_status ON transportation_revisions(status);

-- Analyze tables
ANALYZE TABLE transportation;
ANALYZE TABLE transportation_revisions;
ANALYZE TABLE users;
```

### 4. Cron Jobs (Optional)
```bash
# Daily backup
0 2 * * * /path/to/backup_script.sh

# Weekly cleanup old rejected data
0 3 * * 0 mysql -u user -p database < /path/to/cleanup_script.sql

# Monthly report generation
0 1 1 * * php /path/to/project/spark generate:monthly-report
```

## 📊 Monitoring Setup

### 1. Error Logging
```php
// app/Config/Logger.php
public array $threshold = [
    'production' => 'error',
    'development' => 'debug',
];
```

### 2. Application Monitoring
- [ ] Setup error tracking (e.g., Sentry)
- [ ] Setup uptime monitoring
- [ ] Setup performance monitoring
- [ ] Setup database monitoring

### 3. Log Files to Monitor
```
writable/logs/log-YYYY-MM-DD.log
/var/log/apache2/error.log (Apache)
/var/log/nginx/error.log (Nginx)
/var/log/mysql/error.log (MySQL)
```

## 🔐 Security Hardening

### 1. File Permissions
```bash
# Restrict access to sensitive files
chmod 600 .env
chmod 600 app/Config/Database.php

# Prevent directory listing
# Add to .htaccess or nginx config
Options -Indexes
```

### 2. Database Security
```sql
-- Create dedicated database user
CREATE USER 'transport_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON database_name.* TO 'transport_user'@'localhost';
FLUSH PRIVILEGES;
```

### 3. SSL/HTTPS
- [ ] SSL certificate installed
- [ ] Force HTTPS redirect
- [ ] Update app.baseURL to https://
- [ ] Test all features over HTTPS

### 4. Firewall Rules
```bash
# Allow only necessary ports
ufw allow 80/tcp
ufw allow 443/tcp
ufw allow 22/tcp
ufw enable
```

## 📝 Documentation

### 1. Update Documentation
- [ ] Update README with production URLs
- [ ] Document any environment-specific settings
- [ ] Update API documentation (if any)
- [ ] Create user manual

### 2. Training Materials
- [ ] Create video tutorials
- [ ] Prepare training slides
- [ ] Schedule training sessions
- [ ] Create FAQ document

## 🎯 Go-Live Checklist

### Before Go-Live
- [ ] All tests passed
- [ ] Backup completed
- [ ] Rollback plan ready
- [ ] Team notified
- [ ] Users notified
- [ ] Support team ready

### During Go-Live
- [ ] Deploy code
- [ ] Run migrations
- [ ] Verify deployment
- [ ] Test critical features
- [ ] Monitor logs
- [ ] Check performance

### After Go-Live
- [ ] Monitor for 24 hours
- [ ] Check error logs
- [ ] Verify user feedback
- [ ] Document any issues
- [ ] Plan fixes if needed

## 🚨 Rollback Plan

### If Deployment Fails
```bash
# 1. Restore database
mysql -u username -p database_name < backup_YYYYMMDD.sql

# 2. Restore files
tar -xzf backup_files_YYYYMMDD.tar.gz -C /path/to/project

# 3. Restore uploads
tar -xzf backup_uploads_YYYYMMDD.tar.gz -C /path/to/project/writable/

# 4. Clear cache
php spark cache:clear

# 5. Verify system working
```

## 📞 Support Contacts

### Technical Team
- Developer: [name] - [email] - [phone]
- System Admin: [name] - [email] - [phone]
- Database Admin: [name] - [email] - [phone]

### Business Team
- Project Manager: [name] - [email] - [phone]
- Product Owner: [name] - [email] - [phone]

## 📈 Success Metrics

### Week 1
- [ ] No critical bugs
- [ ] < 5 minor bugs
- [ ] System uptime > 99%
- [ ] Average response time < 2s

### Month 1
- [ ] User adoption > 80%
- [ ] User satisfaction > 4/5
- [ ] Data accuracy > 95%
- [ ] Support tickets < 10/week

## 🔄 Maintenance Schedule

### Daily
- Check error logs
- Monitor system performance
- Verify backups completed

### Weekly
- Review user feedback
- Check disk space
- Update documentation

### Monthly
- Security updates
- Performance optimization
- Generate reports
- Review and archive old data

---

**Deployment Date:** _______________  
**Deployed By:** _______________  
**Verified By:** _______________  
**Status:** ☐ Success ☐ Failed ☐ Rolled Back
