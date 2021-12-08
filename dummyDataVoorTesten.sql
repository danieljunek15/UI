INSERT INTO companies (name, url, latitude, longitude, tags_id, software_skils, blacklisted, email, postal_code, street, address_number, province)
VALUES ('Bit Academy', 'https://www.bit-academy.nl', 52.35577, 4.84148, 1, '["PHP", "CSS", "JS", "SQL", "HTML"]', "No", "info@bit-academy.nl", "1062HG", "Kon. Wilhelminaplein",  1, "Amsterdam");

INSERT INTO tags (companie_id, name)
VALUES 
(1, 'Nice'),
(1, 'Perfect');