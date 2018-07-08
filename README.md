# JBZoo TeamcityKeyKeeper  [![Build Status](https://travis-ci.org/JBZoo/TeamcityKeyKeeper.svg?branch=master)](https://travis-ci.org/JBZoo/TeamcityKeyKeeper)      [![Coverage Status](https://coveralls.io/repos/github/JBZoo/TeamcityKeyKeeper/badge.svg?branch=master)](https://coveralls.io/github/JBZoo/TeamcityKeyKeeper?branch=master)

#### PHP library description

[![License](https://poser.pugx.org/JBZoo/TeamcityKeyKeeper/license)](https://packagist.org/packages/JBZoo/TeamcityKeyKeeper)   [![Latest Stable Version](https://poser.pugx.org/JBZoo/TeamcityKeyKeeper/v/stable)](https://packagist.org/packages/JBZoo/TeamcityKeyKeeper) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/JBZoo/TeamcityKeyKeeper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/JBZoo/TeamcityKeyKeeper/?branch=master)

### Example

```php
require_once './vendor/autoload.php'; // composer autoload.php

// Get needed classes
use JBZoo\TeamcityKeyKeeper\TeamcityKeyKeeper;

// Just use it!
$object = new TeamcityKeyKeeper();
$object->doSomeMagic(':)');
```

## Unit tests and check code style
```sh
make
make test-all
```


### License

MIT
