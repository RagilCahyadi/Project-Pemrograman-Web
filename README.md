# RNR DIGITAL PRINTING

RNR Digital Printing adalah sebuah web penyedia jasa layanan Digital Printing yang bisa digunakan oleh pengguna secara mudah untuk memesan jasa berupa pencetakan Digital Imaging.

## 📋 Daftar Anggota Kelompok
1. Rahmansyah Ragil Cahyadi (3012310034)
2. Muhammad Amirun Nadhif (3012310019)
3. Ruziqna Hadikafilardi Muhtarom (3012310039)

## 🌐 Visit Our Web Project
**Live Demo:** https://rnr.tugas1.id/

## 🎓 Academic Information
**Web Programming Universitas Internasional Semen Indonesia 2025**  
**Lecturer:** As'ad Rosyadi

---

## 📖 About The Project

RNR Digital Printing adalah platform web yang menyediakan layanan pencetakan digital dengan berbagai pilihan produk dan layanan. Website ini dikembangkan menggunakan framework Laravel dan menyediakan interface yang user-friendly untuk pelanggan dalam memesan berbagai jenis layanan percetakan.

### ✨ Key Features

- **Multi-Service Digital Printing**: Banner printing, fancy paper, packaging, UV printing, dan lainnya
- **User Authentication**: Sistem login/register untuk pelanggan dan admin
- **Order Management**: Pelacakan pesanan real-time dengan status updates
- **Payment Integration**: Multiple payment methods dengan tracking status
- **Admin Dashboard**: Panel admin untuk mengelola pesanan, produk, dan pelanggan
- **Responsive Design**: Interface yang mobile-friendly
- **Customer Support**: Integrasi WhatsApp untuk support pelanggan

### 🛠️ Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Bootstrap 5, Blade Templates
- **Database**: MySQL
- **Payment**: Various payment gateways
- **Styling**: Custom CSS with modern design
- **Icons**: Bootstrap Icons

---

## 📋 System Requirements

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL/MariaDB atau SQLite
- Web Server (Apache/Nginx)

---

## 🚀 Installation Guide

### 1. Clone Repository

```bash
git clone https://github.com/your-username/rnr-digital-printing.git
cd rnr-digital-printing
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration

Edit `.env` file untuk konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rnr_printing
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

**Atau gunakan SQLite (untuk development):**

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

### 5. Database Migration & Seeding

```bash
# Run migrations
php artisan migrate

# Seed database with sample data (optional)
php artisan db:seed
```

### 6. Storage Link

```bash
# Create storage link for file uploads
php artisan storage:link
```

### 7. Build Assets

```bash
# Build CSS and JS assets
npm run build

# Or for development with hot reload
npm run dev
```

### 8. Start Development Server

```bash
# Start Laravel development server
php artisan serve

# The application will be available at http://localhost:8000
```

---

## 📁 Project Structure

```
rnr-digital-printing/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── ...
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # CSS files
│   └── js/                 # JavaScript files
├── routes/
│   ├── web.php             # Web routes
│   └── ...
├── public/                 # Public assets
└── storage/                # File storage
```

---

## 🎯 Usage Guide

### For Customers:

1. **Register/Login**: Buat akun atau login ke sistem
2. **Browse Services**: Pilih layanan printing yang diinginkan
3. **Upload Files**: Upload file design yang akan dicetak
4. **Customize Order**: Pilih ukuran, material, quantity, dll
5. **Checkout**: Lakukan pembayaran
6. **Track Order**: Pantau status pesanan di halaman "My Orders"

### For Admins:

1. **Login Admin**: Akses admin panel
2. **Manage Orders**: Kelola pesanan pelanggan
3. **Update Status**: Update status pesanan
4. **Manage Products**: Tambah/edit produk dan layanan
5. **Customer Management**: Kelola data pelanggan

---

## 🔧 Configuration

### Payment Gateway Setup

Edit `.env` untuk konfigurasi payment gateway:

```env
# Payment Configuration
PAYMENT_GATEWAY_KEY=your_payment_key
PAYMENT_GATEWAY_SECRET=your_payment_secret
```

### WhatsApp Integration

```env
# WhatsApp Business API
WHATSAPP_NUMBER=628xxxxxxxxx
```

### Email Configuration

```env
# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
```

---

## 🧪 Testing

```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter=OrderTest
```

---

## 📚 API Documentation

### Customer Orders API

```http
GET /api/orders
Authorization: Bearer {token}
```

### Order Status Update

```http
PUT /api/orders/{id}/status
Authorization: Bearer {token}
Content-Type: application/json

{
    "status": "processing"
}
```

---

## 🚀 Deployment

### Production Setup

1. **Server Requirements**:
   - PHP 8.2+
   - MySQL/MariaDB
   - Composer
   - Node.js

2. **Environment**:
   ```bash
   # Set production environment
   APP_ENV=production
   APP_DEBUG=false
   ```

3. **Optimize Application**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

4. **Set Permissions**:
   ```bash
   chmod -R 755 storage/
   chmod -R 755 bootstrap/cache/
   ```

---

## 🐛 Troubleshooting

### Common Issues

1. **Permission Denied Error**:
   ```bash
   sudo chown -R www-data:www-data storage/
   sudo chown -R www-data:www-data bootstrap/cache/
   ```

2. **Database Connection Error**:
   - Check database credentials in `.env`
   - Ensure database server is running

3. **Asset Not Loading**:
   ```bash
   npm run build
   php artisan storage:link
   ```

---

## 🤝 Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 📞 Support

- **Website**: https://rnr.tugas1.id/
- **Email**: support@rnr.tugas1.id
- **WhatsApp**: +62 851-5696-3404

---

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap Team
- All contributors and testers
- Universitas Internasional Semen Indonesia
