/*INSERT INTO user(firstname,lastname,email,pwd,token,status)
VALUES ('test1','test1','test1@hotmail.fr','123','123',2),
       ('test2','test2','test2@hotmail.fr','123','123',2),
       ('test3','test3','test3@hotmail.fr','133','133',2),
       ('test4','test4','test4@hotmail.fr','144','144',2),
      ('test5','test5','test5@hotmail.fr','155','155',2);

INSERT INTO Appointment(dateAppointment,hourAppointment,id_user,id_Hairdresser,id_Package)
VALUES (20180619,143000,22,3,1),
      (20180619,163000,22,3,1),
      (20180623,18000,22,3,1),
      (20180623,141500,22,3,1);*/

      INSERT INTO categoryType(type)
      VALUES  ('Article'),('Produits'),('Forfaits');


INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )
    VALUES( 'FN_TOCHANGE', 'LN_TOCHANGE', 'MAIL_TOCHANGE',
                         'PWD_TOCHANGE', 'TOKEN_TOCHANGE', 'TEL_TOCHANGE', 0, 0, 'STATUS_TOCHANGE', 'DATE_TOCHANGE',
                         'DATE_TOCHANGE', null, null );

INSERT INTO color(name,code)
VALUES ('current','#637484'),
       ('standard','#637484'),
       ('currentBtn','#009CDF'),
       ('standardBtn','#009CDF');

INSERT INTO configuration( logo, email_address, email_pwd, postal_address, status_configuration , facebook_link, twitter_link, instagram_link, pinterest_link )
VALUES( 'LOGO_TOCHANGE', ' EMAILADDRESS_TOCHANGE', 'EMAILPWD_TO_CHANGE',
'POSTAL_TOCHANGE', 'STATUSCONFIG_TOCHANGE' , 'FACEBOOK', 'TWITTER' , 'INSTAGRAM', 'PINTEREST' )