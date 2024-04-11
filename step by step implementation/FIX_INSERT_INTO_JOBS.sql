
USE hr1;
-- at line 291 of HR.sql creates a trigger for the job table
-- that trigger uses a table called jobs, then an error is 
-- caused because the totJobs which is used by the trigger 
-- does not exist inside the database

CREATE TABLE IF NOT EXISTS totJobs(
  job_title VARCHAR(69),
  total INT
);

-- or DROP TRIGGER IF EXISTS updatetotjobs1;
