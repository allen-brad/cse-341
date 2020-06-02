--Create tables for Member Database
DROP TABLE IF EXISTS MemberPhone;
DROP TABLE IF EXISTS MemberEmergencyContact;
DROP TABLE IF EXISTS MemberAddress;
DROP TABLE IF EXISTS MemberTenure;
DROP TABLE IF EXISTS Member;
DROP TABLE IF EXISTS MemberStatus;


-- ************************************** MemberStatus enum

CREATE TABLE MemberStatus
(
 memberStatusID  integer NOT NULL GENERATED ALWAYS AS IDENTITY,
 memberStatusType varchar(50) NOT NULL,
 CONSTRAINT PK_MemberStatus PRIMARY KEY ( memberStatusID )
);

-- ************************************** Phone Type enum

CREATE TABLE PhoneType
(
 phoneTypeID  integer NOT NULL GENERATED ALWAYS AS IDENTITY,
 phoneType varchar(50) NOT NULL,
 CONSTRAINT PK_PhoneType PRIMARY KEY ( phoneTypeID )
);


-- ************************************** Member

CREATE TABLE Member
(
 memberID       integer NOT NULL GENERATED ALWAYS AS IDENTITY (
 start 1000
 ),
 lastName       varchar(50) NOT NULL,
 firstName      varchar(50) NOT NULL,
 middleName     varchar(50) NULL,
 preferredName  varchar(25) NOT NULL,
 callSign       varchar(10) NOT NULL,
 dob            date NOT NULL,
 sarEmail       varchar(50) NOT NULL,
 personalEmail  varchar(50) NOT NULL,
 dlNumber        varchar(20) NOT NULL,
 dlState        varchar(2) NOT NULL,
 ssnLastFour    integer NOT NULL,
 createdDate    timestamp with time zone default current_timestamp,
 lastUpdate     timestamp with time zone default current_timestamp,
 memberStatusID integer NOT NULL,
 CONSTRAINT PK_Member PRIMARY KEY ( memberID ),
 CONSTRAINT FK_Member_MemberStatus FOREIGN KEY ( memberStatusID ) REFERENCES MemberStatus ( memberStatusID )
);

CREATE INDEX ON Member
(
 memberStatusID
);

-- ************************************** MemberTenure
CREATE TABLE MemberTenure
(
 memberTenureID integer NOT NULL GENERATED ALWAYS AS IDENTITY,
 memberID       integer NOT NULL,
 startDate      date NOT NULL,
 endDate        date,
 createdBy      integer NOT NULL,
 lastUpdateBy   integer NOT NULL,
 createdDate    timestamp with time zone default current_timestamp,
 lastUpdate     timestamp with time zone default current_timestamp,
 CONSTRAINT PK_MemberTenure PRIMARY KEY ( memberTenureID ),
 CONSTRAINT FK_MemberTenure_Member_1 FOREIGN KEY ( memberID ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_MemberTenure_Member_2 FOREIGN KEY ( createdBy ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_MemberTenure_Member_3 FOREIGN KEY ( lastUpdateBy ) REFERENCES Member ( memberID )
);

CREATE INDEX ON MemberTenure
(
 memberID
);

CREATE INDEX ON MemberTenure
(
 createdBy
);

CREATE INDEX ON MemberTenure
(
 lastUpdateBy
);

-- ************************************** MemberAddress
CREATE TABLE MemberAddress
(
 memberAddressID integer NOT NULL GENERATED ALWAYS AS IDENTITY (
 start 1000
 ),
 memberID        integer NOT NULL,
 street1         varchar(50) NOT NULL,
 street2         varchar(50) NULL,
 street3         varchar(50) NULL,
 city            varchar(50) NOT NULL,
 state           varchar(50) NOT NULL,
 zip             varchar(10) NOT NULL,
 createdBy       integer NOT NULL,
 lastUpdateBy    integer NOT NULL,
 createdDate     timestamp with time zone default current_timestamp,
 lastUpdate      timestamp with time zone default current_timestamp,
 CONSTRAINT PK_MemberAddress PRIMARY KEY ( memberAddressID ),
 CONSTRAINT FK_MemberAddress_Member_1 FOREIGN KEY ( memberID ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_MemberAddress_Member_2 FOREIGN KEY ( createdBy ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_MemberAddress_Member_3 FOREIGN KEY ( lastUpdateBy ) REFERENCES Member ( memberID )
);

CREATE INDEX ON MemberAddress
(
 memberID
);

CREATE INDEX ON MemberAddress
(
 createdBy
);

CREATE INDEX ON MemberAddress
(
 lastUpdateBy
);

-- ************************************** MemberEmergencyContact
CREATE TABLE MemberEmergencyContact
(
 memberEmergencyContactID integer NOT NULL GENERATED ALWAYS AS IDENTITY (
 start 1000
 ),
 memberID                 integer NOT NULL,
 contactFullName          varchar(100) NOT NULL,
 contactCellPhone         varchar(50) NOT NULL,
 contactHomePhone         varchar(50) NOT NULL,
 createdBy                integer NOT NULL,
 lastUpdateBy             integer NOT NULL,
 createdDate              timestamp with time zone default current_timestamp,
 lastUpdate               timestamp with time zone default current_timestamp,
 CONSTRAINT PK_MemberEmergencyContact PRIMARY KEY ( memberEmergencyContactID ),
 CONSTRAINT FK_MemberEmergencyContatct_Member_1 FOREIGN KEY ( memberID ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_MemberEmergencyContatct_Member_2 FOREIGN KEY ( createdBy ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_MemberEmergencyContatct_Member_3 FOREIGN KEY ( lastUpdateBy ) REFERENCES Member ( memberID )
);

CREATE INDEX ON MemberEmergencyContact
(
 memberID
);

CREATE INDEX ON MemberEmergencyContact
(
 createdBy
);

CREATE INDEX ON MemberEmergencyContact
(
 lastUpdateBy
);

-- ************************************** MemberPhone
CREATE TABLE MemberPhone
(
 memberPhoneID integer NOT NULL GENERATED ALWAYS AS IDENTITY (
 start 1000
 ),
 memberID      integer NOT NULL,
 phoneTypeID   integer NOT NULL,
 phoneNumber   varchar(50) NOT NULL,
 isPrimary     boolean NOT NULL,
 createdBy     integer NOT NULL,
 lastUpdateBy  integer NOT NULL,
 createdDate   timestamp with time zone default current_timestamp,
 lastUpdate    timestamp with time zone default current_timestamp,
 CONSTRAINT PK_MemberPhone PRIMARY KEY ( memberPhoneID ),
 CONSTRAINT FK_MemberPhone_Member_1 FOREIGN KEY ( memberID ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_MemberPhone_Member_2 FOREIGN KEY ( createdBy ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_MemberPhone_Member_3 FOREIGN KEY ( lastUpdateBy ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_PhoneTypeID FOREIGN KEY ( phoneTypeID ) REFERENCES PhoneType ( phoneTypeID ),
);

CREATE INDEX  ON MemberPhone
(
 memberID
);

CREATE INDEX  ON MemberPhone
(
 createdBy
);

CREATE INDEX  ON MemberPhone
(
 lastUpdateBy
);
--this ensures that a member can only have 1 primary phone
CREATE UNIQUE INDEX ON MemberPhone (memberID) WHERE isPrimary = true;

