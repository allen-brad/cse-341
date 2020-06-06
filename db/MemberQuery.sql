--Get General Member Directory
SELECT m.memberid , m.preferredname || ' ' || m.lastname AS fullname, m.callsign, p.phonenumber
FROM Member m JOIN MemberPhone p ON m.memberid = p.memberid
WHERE p.isprimary = true
ORDER BY m.lastname, m.firstname DESC;


--Get Member Detail
SELECT m.memberid , m.firstname, m.middlename, m.lastname, m.preferredname, m.callsign, m.dob,
        m.saremail, m.personalemail, m.dlnumber, m.dlstate, m.ssnlastfour, s.memberstatustype, e.contactfullname, e.contactcellphone, e.contacthomephone
FROM Member m
JOIN MemberStatus s ON m.memberstatusid = s.memberstatusid
JOIN MemberEmergencyContact e ON m.memberid = e.memberid
WHERE m.memberid = 1000;

--Get Member Phone Numbers
SELECT p.phonetype, p.phonenumber, p.isprimary
FROM MemberPhone p
JOIN Member m ON p.memberid = m.memberid
WHERE m.memberid = 1001
ORDER BY p.isprimary DESC;

--Get Member Addresses
SELECT a.street1, a.street2, a.street3, a.city, a.state, a.zip
FROM MemberAddress a 
JOIN Member m ON a.memberid = m.memberid
WHERE m.memberid = 1000;

--Get Member Status
SELECT m.memberstatusid, m.memberstatustype
FROM MemberStatus m 
ORDER BY m.memberstatustype ASC;

--Member
