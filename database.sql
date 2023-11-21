CREATE TABLE data_mahasiswa (
    nomer INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255),
    nim VARCHAR(15) UNIQUE,
    program_studi VARCHAR(70)
);

INSERT INTO data_mahasiswa (nama, nim, program_studi) VALUES
('Muhammad Farhan Annaufal', '121140190', 'Teknik Informatika'),
('Nanda Dwi Setiawan', '121210029', 'Teknik Sipil'),
('Rafli Ahmad Maulana', '122420156', 'Rekayasa Kehutanan'),
('Muhammad Fabil', '121140189', 'Teknik Informatika'),
('Rizkia Desta Fitriani', '121190017', 'Teknik Industri');