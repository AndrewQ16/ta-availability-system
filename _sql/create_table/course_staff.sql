-- All staff of all courses
CREATE TABLE course_staff (
    course_id INT NOT NULL
    , uid INT NOT NULL
    , uts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    , PRIMARY KEY (uid, course_id)
);
