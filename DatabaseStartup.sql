create schema group420;

create table CustomerOrder (
	Transaction_number int (10),
    Item_name varchar(50),
    Item_ID int (10),
    Quantity int (3),
    Price int (4),
    Date_Of_Sale Date,
    Time_Of_Sale Time
);


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
) values (2, "", 1, "slight yeeeting", 420);


select * from Warehouse;