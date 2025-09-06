# 🐾 Ecommerce_PetShop - E-commerce Website

**Ecommerce_PetShop** is an e-commerce website built with **Laravel** that provides various products and accessories for pets such as dogs, cats, fish, and birds.  
Users can browse products, search, add to cart, checkout, and manage their orders easily.

---

## 🚀 Features

- 👤 **User Management**
  - Register / Login
  - Manage profile information

- 🛍️ **Product Management**
  - Display product list by categories (dog, cat, bird, fish, etc.)
  - Product detail: description, price, images, reviews
  - Related products suggestion

- 🛒 **Cart & Checkout**
  - Add / remove / update quantity in the cart
  - Calculate total order price
  - Support multiple payment methods (COD, MoMo, VNPay, ...)

- ⭐ **Product Reviews & Comments**
  - Users can leave reviews and comments

- 🔐 **Role-based Access**
  - **Admin**: manage products, orders, users, reviews
  - **Client**: browse products, purchase, manage cart

---

## 🛠️ Tech Stack

- **Framework**: Laravel (PHP)  
- **Frontend**: Laravel Blade Template  
- **Database**: MySQL  
- **Authentication**: Laravel Auth / Sanctum  
- **Payment Integration**: MoMo / VNPay (optional)  
- **UI/UX**: Bootstrap / TailwindCSS / AOS animation  

---

## 📂 Project Structure (sample)

Ecommerce_PetShop/
│-- app/ # Laravel application code
│-- public/ # Images, CSS, JS
│-- resources/
│ │-- views/ # Blade templates
│ │-- css/ # Custom CSS
│ │-- js/ # Custom JavaScript
│-- routes/ # web.php, api.php
│-- database/
│ │-- seeders/ # Fake sample data
│-- .env.example # Environment configuration file
│-- README.md # Project documentation


---
