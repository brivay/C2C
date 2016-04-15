DROP TABLE IF EXISTS resources; #remove any existing resources table
CREATE TABLE resources
(
	id smallint unsigned NOT NULL auto_increment, #smallint can hold whole numbers from 0 to 65,535
	title varchar(255) NOT NULL, #can be a string up to 225 characters
	url text NOT NULL, #can hold up to 65,535 characters
	summary text NOT NULL,
	content mediumtext NOT NULL, #can hold up to 16,777,215 characters
	category text NOT NULL,
	-- tag text NOT NULL,
	is_free boolean NOT NULL default 0,
	is_featured boolean NOT NULL default 0,
	is_favorite boolean NOT NULL default 0,
	date_created date NOT NULL,


	PRIMARY KEY (id)
);

-- Now we need to load this MySQL to create the table