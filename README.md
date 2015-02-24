# php-plantuml-wrap
Wrap for PlantUml on PHP. Quick generating UML diagrams.

### Installing with composer
```
"require": {
	"sufir/php-plantuml-wrap": "dev-master"
},
```

## Example 1
```php
    $plantuml = new PlantUml();

	// Create new component diagram
    $diagram = $plantuml->createDiagram('component')
        ->setUmlNotation(Component::NOTATION_UML1);

	// Create diagram elements
    $firstComponent = $plantuml->createElement('component', 'component', 'First Component')
        ->setNote("A note can also be\non several lines", 'right');
    $da = $plantuml->createElement('component', 'interface', 'Data Access');
    $http = $plantuml->createElement('component', 'interface', 'HTTP')
        ->setNote("Web Service only");

	// Create relations
    $rel1 = $plantuml->createRelation($firstComponent, $da)
        ->setDirection(Relation::DIRECTION_LEFT);
    $rel2 = $plantuml->createRelation()
        ->setFrom($firstComponent)
        ->setTo($http, Relation::ARROW_ASSOCIATION)
        ->setDirection(Relation::DIRECTION_BOTTOM)
        ->setLineType(Relation::LINE_DOTTED);

	// Assembly diagram
    $diagram->addElement($firstComponent)
        ->addElement($da)
        ->addElement($http)
        ->addRelation($rel1)
        ->addRelation($rel2);

	// Render diagram
    echo $plantuml->convertDiagram($diagram);
```

<img src="http://www.plantuml.com:80/plantuml/png/hP7DIiD058NtUOfBDwvQ9ibC9hCHYY8k58HMNDzCRZIOJaec5Bfr9OBu1hw3XOAYxJDCtiWOVpUIXSvYO0xVOSwznrxcPeuLpa2NitbfoDIJUbaGd1uV-Pwt0-xUFJGtpPrRkMUtTXltwDRGt7QFbpUXkN9RjuBXtu_t5G461tbbQzZx50Q05f05AanydpCM9pAJd2jCbOpJA5OYPDepPKrGvUSNDPHPFpw6pg3H01QsX8Iyqe2b1LLOG94RiXwPjAEytDHKPQW91ljO8uor9ckxN77WQnKBP8g8qaWgducGb90yH26r_kazd4vFEbCK2qv1pALiMSaGVS6b2bCcXUP1mjw7AIZhPkcbpoY12LMBlFsaDCNoE_Xl7RfjszoclQy_fAT_wR1l6J3iBwOFWD5ejtybhm00">

## Example 2
```php
	$plantuml = new PlantUml();

	// Create new component diagram
    $diagram = $plantuml->createDiagram('component')
        ->setUmlNotation(Component::NOTATION_UML2);

    // Style for webservers
    $webserverSkin = $plantuml->createSkin()
        ->setBackgroundGradient('white', 'lightblue')
        ->setBorderColor('black');

    // Create elements stereotype https://en.wikipedia.org/wiki/Stereotype_(UML)
    $webserverStereotype = $plantuml->createStereotype('Web Server')
        ->setSkin($webserverSkin);

    // Create diagram elements
    $firstComponent = $plantuml->createElement('component', 'component', 'First Component')
        ->setNote("A note can also be\non several lines", 'right');
    $da = $plantuml->createElement('component', 'interface', 'Data Access');
    $http = $plantuml->createElement('component', 'interface', 'HTTP')
        ->setNote("Web Service only");
    $webserver1 = $plantuml->createElement('component', 'component', 'Apache')
        ->addStereotype($webserverStereotype);
    $webserver2 = $plantuml->createElement('component', 'component', 'Nginx')
        ->addStereotype($webserverStereotype);

    // Grouping components
    $webserversGroup = $plantuml->createElement('component', 'frame', 'Servers')
        ->addElement($webserver1)
        ->addElement($webserver2);

    // Create relations
    $rel1 = $plantuml->createRelation($firstComponent, $da)
        ->setDirection(Relation::DIRECTION_LEFT);
    $rel2 = $plantuml->createRelation()
        ->setFrom($firstComponent)
        ->setTo($http, Relation::ARROW_EXTENSION)
        ->setLabel('Rel label...')
        ->setDirection(Relation::DIRECTION_BOTTOM)
        ->setLineType(Relation::LINE_DOTTED);
    $rel3 = $plantuml->createRelation()
        ->setFrom($http)
        ->setTo($webserver1, Relation::ARROW_ASSOCIATION)
        ->setDirection(Relation::DIRECTION_RIGHT)
        ->setColor('darkgreen');
    $rel4 = $plantuml->createRelation()
        ->setFrom($http)
        ->setTo($webserver2, Relation::ARROW_ASSOCIATION)
        ->setDirection(Relation::DIRECTION_RIGHT)
        ->setColor('darkgreen');

    // Assembly diagram
    $diagram->addElement($firstComponent)
        ->addElement($da)
        ->addElement($http)
        ->addElement($webserversGroup)
        ->addRelation($rel1)
        ->addRelation($rel2)
        ->addRelation($rel3)
        ->addRelation($rel4);

    // Render diagram
    echo $plantuml->convertDiagram($diagram);
```

<img src="http://www.plantuml.com:80/plantuml/png/hLJTQjL04BxFKmp72wzwJB99Df5oe5J42nMn5I_4YzdTsJOqtPGahOeAAYXYbRw1u1lKseD7-kChRDx8FJbMMty8OlTYOMTdllc6xsFgjTniO8Nh8ClrZTAGQPQQHmN1dHlNGy-x2FQz_TY-QNVidZsmOtja9tOCxRlkSJWDj2_iiTs3kVy_tWyACBYQLtK3YoU10M0DWh4in8XOGZnAOwbu6lEOIwrq76HSUQPi2AfyPRM1KlUdBq1N8D405dK9WhpIG4rRL641HMweziYeBilBJKELHaamk88DmeAKLDSThup45DTN6KimqvBvI66WcCW4XaBfqxNNbfTlTKLnAdZ6cOeLKqdY2v5Wo2A6CevOeaKy6wOWtStIctsN12nHjPMx9gKf7lqahfsuhl7qawePOL_wCiFCvqaGSi4ZpLM0F9KHne4YAU6n1t1AZ8KDbAiqqq0cd2la8GzJdMPfu8WeZ51hz5cOX30_VqA5gj7eBCxDbTmyx61KobWiD8M-ZbDoT9908AEKKXdhbEjVOPvwV_MYFNOEF7Btw--XB-VYnJvHOQxVO7q9C1m-6VLg2vS7jydv4GKLm-5muFKMpDsxeB1QMwc8pFrHhsR_3DYdNgVL1oVBnEaqiP_jRllAJjeTiFlkkMi_jS_SVMWFs-rpqUfCkvaXzfqP3jgtRZrjjo-XVUv2OzTrt7rExDVfplBgtvTVPts1qirQRXgrM1PbTTQBy60rR-XICLqpejYaQNvPAQh-b2iA1-NS-mq0">