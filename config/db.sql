create table roles (
    id int PRIMARY KEY ,
    role_name VARCHAR(50)
);

create table users (
    id int PRIMARY KEY auto_increment,
    usernam varchar(50),
    email VARCHAR(100),
    PASSWORD VARCHAR(255),
    role_id int ,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);