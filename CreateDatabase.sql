CREATE DATABASE glennsforestcafe;
USE glennsforestcafe;

CREATE TABLE food_item( food_item_id int(5) NOT NULL AUTO_INCREMENT, food_item_name nvarchar(255) NOT NULL, food_item_description nvarchar(5000), food_item_cost  numeric(15,2) NOT NULL, PRIMARY KEY(food_item_id) );

CREATE TABLE food_item_type( food_item_type_id int(5) NOT NULL AUTO_INCREMENT, food_item_type_name nvarchar(255) NOT NULL, PRIMARY KEY(food_item_type_id) );

CREATE TABLE food_item_types( food_item_id int(5) NOT NULL, food_item_type_id int(5) NOT NULL, PRIMARY KEY( food_item_id, food_item_type_id ) );
ALTER TABLE food_item_types ADD CONSTRAINT FK_food_item FOREIGN KEY ( food_item_id ) REFERENCES food_item( food_item_id ) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE food_item_types ADD CONSTRAINT FK_food_item_type FOREIGN KEY ( food_item_type_id ) REFERENCES food_item_type( food_item_type_id );

CREATE TABLE food_image( food_image_id int(5) NOT NULL AUTO_INCREMENT, food_item_id int(5) NOT NULL, food_image_url nvarchar(5000), PRIMARY KEY( food_image_id, food_item_id ) );
ALTER TABLE food_image ADD CONSTRAINT FK_food_item_2 FOREIGN KEY ( food_item_id ) REFERENCES food_item( food_item_id ) ON DELETE CASCADE ON UPDATE CASCADE;

