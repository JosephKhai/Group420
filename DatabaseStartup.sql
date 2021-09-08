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
    Quantity int (4),
    Item_Description varchar(50),
    Price int(4)
);
