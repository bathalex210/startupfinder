CREATE TABLE users(
   email text PRIMARY KEY     NOT NULL,
   name           text    NOT NULL,
   password        varchar(32) NOT NULL,
   date TIMESTAMP NOT NULL DEFAULT NOW()
);
CREATE TABLE startup(
	title text NOT NULL,
	description text NOT NULL,
	industry text NOT NULL,
	email text NOT NULL REFERENCES users,
	date TIMESTAMP NOT NULL DEFAULT NOW(),
	PRIMARY KEY(title,description)
);
CREATE TABLE likes(
	ID SERIAL PRIMARY KEY,
	email text NOT NULL REFERENCES users,
	title text NOT NULL,
	rating text NOT NULL
);