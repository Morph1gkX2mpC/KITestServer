# KITestServer - Web Testing Server

A comprehensive testing environment for web tools and technologies using open source HTML, CSS, JavaScript, and PHP.

## 🎯 Overview

This project provides a complete testing server setup for validating various web technologies including:
- HTML5 semantic elements and structure
- CSS3 styling, animations, and responsive design
- JavaScript (ES6+) DOM manipulation and events
- PHP server-side processing
- Form validation and submission
- AJAX requests and asynchronous operations

## 📁 Project Structure

```
KITestServer/
├── public/                  # Web root directory
│   ├── index.html          # Main landing page
│   ├── assets/             # Static assets
│   │   ├── css/
│   │   │   └── style.css   # Main stylesheet
│   │   ├── js/
│   │   │   └── main.js     # Main JavaScript utilities
│   │   └── images/         # Image assets
│   └── tools/              # Testing modules
│       ├── html-tests.html  # HTML testing page
│       ├── css-tests.html   # CSS testing page
│       ├── js-tests.html    # JavaScript testing page
│       ├── php-tests.php    # PHP testing page
│       ├── form-tests.html  # Form testing page
│       ├── ajax-tests.html  # AJAX testing page
│       └── api.php          # Sample API endpoint
└── README.md
```

## 🚀 Setup Instructions

### Prerequisites

- Linux server (Ubuntu, Debian, CentOS, etc.)
- Web server (Apache or Nginx)
- PHP 7.4 or higher

### Installation

#### Option 1: Apache Setup

1. **Install Apache and PHP:**
```bash
sudo apt update
sudo apt install apache2 php libapache2-mod-php
```

2. **Clone or copy the repository:**
```bash
cd /var/www/html
sudo git clone https://github.com/Morph1gkX2mpC/KITestServer.git
# Or copy the files manually
```

3. **Set proper permissions:**
```bash
sudo chown -R www-data:www-data /var/www/html/KITestServer
sudo chmod -R 755 /var/www/html/KITestServer
```

4. **Configure Apache virtual host (optional):**
```bash
sudo nano /etc/apache2/sites-available/testserver.conf
```

Add:
```apache
<VirtualHost *:80>
    ServerName testserver.local
    DocumentRoot /var/www/html/KITestServer/public
    
    <Directory /var/www/html/KITestServer/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/testserver_error.log
    CustomLog ${APACHE_LOG_DIR}/testserver_access.log combined
</VirtualHost>
```

5. **Enable the site and restart Apache:**
```bash
sudo a2ensite testserver.conf
sudo systemctl restart apache2
```

#### Option 2: Nginx Setup

1. **Install Nginx and PHP-FPM:**
```bash
sudo apt update
sudo apt install nginx php-fpm
```

2. **Clone or copy the repository:**
```bash
cd /var/www/html
sudo git clone https://github.com/Morph1gkX2mpC/KITestServer.git
```

3. **Configure Nginx:**
```bash
sudo nano /etc/nginx/sites-available/testserver
```

Add:
```nginx
server {
    listen 80;
    server_name testserver.local;
    root /var/www/html/KITestServer/public;
    index index.html index.php;

    location / {
        try_files $uri $uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

4. **Enable the site and restart Nginx:**
```bash
sudo ln -s /etc/nginx/sites-available/testserver /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

#### Option 3: Quick Test with PHP Built-in Server

For quick testing without Apache/Nginx:

```bash
cd KITestServer/public
php -S localhost:8000
```

Access at: `http://localhost:8000`

## 🌐 Accessing the Server

- **Local access:** `http://localhost` or `http://localhost:8000` (PHP built-in server)
- **Network access:** `http://your-server-ip`
- **Custom domain:** Configure DNS and use your domain name

## 📚 Features & Testing Modules

### 1. HTML Tests
- Semantic HTML5 elements
- Text formatting tags
- Lists and tables
- Multimedia elements (audio, video)
- Embedded content (iframe, progress, meter)

### 2. CSS Tests
- Flexbox and Grid layouts
- CSS animations and transitions
- Gradients and shadows
- Responsive design with media queries
- CSS variables and filters

### 3. JavaScript Tests
- DOM manipulation
- Event handling
- Array and string methods
- Promises and async/await
- Local storage
- ES6+ features

### 4. PHP Tests
- Server information
- Date and time functions
- Session management
- String and array operations
- File system operations
- JSON handling
- Form processing

### 5. Form Tests
- Various input types (text, email, number, date, etc.)
- Form validation
- File uploads
- Radio buttons and checkboxes
- Custom patterns

### 6. AJAX Tests
- GET and POST requests
- Fetch API
- JSON data exchange
- Loading states
- Sequential and parallel requests
- Auto-refresh (polling)

## 🔧 Configuration

### PHP Configuration

Edit `php.ini` for optimal settings:

```ini
upload_max_filesize = 20M
post_max_size = 25M
max_execution_time = 300
memory_limit = 256M
```

### File Permissions

```bash
# Web server user (usually www-data or nginx)
sudo chown -R www-data:www-data /var/www/html/KITestServer
sudo chmod -R 755 /var/www/html/KITestServer

# Make specific directories writable if needed
sudo chmod -R 775 /var/www/html/KITestServer/public/uploads
```

## 🔒 Security Notes

- This is a **testing server** - do not use in production without proper security measures
- **CSRF Protection**: Implemented for session management operations
- **CORS**: API endpoint has origin validation (update allowed origins for production)
- Disable directory listing in production
- Use HTTPS for production environments
- Implement proper input validation and sanitization
- Set up firewall rules appropriately
- Keep PHP and server software updated
- For production use:
  - Update CORS allowed origins in `tools/api.php`
  - Review and enhance all security measures
  - Enable error logging and monitoring
  - Use environment variables for sensitive configuration

## 🛠️ Customization

### Adding New Test Pages

1. Create a new HTML/PHP file in `public/tools/`
2. Add navigation link in the main navigation menu
3. Use the existing CSS classes for consistent styling
4. Include `main.js` for common utilities

### Styling

- Main styles: `public/assets/css/style.css`
- Modify CSS variables for color scheme changes
- Responsive breakpoint: 768px

### JavaScript

- Common utilities available in `window.Utils` and `window.Ajax`
- Add page-specific JavaScript inline or create new files

## 📝 API Endpoints

Sample API endpoint available at `tools/api.php`:

- **GET** `api.php?action=users` - Get user list
- **GET** `api.php?action=time` - Get server time
- **POST** `api.php` - Echo posted data
- **PUT** `api.php` - Handle PUT requests
- **DELETE** `api.php?id=1` - Handle DELETE requests

## 🤝 Contributing

Feel free to extend this testing server with additional tools and features:
- Database testing tools
- WebSocket examples
- API testing interface
- Performance testing tools
- Security testing tools

## 📄 License

Open source project - free to use and modify.

## 🐛 Troubleshooting

### PHP not working
- Check if PHP module is installed and enabled
- Verify PHP-FPM is running: `sudo systemctl status php7.4-fpm`
- Check error logs: `/var/log/apache2/error.log` or `/var/log/nginx/error.log`

### Permission denied errors
- Check file ownership and permissions
- Ensure web server user has access to files

### 404 errors
- Verify DocumentRoot/root path in server configuration
- Check if files exist in the correct location
- Restart web server after configuration changes

## 📞 Support

For issues or questions, please open an issue on the GitHub repository.

## 🎓 Learning Resources

This testing server is ideal for:
- Learning web development basics
- Testing new features before implementation
- Training and education
- Development environment setup
- API testing and debugging
