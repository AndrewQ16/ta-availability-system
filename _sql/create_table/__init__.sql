---------------------------------------------------------------------
---------------------------------------------------------------------
-- TO INITIALIZE THE DATABASE:
--   1. CREATE ALL TABLES
--   2. CREATE AN ADMIN PROFESSOR WITH THE FOLLOWING SCRIPT
---------------------------------------------------------------------
---------------------------------------------------------------------
SET @email = 'jcgoodru@buffalo.edu';
SET @password = 'jcgoodru@buffalo.edu';
SET @name = 'jon goodrum';
SET @salt = MD5(RAND());
INSERT INTO
user (email, name, is_admin, is_staff, role)
VALUES (@email, @name, 1, 1, 1);
INSERT INTO
auth_user (uid, email, hashword, salt, hashalgo)
VALUES (1, @email, MD5(CONCAT(@password, @salt)), @salt, 'MD5');
---------------------------------------------------------------------
---------------------------------------------------------------------
