DROP TABLE IF EXISTS eboat.users;
DROP TABLE IF EXISTS eboat.trip;
DROP TABLE IF EXISTS eboat.schedule;

CREATE TABLE eboat.users (
  user_id serial NOT NULL,
  name character varying(50) NOT NULL,
  email character varying(80) NOT NULL,
  password character varying(45) NOT NULL,
  permission boolean,
  balance real,
  PRIMARY KEY (user_id)
);

CREATE TABLE eboat.trip (
  trip_id serial NOT NULL,
  provider_id integer NOT NULL,
  destination character varying(50) NOT NULL,
  departure character varying(50) NOT NULL,
  cost real NOT NULL,
  origin character varying(50),
  PRIMARY KEY (trip_id),
  FOREIGN KEY (provider_id) REFERENCES eboat.users (user_id) ON DELETE CASCADE
);

CREATE TABLE eboat.schedule (
  passenger_id integer NOT NULL,
  trip_id integer NOT NULL,
  PRIMARY KEY (passenger_id, trip),
  FOREIGN KEY (passenger_id) REFERENCES eboat.users (user_id) ON DELETE CASCADE,
  FOREIGN KEY (trip_id) REFERENCES eboat.trip (trip_id) ON DELETE CASCADE
);
