docker-compose down
docker-compose up --build
down = stops old container

up --build = rebuilds and starts with the new volume (your new project)

# If you don't want to edit the docker-compose.yml every time,
# you could set it up to mount the whole projects/ folder instead, like this:

yaml
Copy
Edit
volumes:
  - ./projects:/var/www/html
Then in your browser, you can access:

http://localhost:8080/ooppractice/index.php

http://localhost:8080/blogsystem/index.php

http://localhost:8080/chatapp/index.php

Without touching docker-compose.yml again! 🚀
(You just organize your projects inside /projects/.)

# How to Restart Docker the easy way:
In your project folder:

Copy
Edit
docker-compose down
docker-compose up --build
(Use --build to make sure new Apache config is used.)

# Manually create the new database
If you want to keep the existing data but just add user_management:

Connect to the MySQL container:

Copy
Edit
docker exec -it mysql-db mysql -u root -p
Enter password (root in your case)

Run:

sql
Copy
Edit
CREATE DATABASE user_management;
Now you'll have both todoapp and user_management.

# 🔐 Why it happens:
Your docker-compose.yml defines:

environment:
  MYSQL_ROOT_PASSWORD: root
  MYSQL_USER: devuser
  MYSQL_PASSWORD: devpass
So:

root is the superuser (has all privileges)

devuser is a limited user, can't create databases

✅ How to fix it:
Use the root user to create the database instead:

docker exec -it mysql-db mysql -u root -p
Then enter password root when prompted.

Inside MySQL, run:

CREATE DATABASE user_management;