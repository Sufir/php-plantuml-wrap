# php-plantuml-wrap
Wrap for PlantUml on PHP. Quickly generation UML diagrams.

## Example 1
```php
    $plantuml = new PlantUml();

	// Create new diagram
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