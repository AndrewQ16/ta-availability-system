-- Profiles of users (including unconfirmed users)
CREATE TABLE user (
    uid INT NOT NULL AUTO_INCREMENT PRIMARY KEY
    , email VARCHAR(256) NOT NULL UNIQUE
    , name VARCHAR(256) NOT NULL
    , role INT NOT NULL -- roles: {1: prof, 2: ta}
    , is_admin BOOLEAN NOT NULL
    , is_staff BOOLEAN NOT NULL
    , uts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
