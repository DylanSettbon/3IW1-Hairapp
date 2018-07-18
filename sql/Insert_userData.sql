INSERT INTO categoryType(type) VALUES ('Article'),('Produits'),('Forfaits');


INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )
VALUES( 'FN_TOCHANGE', 'LN_TOCHANGE', 'MAIL_TOCHANGE',
                       'PWD_TOCHANGE', 'TOKEN_TOCHANGE', 'TEL_TOCHANGE', 0, 0, 'STATUS_TOCHANGE', 'DATE_TOCHANGE',
                       'DATE_TOCHANGE', null, null );

INSERT INTO color(name,code) VALUES ('current','#637484'),('standard','#637484'),('currentBtn','#009CDF'),('standardBtn','#009CDF');

INSERT INTO configuration( logo, email_address, email_pwd, postal_address, status_configuration , facebook_link, twitter_link, instagram_link, pinterest_link )
VALUES( 'LOGO_TOCHANGE', ' EMAILADDRESS_TOCHANGE', 'EMAILPWD_TO_CHANGE',
        'POSTAL_TOCHANGE', 'STATUSCONFIG_TOCHANGE' , 'FACEBOOK', 'TWITTER' , 'INSTAGRAM', 'PINTEREST' )