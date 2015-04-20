USE EMS;

CREATE TABLE seniority_report
(
	emp_name varchar(100),
    emp_sin int,
    emp_type varchar(50),
    hire_date date,
    company_name varchar(50),
    length_of_service int
);
       
/* Fulltime seniority */
INSERT INTO seniority_report
SELECT concat(p_firstname, ' ', p_lastname), si_number, 'Fulltime', ft_date_of_hire, companyName, (DATEDIFF(CURDATE(), ft_date_of_hire))
FROM FT_View
JOIN Company
ON ft_company_id = companyID;

select * from seniority_report;


/* Parttime seniority */
INSERT INTO seniority_report
SELECT concat(p_firstname, p_lastname), si_number, 'Parttime', pt_date_of_hire, companyName, (DATEDIFF(CURDATE(), pt_date_of_hire))
FROM PT_View
JOIN Company
ON pt_company_id = companyID;

/* Seasonal seniority */
INSERT INTO seniority_report
SELECT concat(p_firstname, p_lastname), si_number, 'Seasonal', CONCAT(season_year, season_start_date), companyName, (DATEDIFF(CURDATE(), CONCAT(season_year, season_start_date)))
FROM SN_View
JOIN Seasons
ON season = season_start_date
JOIN Company
ON sn_company_id = companyID;
