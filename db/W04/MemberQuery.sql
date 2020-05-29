--General Member Directory
SELECT m.memberid , m.preferredname || ' ' || m.lastname AS fullname, m.callsign, p.phonenumber
FROM Member m JOIN MemberPhone p ON m.memberid = p.memberid
WHERE p.isprimary = true
ORDER BY m.lastname, m.firstname DESC;