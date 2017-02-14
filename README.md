# php-lemmatizer

PHP Lemmatizer is a lemmatization library for PHP to retrieve a base form from an inflected form word in English.

Inspired by [JavaScript Lemmatizer](https://github.com/takafumir/javascript-lemmatizer) but the returned values are different from it.

## Installation

### With Composer

```
$ composer require skyeng/php-lemmatizer
```

```json
{
    "require": {
        "skyeng/php-lemmatizer": "^1.0"
    }
}
```

## Usage

```php
<?php

use Skyeng\Lemmatizer;
use Skyeng\Lemma;

// Require Composer's autoloader
require_once __DIR__ . "/vendor/autoload.php";

$lemmatizer = new Lemmatizer();

// retrieve a lemma with a part of speech.
// you can assign Lemma::POS_VERB or Lemma::POS_NOUN or Lemma::POS_ADJECTIVE or
// POS_ADVERB as a part of speech.
$lemmas = $lemmatizer->getLemmas('desks', Lemma::POS_NOUN); // => [ new Lemma('desk', Lemma::POS_NOUN) ]

// of course, available for irregular inflected form words.
$lemmas = $lemmatizer->getLemmas('went', Lemma::POS_VERB); // => [ new Lemma('go', Lemma::POS_VERB) ]
$lemmas = $lemmatizer->getLemmas('better', Lemma::POS_ADJECTIVE); // => [ new Lemma('better', Lemma::POS_ADJECTIVE), new Lemma('good', Lemma::POS_ADJECTIVE) ]

// when multiple base forms are found, return all of them.
$lemmas = $lemmatizer->getLemmas('leaves', Lemma::POS_NOUN); // => [ new Lemma('leave', Lemma::POS_NOUN), new Lemma('leaf', Lemma::POS_NOUN) ]

// retrieve a lemma without a part of speech.
$lemmas = $lemmatizer->getLemmas('sitting'); // => [ new Lemma('sit', Lemma::POS_VERB), new Lemma('sitting', Lemma::POS_ADJECTIVE) ]

// retrieve only lemmas not including part of speeches in the returned value.
$lemmas = $lemmatizer->getOnlyLemmas('desks', Lemma::POS_NOUN); // => [ 'desk' ]
$lemmas = $lemmatizer->getOnlyLemmas('coded', Lemma::POS_VERB); // => [ 'code' ]
$lemmas = $lemmatizer->getOnlyLemmas('leaves'); // => [ 'leave', 'leaf' ]
```

## Limitations
```php
// Lemmatizer leaves alone a word not included in it's dictionary index.
$lemmas = $lemmatizer->getLemmas('MacBooks'); // => [ new Lemma('MacBooks', Lemma::POS_NOUN) ]
```

## Contribution

1. Fork it ( https://github.com/skyeng/php-lemmatizer )
1. Create your feature branch (git checkout -b my-new-feature)
1. Commit your changes (git commit -am 'Add some feature')
1. Push to the branch (git push origin my-new-feature)
1. Create a new Pull Request

## Licence

[MIT License](https://github.com/skyeng/php-lemmatizer/blob/master/LICENSE)
