<?php

use Skyeng\Lemma;
use Skyeng\Lemmatizer;

class LemmatizationTest extends PHPUnit_Framework_TestCase {
  /**
   * @var Lemmatizer
   */
  private static $lemmatizer;

  public static function setUpBeforeClass() {
    self::$lemmatizer = new Lemmatizer();
  }

  /**
   * Lemmatizer leaves alone words that its dictionary does not contain.
   */
  public function testLemmatizationUnknownWord() {
    $this->assertEquals(self::$lemmatizer->getLemmas('MacBooks', 'noun'), [new Lemma('MacBooks', 'noun')]);
  }

  /**
   * Lemmatizer leaves alone non-existing words.
   */
  public function testLemmatizationNotExistingWord() {
    $this->assertEquals(self::$lemmatizer->getLemmas('abcdefg'), [new Lemma('abcdefg')]);
  }

  /**
   * @return array
   */
  public function withPosProvider() {
    return [
      [['wives', Lemma::POS_NOUN], [new Lemma('wife', Lemma::POS_NOUN)]],
      [['desks', Lemma::POS_NOUN], [new Lemma('desk', Lemma::POS_NOUN)]],
      [['hired', Lemma::POS_VERB], [new Lemma('hire', Lemma::POS_VERB)]],
      [['worried', Lemma::POS_VERB], [new Lemma('worry', Lemma::POS_VERB)]],
      [['partying', Lemma::POS_VERB], [new Lemma('party', Lemma::POS_VERB)]],
      [
        ['better', Lemma::POS_ADJECTIVE],
        [new Lemma('better', Lemma::POS_ADJECTIVE), new Lemma('good', Lemma::POS_ADJECTIVE)],
      ],
      [['hotter', Lemma::POS_ADJECTIVE], [new Lemma('hot', Lemma::POS_ADJECTIVE)]],
      [['best', Lemma::POS_ADVERB], [new Lemma('best', Lemma::POS_ADVERB), new Lemma('well', Lemma::POS_ADVERB)]],
      [
        ['best', Lemma::POS_ADJECTIVE],
        [new Lemma('best', Lemma::POS_ADJECTIVE), new Lemma('good', Lemma::POS_ADJECTIVE)],
      ],
      [['goes', Lemma::POS_VERB], [new Lemma('go', Lemma::POS_VERB)]],
      [['went', Lemma::POS_VERB], [new Lemma('go', Lemma::POS_VERB)]],
      [['gone', Lemma::POS_VERB], [new Lemma('go', Lemma::POS_VERB)]],
      [['writes', Lemma::POS_VERB], [new Lemma('write', Lemma::POS_VERB)]],
      [['wrote', Lemma::POS_VERB], [new Lemma('write', Lemma::POS_VERB)]],
      [['written', Lemma::POS_VERB], [new Lemma('write', Lemma::POS_VERB)]],
      [['confirms', Lemma::POS_VERB], [new Lemma('confirm', Lemma::POS_VERB)]],
      [['confirmed', Lemma::POS_VERB], [new Lemma('confirm', Lemma::POS_VERB)]],
      [['confirming', Lemma::POS_VERB], [new Lemma('confirm', Lemma::POS_VERB)]],
      [['acidless', Lemma::POS_NOUN], [new Lemma('acidless', Lemma::POS_NOUN)]],
      [['pizzas', Lemma::POS_NOUN], [new Lemma('pizza', Lemma::POS_NOUN)]],
      [['foxes', Lemma::POS_NOUN], [new Lemma('fox', Lemma::POS_NOUN)]],
      [['hacked', Lemma::POS_VERB], [new Lemma('hack', Lemma::POS_VERB)]],
      [['hacking', Lemma::POS_VERB], [new Lemma('hack', Lemma::POS_VERB)]],
      [['coded', Lemma::POS_VERB], [new Lemma('code', Lemma::POS_VERB)]],
      [['coding', Lemma::POS_VERB], [new Lemma('code', Lemma::POS_VERB)]],
      [['fitting', Lemma::POS_VERB], [new Lemma('fit', Lemma::POS_VERB)]],
      [['pirouetting', Lemma::POS_VERB], [new Lemma('pirouette', Lemma::POS_VERB)]],
      [
        ['earliest', Lemma::POS_ADJECTIVE],
        [new Lemma('earliest', Lemma::POS_ADJECTIVE), new Lemma('early', Lemma::POS_ADJECTIVE)],
      ],
      [['biggest', Lemma::POS_ADJECTIVE], [new Lemma('big', Lemma::POS_ADJECTIVE)]],
      [['largest', Lemma::POS_ADJECTIVE], [new Lemma('large', Lemma::POS_ADJECTIVE)]],
      [['smallest', Lemma::POS_ADJECTIVE], [new Lemma('small', Lemma::POS_ADJECTIVE)]],
      [
        ['earlier', Lemma::POS_ADJECTIVE],
        [new Lemma('earlier', Lemma::POS_ADJECTIVE), new Lemma('early', Lemma::POS_ADJECTIVE)],
      ],
      [
        ['bigger', Lemma::POS_ADJECTIVE],
        [new Lemma('bigger', Lemma::POS_ADJECTIVE), new Lemma('big', Lemma::POS_ADJECTIVE)],
      ],
      [
        ['larger', Lemma::POS_ADJECTIVE],
        [new Lemma('larger', Lemma::POS_ADJECTIVE), new Lemma('large', Lemma::POS_ADJECTIVE)],
      ],
      [
        ['smaller', Lemma::POS_ADJECTIVE],
        [new Lemma('smaller', Lemma::POS_ADJECTIVE), new Lemma('small', Lemma::POS_ADJECTIVE)],
      ],
      [['recognizable', Lemma::POS_ADJECTIVE], [new Lemma('recognizable', Lemma::POS_ADJECTIVE)]],
      [['networkable', Lemma::POS_ADJECTIVE], [new Lemma('networkable', Lemma::POS_ADJECTIVE)]],
      [['resettability', Lemma::POS_NOUN], [new Lemma('resettability', Lemma::POS_NOUN)]],
      [['repairability', Lemma::POS_NOUN], [new Lemma('repairability', Lemma::POS_NOUN)]],
      [['reorganizability', Lemma::POS_NOUN], [new Lemma('reorganizability', Lemma::POS_NOUN)]],
      [['starts', Lemma::POS_VERB], [new Lemma('start', Lemma::POS_VERB)]],
      [['teaches', Lemma::POS_VERB], [new Lemma('teach', Lemma::POS_VERB)]],
      [['talked', Lemma::POS_VERB], [new Lemma('talk', Lemma::POS_VERB)]],
      [['saved', Lemma::POS_VERB], [new Lemma('save', Lemma::POS_VERB)]],
      [['sitting', Lemma::POS_VERB], [new Lemma('sit', Lemma::POS_VERB)]],
      [['having', Lemma::POS_VERB], [new Lemma('have', Lemma::POS_VERB)]],
      [['talking', Lemma::POS_VERB], [new Lemma('talk', Lemma::POS_VERB)]],
      [['heavier', Lemma::POS_ADJECTIVE], [new Lemma('heavy', Lemma::POS_ADJECTIVE)]],
      [
        ['bigger', Lemma::POS_ADJECTIVE],
        [new Lemma('bigger', Lemma::POS_ADJECTIVE), new Lemma('big', Lemma::POS_ADJECTIVE)],
      ],
      [['huger', Lemma::POS_ADJECTIVE], [new Lemma('huge', Lemma::POS_ADJECTIVE)]],
      [['hugest', Lemma::POS_ADJECTIVE], [new Lemma('huge', Lemma::POS_ADJECTIVE)]],
      [['lower', Lemma::POS_ADJECTIVE], [new Lemma('low', Lemma::POS_ADJECTIVE)]],
      [['writable', Lemma::POS_ADJECTIVE], [new Lemma('writable', Lemma::POS_ADJECTIVE)]],
      [['readable', Lemma::POS_ADJECTIVE], [new Lemma('readable', Lemma::POS_ADJECTIVE)]],
      [['readability', Lemma::POS_NOUN], [new Lemma('readability', Lemma::POS_NOUN)]],
      [['writability', Lemma::POS_NOUN], [new Lemma('writability', Lemma::POS_NOUN)]],
      [['scoreless', Lemma::POS_NOUN], [new Lemma('scoreless', Lemma::POS_NOUN)]],
      [['dogs', Lemma::POS_NOUN], [new Lemma('dog', Lemma::POS_NOUN)]],
      [['dishes', Lemma::POS_NOUN], [new Lemma('dish', Lemma::POS_NOUN)]],
      [['heaviest', Lemma::POS_ADJECTIVE], [new Lemma('heavy', Lemma::POS_ADJECTIVE)]],
      [
        ['lowest', Lemma::POS_ADJECTIVE],
        [new Lemma('lowest', Lemma::POS_ADJECTIVE), new Lemma('low', Lemma::POS_ADJECTIVE)],
      ],
      [
        ['higher', Lemma::POS_ADJECTIVE],
        [new Lemma('higher', Lemma::POS_ADJECTIVE), new Lemma('high', Lemma::POS_ADJECTIVE)],
      ],
      [['leaves', Lemma::POS_NOUN], [new Lemma('leave', Lemma::POS_NOUN), new Lemma('leaf', Lemma::POS_NOUN)]],
      [['player', Lemma::POS_NOUN], [new Lemma('player', Lemma::POS_NOUN)]],
      [['priorities', Lemma::POS_NOUN], [new Lemma('priority', Lemma::POS_NOUN)]],
      [['matter', Lemma::POS_VERB], [new Lemma('matter', Lemma::POS_VERB)]],
      [['matter', Lemma::POS_NOUN], [new Lemma('matter', Lemma::POS_NOUN)]],
      [
        ['matter', Lemma::POS_ADJECTIVE],
        [
          new Lemma('matte', Lemma::POS_ADJECTIVE),
          new Lemma('matt', Lemma::POS_ADJECTIVE),
          new Lemma('mat', Lemma::POS_ADJECTIVE),
        ],
      ],
      [['added', Lemma::POS_VERB], [new Lemma('add', Lemma::POS_VERB)]],
      [['opposes', Lemma::POS_VERB], [new Lemma('oppose', Lemma::POS_VERB)]],
      [['singing', Lemma::POS_VERB], [new Lemma('sing', Lemma::POS_VERB)]],
      [['dying', Lemma::POS_VERB], [new Lemma('die', Lemma::POS_VERB)]],
      [['after', Lemma::POS_ADVERB], [new Lemma('after', Lemma::POS_ADVERB), new Lemma('aft', Lemma::POS_ADVERB)]],
      [['us', Lemma::POS_NOUN], [new Lemma('us', Lemma::POS_NOUN)]],
    ];
  }

  /**
   * Lemmatize a word with a part of speech (pos).
   *
   * @dataProvider withPosProvider
   *
   * @param array $wordWithPos
   * @param Lemma[] $expectedResult
   */
  public function testLemmatizationWithPos(array $wordWithPos, array $expectedResult) {
    $lemmas = self::$lemmatizer->getLemmas(...$wordWithPos);
    $message = $this->getMessage($expectedResult, $lemmas);
    $this->assertEquals(count($expectedResult), count($lemmas), $message);
    foreach($expectedResult as $expectedLemma) {
      $this->assertContains($expectedLemma, $lemmas, $message, false, false);
    }
  }

  /**
   * @return array
   */
  public function withoutPosProvider() {
    return [
      [['wives'], [new Lemma('wife', Lemma::POS_NOUN), new Lemma('wive', Lemma::POS_VERB)]],
      [['plays'], [new Lemma('play', Lemma::POS_VERB), new Lemma('play', Lemma::POS_NOUN)]],
      [['oxen'], [new Lemma('oxen', Lemma::POS_NOUN), new Lemma('ox', Lemma::POS_NOUN)]],
      [['fired'], [new Lemma('fire', Lemma::POS_VERB), new Lemma('fired', Lemma::POS_ADJECTIVE)]],
      [
        ['slower'],
        [
          new Lemma('slower', Lemma::POS_ADVERB),
          new Lemma('slow', Lemma::POS_ADVERB),
          new Lemma('slow', Lemma::POS_ADJECTIVE),
        ],
      ],
      [['goes'], [new Lemma('go', Lemma::POS_VERB), new Lemma('go', Lemma::POS_NOUN)]],
      [['went'], [new Lemma('go', Lemma::POS_VERB)]],
      [['gone'], [new Lemma('go', Lemma::POS_VERB), new Lemma('gone', Lemma::POS_ADJECTIVE)]],
      [['writes'], [new Lemma('write', Lemma::POS_VERB)]],
      [['wrote'], [new Lemma('write', Lemma::POS_VERB)]],
      [['written'], [new Lemma('write', Lemma::POS_VERB), new Lemma('written', Lemma::POS_ADJECTIVE)]],
      [['confirms'], [new Lemma('confirm', Lemma::POS_VERB)]],
      [['confirmed'], [new Lemma('confirm', Lemma::POS_VERB), new Lemma('confirmed', Lemma::POS_ADJECTIVE)]],
      [['confirming'], [new Lemma('confirm', Lemma::POS_VERB), new Lemma('confirming', Lemma::POS_ADJECTIVE)]],
      [['acidless'], [new Lemma('acidless')]],
      [['pizzas'], [new Lemma('pizza', Lemma::POS_NOUN)]],
      [['foxes'], [new Lemma('fox', Lemma::POS_VERB), new Lemma('fox', Lemma::POS_NOUN)]],
      [['hacked'], [new Lemma('hack', Lemma::POS_VERB)]],
      [['coded'], [new Lemma('code', Lemma::POS_VERB)]],
      [['coding'], [new Lemma('code', Lemma::POS_VERB), new Lemma('coding', Lemma::POS_NOUN)]],
      [
        ['fitting'],
        [
          new Lemma('fit', Lemma::POS_VERB),
          new Lemma('fitting', Lemma::POS_NOUN),
          new Lemma('fitting', Lemma::POS_ADJECTIVE),
        ],
      ],
      [['pirouetting'], [new Lemma('pirouette', Lemma::POS_VERB)]],
      [['hacking'], [new Lemma('hack', Lemma::POS_VERB)]],
      [
        ['earliest'],
        [
          new Lemma('earliest', Lemma::POS_ADVERB),
          new Lemma('early', Lemma::POS_ADVERB),
          new Lemma('earliest', Lemma::POS_ADJECTIVE),
          new Lemma('early', Lemma::POS_ADJECTIVE),
        ],
      ],
      [['biggest'], [new Lemma('big', Lemma::POS_ADVERB), new Lemma('big', Lemma::POS_ADJECTIVE)]],
      [['largest'], [new Lemma('large', Lemma::POS_ADVERB), new Lemma('large', Lemma::POS_ADJECTIVE)]],
      [['smallest'], [new Lemma('small', Lemma::POS_ADVERB), new Lemma('small', Lemma::POS_ADJECTIVE)]],
      [
        ['bigger'],
        [
          new Lemma('big', Lemma::POS_ADVERB),
          new Lemma('bigger', Lemma::POS_ADJECTIVE),
          new Lemma('big', Lemma::POS_ADJECTIVE),
        ],
      ],
      [
        ['earlier'],
        [
          new Lemma('earlier', Lemma::POS_ADVERB),
          new Lemma('early', Lemma::POS_ADVERB),
          new Lemma('earlier', Lemma::POS_ADJECTIVE),
          new Lemma('early', Lemma::POS_ADJECTIVE),
        ],
      ],
      [
        ['larger'],
        [
          new Lemma('large', Lemma::POS_ADVERB),
          new Lemma('larger', Lemma::POS_ADJECTIVE),
          new Lemma('large', Lemma::POS_ADJECTIVE),
        ],
      ],
      [
        ['smaller'],
        [
          new Lemma('small', Lemma::POS_ADVERB),
          new Lemma('smaller', Lemma::POS_ADJECTIVE),
          new Lemma('small', Lemma::POS_ADJECTIVE),
        ],
      ],
      [['recognizable'], [new Lemma('recognize', Lemma::POS_VERB), new Lemma('recognizable', Lemma::POS_ADJECTIVE)]],
      [['networkable'], [new Lemma('network', Lemma::POS_VERB)]],
      [['resettability'], [new Lemma('reset', Lemma::POS_VERB)]],
      [['repairability'], [new Lemma('repair', Lemma::POS_VERB)]],
      [['reorganizability'], [new Lemma('reorganize', Lemma::POS_VERB)]],
      [['starts'], [new Lemma('start', Lemma::POS_VERB), new Lemma('start', Lemma::POS_NOUN)]],
      [['teaches'], [new Lemma('teach', Lemma::POS_VERB), new Lemma('teach', Lemma::POS_NOUN)]],
      [['talked'], [new Lemma('talk', Lemma::POS_VERB)]],
      [['saved'], [new Lemma('save', Lemma::POS_VERB), new Lemma('saved', Lemma::POS_ADJECTIVE)]],
      [
        ['sitting'],
        [
          new Lemma('sit', Lemma::POS_VERB),
          new Lemma('sitting', Lemma::POS_NOUN),
          new Lemma('sitting', Lemma::POS_ADJECTIVE),
        ],
      ],
      [['having'], [new Lemma('have', Lemma::POS_VERB)]],
      [['talking'], [new Lemma('talk', Lemma::POS_VERB), new Lemma('talking', Lemma::POS_NOUN)]],
      [['heavier'], [new Lemma('heavy', Lemma::POS_ADVERB), new Lemma('heavy', Lemma::POS_ADJECTIVE)]],
      [
        ['bigger'],
        [
          new Lemma('big', Lemma::POS_ADVERB),
          new Lemma('bigger', Lemma::POS_ADJECTIVE),
          new Lemma('big', Lemma::POS_ADJECTIVE),
        ],
      ],
      [['huger'], [new Lemma('huge', Lemma::POS_ADJECTIVE)]],
      [
        ['lower'],
        [
          new Lemma('lower', Lemma::POS_VERB),
          new Lemma('lower', Lemma::POS_NOUN),
          new Lemma('low', Lemma::POS_ADVERB),
          new Lemma('low', Lemma::POS_ADJECTIVE),
        ],
      ],
      [['writable'], [new Lemma('write', Lemma::POS_VERB)]],
      [['readable'], [new Lemma('read', Lemma::POS_VERB), new Lemma('readable', Lemma::POS_ADJECTIVE)]],
      [['resettable'], [new Lemma('reset', Lemma::POS_VERB)]],
      [['readability'], [new Lemma('read', Lemma::POS_VERB), new Lemma('readability', Lemma::POS_NOUN)]],
      [['writability'], [new Lemma('write', Lemma::POS_VERB)]],
      [['scoreless'], [new Lemma('scoreless', Lemma::POS_ADJECTIVE)]],
      [['dogs'], [new Lemma('dog', Lemma::POS_VERB), new Lemma('dog', Lemma::POS_NOUN)]],
      [['dishes'], [new Lemma('dish', Lemma::POS_VERB), new Lemma('dish', Lemma::POS_NOUN)]],
      [['heaviest'], [new Lemma('heavy', Lemma::POS_ADVERB), new Lemma('heavy', Lemma::POS_ADJECTIVE)]],
      [['biggest'], [new Lemma('big', Lemma::POS_ADVERB), new Lemma('big', Lemma::POS_ADJECTIVE)]],
      [['hugest'], [new Lemma('huge', Lemma::POS_ADJECTIVE)]],
      [
        ['lowest'],
        [
          new Lemma('lowest', Lemma::POS_ADVERB),
          new Lemma('low', Lemma::POS_ADVERB),
          new Lemma('lowest', Lemma::POS_ADJECTIVE),
          new Lemma('low', Lemma::POS_ADJECTIVE),
        ],
      ],
      [
        ['higher'],
        [
          new Lemma('high', Lemma::POS_ADVERB),
          new Lemma('higher', Lemma::POS_ADJECTIVE),
          new Lemma('high', Lemma::POS_ADJECTIVE),
        ],
      ],
      [
        ['leaves'],
        [
          new Lemma('leave', Lemma::POS_VERB),
          new Lemma('leave', Lemma::POS_NOUN),
          new Lemma('leaf', Lemma::POS_NOUN),
        ],
      ],
      [['player'], [new Lemma('player', Lemma::POS_NOUN)]],
      [['priorities'], [new Lemma('priority', Lemma::POS_NOUN)]],
      [
        ['matter'],
        [
          new Lemma('matter', Lemma::POS_VERB),
          new Lemma('matter', Lemma::POS_NOUN),
          new Lemma('matte', Lemma::POS_ADJECTIVE),
          new Lemma('mat', Lemma::POS_ADJECTIVE),
          new Lemma('matt', Lemma::POS_ADJECTIVE),
        ],
      ],
      [['added'], [new Lemma('add', Lemma::POS_VERB)]],
      [['opposes'], [new Lemma('oppose', Lemma::POS_VERB)]],
      [
        ['singing'],
        [
          new Lemma('sing', Lemma::POS_VERB),
          new Lemma('singing', Lemma::POS_NOUN),
          new Lemma('singing', Lemma::POS_ADJECTIVE),
        ],
      ],
      [
        ['dying'],
        [
          new Lemma('die', Lemma::POS_VERB),
          new Lemma('dying', Lemma::POS_NOUN),
          new Lemma('dying', Lemma::POS_ADJECTIVE),
        ],
      ],
      [
        ['after'],
        [
          new Lemma('after', Lemma::POS_ADVERB),
          new Lemma('aft', Lemma::POS_ADVERB),
          new Lemma('after', Lemma::POS_ADJECTIVE),
          new Lemma('aft', Lemma::POS_ADJECTIVE),
        ],
      ],
      [['us'], [new Lemma('us', Lemma::POS_NOUN)]],
    ];
  }

  /**
   * Lemmatizer leaves alone words that its dictionary does not contain.
   *
   * @dataProvider withoutPosProvider
   *
   * @param array $wordWithoutPos
   * @param Lemma[] $expectedResult
   */
  public function testLemmatizationWithoutPos(array $wordWithoutPos, array $expectedResult) {
    $lemmas = self::$lemmatizer->getLemmas(...$wordWithoutPos);
    $message = $this->getMessage($expectedResult, $lemmas);
    $this->assertEquals(count($expectedResult), count($lemmas), $message);
    foreach($expectedResult as $expectedLemma) {
      $this->assertContains($expectedLemma, $lemmas, $message, false, false);
    }
  }

  /**
   * @param Lemma[] $expectedResult
   * @param Lemma[] $actualResult
   *
   * @return string
   */
  private function getMessage(array $expectedResult, array $actualResult) {
    return 'Expected lemmas: ' . implode(', ', $this->getLemmasAsArrayOfStrings($expectedResult)) . "\n"
      . 'Actual lemmas: ' . implode(', ', $this->getLemmasAsArrayOfStrings($actualResult)) . "\n";
  }

  /**
   * @param Lemma[] $lemmas
   *
   * @return string[]
   */
  private function getLemmasAsArrayOfStrings(array $lemmas) {
    $result = [];
    foreach($lemmas as $lemma) {
      $result[] = $lemma->getLemma();
    }

    return $result;
  }
}
