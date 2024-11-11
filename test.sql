
#README Hướng dẫn
use table users include 3 role
- user: registration injections services, viewing registration results
- staff: view and search registration of each user
- admin: stat user, count of registration injections, user management,;....

default registration user with role user

integrate authentication authorizations all

user 1:n register N:1 service and register 1: bills


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    address TEXT,
    age INT,
    role VARCHAR(50) DEFAULT 'user'
);

CREATE TABLE services (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT NULL
);

INSERT INTO services (name, price, description)
VALUES
    ('Website Development', 1200.00, 'Custom website design and development services'),
    ('SEO Optimization', 500.00, 'Search Engine Optimization to improve website ranking'),
    ('Graphic Design', 350.00, 'Logo, banner, and branding design services'),
    ('Mobile App Development', 1500.00, 'Custom mobile app development for iOS and Android'),
    ('Content Writing', 200.00, 'High-quality content writing for blogs, websites, and more'),
    ('Social Media Management', 400.00, 'Managing social media campaigns and content creation'),
    ('IT Consultation', 100.00, NULL);

CREATE TABLE bills (
    id INT PRIMARY KEY AUTO_INCREMENT,
    staff_id INT,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2),
    payment_status VARCHAR(50) DEFAULT 'Chưa thanh toán', 
    FOREIGN KEY (staff_id) REFERENCES users(id)
);

CREATE TABLE registrations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    service_id INT,
    status VARCHAR(50) DEFAULT 'Chưa tiêm',
    bill_id INT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (service_id) REFERENCES services(id),
    FOREIGN KEY (bill_id) REFERENCES bills(id)
);

create table screenings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    service_id INT,
    status VARCHAR(50) DEFAULT 'Chưa tiêm',
    bill_id INT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (service_id) REFERENCES services(id),
    FOREIGN KEY (bill_id) REFERENCES bills(id)
)

