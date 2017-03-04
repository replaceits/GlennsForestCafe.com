CREATE DATABASE glennsforestcafe;
USE glennsforestcafe;

CREATE TABLE food_item(
    food_item_id int(5) NOT NULL AUTO_INCREMENT,
    food_item_name nvarchar(255) NOT NULL,
    food_item_description nvarchar(5000),
    food_item_cost  numeric(15,2) NOT NULL,
    PRIMARY KEY(food_item_id)
);

CREATE TABLE food_item_type(
    food_item_type_id int(5) NOT NULL AUTO_INCREMENT,
    food_item_type_name nvarchar(255) NOT NULL,
    PRIMARY KEY(food_item_type_id)
);

CREATE TABLE food_item_types(
    food_item_id int(5) NOT NULL,
    food_item_type_id int(5) NOT NULL,
    PRIMARY KEY(food_item_id, food_item_type_id)
);

ALTER TABLE food_item_types ADD CONSTRAINT FK_food_item 
    FOREIGN KEY ( food_item_id ) 
    REFERENCES food_item( food_item_id ) 
    ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE food_item_types ADD CONSTRAINT FK_food_item_type 
    FOREIGN KEY ( food_item_type_id ) 
    REFERENCES food_item_type( food_item_type_id );

CREATE TABLE food_image(
    food_image_id int(5) NOT NULL AUTO_INCREMENT,
    food_item_id int(5) NOT NULL,
    food_image_url nvarchar(5000),
    PRIMARY KEY(food_image_id, food_item_id)
);

ALTER TABLE food_image ADD CONSTRAINT FK_food_item_2
    FOREIGN KEY ( food_item_id ) 
    REFERENCES food_item( food_item_id ) 
    ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE users( 
    user_id int(5) NOT NULL AUTO_INCREMENT, 
    user_first_name nvarchar(255) NOT NULL, 
    user_last_name nvarchar(255), 
    user_email nvarchar(255) NOT NULL, 
    user_password_hash nvarchar(255) NOT NULL, 
    PRIMARY KEY(user_id)
);

CREATE TABLE user_admins( 
    user_admin_id int(5) NOT NULL AUTO_INCREMENT, 
    user_id int(5) NOT NULL, 
    PRIMARY KEY(user_admin_id, user_id) 
);

ALTER TABLE user_admins ADD CONSTRAINT FK_user_id_admin 
    FOREIGN KEY ( user_id ) 
    REFERENCES users( user_id ) 
    ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE orders( 
    order_id int(5) NOT NULL AUTO_INCREMENT, 
    order_date DATETIME NOT NULL, 
    order_total_cost decimal(15,2) NOT NULL, 
    order_taxes decimal(15,2) NOT NULL, 
    PRIMARY KEY(order_id)
);

CREATE TABLE user_orders(
    user_id int(5) NOT NULL, 
    order_id int(5) NOT NULL, 
    PRIMARY KEY(user_id, order_id)
);

CREATE TABLE order_item( 
    order_item_id int(5) NOT NULL AUTO_INCREMENT, 
    order_id int(5) NOT NULL, 
    food_item_id int(5) NOT NULL, 
    PRIMARY KEY( order_item_id, order_id, food_item_id) 
);

ALTER TABLE order_item ADD CONSTRAINT FK_order_id_item 
    FOREIGN KEY ( order_id ) 
    REFERENCES orders( order_id ) 
    ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE order_item ADD CONSTRAINT FK_order_id_food 
    FOREIGN KEY ( food_item_id ) 
    REFERENCES food_item( food_item_id ) 
    ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE ingredient( 
    ingredient_id int(5) NOT NULL AUTO_INCREMENT, 
    ingredient_name nvarchar(255), 
    PRIMARY KEY( ingredient_id )
);

CREATE TABLE food_item_ingredient( 
    ingredient_id int(5) NOT NULL, 
    food_item_id int(5) NOT NULL, 
    PRIMARY KEY( ingredient_id, food_item_id)
);

ALTER TABLE food_item_ingredient ADD CONSTRAINT FK_food_ingredient_food_id 
    FOREIGN KEY ( food_item_id ) 
    REFERENCES food_item( food_item_id ) 
    ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE food_item_ingredient ADD CONSTRAINT FK_food_ingredient_id 
    FOREIGN KEY ( ingredient_id ) 
    REFERENCES ingredient( ingredient_id ) 
    ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE order_item_addition(
    order_item_id int(5) NOT NULL,
    ingredient_id int(5) NOT NULL,
    PRIMARY KEY(order_item_id, ingredient_id)
);

ALTER TABLE order_item_addition ADD CONSTRAINT FK_order_item_order_add 
    FOREIGN KEY ( order_item_id ) 
    REFERENCES order_item( order_item_id ) 
    ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE order_item_addition ADD CONSTRAINT FK_order_item_ingredient_add 
    FOREIGN KEY ( ingredient_id ) 
    REFERENCES ingredient( ingredient_id ) 
    ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE order_item_subtraction(
    order_item_id int(5) NOT NULL,
    ingredient_id int(5) NOT NULL,
    PRIMARY KEY(order_item_id, ingredient_id)
);

ALTER TABLE order_item_subtraction ADD CONSTRAINT FK_order_item_order_sub 
    FOREIGN KEY ( order_item_id ) 
    REFERENCES order_item( order_item_id ) 
    ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE order_item_subtraction ADD CONSTRAINT FK_order_item_ingredient_sub 
    FOREIGN KEY ( ingredient_id ) 
    REFERENCES ingredient( ingredient_id ) 
    ON DELETE CASCADE ON UPDATE CASCADE;
