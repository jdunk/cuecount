server {
    listen 80;
    listen [::]:80;

    server_name cuecount.vcap.me *.cuecount.vcap.me cc.vcap.me *.cc.vcap.me;

    access_log /var/log/nginx/cuecountapp.com.access.log;
    error_log /var/log/nginx/cuecountapp.com.error.log debug;

    root /var/www/cuecountapp.com/public;
    index start.php;

    client_max_body_size 500M;

    location ~ "\.[a-z]{2,4}$" {

        location ~ !\.php(/|$) {
            try_files $uri =404;
        }

        location ~ \.php(/|$) {
            fastcgi_split_path_info ^(.+?\.php)(/.*)$;
            if (!-f $document_root$fastcgi_script_name) {
                return 404;
            }

            # "cgi.fix_pathinfo = 0;" in php.ini is recommended to avoid /upload/some.gif/index.php exploit
            # but this exploit is not possible here because we are checking that the php file exists

            fastcgi_pass unix:/var/run/php/php7.1-fpm.sock;
            fastcgi_index start.php;
            include fastcgi_params;
        }
    }

    location / {
        try_files $uri $uri/ /start.php?$query_string;
    }

    # deny access to .ht* files

    location ~ /\.ht {
        deny all;
    }
}