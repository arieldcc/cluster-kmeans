Upload project ke GitHub:
1. git init
2. git add README.md
3. git add .
4. git commit -m "first commit"
5. git remote add origin https://github.com/arieldcc/cluster-kmeans.git
6. git push --force origin master

Cara clone/mengambil project dari GitHub:
1. git clone url_project di GitHub (ambil project dari GitHub)
2. Composer update (update dependence yang dibutuhkan)
3. Php artisan key:generate (membuat key ke file .env)
4. Php artisan migrate (membuat/memasukkan tabel)
5. Php artisan db:seed —class=nama_class_seeder (input data awal) 
