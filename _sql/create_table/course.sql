-- All courses offered at UB, per semester
CREATE TABLE course (
    course_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
    , prefix VARCHAR(5) NOT NULL
    , number INT NOT NULL
    , semester INT NOT NULL -- semesters: {1: spring, 2: summer, 3: fall, 4: winter}
    , year INT NOT NULL
    , uts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
