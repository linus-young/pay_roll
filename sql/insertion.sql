SET time_zone = "+08:00";


INSERT INTO types VALUES(1, 'Administrator', 'daily', 2000);
INSERT INTO types VALUES(2, 'Project Manager', 'daily', 1000);
INSERT INTO types VALUES(3, 'Software Engineer', 'daily', 900);
INSERT INTO types VALUES(4, 'Intern', 'hourly', 25);


INSERT INTO employees VALUES(1, 'admin', MD5('admin'), 6222021001092553233, 1, 1);
INSERT INTO employees VALUES(2, 'zx', MD5('zx'), 6222021001092553234, 2, 0);
INSERT INTO employees VALUES(3, 'ylm', MD5('ylm'), 6222021001092553235, 3, 0);
INSERT INTO employees VALUES(4, 'hex', MD5('hex'), 6222021001092553236, 4, 0);



INSERT INTO timecards VALUES(1, '2013-12-07 08:00:00', '2013-12-07 05:00:00', 0, 0);
INSERT INTO timecards VALUES(2, '2013-12-08 08:00:00', '2013-12-09 05:00:00', 0, 0);



INSERT INTO projects VALUES(1, 'PHP Pay Roll System');
INSERT INTO projects VALUES(2, 'Secret Project');
INSERT INTO projects VALUES(3, 'Design');

