INSERT INTO categoryType(type) VALUES ('Article'),('Produits'),('Forfaits');


INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )
VALUES( 'FN_TOCHANGE', 'LN_TOCHANGE', 'MAIL_TOCHANGE',
                       'PWD_TOCHANGE', 'TOKEN_TOCHANGE', 'TEL_TOCHANGE', 0, 0, 'STATUS_TOCHANGE', 'DATE_TOCHANGE',
                       'DATE_TOCHANGE', null, null );

INSERT INTO color(name,code)
VALUES ('current','#637484'),
  ('standard','#637484'),
  ('currentBtn','#009CDF'),
  ('standardBtn','#009CDF'),
  ('currentColorHome','#ffffff'),
  ('standardColorHome','#ffffff'),
  ('public/img/barber1.jpg','first'),
  ('public/img/barber1.jpg','nFirst'),
  ('public/img/barber2.jpg','second'),
  ('public/img/barber2.jpg','nSecond'),
  ('public/img/barber3.jpg','third'),
  ('public/img/barber3.jpg','nThird'),
  ('salon coiffure.jpeg','fond'),
  ('salon coiffure.jpeg','nFond');

INSERT INTO configuration( logo, name, email_address, email_pwd, postal_address, status_configuration , facebook_link, twitter_link, instagram_link, pinterest_link )
VALUES( 'LOGO_TOCHANGE', 'NAME_TOCHANGE', ' EMAILADDRESS_TOCHANGE', 'EMAILPWD_TO_CHANGE',
        'POSTAL_TOCHANGE', 'STATUSCONFIG_TOCHANGE' , 'FACEBOOK', 'TWITTER' , 'INSTAGRAM', 'PINTEREST' )