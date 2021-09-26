create table CustomerOrder (
	Transaction_number int (10),
    Item_name varchar(50),
    Item_ID int (10),
    Quantity int (3),
    Price int (4),
    Date_Of_Sale Date,
    Time_Of_Sale Time
);


drop table Warehouse;

create table Warehouse (
	Item_ID int,
    Item_Name varchar(50), 
    Quantity int (4),
    Item_Description varchar(50),
    Price int(4)
);

insert into Warehouse (
	Item_ID, Item_Name, Quantity, Item_Description, Price
) values (1, "Four Twenty", 1, "slight yeeeting", 420);


insert into Warehouse (
	Item_ID, Item_Name, Quantity, Item_Description, Price
) values (2, "Fire Crackers", 1, "Highly Flamable", 35);

insert into Warehouse (
	Item_ID, Item_Name, Quantity, Item_Description, Price
) values (3, "water", 1, "H2O", 10);


insert into Warehouse (
	Item_ID, Item_Name, Quantity, Item_Description, Price
) values (4, "Ear Muffs", 1, "Fluffy", 45);

insert into Warehouse (
	Item_ID, Item_Name, Quantity, Item_Description, Price
) values (5, "bandaids", 1, "Thick", 69);


use group420;

select * from Warehouse;

select * from Login_;

update Warehouse
SET Item_Description = "Thick and lubricated" Where Item_id = 3;

