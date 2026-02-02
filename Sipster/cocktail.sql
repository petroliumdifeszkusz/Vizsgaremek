CREATE TABLE termekek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(100) NOT NULL,
    leiras TEXT,
    ar INT NOT NULL,
    kep_nev VARCHAR(100) DEFAULT 'default.jpg'
);

INSERT INTO termekek (nev, leiras, ar) VALUES 
('Mojito', 'Menta, lime, rum, szóda', 1800),
('Pina Colada', 'Ananász, kókusz, rum', 2200),
('Gin Tonic', 'Gin, tonik, uborka', 1900);