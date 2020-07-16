-- Info regarding email verification links (account creation and password resets)
CREATE TABLE email_verification (
    email_verification_id VARCHAR(256) PRIMARY KEY
    , email VARCHAR(256) NOT NULL
    , reason INT NOT NULL -- reasons: {1: signup, 2: reset password}
    , uts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
