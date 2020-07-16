-- All staff currently working
create table staff_activity (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
    , course_id VARCHAR(20)
    , uid INT NOT NULL
    , is_active BOOLEAN NOT NULL
    , location VARCHAR(2000)
    , end_time BIGINT(20)
    , uts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    , is_location_link TINYINT(1)
);
