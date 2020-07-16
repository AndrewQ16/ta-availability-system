-- Login info of confirmed users
CREATE TABLE auth_user (
    uid INT NOT NULL PRIMARY KEY
    , email VARCHAR(256) NOT NULL UNIQUE
    , hashword VARCHAR(256) NOT NULL
    , salt VARCHAR(32) NOT NULL
    , hashalgo VARCHAR(20) NOT NULL
    , uts TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP
);
