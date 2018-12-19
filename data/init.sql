create database if not exists todo_database;

create table if not exists todo (

	id int primary key auto_increment,
    task varchar(255) not null,
    completed boolean default false, 
    due_date date,
    created_at timestamp default current_timestamp not null,
    updated_at date

);