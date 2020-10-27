<p align="center"><h1 align="center">Smart House</h1></p>

## 🧾 About
Smart House is a project for college, where you can turn on and off devices in your smart house, you can register and update all devices, create rooms, routines etc,
you can also manage your houses, add residents, create scenes with routines...

## 🤹‍ Our Team

- **[Rafael Tessarolo](https://github.com/RaFaTEOLI)**
- **[Vitor Gabriel](https://github.com/vtrgabriel)**
- **[Gabriel Barbosa](https://github.com/NemesisLink)**
- **[Gabriel Rodrigues](https://github.com/gaguinhosantos)**

## 📄 License

The Smart House app is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## ⚙ How to Install

You must have Apache, PHP 7.2 or higher installed, also mysql to handle the database.

Once you have those installed, you'll have to run the SQL script, which is located at smart_house/sql/ScriptSQL.sql

If you're using Linux, there is bash script that you can run to do everything for you automatically, in order to run the script you need to change a few things:
  - DBUSER="USER" (You must replace USER with root or any other mysql user you have)
  - DBPASS="PASSWORD" (You must replace PASSWORD with the user's password you just configured)
  - Then inside the project's directory run `chmod +x Install.sh && ./Install.sh`
 
After installing PHP, MySQL and running the script you'll have to move the project's folder to apache directory, in Windows it'll be C:\xampp\htdocs\, then it will look like: C:\xampp\htdocs\smart_house, on Linux you'll move to /var/www/html, and it will look like this /var/www/html/smart_house.
  
Then you're all set, just go to your browser and type "http://localhost/smart_house" and use the following credentials:
  - Username: admin
  - Email: admin@smarthouse.com
  - Password: 1234
