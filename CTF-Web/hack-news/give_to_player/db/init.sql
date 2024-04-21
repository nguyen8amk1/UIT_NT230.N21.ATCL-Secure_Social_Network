USE chall;

CREATE TABLE users
(
    username VARCHAR(100) PRIMARY KEY,
    password VARCHAR(100)
);

CREATE TABLE news
(
    name VARCHAR(100),
    content VARCHAR(1000),
    private BOOLEAN
);

INSERT INTO users VALUES ("guest", "123456"), ("4dm1n", HEX(RANDOM_BYTES(28)));

INSERT INTO news VALUES ("VNDIRECT", "Stock brokerage VNDirect said it was under cyberattack on Sunday but was able to overcome it by Monday morning though its website remained inaccessible.", 0), 
                        ("UIT was underattack", "The attack happened on 30 Feb 2808. And the attacker modified the data of Web and Application Security subject, and every students got 10 on that subject. The security researcher said it was the one who could not solve this challenge.", 0),
                        ("xz backdoor", "Supply chain backdoor affected many computers.", 0);

GRANT CREATE, INSERT, SELECT ON chall.* TO 'hackernews'@'%';
GRANT FILE ON *.* to 'hackernews'@'%';
FLUSH PRIVILEGES;
