CREATE DATABASE EMS
USE EMS

CREATE TABLE access_level
(
	accessLevel int,
	accessDescription varchar(200),
    PRIMARY KEY (accessLevel)
);


CREATE TABLE Users
(
	userID varchar(25),
	userPassword varchar(30),
	u_firstName varchar(15),
	u_lastName varchar(15),
	securityLevel int,
    PRIMARY KEY (userID),
    FOREIGN KEY (securityLevel) REFERENCES access_level(accessLevel)
);


CREATE TABLE Company
(
	companyID int,
	companyName varchar(50),
    PRIMARY KEY (companyID)
);


CREATE TABLE Person
(
	p_firstName varchar(15),
	p_lastName varchar(15),
	si_number varchar(9) NOT NULL UNIQUE,
	date_of_birth date,
	p_id int,
    PRIMARY KEY (p_id)
);


CREATE TABLE Employee
(
	emp_id int PRIMARY KEY,
	person_id int,
    FOREIGN KEY (person_id) REFERENCES Person(p_id)
);


CREATE TABLE Fulltime_Employee
(
	ft_employee_id int,
	ft_company_id int,
	ft_date_of_hire date,
	ft_date_of_termination date,
	salary float,
	PRIMARY KEY (ft_employee_id, ft_company_id),
    FOREIGN KEY (ft_employee_id) REFERENCES Employee(emp_id),
    FOREIGN KEY (ft_company_id) REFERENCES Company(companyID)
);


CREATE TABLE Parttime_Employee
(
	pt_employee_id int,
	pt_company_id int,
	pt_date_of_hire date,
	pt_date_of_termination date,
	hourlyRate float,
	PRIMARY KEY (pt_employee_id, pt_company_id),
    FOREIGN KEY (pt_employee_id) REFERENCES Employee(emp_id),
    FOREIGN KEY (pt_company_id) REFERENCES Company(companyID)
);


CREATE TABLE Contract_Employee
(
	ct_employee_id int,
	ct_company_id int,
	contract_start_date date,
	contract_stop_date date,
	fixedContractAmount float,
	PRIMARY KEY (ct_employee_id, ct_company_id),
    FOREIGN KEY (ct_employee_id) REFERENCES Employee(emp_id),
    FOREIGN KEY (ct_company_id) REFERENCES Employee(emp_id)
);


CREATE TABLE Seasonal_Employee
(
	sn_employee_id int,
	sn_company_id int,
	season varchar(7),
	season_year int,
	piece_pay float,
	PRIMARY KEY (sn_employee_id, sn_company_id),
    FOREIGN KEY (sn_employee_id) REFERENCES Employee(emp_id),
    FOREIGN KEY (sn_company_id) REFERENCES Company(companyID)
);


CREATE TABLE Time_Cards
(
	tc_employee_id int,
	tc_company_id int,
	pay_period_start_date date,
	hours_worked float,
	pieces_completed float,
	PRIMARY KEY (tc_employee_id, tc_company_id, pay_period_start_date),
    FOREIGN KEY (tc_employee_id) REFERENCES EMPLOYEE(emp_id),
    FOREIGN KEY (tc_company_id) REFERENCES Company(companyID)
);


CREATE TABLE Audits
(
	audit_id int,
	au_employee_id int,
	time_of_action date,
	audited_action varchar(50),
	audited_field varchar(50),
	old_value varchar(50),
	new_value varchar(50),
    PRIMARY KEY (audit_id),
    FOREIGN KEY (au_employee_id) REFERENCES Employee(emp_id)
)