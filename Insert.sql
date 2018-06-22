INSERT INTO CategoryType(type) 
VALUES  ('Article'),
		    ('Produits'),
		    ('Forfaits');


INSERT INTO user(firstname,lastname,email,pwd,token,status)
VALUES ('test1','test1','test1@hotmail.fr','123','123',2),
       ('test2','test2','test2@hotmail.fr','123','123',2),
       ('test3','test3','test3@hotmail.fr','133','133',2),
       ('test4','test4','test4@hotmail.fr','144','144',2),
      ('test5','test5','test5@hotmail.fr','155','155',2);

INSERT INTO Appointment(dateAppointment,hourAppointment,id_user,id_Hairdresser,id_Package)
VALUES (20180619,143000,22,14,3),
      (20180619,163000,22,14,3),
      (20180623,18000,22,14,3),
      (20180623,141500,22,14,3);