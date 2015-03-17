CREATE TABLE users(
   email text PRIMARY KEY     NOT NULL,
   name           text    NOT NULL,
   password        varchar(32) NOT NULL
);
CREATE TABLE startup(
	title text NOT NULL,
	description text NOT NULL,
	industry text NOT NULL,
	email text NOT NULL
);